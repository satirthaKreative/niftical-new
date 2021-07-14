<?php

namespace App\Http\Controllers\Front\Auction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Auction\AuctionImgModel;
use App\Model\Auction\AuctionModel;
use App\Model\CategoryModel;
use App\Model\SubCategoryModel;

class AuctionController extends Controller
{
    // auction @index

    public function index(Request $request)
    {
        return view('frontend.pages.auction-product');
    }


    // auction order @index
    
    public function auction_order_index(Request $request)
    {
        return view('frontend.pages.auction-order-details');
    }

    // auction @home

    public function auction_home_fx(Request $request)
    {
        $auctionQuery = AuctionModel::all();
        $html['auctionHtml'] = "";
        if(count($auctionQuery) > 0)
        {
            foreach($auctionQuery as $auctionQ)
            {
                $html['auctionHtml'] .= '<div class="col-lg-4 col-md-4">
                                            <div class="m_cat_info">
                                                <img src="'.str_replace('public','storage/app/public',asset($auctionQ->product_thumbnail)).'">
                                                    <h2>'.$auctionQ->product_name.'</h2>
                                                    <div class="progress">
                                                    <div class="progress-bar" id="progress-bar" style="width: 13.7722%;"></div>
                                                    </div>
                                                <a href="'.url('auction-products-details/'.base64_encode($auctionQ->id)).'">View Details</a>
                                            </div>
                                        </div>';
            }
        }
        echo json_encode($html);
    }

    // auction @order details
    public function auction_order_details_fx(Request $request)
    {
        $auctionQuery = AuctionModel::where('id',base64_decode($_GET['id']))->get();
        $html['auctionHtml'] = "";
        if(count($auctionQuery) > 0)
        {
            foreach($auctionQuery as $auctionQ)
            {
                $html['auctionProductName'] = $auctionQ->product_name;
                $html['auctionShortDesc'] = $auctionQ->product_short_description;
                $html['auctionFullDesc'] = $auctionQ->product_full_description;
                $html['auctionAnotherDesc'] = $auctionQ->product_additional_information;
                $html['auctionHeading'] = $auctionQ->product_name;
                $html['auctionHtml'] .= '<div class="item">
                                            <img src="'.str_replace('public','storage/app/public',asset($auctionQ->product_thumbnail)).'">
                                        </div>';
                $subAuctionQuery = AuctionImgModel::where('auction_product_id',$auctionQ->id)->get();
                foreach($subAuctionQuery as $sAuctionQ)
                {
                    $html['auctionHtml'] .= '<div class="item">
                                                <img src="'.str_replace('public','storage/app/public',asset($sAuctionQ->auction_product_images)).'">
                                            </div>';
                }
            }
        }
        echo json_encode($html);
    }
}
