<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Branch extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    const TYPE_PHYSICAL = 1;
    const TYPE_VIRTUAL = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'name',
        'code',
        'mobile',
        'telephone',
        'email',
        'inc_date',
        'vat',
        'url',
        'country_id',
        'city_id',
        'building_size',
        'rent',
        'total_accomodation',
        'accomodation_rent',
        'total_warehouse',
        'warehouse_rent',
        'emp_male',
        'emp_female',
        'capital',
        'share_value',
        'total_shares',
        'investment_amount',
        'investment_percentage',
        'investment_shares',
        'additional_info',
        'remark',
        'type'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'building_size' => 'integer',
        'capital' => 'integer',
        'total_shares' => 'integer',
        'investment_amount' => 'integer',
        'investment_shares' => 'integer',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty();
    }

    public function getTypeTextAttribute()
    {
        return match ($this->type) {
            self::TYPE_PHYSICAL => 'Physical',
            self::TYPE_VIRTUAL  => 'Virtual',
        };
    }

    /**
     * Get the company that owns the Branch
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    /**
     * Get the country that owns the Branch
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Get the city that Branch is located at.
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Get all of the invoices for the Branch
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }
}
