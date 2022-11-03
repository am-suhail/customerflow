<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserDetail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'referral_code',
        'user_id',
        'dob',
        'sex',
        'national_id',
        'national_id_expiry',
        'tax_id',
        'tax_id_expiry',
        'country_id',
        'passport',
        'passport_expiry',
        'building_name',
        'city_id',
        'street_id',
        'street_text',
        'area_id',
        'area_text',
        'address',
        'qualification_id',
        'years_of_exp',
        'remark',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'national_id_expiry' => 'date',
        'dob' => 'date',
    ];

    /**
     * Get the user that owns the UserDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the country that owns the UserDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Get the city that owns the UserDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Get the area that owns the UserDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    /**
     * Get the street that owns the UserDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function street(): BelongsTo
    {
        return $this->belongsTo(Street::class);
    }

    /**
     * Get the qualification that owns the UserDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function qualification(): BelongsTo
    {
        return $this->belongsTo(Qualification::class);
    }
}
