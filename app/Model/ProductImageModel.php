<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductImageModel extends Model
{
    //
    protected $table = "product_img_tbls";

    protected $fillable = [
        'product_images', 'product_id'
    ];
}
