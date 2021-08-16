<?php

namespace App\Http\Controllers\Front\Auction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\Model\Auction\AuctionImgModel;
use App\Model\Auction\AuctionModel;
use App\Model\CategoryModel;
use App\Model\SubCategoryModel;

use App\Model\Bid\ProductBidModel;

use App\Model\ProductModel;
use App\Model\ProductImageModel;

use App\Model\OrderDetailModel;

use App\User;
use Illuminate\Support\Facades\Auth;

class AuctionListingController extends Controller
{
    // auction listing product 
    public function index(Request $request)
    {
        return view('frontend.pages.auction-product-listing');
    }

    // normal & auction order history
    public function normal_order_history_fx(Request $request)
    {
        // normal order history
        $normalOrderHistoryQuery = OrderDetailModel::where(['user_id' => Auth::user()->id])->get();
        $html['normal_order_history_html'] = '<tr>
                                                <th>image</th>
                                                <th>name</th>
                                                <th>quantity</th>
                                                <th>price</th>
                                            </tr>';
        if(count($normalOrderHistoryQuery) > 0)
        {
            foreach($normalOrderHistoryQuery as $normalOHis)
            {
                $productQuery = ProductModel::where(['id' => $normalOHis->product_id])->get();
                foreach($productQuery as $pQuery)
                {
                    $ProductName = $pQuery->product_name;
                    $ProductImg = str_replace('public','storage/app/public',$pQuery->product_thumbnail);
                    $productPrice = $pQuery->product_price;
                }

                $productQuantity = $normalOHis->product_quantity;

                $html['normal_order_history_html'] .= '<tr>
                                                            <td><img src="'.$ProductImg.'"></td>
                                                            <td>'.ucwords($ProductName).'</td>
                                                            <td>Quantity:'.$productQuantity.'</td>
                                                            <td>Total price: $'.$productPrice*$productQuantity.'<br/>( Single Product Price: $'.$productPrice.' )</td>
                                                        </tr>';
            }
        }
        else
        {
            $html['normal_order_history_html'] .= '<tr>
                                                        <td colspan=4 class="text-danger"><center><i class="fa fa-times"></i> No order placed yet</center></td>
                                                    </tr>';
        }
        
        
        // auction order history
        $auctionOrderHistoryQuery = ProductBidModel::where(['user_id' => Auth::user()->id, 'bid_accept' => 'accept'])->get();
        $html['auction_order_history_html']  =  '<tr>
                                                    <th>image</th>
                                                    <th>name</th>
                                                    <th>price</th>
                                                    <th>Date</th>
                                                </tr>';
        if(count($auctionOrderHistoryQuery) > 0)
        {
            foreach($auctionOrderHistoryQuery as $auctionOHis)
            {

                $auctionProdId = $auctionOHis->product_id;
                $auctionProductQuery = AuctionModel::where(['id' => $auctionProdId])->get();
                foreach($auctionProductQuery as $auctionP)
                {
                    $auctionProductName = $auctionP->product_name;
                    $auctionProductImg = str_replace('public','storage/app/public',$auctionP->product_thumbnail);
                    
                }
                $auctionProductPrice = "$".$auctionOHis->bid_price;
                $auctionOwnDate = date('M d,Y',strtotime($auctionOHis->created_at));

                $html['auction_order_history_html'] .= '<tr>
                                                            <td><img src="'.$auctionProductImg.'"></td>
                                                            <td>'.$auctionProductName.'</td>
                                                            <td>'.$auctionProductPrice.'</td>
                                                            <td>'.$auctionOwnDate.'</td>
                                                        </tr>';
            }
        }
        else
        {
            $html['auction_order_history_html'] .= '<tr>
                                                        <td colspan=4 class="text-danger"><center><i class="fa fa-times"></i> No auction product in your bag yet</center></td>
                                                    </tr>';
        }


        echo json_encode($html);
    }

    public function auctionListedProductsFx(Request $request)
    {
        if($_GET['id'] == "newAuction")
        {
            $auctionQuery = AuctionModel::orderBy('id','Desc')->get();
        }
        else if($_GET['id'] == "oldAuction")
        {
            $auctionQuery = AuctionModel::orderBy('id','Asc')->get();
        }
        else
        {
            $auctionQuery = AuctionModel::orderBy('id','Desc')->get();
        }
        
        $html['auctionHtml'] = "";
        if(count($auctionQuery) > 0)
        {
            foreach($auctionQuery as $auctionQ)
            {
                $categoryQuery = CategoryModel::where('id',$auctionQ->category_id)->get();
                foreach($categoryQuery as $categoryQ)
                {
                    $category_name = ucwords($categoryQ->category_name);
                }

                $date1 = $auctionQ->created_at;
                $date2 = $auctionQ->end_date_time;
                $seconds = strtotime($date2) - strtotime($date1);
                $hours = $seconds / 60 /  60;

                $date_now = date('Y-m-d H:i:s');
                $seconds2 = strtotime($date2) - strtotime($date_now);
                $hours2 = $seconds2 / 60 /  60;

                $html['auctionHtml'] .= '<div class="col-lg-12 pl_con">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-5">
                                                    <img src="'.str_replace('public','storage/app/public',asset($auctionQ->product_thumbnail)).'" alt="">
                                                </div>
                                                <div class="col-lg-8 col-md-7">
                                                    <h2>'.ucwords($auctionQ->product_name).'</h2>
                                                    <h4>Category : <span>'.ucwords($category_name).'</span></h4>
                                                    <div class="progress">
                                                        <div class="progress-bar" id="progress-bar" style="width: '.(($hours2*100)/$hours).'%;"></div>
                                                    </div>
                                                    <h5>Posted on : <span>'.date('M d,Y',strtotime($auctionQ->created_at)).'</span></h5>
                                                    <p>'.$auctionQ->product_short_description.'</p>
                                                    <a class="view_ad" href="'.url('auction-products-details/'.base64_encode($auctionQ->id)).'">View Auction Details</a>
                                                </div>
                                            </div>
                                        </div>';
            }
        }
        echo json_encode($html);
    }
}
