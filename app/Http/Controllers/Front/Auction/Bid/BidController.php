<?php

namespace App\Http\Controllers\Front\Auction\Bid;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Bid\ProductBidModel;
use App\Model\Auction\AuctionModel;
use App\User;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    // user biiding function

    public function user_bidding_fx(Request $request)
    {
        $checkingBiddingQuery = ProductBidModel::where(['product_id' => base64_decode($_GET['page_product_id']), 'user_id' => $_GET['user_id']])->get();
        if(count($checkingBiddingQuery) > 0)
        {
            $msg = "already";
        }
        else
        {
            $insertArr = [
                "user_id" => $_GET['user_id'], 
                "product_id" => base64_decode($_GET['page_product_id']), 
                "product_name" => $_GET['bid_user_name'], 
                "bid_price" => $_GET['bid_price'], 
                "bid_accept" => "decline", 
                "created_at" => date('Y-m-d H:i:sa'), 
                "updated_at" => date('Y-m-d H:i:sa')
            ];

            $insertQuery =  ProductBidModel::insert($insertArr);

            $msg = "error";
            if($insertQuery)
            {
                $msg = "success";
            }
        }

        echo json_encode($msg);
    }

    public function user_bidding_time_status_fx(Request $request)
    {
        $auctionQuery = AuctionModel::where(['id' => base64_decode($_GET['id'])])->get();
        foreach($auctionQuery as $auctionQ)
        {
            $auctionEndTime = $auctionQ->end_date_time;
        }

        $msg = "ongoing";
            if(strtotime("now") > strtotime($auctionEndTime))
            {
                $msg = "ended";
            }

            echo json_encode($msg);   
    }

    public function bidding_on_this_products_fx(Request $request)
    {
        if(Auth::user())
        {
            $selectQuery = ProductBidModel::where(['product_id' => base64_decode($_GET['id']) ])->where('user_id','!=',Auth::user()->id)->orderBy('id','DESC')->get();
        }
        else
        {
            $selectQuery = ProductBidModel::where(['product_id' => base64_decode($_GET['id']) ])->orderBy('id','DESC')->get();
        }
        $html = "";
        if(count($selectQuery) > 0)
        {
            foreach($selectQuery as $sQuery)
            {
                $uQ = 0.00032*$sQuery->bid_price;
                $userQuery = User::where('id',$sQuery->user_id)->get();
                foreach($userQuery as $uQuery)
                {
                    $userName = $uQuery->name;
                }


                $bid_accept_css = "";
                if($sQuery->bid_accept == "accept")
                {
                    $bid_accept_css = "bid-accept-css-id";
                }
                $html .= '<div class="nd_right_b2_info_con content" id="'.$bid_accept_css.'">
                            <div class="nd_right_b2_info_con1">
                                <img src="'.asset("frontend/images/no-photo.png").'">
                            </div>
                            <div class="nd_right_b2_info_con2">
                                <h3>'.$userName.' <span>'.date('M d,Y h:i A',strtotime($sQuery->created_at)).'</span></h3>
                            </div>
                            <div class="nd_right_b2_info_con3">
                                <h4>'.number_format((float)$uQ, 3, '.','').' <label>ETH</label>
                                <span>$'.$sQuery->bid_price.'</span></h4>
                            </div>
                        </div>';
            }

            if(count($selectQuery) > 3)
            {
                $html .= '<a class="load" href="#" id="loadMore">Load More</a>';
            }
        }
        else
        {
            $html .= '<div class="nd_right_b2_info_con content">
                        <h4>No one bid yet</h4>
                    </div>';
        }

        echo json_encode($html);
    }


    public function auction_ended_action_fx(Request $request)
    {
        $mainQuery = ProductBidModel::where(['product_id' => base64_decode($_GET['id'])])->orderBy('bid_price', 'desc')->limit(1)->get();
        
        if(count($mainQuery) > 0)
        {
            foreach($mainQuery as $mQuery)
            {
                $user_bid_status_query = ProductBidModel::where(['id' => $mQuery->id, 'bid_accept' => 'accept'])->get();
                if(count($user_bid_status_query) > 0)
                {
                    $msg = "updated";
                }
                else
                {
                    $updateArr = [
                        'bid_accept' => 'accept'
                    ];
                    $updateQuery = ProductBidModel::where(['id' => $mQuery->id])->update($updateArr);

                    $msg = "error";
                    if($updateQuery)
                    {
                        $msg = "success";
                    }
                }
            }
        }
        else
        {
            $msg = "noOneBid";
        }

        echo json_encode($msg);
    }
}
