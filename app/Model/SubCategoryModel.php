<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SubCategoryModel extends Model
{
    //
    protected $table = "sub_category_tbls";

    protected $fillable = [
        'category_id', 'sub_category_name', 'sub_category_quote', 'admin_status'
    ];
}
