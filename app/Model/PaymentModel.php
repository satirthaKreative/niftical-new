<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PaymentModel extends Model
{
    //
    protected $table  = "payment_tbl";

    protected $fillble = [
        'payment_status', 'admin_action'
    ];
}
