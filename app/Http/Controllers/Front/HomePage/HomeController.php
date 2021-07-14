<?php

namespace App\Http\Controllers\Front\HomePage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\BannerModel;

class HomeController extends Controller
{
    //
    public function bannerPage(Request $request)
    {
        $bannerQuery = BannerModel::where('admin_status','active')->get();
        $html['banner_html'] = "";
        $html['my_count'] = 0;
        if(count($bannerQuery) > 0)
        {
            $html['my_count'] = count($bannerQuery);
            foreach($bannerQuery as $bQuery)
            {
                $html['banner_html'] .= '<div class="item">
                    <div class="banner">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="bantext">
                                        <h1><span>"'.$bQuery->banner_heading_quote.'"</span>  - '.$bQuery->banner_heading_name.'
                                    </h1>
                                    <p>'.$bQuery->banner_paragraph.'</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 slide_pic">
                                    <img src="'.str_replace("public","storage",asset($bQuery->banner_img)).'" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
            }
        }

        echo json_encode($html);
    }

    
}