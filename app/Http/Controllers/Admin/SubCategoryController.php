<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\SubCategoryModel;
use App\Model\CategoryModel;

class SubCategoryController extends Controller
{
    //
    public function showPage(Request $request)
    {
        return view('backend.pages.sub-category.show-sub-category');
    }

    public function showProductCategory(Request $request)
    {
        $getCategory = SubCategoryModel::get();
        if(count($getCategory) > 0)
        {
            $html['category_full_data'] = "";
            $i = 0;
            foreach($getCategory as $getC)
            {

                // getting category details
                $cateForSubCategoryQuery = CategoryModel::where('id',$getC->category_id)->get();
                foreach($cateForSubCategoryQuery as $cateFullData)
                {
                    $sub_wish_category_name = $cateFullData->category_name;
                }
                // sub category quote
                if($getC->sub_category_quote == null || $getC->sub_category_quote == ""){
                    $cateDetails = "No quote for this sub category";
                }else{
                    $cateDetails = $getC->sub_category_quote;
                }
                // sub category quote
                if($getC->admin_status == "active"){
                    $cateAdminStatus = "<span class='text-success'><i class='fa fa-check'></i> Active</span>";
                }else if($getC->admin_status == "inactive"){
                    $cateAdminStatus = "<span class='text-danger'><i class='fa fa-times'></i> Deactive</span>";
                }else{
                    $cateAdminStatus = "<span class='text-danger'><i class='fa fa-times'></i> No defined</span>";
                }

                // sub category action status
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
                            <td>".ucwords($getC->sub_category_name)."</td>
                            <td>".ucwords($sub_wish_category_name)."</td>
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
            $html['category_full_data'] = "<tr><td colspan='6'><center class='text-danger'><i class='fa fa-times'></i> No Data Available</center></td></tr>";
        }

        echo json_encode($html);
    }

    // category found for subcategory
    public function category_found(Request $request)
    {
        $categoryQuery = CategoryModel::where('admin_status','active')->get();
        $html = '<option value="">Choose category name</option>';
        if(count($categoryQuery) > 0)
        {
            foreach($categoryQuery as $cQuery)
            {
                $html .= '<option value="'.$cQuery->id.'">'.$cQuery->category_name.'</option>';
            }
        }
        echo json_encode($html);
    }

    // sub category add 
    public function addProductCategory(Request $request)
    {
        $cname = $_GET['c_name'];
        $c_sub_name = $_GET['c_sub_name'];
        $c_sub_quote = $_GET['c_sub_quote'];

        if($cname == "" || $cname == null)
        {
            $html['status_code'] = "Please choose category name";
        }
        else if($c_sub_name == "" || $c_sub_name == null)
        {
            $html['status_code'] = "Please enter subcategory name";
        }  
        else
        {

            // checking to have category data or, not
            $checkingQueryForCategory = SubCategoryModel::where(['category_id' => $cname, 'sub_category_name' => strtolower($c_sub_name)])->get();
            if(count($checkingQueryForCategory) > 0)
            {
                $html['status_code'] = "This sub-category already added under this category ";
            }
            else if(count($checkingQueryForCategory) == 0)
            {
                $html['status_code'] = "Something went wrong ";
                $insertArr = [
                    'category_id' => $cname, 
                    'sub_category_name' => strtolower($c_sub_name),
                    'sub_category_quote' => $c_sub_quote
                ];
                $insertQuery = SubCategoryModel::insert($insertArr);
                if($insertQuery)
                {
                    $html['status_code'] = "success";
                }
            }
            else
            {
                $html['status_code'] = "Server connecting issue ! Please try couple of minutes later ";
            }
            
            
        }
        echo json_encode($html);
    }

    // show edit sub category
    public function showEditProductCategory(Request $request)
    {
        $getCategory = SubCategoryModel::where('id',$_GET['id'])->get();
        foreach($getCategory as $getC)
        {
            $html['cname'] = $getC->sub_category_name;
            $html['cquote'] = $getC->sub_category_quote; 

            $categoryQuery = CategoryModel::where(['admin_status' => 'active'])->get();
            $html['category_name'] = '<option value="">Choose category name</option>';
            if(count($categoryQuery) > 0)
            {
                foreach($categoryQuery as $cQuery)
                {
                    $checked = "";
                    if($cQuery->id == $getC->category_id)
                    {
                        $checked = "selected";
                    }
                    $html['category_name'] .= '<option value="'.$cQuery->id.'" '.$checked.'>'.$cQuery->category_name.'</option>';
                }
            }
        }
        echo  json_encode($html);
    }

    // update query
    public function updateProductCategory(Request $request)
    {
        $cname = $_GET['cname'];
        $csubname = $_GET['csubname'];
        $csubquote = $_GET['csubquote'];

        if($cname == "" || $cname == null)
        {
            $html['status_code'] = "Please choose a category";
        } 
        else if($csubname == "" || $csubname == null)
        {
            $html['status_code'] = "Please enter a sub category";
        }
        else
        {
            $checkingQueryForSubEdit = SubCategoryModel::where(['category_id' => $cname, 'sub_category_name' => strtolower($csubname)])->where('id', '!=', $_GET['cid'])->get();
            if(count($checkingQueryForSubEdit) > 0)
            {
                $html['status_code'] = "This sub-category already added under this category ";
            }
            else if(count($checkingQueryForSubEdit) == 0)
            {
                $html['status_code'] = "Something went wrong ";
                $insertArr = [
                    'category_id' => $cname,
                    'sub_category_name' => strtolower($csubname), 
                    'sub_category_quote' => $csubquote
                ];
                $insertQuery = SubCategoryModel::where('id',$_GET['cid'])->update($insertArr);
                if($insertQuery)
                {
                    $html['status_code'] = "success";
                }
            }
            else
            {
                $html['status_code'] = "Server connecting issue ! Please try couple of minutes later ";
            }
            
            
        }
        echo json_encode($html);
    }

    // sub category action change
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

        $updateQuery = SubCategoryModel::where('id',$_GET['id'])->update($status_arr);
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

    // subcategory delete
    public function delProductCategory(Request $request)
    {
        $delQuery =  SubCategoryModel::where('id',$_GET['id'])->delete();
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

    public function chooseSubCategory(Request $request)
    {
        $getSubCategory = SubCategoryModel::where(['category_id' => $_GET['id']])->get();
        $html = '<option value="">Choose your sub-category name</option>';
        if(count($getSubCategory) > 0)
        {
            foreach($getSubCategory as $getSubC)
            {
                $html .= '<option value="'.$getSubC->id.'">'.$getSubC->sub_category_name.'</option>';
            }
            
        }
        echo json_encode($html);
    }
}
