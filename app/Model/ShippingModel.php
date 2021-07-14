<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ShippingModel extends Model
{
    //

    protected $table = "billing_address_tbl";

    protected $fillable = [
        "user_id", "first_name", "last_name", "company_name", "country_name", "street_one", "street_two", "city_name", "zip_code", "phone_num", "email_address", "admin_action", "created_at", "updated_at"
    ];
}
