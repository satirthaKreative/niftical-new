<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductAdditionalData extends Model
{
    protected $table = "product_additional_tbl";

    protected $fillable = [
        "product_id", "product_customize_name", "product_customize_link", "user_ip", "user_id", "created_at", "updated_at"
    ];
}
