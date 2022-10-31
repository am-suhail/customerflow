<?php

namespace App\Models;

use App\Traits\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Project extends Model implements Auditable
{
    use HasFactory, SoftDeletes, \OwenIt\Auditing\Auditable;

    const STATUS_ON_GOING = 1;
    const STATUS_PENDING = 2;
    const STATUS_COMPLETED = 3;
    const STATUS_DOCUMENTED = 4;
    const STATUS_INVOICE_ = 5;
    const STATUS_DELAYED = 6;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'inward',
        'code',
        'vendor_id',
        'referral_no',
        'building_name',
        'city_id',
        'area',
        'street',
        'remarks',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'inward' => 'date',
    ];

    public function scopeWithCurrentStatus($query, $status)
    {
        $query->join('project_statuses', 'projects.id', 'project_statuses.project_id')
            ->where('project_statuses.badge', $status)
            ->where('project_statuses.id', function ($query) {
                $query->select('id')
                    ->from('project_statuses')
                    ->whereColumn('project_id', 'projects.id')
                    ->latest()
                    ->limit(1);
            });
    }

    /**
     * Get all of the status for the Project
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function current_status()
    {
        return $this->hasOne(ProjectStatus::class)->latest();
    }

    /**
     * Get all of the status for the Project
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function status()
    {
        return $this->hasMany(ProjectStatus::class);
    }

    /**
     * Get all of the services for the Project
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function services()
    {
        return $this->hasMany(ProjectService::class);
    }

    /**
     * Get the vendor that owns the Project
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    /**
     * Get the area that owns the Project
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
