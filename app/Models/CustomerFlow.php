<?php

namespace App\Models;

use App\Models\User;
use App\Models\Branch;
use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerFlow extends Model
{
    use HasFactory;

    protected $table = 'customer_flows';
    protected $primaryKey = 'id'; 


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

    
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}

