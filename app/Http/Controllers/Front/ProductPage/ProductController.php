<?php

namespace App\Http\Controllers\Front\ProductPage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ProductModel;
use App\Model\ProductImageModel;

class ProductController extends Controller
{
    //

    public function productsPage(Request $request)
    {
        return view('frontend.pages.product');
    }


    public function allProducts(Request $request)
    {
        $allProductQuery = ProductModel::where('admin_status','active')->get();

        $html['product_datas'] = "";
        if(count($allProductQuery) > 0)
        {
            foreach($allProductQuery as $allProduct)
            {
                // <a href="#" data-toggle="modal" data-target="#myModal2">Order Now</a>
                $html['product_datas'] .= '<div class="col-md-3 col-sm-3 col-6">
                                            <div class="feature_pic">
                                                <div class="feature_pic_con">
                                                    <img src="'.str_replace('public','storage/app/public',asset($allProduct->product_thumbnail)).'">
                                                    <div class="hov-but">
                                                        <a href="'.route("satirtha.show-single-product",['val2' => base64_encode($allProduct->id)]).'">Product Details</a>
                                                    </div>
                                                </div>
                                                <h3>'.ucwords($allProduct->product_name).'</h3>
                                            </div>
                                        </div>';
            }
        }

        echo json_encode($html);
    }

    public function load_modal_product_data(Request $request)
    {
        $allProductQuery = ProductModel::where('admin_status','active')->get();
        $html['product_names'] = '<option value="">Choose product</option>';
        if(count($allProductQuery) > 0)
        {
            foreach($allProductQuery as $allProduct)
            {
                $html['product_names'] .= '<option value="'.ucwords($allProduct->product_name).'">'.ucwords($allProduct->product_name).'</option>';
            }
        }

        echo json_encode($html);
    }
}
