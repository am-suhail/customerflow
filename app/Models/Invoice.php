<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;


class Invoice extends Model
{
    use HasFactory, LogsActivity;

    const TYPE_REG = 1;
    const TYPE_BASIC = 2;

    const STATUS_SENT = 1;
    const STATUS_PAID = 2;
    const STATUS_OVERDUE = 3;
    const STATUS_VOID = 4;
    const STATUS_DRAFT = 5;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number',
        'vendor_id',
        'date',
        'total_discount',
        'total_tax',
        'total_amount',
        'additional_info',
        'type',
        'status',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty();
    }

    

    /**
     * Get the vendor that owns the Invoice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    /**
     * Get all of the items for the Invoice
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(InvoiceItems::class);
    }
}
