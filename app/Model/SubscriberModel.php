<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SubscriberModel extends Model
{
    //
    protected $table = "subscriber_tbls";

    protected $fillable = [
        "subscriber_email_address", "admin_status"
    ];
}
