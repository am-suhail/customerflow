<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Branch;
use App\Models\User;

class CustomerFlow extends Model
{
    use HasFactory;

    protected $table = 'customer_flows';

    protected $fillable = [
        'branch_id',
        'date',
        'invoices',
        'loyalty_cards',
        'remark',
        'created_by_id',
    ];

    
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }


    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}

