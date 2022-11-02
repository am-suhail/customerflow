<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    use HasFactory;

    const TYPE_REG = 1;
    const TYPE_BASIC = 2;

    const STATUS_SENT = 1;
    const STATUS_PAID = 2;
    const STATUS_OVERDUE = 3;
    const STATUS_VOID = 4;
    const STATUS_DRAFT = 5;

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
