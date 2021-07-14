<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $table = "product_tbls";

    protected $fillable = [
        'category_id', 'sub_category_id', 'product_name', 'product_price', 'product_short_description', 'product_full_description', 'product_additional_information', 'product_unique_code', 'product_stock', 'product_thumbnail', 'product_available_status', 'admin_status'
    ];
}
