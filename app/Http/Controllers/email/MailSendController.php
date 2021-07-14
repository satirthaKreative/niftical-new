<?php

namespace App\Http\Controllers\email;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use GuzzleHttp\Exception\GuzzleException;
use App\Mail\SendEmailDemo;

class MailSendController extends Controller
{
    //
    public function store(Request $request)
    {
            $mail_name = $request->input('mail_name');
            $mail_address = $request->input('mail_address');
            $mail_email = $request->input('mail_email');
            $mail_product = $request->input('mail_product');
            $mail_phone = $request->input('mail_phone');
            $mail_image_link = $request->input('mail_image_link');
            $mail_qr_code = $request->input('mail_qr_code');
            $mail_comments = $request->input('mail_comments');

            if($mail_name == "" || $mail_name == null)
            {
                $request->session()->flash('error_msg', 'Please enter mailer name');
                return redirect()->back();
            }
            else if($mail_address == "" || $mail_address == null)
            {
                $request->session()->flash('error_msg', 'Please enter mailer address');
                return redirect()->back();
            }
            else if($mail_email == "" || $mail_email == null)
            {
                $request->session()->flash('error_msg', 'Please enter mailer email');
                return redirect()->back();
            }
            else if($mail_qr_code == "" || $mail_qr_code == null)
            {
                $request->session()->flash('error_msg', 'Please enter QR code');
                return redirect()->back();
            }
            else
            {
                $data=[
                    "mail_name"=>$mail_name,
                    "mail_email" => $mail_email,
                    "mail_address"=>$mail_address,
                    "mail_product"=>$mail_product,
                    "mail_phone"=>$mail_phone,
                    "mail_image_link"=>$mail_image_link,
                    "mail_qr_code"=>$mail_qr_code,
                    "mail_comments"=>$mail_comments,
                    "mail_image"=>$request->file('mail_image')
                ];
                
                Mail::to($mail_email)->send(new SendEmailDemo($data));

                
                $request->session()->flash('success_msg', 'Successfully sent the mail');
                return redirect()->back();
            }
        
    }
}
