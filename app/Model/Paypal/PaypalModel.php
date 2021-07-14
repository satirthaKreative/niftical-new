<?php

namespace App\Model\Paypal;

use Illuminate\Database\Eloquent\Model;

class PaypalModel extends Model
{
    //
    protected $table = "payments";

    protected $fillable = [
        "order_id", "user_id", "payment_id", "payer_id", "payer_email", "amount", "currency", "payment_status", "created_at", "updated_at"
    ];
}
