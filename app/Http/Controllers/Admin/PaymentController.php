<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\PaymentModel;

class PaymentController extends Controller
{
    //

    public function showPage(Request $request)
    {
        return view('backend.pages.payment.payment');
    }

    public function showPayment(Request $request)
    {
        $getCategory = PaymentModel::get();
        if(count($getCategory) > 0)
        {
            $html['category_full_data'] = "";
            $i = 0;
            foreach($getCategory as $getC)
            {
                $user_name = $getC->user_name;
                // category quote
                if($getC->payment_status == "no"){
                    $cateDetails = "Payment not approved yet!";
                }else if($getC->payment_status == "yes"){
                    $cateDetails = "Payment approved successfully!";
                }else{
                    $cateDetails = "Payment pending!";
                }
                // category quote
                if($getC->admin_action == "yes"){
                    $cateAdminStatus = "<span class='text-success'><i class='fa fa-check'></i> Active</span>";
                }else if($getC->admin_action == "no"){
                    $cateAdminStatus = "<span class='text-danger'><i class='fa fa-times'></i> Deactive</span>";
                }else{
                    $cateAdminStatus = "<span class='text-danger'><i class='fa fa-times'></i> No defined</span>";
                }

                // category action status
                if($getC->admin_status == "yes")
                {
                    $btn_html = "<button type='button' class='btn btn-danger btn-sm' onclick=change_action(".$getC->id.",'no')>Deactive</button>&nbsp;&nbsp;&nbsp;<button type='button' class='btn btn-danger btn-sm' onclick=del_action(".$getC->id.")>Delete</button>";
                }
                else if($getC->admin_status == "no")
                {
                    $btn_html = "<button type='button' class='btn btn-success btn-sm' onclick=change_action(".$getC->id.",'yes')>Active</button>&nbsp;&nbsp;&nbsp;<button type='button' class='btn btn-danger btn-sm' onclick=del_action(".$getC->id.")>Delete</button>";
                }
                else
                {
                    $btn_html = "<button type='button' class='btn btn-success btn-sm' onclick=change_action(".$getC->id.",'yes')>Active</button> | <button type='button' class='btn btn-danger btn-sm' onclick=change_action(".$getC->id.",'no')>Deactive</button>";
                }

                $html['category_full_data'] .= "<tr>
                            <td>".++$i."</td>
                            <td>".ucwords($user_name)."</td>
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


    public function actionPayment(Request $request)
    {
        if($_GET['status_call'] == "yes"){
            $status_arr = [
                'admin_action' => 'yes',
            ];
        }else if($_GET['status_call'] == "no"){
            $status_arr = [
                'admin_action' => 'no',
            ];
        }

        $updateQuery = PaymentModel::where('id',$_GET['id'])->update($status_arr);
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

    public function delPayment(Request $request)
    {
        $delQuery =  PaymentModel::where('id',$_GET['id'])->delete();
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
