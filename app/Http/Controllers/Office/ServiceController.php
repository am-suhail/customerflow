<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\BaseController;
use App\Models\Service;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->setPageTitle('Products', '');
        return view('office.service.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $units = Unit::pluck('name', 'id');

        $this->setPageTitle('Add Product', '');
        return view('office.service.create', compact('units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:191'],
            'sub_category_id' => ['required', 'not_in:0'],
            'unit_id' => ['required', 'not_in:0'],
            'selling_price' => ['required', 'numeric'],
            'cost_one' => ['nullable', 'numeric'],
            'cost_one_desc' => ['nullable', 'string', 'max:191'],
            'cost_two' => ['nullable', 'numeric'],
            'cost_two_desc' => ['nullable', 'string', 'max:191'],
        ]);

        $code = 'PR-' . mt_rand(111111111, 999999999);
        $validated['code'] = $code;

        $created = Service::create($validated);

        if (!$created) {
            return $this->responseRedirectBack('Something went wrong', 'warning', true, true);
        }

        return $this->responseRedirect('service.index', 'Service Added', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('home');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        $units = Unit::pluck('name', 'id');

        $this->setPageTitle('Edit ' . Str::limit($service->name, 12, '..'), '');
        return view('office.service.edit', compact('service', 'units'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:191'],
            'sub_category_id' => ['required', 'not_in:0'],
            'unit_id' => ['required', 'not_in:0'],
            'selling_price' => ['required', 'numeric'],
            'cost_one' => ['nullable', 'numeric'],
            'cost_one_desc' => ['nullable', 'string', 'max:191'],
            'cost_two' => ['nullable', 'numeric'],
            'cost_two_desc' => ['nullable', 'string', 'max:191'],
        ]);

        $service = Service::findOrFail($id);
        $updated = $service->update($validated);

        if (!$updated) {
            return $this->responseRedirectBack('Something went wrong, could not update the service at this moment', 'warning', true, true);
        }

        return $this->responseRedirect('service.index', 'Service Updated', 'success');
    }
}
