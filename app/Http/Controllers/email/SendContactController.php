<?php

namespace App\Http\Controllers\email;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendContactEmail;

class SendContactController extends Controller
{
    //
    public function store(Request $request)
    {
            $contact_name = $_GET['contact_name'];
            $contact_mail = $_GET['contact_email'];
            $contact_msg = $_GET['contact_msg'];

            if($contact_name == "" || $contact_name == null)
            {
                $msg = "error";
            }
            else if($contact_mail == "" || $contact_mail == null)
            {
                $msg = "error";
            }
            else if($contact_msg == "" || $contact_msg == null)
            {
                $msg = "error";
            }
            else
            {
                $data=[
                    "contact_name"=>$contact_name,
                    "contact_email" => $contact_mail,
                    "contact_msg"=>$contact_msg,
                ];

                Mail::to($contact_mail)->send(new SendContactEmail($data));
                $msg = "success";
            }
        echo json_encode($msg);
    }
}
