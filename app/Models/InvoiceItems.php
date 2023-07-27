<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class InvoiceItems extends Model
{
    use HasFactory, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice_id',
        'sub_category_id',
        'revenue_type_id',
        'unit_price',
        'qty',
        'discount',
        'tax',
        'tax_option_id',
        'non_trade_revenue',
        'additional_charge',
        'total'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty();
    }

    /**
     * Get the unit_price
     *
     * @param  string  $value
     * @return float
     */
    public function getUnitPriceAttribute($value)
    {
        if (is_null($this->custom_price) || $this->custom_price == 0) {
            return $value;
        }

        return $this->custom_price / $this->qty;
    }

    /**
     * Get the invoice that owns the InvoiceItems
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    /**
     * Get the subcategory that owns the InvoiceItems
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id', 'id');
    }

    /**
     * Get the tax_option that owns the InvoiceItems
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tax_option(): BelongsTo
    {
        return $this->belongsTo(TaxOption::class);
    }
}
