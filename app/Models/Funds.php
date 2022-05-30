<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funds extends Model {
    use HasFactory;

    protected $guarded = ['id'];

    public function member() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function months() {
        return $this->belongsTo(Month::class, 'month');
    }

    public function payment_methods() {
        return $this->belongsTo(PaymentMethod::class, 'payment_method');
    }
}
