<?php

namespace App\Model\Auction;

use Illuminate\Database\Eloquent\Model;

class AuctionImgModel extends Model
{
    //
    protected $table = "auction_product_img_tbls";

    protected $fillable = [
        "auction_product_images", "auction_product_id", "created_at", "updated_at"
    ];
}
