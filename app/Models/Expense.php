<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number',
        'branch_id',
        'sub_category_id',
        'entry_type_id',
        'document_date',
        'document_number',
        'accounting_date',
        'amount',
        'tax_option_id',
        'payment_mode',
        'description',
        'created_by',
        'additional_info',
        'remark',
        'type',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'accounting_date' => 'date',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty();
    }

    /**
     * Get the taxCalc
     *
     * @param  string  $value
     * @return string
     */
    public function getTaxCalcAttribute()
    {
        $tax_percentage = $this->tax->value ?? 0;
        $amount = $this->amount;

        if ($tax_percentage == 0) {
            return 0;
        }

        $tax = ($amount * $tax_percentage) / 100;

        return number_format($tax, 2, '.', '');
    }

    /**
     * Get the creator that owns the Expense
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    /**
     * Get the sub_category that owns the Expense
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sub_category(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class);
    }

    /**
     * Get the branch that owns the Expense
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Get the entry_type that owns the Expense
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entry_type(): BelongsTo
    {
        return $this->belongsTo(TransactionEntryType::class, 'entry_type_id', 'id');
    }

    /**
     * Get the tax that owns the Expense
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tax(): BelongsTo
    {
        return $this->belongsTo(TaxOption::class, 'tax_option_id', 'id');
    }
}
