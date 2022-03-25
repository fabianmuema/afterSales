<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['total_transactions', 'total_amount'];

    public function payments()
    {
        return $this->hasMany(Payment::class, 'customer_email', 'email');
    }

    public function getTotalTransactionsAttribute() {
        return $this->payments()->count();
    }

    public function getTotalAmountAttribute() {
        return $this->payments()->sum('amount');
    }
}
