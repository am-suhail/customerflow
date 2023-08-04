<?php

namespace App\Http\Controllers\Office;

use App\Exceptions\ProductTypeNotFoundException;
use App\Http\Controllers\BaseController;
use App\Imports\RevenueImport;
use App\Models\Branch;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\InvoiceItems;
use App\Models\RevenueType;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class RevenueUploadController extends BaseController
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->setPageTitle('Revenue - Import', 'Easily import revenue using Excel Format');
        return view('office.invoice.import');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'revenue_file' => 'required|file',
        ]);

        try {
            $subcategory_lists = SubCategory::whereHas('category', fn ($q) => $q->where('type', Category::TYPE_PRODUCT))
                ->get()
                ->pluck('id', 'name');
            $branches = Branch::all(['id', 'name'])->pluck('id', 'name');
            $revenue_types = RevenueType::all(['id', 'name'])->pluck('id', 'name');

            $invoices = Excel::toCollection(new RevenueImport, $request->file('revenue_file'));
        } catch (\Throwable $th) {
            return $this->responseRedirectBack($th->getMessage(), 'warning', false, true);
        }

        DB::beginTransaction();

        try {
            $iteration_count = 0;

            foreach ($invoices as $invoice) {
                foreach ($invoice as $single_invoice) {
                    $iteration_count++;

                    try {
                        $branch_id = $branches[$single_invoice['branch']];
                        if (!$branch_id) {
                            throw new ProductTypeNotFoundException("Branch Not Found: " . $single_invoice['branch']);
                        }
                    } catch (\Exception $e) {
                        if ($e instanceof ProductTypeNotFoundException) {
                            return $this->responseRedirectBack($e->getMessage() . ' on row ' . $iteration_count, 'warning', false, true);
                        } else {
                            return $this->responseRedirectBack("An error occurred while processing Branch: " . $single_invoice['branch'] . ' on row ' . $iteration_count, 'warning', false, true);
                        }
                    }

                    try {
                        $revenue_type_id = $revenue_types[$single_invoice['category']];
                        if (!$revenue_type_id) {
                            throw new ProductTypeNotFoundException("Revenue Type Not Found: " . $single_invoice['category']);
                        }
                    } catch (\Exception $e) {
                        if ($e instanceof ProductTypeNotFoundException) {
                            return $this->responseRedirectBack($e->getMessage() . ' on row ' . $iteration_count, 'warning', false, true);
                        } else {
                            return $this->responseRedirectBack("An error occurred while processing Revenue Type: " . $single_invoice['category'] . ' on row ' . $iteration_count, 'warning', false, true);
                        }
                    }

                    try {
                        $subcategory_id = $subcategory_lists[$single_invoice['sub_category']];
                        if (!$subcategory_id) {
                            throw new ProductTypeNotFoundException("Sub Category Not Found: " . $single_invoice['sub_category']);
                        }
                    } catch (\Exception $e) {
                        if ($e instanceof ProductTypeNotFoundException) {
                            return $this->responseRedirectBack($e->getMessage() . ' on row ' . $iteration_count, 'warning', false, true);
                        } else {
                            return $this->responseRedirectBack("An error occurred while processing Sub Category: " . $single_invoice['sub_category'] . ' on row ' . $iteration_count, 'warning', false, true);
                        }
                    }

                    $invoice_data = [
                        'number' => $this->invoice_number(),
                        'branch_id' => $branch_id,
                        'date' => Date::excelToDateTimeObject($single_invoice['date']),
                        'total_tax' => 0,
                        'total_amount' => $single_invoice['total'],
                    ];

                    $invoice = Invoice::create($invoice_data);

                    $invoice_item_data = [
                        'invoice_id' => $invoice->id,
                        'sub_category_id' => $subcategory_id,
                        'revenue_type_id' => $revenue_type_id,
                        'unit_price' => $single_invoice['taxable_amount'],
                        'qty' => 1,
                        'discount' => $single_invoice['tax'],
                        'tax' => 0,
                        'total' => $single_invoice['total'],
                    ];

                    $invoice_item = InvoiceItems::create($invoice_item_data);
                }
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->responseRedirectBack("Something went wrong! while processing your request on row " . ($iteration_count ?? "--"), 'warning', false, true);
        }

        return $this->responseRedirectBack('Revenue Data Uploaded!', 'success');
    }

    private function invoice_number()
    {
        $lastInvoice = Invoice::latest()->first();
        $lastCode = preg_replace('~\D~', '', $lastInvoice ? $lastInvoice->number : '#INV-000000');
        $code = str_pad($lastCode + 1, 6, "0", STR_PAD_LEFT);
        $newNumber = '#INV-' . $code;

        return $newNumber;
    }
}
