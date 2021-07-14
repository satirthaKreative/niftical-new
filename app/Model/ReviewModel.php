<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ReviewModel extends Model
{
    //
    protected $table = "reviews_tbl";

    protected $fillable = [
        'product_id', 'review_start_count', 'customer_name', 'customer_msg', 'created_at', 'updated_at'
    ];
}
