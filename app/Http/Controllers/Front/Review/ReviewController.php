<?php

namespace App\Http\Controllers\Front\Review;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ReviewModel;
use App\Model\ProductModel;
use App\Model\ProductImageModel;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $reviewQuery = ReviewModel::insert([
                                            'product_id' => $_GET['review_product_id'], 
                                            'review_start_count' => $_GET['review_star_count'], 
                                            'customer_name' => $_GET['review_star_name'], 
                                            'customer_msg' => $_GET['review_star_msg'], 
                                            'created_at' => date('Y-m-d'), 
                                            'updated_at' => date('Y-m-d')
                                            ]);
        if($reviewQuery)
        {
            $msg = "success";
        }
        else
        {
            $msg = "error";
        }
        echo json_encode($msg);
    }

    public function review_fx(Request $request)
    {
        $reviewQuery = ReviewModel::where('product_id',$_GET['review_id'])->get();
        $html = "";
        foreach($reviewQuery as $rQuery)
        {

            $countReview =  $rQuery->review_start_count; 
            $fullStarCount = $rQuery->review_start_count;
            $noStarCount = 5 - $rQuery->review_start_count;
            $html_star = "";
            for($i = 0; $i < $fullStarCount; $i++ ){
                $html_star .= '<i class = "fa fa-star" aria-hidden = "true" style="color: yellow"></i>';
            }
            for($j = 0; $j < $noStarCount; $j++ ){
                $html_star .= '<i class = "fa fa-star" aria-hidden = "true"></i>';
            }
            $html .= '<li>
                        <div class="c_img">
                            <img src='.asset("backend/dist/img/avatar5.png").' alt="">
                        </div>
                        <h3>'.$rQuery->customer_name.'</h3>
                        <p>'.$html_star.'</p>
                        <p>'.$rQuery->customer_msg.'</p>';
        }
        echo json_encode($html);               
    }
}
