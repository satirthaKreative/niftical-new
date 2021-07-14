<?php

namespace App\Model\Auction;

use Illuminate\Database\Eloquent\Model;

class AuctionModel extends Model
{
    protected $table = "auction_product_tbls";

    protected $fillable = [
        "category_id", "sub_category_id", "product_name", "product_short_description", "product_full_description", "product_additional_information", "product_unique_code", "product_thumbnail", "auction_time", "product_available_status", "admin_status", "created_at", "updated_at"
    ];
}
