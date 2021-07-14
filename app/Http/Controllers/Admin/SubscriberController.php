<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Mail;
use App\Model\SubscriberModel;
use App\Mail\AdminSubscriberMail;

class SubscriberController extends Controller
{
    //
    public function showPage(Request $request)
    {
        return view('backend.pages.subscribers.subscribe');
    }

    public function subcriberShow(Request $request)
    {
        $getCategory = SubscriberModel::get();
        if(count($getCategory) > 0)
        {
            $html['subscriber_full_data'] = "";
            $i = 0;
            foreach($getCategory as $getC)
            {

                // getting  email address
                $get_subscriber_email = $getC->subscriber_email_address;

                // sub category quote
                if($getC->admin_status == "active"){
                    $cateAdminStatus = "<span class='text-success'><i class='fa fa-check'></i> Active</span>";
                }else if($getC->admin_status == "inactive"){
                    $cateAdminStatus = "<span class='text-danger'><i class='fa fa-times'></i> Deactive</span>";
                }else{
                    $cateAdminStatus = "<span class='text-danger'><i class='fa fa-times'></i> No defined</span>";
                }

                // action status
                if($getC->admin_status == "active")
                {
                    $btn_html = "<button type='button' class='btn btn-danger btn-sm' onclick=change_action(".$getC->id.",'inactive')>Deactive</button>&nbsp;&nbsp;&nbsp;<button type='button' class='btn btn-danger btn-sm' onclick=del_action(".$getC->id.")>Delete</button>";
                }
                else if($getC->admin_status == "inactive")
                {
                    $btn_html = "<button type='button' class='btn btn-success btn-sm' onclick=change_action(".$getC->id.",'active')>Active</button>&nbsp;&nbsp;&nbsp;<button type='button' class='btn btn-danger btn-sm' onclick=del_action(".$getC->id.")>Delete</button>";
                }
                else
                {
                    $btn_html = "<button type='button' class='btn btn-success btn-sm' onclick=change_action(".$getC->id.",'active')>Active</button> | <button type='button' class='btn btn-danger btn-sm' onclick=change_action(".$getC->id.",'inactive')>Deactive</button> | <button type='button' class='btn btn-danger btn-sm' onclick=del_action(".$getC->id.")>Delete</button>";
                }

                $html['subscriber_full_data'] .= "<tr>
                            <td>".++$i."</td>
                            <td>".strtolower($get_subscriber_email)."</td>
                            <td>".$cateAdminStatus."</td>
                            <td>".$btn_html."</td>
                        </tr>";
                $html['action_type'] = "yes";
            }
            
        }
        else
        {
            $html['action_type'] = "no";
            $html['subscriber_full_data'] = "<tr><td colspan='4'><center class='text-danger'><i class='fa fa-times'></i> No Data Available</center></td></tr>";
        }

        echo json_encode($html);
    }

    // subscribers status change
    public function subcriberActionChange(Request $request)
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

        $updateQuery = SubscriberModel::where('id',$_GET['id'])->update($status_arr);
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

    // subscriber delete
    public function subcriberActionDel(Request $request)
    {
        $delQuery =  SubscriberModel::where('id',$_GET['id'])->delete();
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

    public function subscribers_email_view_panel(Request $request)
    {
        $subscriberQuery = SubscriberModel::where(['admin_status' => 'active'])->get();
        $html['subscriber_email'] = "";
        foreach($subscriberQuery as $sQuery)
        {
            $html['subscriber_email'] .= '<option value="'.$sQuery->subscriber_email_address.'" />'.$sQuery->subscriber_email_address.'</option>';
        }

        echo json_encode($html);
    }


    public function subscribe_email_sending_file_fx(Request $request)
    {
        foreach($request->input('subscriber_mail_name') as $subscriber_name_mail)
        {
            $data = [
                'heading_data' => "Acknownlwdge Mail from Nifticals",
                'paragraph_data' => $request->input('subscriber_mail_content'),
            ];
            $geting_email = strtolower($subscriber_name_mail);
            Mail::to($geting_email)->send(new \App\Mail\AdminSubscriberMail($data));

            $request->session()->flash('success_msg', 'Successfully sent the mail');
            return redirect()->back();
        }

            
    }

}