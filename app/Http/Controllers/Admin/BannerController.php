<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\BannerModel;

class BannerController extends Controller
{
    //
    //
    public function showPage(Request $request)
    {
        return view('backend.pages.banner.banner');
    }

    public function showProduct(Request $request)
    {
        $getProduct = BannerModel::get();
        if(count($getProduct) > 0)
        {
            $html['product_full_data'] = "";
            $i = 0;
            foreach($getProduct as $getP)
            {

                // banner heading quote
                $banner_heading_quote = ucwords($getP->banner_heading_quote);

                // banner heading name
                $banner_heading_name = ucwords($getP->banner_heading_name);

                

                // product image 
                $banner_img = '<img src="'.str_replace('public','storage',asset($getP->banner_img)).'"  alt="no image" width="100px" height="100px" />';
                
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



                /// product description
                if(strlen($getP->banner_paragraph) > 40)
                {
                    $product_s_des = substr($getP->banner_paragraph,0,39)." ...";
                }
                else
                {
                    $product_s_des = $getP->banner_paragraph;
                }

                // <br><div class='MainContainer'><div class='info'><input type='checkbox' checked></div><div class='Switch Round'><div class='Toggle'></div></div></div>
                $html['product_full_data'] .= "<tr>
                            <td>".++$i."</td>
                            <td>".$banner_img."</td>
                            <td>".$banner_heading_quote."<br>".$banner_heading_name."</td>
                            <td>".$product_s_des."</td>
                            <td>".$cateAdminStatus."</td>
                            <td>".$btn_html."</td>
                        </tr>";
                $html['action_type'] = "yes";
            }
        }
        else
        {
            $html['action_type'] = "no";
            $html['product_full_data'] = "<tr><td colspan='6'><center class='text-danger'><i class='fa fa-times'></i> No Data Available</center></td></tr>";
        }

        echo json_encode($html);
    }


    /// product addition
    public function addProduct(Request $request)
    {
        $unique_folder_id = "banner".rand(01,99999);
        $product_unique_code = rand(10000000,99999999);
        $banner_heading_quote = $request->input('banner_heading_quote');
        $banner_heading_name = $request->input('banner_heading_name');
        $banner_paragraph = $request->input('banner_paragraph');
        
        // product thumbnail
        $product_thumbnail = "";
        if($request->hasFile('banner_image'))
        {
            $product_thumbnail = $request->file('banner_image')->store('public/banners/'.$unique_folder_id);
        }
        // product insert 
        $productArr = [
            'banner_heading_quote'=> $banner_heading_quote, 
            'banner_heading_name' => $banner_heading_name,
            'banner_paragraph' => $banner_paragraph, 
            'banner_img' => $product_thumbnail, 
            'admin_status' => 'active',
            'created_at' => strtotime(date('Y-m-d H:i:s')), 
            'updated_at' => strtotime(date('Y-m-d H:i:s'))
        ];
        $productInsertQuery = BannerModel::insert($productArr);
        if($productInsertQuery)
        {
            $request->session()->flash('success_msg', 'Successfully Banner Inserted ');
            return redirect()->back();
        }
        else
        {
            $request->session()->flash('error_msg', 'Something went wrong ! Try  again later');
            return redirect()->back();
        }
        // product gallery
        
    }

    public function actionProduct(Request $request)
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

        $updateQuery = BannerModel::where('id',$_GET['id'])->update($status_arr);
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

    // product delete
    public function delProduct(Request $request)
    {
        $delQuery =  BannerModel::where('id',$_GET['id'])->delete();
        if($delQuery)
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
    public function showEditProduct(Request $request)
    {
        $productSearchQuery = BannerModel::where('id',$_GET['id'])->get();
        foreach($productSearchQuery as $productQuery)
        {
            $html['banner_quote'] = $productQuery->banner_heading_quote;
            $html['banner_name'] = $productQuery->banner_heading_name;
            $html['banner_des'] = $productQuery->banner_paragraph;
            $html['banner_img'] = '<img src="'.str_replace('public','storage',asset($productQuery->banner_img)).'" alt="No Image" width="100px" height="100px"/>';
        }
        echo json_encode($html);
    }

    // delete gallery images
    public function delGalleryProduct(Request $request)
    {
        $productMultipleImagesDel = BannerModel::where('id',$_GET['id'])->delete();
        
        if($productMultipleImagesDel)
        {
            $msg['status_code'] = "success";
        }
        else
        {
            $msg['status_code'] = "error";
        }
        echo json_encode($msg);
    }

    // update gallery images
    public function updateProduct(Request $request)
    {
        $gettingProductQuery = BannerModel::where('id',$request->input('edit_banner_name_first_name'))->get();
        foreach($gettingProductQuery as $getProductDetailsQuery)
        {
            $product_thumbnail = $getProductDetailsQuery->banner_img;
        }

        $unique_folder_id = "banner".rand(01,99999);
        $product_unique_code = rand(10000000,99999999);
        $banner_heading_quote = $request->input('banner_heading_quote');
        $banner_heading_name = $request->input('banner_heading_name');
        $banner_paragraph = $request->input('banner_paragraph');
        
        // product thumbnail
        if($request->hasFile('banner_image'))
        {
            $product_thumbnail = $request->file('banner_image')->store('public/banners/'.$unique_folder_id);
        }
        // product insert 
        $productArr = [
            'banner_heading_quote'=> $banner_heading_quote, 
            'banner_heading_name' => $banner_heading_name,
            'banner_paragraph' => $banner_paragraph, 
            'banner_img' => $product_thumbnail, 
            'admin_status' => 'active', 
            'updated_at' => strtotime(date('Y-m-d H:i:s'))
        ];
        $productInsertQuery = BannerModel::where('id',$request->input('edit_banner_name_first_name'))->update($productArr);
        if($productInsertQuery)
        {
            
            $request->session()->flash('success_msg', 'Successfully Banner Updated ');
            return redirect()->back();

        }
        else
        {
            $request->session()->flash('error_msg', 'Something went wrong ! Try  again later');
            return redirect()->back();
        }
        // product gallery
        
    }
}
