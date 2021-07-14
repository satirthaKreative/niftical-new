<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    //
    protected $table = "product_category";

    protected $fillable = [
        'category_name', 'category_quote', 'admin_status'
    ];
}
