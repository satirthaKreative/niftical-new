<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CartModel extends Model
{
    protected $table = "cart_tbls";

    protected $fillable = [
        "user_id", "user_ip", "product_id", "product_name", "additional_product_id", "product_price", "product_quantity", "admin_action", "created_at", "updated_at"
    ];
}
