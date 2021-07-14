<?php

namespace App\Http\Controllers\Front\ProductPage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\CartModel;
use App\Model\ProductModel;
use App\Model\ProductImageModel;
use App\Model\ReviewModel;
use Auth;
use App\Model\ProductAdditionalData;

class ProductDetailsController extends Controller
{
    //

    public function index(Request $request, $val2)
    {
        $p_id = base64_decode($val2);
        $productSingleQuery = ProductModel::where('id',$p_id)->get();
        $productSingleImgsQuery = ProductImageModel::where('product_id',$p_id)->get();
        $reviewQuery = ReviewModel::where('product_id',$p_id)->get();

        return view('frontend.pages.product-details',compact('productSingleQuery','productSingleImgsQuery','reviewQuery'));
    }

    public function review_star_count(Request $rqeuest)
    {
        $reviewQuery = ReviewModel::where('product_id',$_GET['productId'])->get();

        if(count($reviewQuery) > 0)
        {
            $sum = 0;
            foreach($reviewQuery as $rQuery)
            {
                $sum += $rQuery->review_start_count;
            }

            $countInStar =   round($sum/count($reviewQuery));

            $actualTotalStar = 5;

            $restBlackStar = $actualTotalStar - $countInStar;

            $html = "";

            for($i=0; $i<$countInStar; $i++)
            {
                $html .= '<li><i class="fa fa-star"></i></li>';
            }

            for($i=0; $i<$restBlackStar; $i++)
            {
                $html .= '<li><i class="fa fa-star" style="color: #ccc"></i></li>';
            }
            $html .= '<li><span>'.count($reviewQuery).' customer ratings</span></li>';
            // echo json_encode(count($reviewQuery));
        }
        else
        {
            $html = '';
            for($i=0; $i < 5; $i++)
            {
                $html .= '<li><i class="fa fa-star" style="color: #ccc"></i></li>';
            }
            $html .= '<li><span>0 customer ratings</span></li>';
        }
        echo json_encode($html);
    }


    public function product_details_additional_functional_fx(Request $request)
    {
        if(Auth::user())
        {
            $user_id = Auth::user()->id;
            $user_ip = $_SERVER['REMOTE_ADDR'];
            $countQuery = ProductAdditionalData::where(['product_id' => $request->input('product_id'), 'user_id' => Auth::user()->id])->count();

            if($countQuery > 0)
            {
                $updateQuery = ProductAdditionalData::where(['product_id' => $request->input('product_id'), 'user_id' => Auth::user()->id])->update(['additional_status' => 'off']);
            }
        }
        else
        {
            $user_id = 0;
            $user_ip = $_SERVER['REMOTE_ADDR'];
            $countQuery = ProductAdditionalData::where(['product_id' => $request->input('product_id'), 'user_ip' => $_SERVER['REMOTE_ADDR']])->count();

            if($countQuery > 0)
            {
                $updateQuery = ProductAdditionalData::where(['product_id' => $request->input('product_id'), 'user_ip' => $_SERVER['REMOTE_ADDR']])->update(['additional_status' => 'off']);
            }
        }
        $insertArr = [
            "product_id" => $request->input('product_id'), 
            "product_customize_name" => $request->input('product_customize_name'), 
            "product_customize_link" => $request->input('product_customize_link'), 
            "user_ip" => $user_ip, 
            "user_id" => $user_id, 
            "created_at" => date('Y-m-d'), 
            "updated_at" => date('Y-m-d')
        ];
        $productAdditionalQuery = ProductAdditionalData::insert($insertArr);
        if($productAdditionalQuery)
        {
            $selectProduct = ProductModel::where('id',$request->input('product_id'))->get();
            foreach($selectProduct as $sProduct)
            {
                $product_name = $sProduct->product_name;
                $product_price = $sProduct->product_price;
            }

            $selectProductAdditional = ProductAdditionalData::where(['product_id' => $request->input('product_id'), 'user_ip' => $_SERVER['REMOTE_ADDR']])->orderBy('id','DESC')->limit(1)->get();
            foreach($selectProductAdditional as $sProductA)
            {
                $product_additional_id = $sProductA->id;
            }
            $cartInsertArr = [
                "user_id" => $user_id, 
                "user_ip" => $user_ip,
                "product_id" => $request->input('product_id'), 
                "product_name" => $product_name, 
                "additional_product_id" => $product_additional_id, 
                "product_price" => $product_price, 
                "product_quantity" => 1, 
                "admin_action" => 'active', 
                "created_at" => date('Y-m-d'), 
                "updated_at" => date('Y-m-d')
            ];
            $cartInsertQuery = CartModel::insert($cartInsertArr);
            return redirect()->route('satirtha.show-cart-page');
        }
        else
        {
            $request->session()->flash('error_msg', 'Something went wrong! product not added');
            return redirect()->back();
        }
        
        
    }

    public function additional_product_skip_fx(Request $request)
    {
        if(Auth::user())
        {
            $user_id = Auth::user()->id;
            $user_ip = $_SERVER['REMOTE_ADDR'];
        }
        else
        {
            $user_id = 0;
            $user_ip = $_SERVER['REMOTE_ADDR'];
        }

        $selectProduct = ProductModel::where('id',$_GET['pId'])->get();
        foreach($selectProduct as $sProduct)
        {
            $product_name = $sProduct->product_name;
            $product_price = $sProduct->product_price;
        }
        if(Auth::user())
        {
            $countGetCartQuery = CartModel::where(["user_id" => $user_id, "product_id" => $_GET['pId'], "additional_product_id" => 0])->get();
        }
        else
        {
            $countGetCartQuery = CartModel::where(["user_ip" => $user_ip, "product_id" => $_GET['pId'], "additional_product_id" => 0])->get();
        }

        if(count($countGetCartQuery) > 0)
        {
            if(Auth::user())
            {
                $lastCartQuery = CartModel::where(["user_id" => $user_id, "product_id" => $_GET['pId'], "additional_product_id" => 0])->get();
            }
            else
            {
                $lastCartQuery = CartModel::where(["user_ip" => $user_ip, "product_id" => $_GET['pId'], "additional_product_id" => 0])->get();
            }
            foreach($lastCartQuery as $lCQuery)
            {
                $productQueryCount = $lCQuery->product_quantity + 1;
                $cart_id = $lCQuery->id;
            }

            $cartInsertArr = [
                "product_quantity" => $productQueryCount
            ];
            $cartInsertQuery = CartModel::where('id',$cart_id)->update($cartInsertArr);
        }
        else
        {
           
            $cartInsertArr = [
                "user_id" => $user_id, 
                "user_ip" => $user_ip,
                "product_id" => $_GET['pId'], 
                "product_name" => $product_name, 
                "additional_product_id" => 0, 
                "product_price" => $product_price, 
                "product_quantity" => 1, 
                "admin_action" => 'active', 
                "created_at" => date('Y-m-d'), 
                "updated_at" => date('Y-m-d')
            ];
            $cartInsertQuery = CartModel::insert($cartInsertArr);
            
        }
        
        
        if($cartInsertQuery)
        {
            $msg = "success";
        }
        else
        {
            $msg = "error";
        }

        echo json_encode($msg);
    
    }


    public function show_additional_product_details_fx(Request $request)
    {
        $product_id = $_GET['pId'];
        

            $selectQuery = ProductAdditionalData::where(['product_id' => $product_id, 'user_ip' => $_SERVER['REMOTE_ADDR'], 'additional_status' => 'on'])->get();
            $html['custom_name'] = "";
            $html['custom_link'] = "";
            if(count($selectQuery) > 0)
            {
                foreach($selectQuery as $sQuery)
                {
                    $html['custom_name'] = $sQuery->product_customize_name;
                    $html['custom_link'] = $sQuery->product_customize_link;
                }
            }

        echo json_encode($html);
    }


    
}