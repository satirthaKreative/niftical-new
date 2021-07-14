<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\CategoryModel;

class CategoryController extends Controller
{
    //
    public function showPage(Request $request)
    {
        return view('backend.pages.category.show-category');
    }

    public function showProductCategory(Request $request)
    {
        $getCategory = CategoryModel::get();
        if(count($getCategory) > 0)
        {
            $html['category_full_data'] = "";
            $i = 0;
            foreach($getCategory as $getC)
            {
                // category quote
                if($getC->category_quote == null || $getC->category_quote == ""){
                    $cateDetails = "No quote for this category";
                }else{
                    $cateDetails = $getC->category_quote;
                }
                // category quote
                if($getC->admin_status == "active"){
                    $cateAdminStatus = "<span class='text-success'><i class='fa fa-check'></i> Active</span>";
                }else if($getC->admin_status == "inactive"){
                    $cateAdminStatus = "<span class='text-danger'><i class='fa fa-times'></i> Deactive</span>";
                }else{
                    $cateAdminStatus = "<span class='text-danger'><i class='fa fa-times'></i> No defined</span>";
                }

                // category action status
                if($getC->admin_status == "active")
                {
                    $btn_html = "<button type='button' class='btn btn-danger btn-sm' onclick=change_action(".$getC->id.",'inactive')>Deactive</button>&nbsp;&nbsp;&nbsp;<button type='button' class='btn btn-info btn-sm' onclick=edit_action(".$getC->id.")>Edit</button>&nbsp;&nbsp;&nbsp;<button type='button' class='btn btn-danger btn-sm' onclick=del_action(".$getC->id.")>Delete</button>";
                }
                else if($getC->admin_status == "inactive")
                {
                    $btn_html = "<button type='button' class='btn btn-success btn-sm' onclick=change_action(".$getC->id.",'active')>Active</button>&nbsp;&nbsp;&nbsp;<button type='button' class='btn btn-info btn-sm' onclick=edit_action(".$getC->id.")>Edit</button>&nbsp;&nbsp;&nbsp;<button type='button' class='btn btn-danger btn-sm' onclick=del_action(".$getC->id.")>Delete</button>";
                }
                else
                {
                    $btn_html = "<button type='button' class='btn btn-success btn-sm' onclick=change_action(".$getC->id.",'active')>Active</button> | <button type='button' class='btn btn-danger btn-sm' onclick=change_action(".$getC->id.",'inactive')>Deactive</button> | <button type='button' class='btn btn-info btn-sm' onclick=edit_action(".$getC->id.")>Edit</button> | <button type='button' class='btn btn-danger btn-sm' onclick=del_action(".$getC->id.")>Delete</button>";
                }

                $html['category_full_data'] .= "<tr>
                            <td>".++$i."</td>
                            <td>".ucwords($getC->category_name)."</td>
                            <td>".$cateDetails."</td>
                            <td>".$cateAdminStatus."</td>
                            <td>".$btn_html."</td>
                        </tr>";
                $html['action_type'] = "yes";
            }
            
        }
        else
        {
            $html['action_type'] = "no";
            $html['category_full_data'] = "<tr><td colspan='5'><center class='text-danger'><i class='fa fa-times'></i> No Data Available</center></td></tr>";
        }

        echo json_encode($html);
    }

    public function addProductCategory(Request $request)
    {
        $cname = $_GET['cname'];
        $cquote = $_GET['cquote'];

        if($cname == "" || $cname == null)
        {
            $html['status_code'] = "Please enter category name";
        } 
        else
        {
            $html['status_code'] = "Something went wrong ";
            $insertArr = [
                'category_name' => strtolower($cname), 
                'category_quote' => $cquote
            ];
            $insertQuery = CategoryModel::insert($insertArr);
            if($insertQuery)
            {
                $html['status_code'] = "success";
            }
            
        }
        echo json_encode($html);
    }


    public function showEditProductCategory(Request $request)
    {
        $getCategory = CategoryModel::where('id',$_GET['id'])->get();
        foreach($getCategory as $getC)
        {
            $html['cname'] = $getC->category_name;
            $html['cquote'] = $getC->category_quote; 
        }
        echo  json_encode($html);
    }

    public function updateProductCategory(Request $request)
    {
        $cname = $_GET['cname'];
        $cquote = $_GET['cquote'];

        if($cname == "" || $cname == null)
        {
            $html['status_code'] = "Please enter category name";
        } 
        else
        {
            $html['status_code'] = "Something went wrong ";
            $insertArr = [
                'category_name' => strtolower($cname), 
                'category_quote' => $cquote
            ];
            $insertQuery = CategoryModel::where('id',$_GET['cid'])->update($insertArr);
            if($insertQuery)
            {
                $html['status_code'] = "success";
            }
            
        }
        echo json_encode($html);
    }

    public function actionProductCategory(Request $request)
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

        $updateQuery = CategoryModel::where('id',$_GET['id'])->update($status_arr);
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

    public function delProductCategory(Request $request)
    {
        $delQuery =  CategoryModel::where('id',$_GET['id'])->delete();
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
    
}
