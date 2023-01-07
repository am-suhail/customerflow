<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sub_category_id',
        'name',
        'inc_date',
        'inc_number',
        'country_id',
        'industry_id',
        'tax_number',
        'website',
        'telephone',
        'email',
        'additional_info',
        'remark'
    ];
}
