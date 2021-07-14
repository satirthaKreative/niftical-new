<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BannerModel extends Model
{
    //
    protected $table = "banner_tbl";

    protected $fillable = [
        "banner_heading_quote", "banner_heading_name", "banner_paragraph", "banner_img", "admin_status", "created_at", "updated_at"
    ];
}
