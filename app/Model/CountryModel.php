<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CountryModel extends Model
{
    //
    protected $table = "country";

    protected $fillable = [
        "iso", "name", "nicename", "iso3", "numcode", "phonecode"
    ];
}
