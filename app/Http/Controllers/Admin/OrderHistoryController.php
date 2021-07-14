<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\CartModel;
use App\Model\ReviewModel;
use App\Model\ProductModel;
use App\Model\CountryModel;
use App\Model\ProductImageModel;
use App\Model\ProductAdditionalData;
use App\Model\OrderDetailModel;
use App\Model\ShippingModel;
use Auth;

class OrderHistoryController extends Controller
{
    //

    public function index(Request $request)
    {
        return view('backend.pages.order-details');
    }

    public function showActualPage(Request $request)
    {
        $fetchQuery = OrderDetailModel::get();
        $html = "";
        if(count($fetchQuery) > 0)
        {
            $count = 0;
            foreach($fetchQuery as $fQuery)
            {
                $productQuery = ProductModel::where('id',$fQuery->product_id)->get();
                if(count($productQuery) > 0)
                {
                    foreach($productQuery as $pQuery)
                    {
                        $productImage = '<img src="'.str_replace('public','storage/app/public',asset($pQuery->product_thumbnail)).'" alt="no image" width="100px"/>';
                        $productName = $fQuery->product_name;
                    }

                }
                else
                {
                    $productImage = "No image"; 
                }


                if($fQuery->order_status == "placed_ordered")
                {
                    $track_msg = "Placed Ordered";
                }
                else if($fQuery->order_status == "tracking")
                {
                    $track_msg = "Tracking";
                }
                else if($fQuery->order_status == "shipping")
                {
                    $track_msg = "Shipping";
                }
                else if($fQuery->order_status == "completed")
                {
                    $track_msg = "Completed";
                }
                $html .='<tr>
                            <td>'.++$count.'</td>
                            <td>'.$productImage.'</td>
                            <td>'.$fQuery->product_name.'</td>
                            <td>$ '.($fQuery->product_quantity * $fQuery->product_price).'<br/>Product Quantity : '.$fQuery->product_quantity.'</td> 
                            <td>'.$track_msg.'</td>
                            <td><select name="order_track_name" id="order-track-id'.$fQuery->id.'" onchange=order_track_fx('.$fQuery->id.')><option value="">select</option><option value="placed_ordered">Order Placed</option><option value="tracking">Tracking</option><option value="shipping">Shipping</option><option value="completed">Completed</option></select></td>
                        </tr>';
            }
        }
        else
        {
            $html .= '<tr>
                        <td colspan="6"><center class="text-danger"><i class="fa fa-times"></i> No Data</center></td>
                      </tr>';
        }

        echo json_encode($html);
    }

    public function tracking_fx(Request $request)
    {
        $trackingQuery = OrderDetailModel::where('id',$_GET['id'])->update(['order_Status' => $_GET['tracking_id'], 'updated_at' => date('Y-m-d H:i:sa')]);
        $msg = "error";
        if($trackingQuery)
        {
            $msg = "success";
        }
        echo json_encode($msg);
    }
}
