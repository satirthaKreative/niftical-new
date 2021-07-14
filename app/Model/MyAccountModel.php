<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MyAccountModel extends Model
{
    protected $table = "accountfulltbl";

    protected $fillable = [
        'user_id', 'phone_num', 'country_phone_num', 'user_birth', 'user_street', 'user_city', 'user_state', 'user_state_code', 'zipcode', 'admin_action', 'admin_comments', 'created_at', 'updated_at'
    ];
}
