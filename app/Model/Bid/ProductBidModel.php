<?php

namespace App\Model\Bid;

use Illuminate\Database\Eloquent\Model;

class ProductBidModel extends Model
{
    protected $table = "bid_product_tbls";

    protected $fillable = [
        "user_id", "product_id", "product_name", "bid_price", "bid_accept", "created_at", "updated_at"
    ];
}
