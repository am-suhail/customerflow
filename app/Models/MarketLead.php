<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MarketLead extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'designation',
        'languages',
        'company_name',
        'industry_id',
        'email',
        'mobile',
        'landline',
        'alternate_number',
        'country_id',
        'city_id',
        'area',
        'street',
        'address',
        'user_id',
        'date',
        'sub_category_id',
        'service_id',
        'demo_presented',
        'feedback',
        'follow_up_status_id',
        'remarks',
        'lead_type',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'date',
    ];

    /**
     * Get the user that owns the MarketLead
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the country that owns the MarketLead
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Get the city that owns the MarketLead
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Get the sub_category that owns the MarketLead
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sub_category(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class);
    }

    /**
     * Get the follow_up_status that owns the MarketLead
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function follow_up_status(): BelongsTo
    {
        return $this->belongsTo(FollowUpStatus::class);
    }
}
