<?php

namespace App\Models;

use App\Traits\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Service extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
        'sub_category_id',
        'unit_id',
        'selling_price',
        'cost_one',
        'cost_one_desc',
        'cost_two',
        'cost_two_desc',
        'cost_three',
        'cost_three_desc',
        'comment',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty();
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'cost_one' => 'float',
        'cost_two' => 'float',
    ];

    /**
     * Get the subcategory that owns the Service
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id', 'id');
    }

    /**
     * Get the unit that owns the Service
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    /**
     * Get all of the invoice_items for the Service
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invoice_items(): HasMany
    {
        return $this->hasMany(InvoiceItems::class);
    }
}
