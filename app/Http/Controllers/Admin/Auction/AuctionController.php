<?php

namespace App\Http\Controllers\Admin\Auction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Auction\AuctionImgModel;
use App\Model\Auction\AuctionModel;
use App\Model\CategoryModel;
use App\Model\SubCategoryModel;

class AuctionController extends Controller
{
    //

    public function index(Request $request)
    {
        return view('backend.pages.auction.auction-product-view');
    }


    /// all product details

    public function product_details_fx(Request $request)
    {
        $auction_product_query = AuctionModel::get();
        $html['product_full_data'] = "";

        if(count($auction_product_query) > 0)
        {
            $i = 0;
            foreach($auction_product_query as $getP)
            {

                // product name
                $product_name = ucwords($getP->product_name);

                // product image 
                $product_thumbnails = '<img src="'.str_replace('public','storage',asset($getP->product_thumbnail)).'"  alt="no image" width="100px" height="100px" />';
                
                // admin action
                if($getP->admin_status == "active"){
                    $cateAdminStatus = "<span class='text-success'><i class='fa fa-check'></i> Active</span>";
                }else if($getP->admin_status == "inactive"){
                    $cateAdminStatus = "<span class='text-danger'><i class='fa fa-times'></i> Deactive</span>";
                }else{
                    $cateAdminStatus = "<span class='text-danger'><i class='fa fa-times'></i> No defined</span>";
                }

                // admin action status
                if($getP->admin_status == "active")
                {
                    $btn_html = "<button type='button' class='btn btn-danger btn-sm' onclick=change_action(".$getP->id.",'inactive')>Deactive</button>&nbsp;&nbsp;&nbsp;<button type='button' class='btn btn-info btn-sm' onclick=edit_action(".$getP->id.")>Edit</button>&nbsp;&nbsp;&nbsp;<button type='button' class='btn btn-danger btn-sm' onclick=del_action(".$getP->id.")>Delete</button>";
                }
                else if($getP->admin_status == "inactive")
                {
                    $btn_html = "<button type='button' class='btn btn-success btn-sm' onclick=change_action(".$getP->id.",'active')>Active</button>&nbsp;&nbsp;&nbsp;<button type='button' class='btn btn-info btn-sm' onclick=edit_action(".$getP->id.")>Edit</button>&nbsp;&nbsp;&nbsp;<button type='button' class='btn btn-danger btn-sm' onclick=del_action(".$getP->id.")>Delete</button>";
                }
                else
                {
                    $btn_html = "<button type='button' class='btn btn-success btn-sm' onclick=change_action(".$getP->id.",'active')>Active</button> | <button type='button' class='btn btn-danger btn-sm' onclick=change_action(".$getP->id.",'inactive')>Deactive</button> | <button type='button' class='btn btn-info btn-sm' onclick=edit_action(".$getP->id.")>Edit</button> | <button type='button' class='btn btn-danger btn-sm' onclick=del_action(".$getP->id.")>Delete</button>";
                }

                /// product available
                $avail = $getP->auction_time;


                /// product description
                if(strlen($getP->product_short_description) > 40)
                {
                    $product_s_des = substr($getP->product_short_description,0,39)." ...";
                }
                else
                {
                    $product_s_des = $getP->product_short_description;
                }

                $html['product_full_data'] .= '<tr>
                            <td>'.++$i.'</td>
                            <td>'.$product_thumbnails.'</td>
                            <td>'.$product_name.'</td>
                            <td>'.$product_s_des.'</td>
                            <td>'.$avail.' hrs</td>
                            <td>'.$cateAdminStatus.'</td>
                            <td>'.$btn_html.'</td>
                        </tr>';
                $html['action_type'] = "yes";
            }
        }
        else
        {
            $html['action_type'] = "no";
            $html['product_full_data'] .= '<tr><td colspan="7"><center class="text-danger"><i class="fa fa-times"></i> No Auction Product</center></td></tr>';
        }

        echo json_encode($html);
    }


    public function product_details_add_fx(Request $request)
    {
        $unique_folder_id = "auction".rand(01,99999);
        $product_unique_code = rand(10000000,99999999);
        $category_id = $request->input('category_name');
        $sub_category_id = $request->input('sub_category_name');
        $product_name = $request->input('product_name');
        $auction_time = $request->input('product_auction_timing');
        $product_short_description = $request->input('product_short_description');
        $product_description = $request->input('product_description');
        $product_addtional_description = $request->input('product_additional_details');
        // product thumbnail 
        $product_thumbnail = "";
        if($request->hasFile('product_thumbnail_name'))
        {
            $product_thumbnail = $request->file('product_thumbnail_name')->store('public/auction/thumbnail');
        }
        // product insert 
        $productArr = [
            'category_id' => $category_id, 
            'sub_category_id' => $sub_category_id, 
            'product_name' => $product_name, 
            'product_short_description' => $product_short_description, 
            'product_full_description' => $product_description, 
            'product_additional_information' => $product_addtional_description, 
            'product_unique_code' => $product_unique_code, 
            'auction_time' => $auction_time, 
            'product_thumbnail' => $product_thumbnail, 
            'product_available_status' => 'available', 
            'admin_status' => 'active'
        ];
        $productInsertQuery = AuctionModel::insert($productArr);
        if($productInsertQuery)
        {
            $getLastInsertData = AuctionModel::orderBy('id','DESC')->limit(1)->get();
            foreach($getLastInsertData as $newlastId)
            {
                $getLastInsertId = $newlastId->id;
            }

            $product_gallery = "";
            if($request->hasFile('product_gallery_images_name'))
            {
                foreach($request->file('product_gallery_images_name') as $images)
                {
                    $product_gallery = $images->store('public/'.$unique_folder_id);
                    $insertMultipleArr = [
                        'auction_product_images' => $product_gallery, 
                        'auction_product_id' => $getLastInsertId
                    ];
                    $ProductGalleryQuery = AuctionImgModel::insert($insertMultipleArr);
                }
                if($ProductGalleryQuery)
                {
                    $request->session()->flash('success_msg', 'Successfully Auction Inserted ');
                    return redirect()->back();
                }
                else
                {
                    $request->session()->flash('error_msg', 'Multiple images not uploaded');
                    return redirect()->back();
                }
                
            }
            else
            {
                $request->session()->flash('success_msg', 'Successfully Auction Inserted ');
                return redirect()->back();
            }
        }
        else
        {
            $request->session()->flash('error_msg', 'Something went wrong ! Try  again later');
            return redirect()->back();
        }
        // product gallery
        
    }


    public function product_details_del_fx(Request $request)
    {
        $delQuery =  AuctionModel::where('id',$_GET['id'])->delete();
        if($delQuery)
        {
            $deleteQuery = AuctionImgModel::where('auction_product_id',$_GET['id'])->delete();
            $html['status_code'] = "success";
        }
        else
        {
            $html['status_code'] = "error";
        }

        echo json_encode($html);
    }

    public function product_details_status_fx(Request $request)
    {
        if($_GET['status_call'] == "active"){
            $status_arr = [
                'admin_status' => 'active',
            ];
        }else if($_GET['status_call'] == "inactive"){
            $status_arr = [
                'admin_status' => 'inactive',
            ];
        }

        $updateQuery = AuctionModel::where('id',$_GET['id'])->update($status_arr);
        if($updateQuery)
        {
            $html['status_code'] = "success";
        }
        else
        {
            $html['status_code'] = "error";
        }

        echo json_encode($html);
    }

    // show edit product details
    public function product_details_edit_fx(Request $request)
    {
        $productSearchQuery = AuctionModel::where('id',$_GET['id'])->get();
        foreach($productSearchQuery as $productQuery)
        {
            // panel wish category check
            $categoryFetch = CategoryModel::where(['admin_status' => 'active'])->get();
            $html['category_full_view'] = "<option value=''>Choose your category name</option>";
            foreach($categoryFetch as $categoryF)
            {
                $selected = "";
                if($categoryF->id == $productQuery->category_id)
                {
                    $selected = "selected";
                }
                $html['category_full_view'] .= "<option value='".$categoryF->id."' ".$selected.">".$categoryF->category_name."</option>";
            }


            // panel wish sub category check
            $getSubCategory = SubCategoryModel::where(['admin_status' => 'active'])->get();
            $html['sub_category_full_view'] = '<option value="">Choose your sub-category name</option>';
            if(count($getSubCategory) > 0)
            {
                foreach($getSubCategory as $getSubC)
                {
                    $selected = "";
                    if($getSubC->id == $productQuery->sub_category_id)
                    {
                        $selected = "selected";
                    }
                    $html['sub_category_full_view'] .= '<option value="'.$getSubC->id.'" '.$selected.'>'.$getSubC->sub_category_name.'</option>';
                }
                
            }

            $html['product_name_full_view'] = $productQuery->product_name;
            $html['product_short_des_full_view'] = $productQuery->product_short_description;
            $html['product_des_full_view'] = $productQuery->product_full_description;
            $html['product_additional_des_full_view'] = $productQuery->product_additional_information;
            $html['product_auction_time'] = $productQuery->auction_time;

            $html['getting_thumbnail_image'] = '<img src="'.str_replace('public','storage',asset($productQuery->product_thumbnail)).'" alt="No Image" width="100px" height="100px"/>';

            

        }
        // getting multiple images
        $productMultipleImagesQuery = AuctionImgModel::where('auction_product_id',$_GET['id'])->get();
        $html['getting_gallery_images'] = "";
        if(count($productMultipleImagesQuery) > 0)
        {
            foreach($productMultipleImagesQuery as $multiQuery)
            {
                $html['getting_gallery_images'] .= '<div class="md_pic_con"><img src="'.str_replace('public','storage',asset($multiQuery->auction_product_images)).'" alt="No Image" width="100px" height="100px"/><a href="javascript: ;" onclick=del_gallery_images_fx('.$multiQuery->id.') class="text-danger"><i class="fa fa-trash"></i></a></div>';
            }
        }
        // end of getting multiple images 

        echo json_encode($html);
    }


    // update gallery images
    public function product_details_update_fx(Request $request)
    {
        $gettingProductQuery = AuctionModel::where('id',$request->input('edit_product_name_first_id'))->get();
        foreach($gettingProductQuery as $getProductDetailsQuery)
        {
            $product_thumbnail = $getProductDetailsQuery->product_thumbnail;
        }
        $unique_folder_id = "auction".rand(01,99999);
        $product_unique_code = rand(10000000,99999999);
        $category_id = $request->input('category_name');
        $sub_category_id = $request->input('sub_category_name');
        $product_name = $request->input('product_name');
        $product_short_description = $request->input('product_short_description');
        $product_description = $request->input('product_description');
        $product_addtional_description = $request->input('product_additional_details');
        $auction_time = $request->input('product_auction_timing');
        // product thumbnail
        if($request->hasFile('product_thumbnail_name'))
        {
            $product_thumbnail = $request->file('product_thumbnail_name')->store('public/thumbnail');
        }
        // product insert 
        $productArr = [
            'category_id' => $category_id, 
            'sub_category_id' => $sub_category_id, 
            'product_name' => $product_name, 
            'product_short_description' => $product_short_description, 
            'product_full_description' => $product_description, 
            'product_additional_information' => $product_addtional_description, 
            'product_unique_code' => $product_unique_code, 
            'auction_time' => $auction_time, 
            'product_thumbnail' => $product_thumbnail, 
            'product_available_status' => 'available', 
            'admin_status' => 'active'
        ];
        $productInsertQuery = AuctionModel::where('id',$request->input('edit_product_name_first_id'))->update($productArr);
        if($productInsertQuery)
        {
            $ProductGalleryQueryFileName = AuctionImgModel::where('auction_product_id',$request->input('edit_product_name_first_id'))->get();
            if(count($ProductGalleryQueryFileName))
            {
                foreach($ProductGalleryQueryFileName as $productGFile)
                {
                    $unique_folder_id = explode("/", $productGFile->auction_product_images)[1];
                }
            }

            $product_gallery = "";
            if($request->hasFile('product_gallery_images_name'))
            {
                foreach($request->file('product_gallery_images_name') as $images)
                {
                    $product_gallery = $images->store('public/'.$unique_folder_id);
                    $insertMultipleArr = [
                        'auction_product_images' => $product_gallery, 
                        'auction_product_id' => $request->input('edit_product_name_first_id')
                    ];
                    $ProductGalleryQuery = AuctionImgModel::insert($insertMultipleArr);
                }
                if($ProductGalleryQuery)
                {
                    $request->session()->flash('success_msg', 'Successfully Auction Updated ');
                    return redirect()->back();
                }
                else
                {
                    $request->session()->flash('error_msg', 'Multiple images not uploaded');
                    return redirect()->back();
                }
                
            }
            else
            {
                $request->session()->flash('success_msg', 'Successfully Auction Inserted ');
                return redirect()->back();
            }
        }
        else
        {
            $request->session()->flash('error_msg', 'Something went wrong ! Try  again later');
            return redirect()->back();
        }
        // product gallery
        
    }
}
