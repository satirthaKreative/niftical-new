<?php

namespace App\Http\Controllers\email;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriberMail;
use App\Mail\SubscriberMailToOwner;
use App\Model\SubscriberModel;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        $checkingSubscribers = SubscriberModel::where('subscriber_email_address',strtolower($request->input('subscribe_email_name')))->count();
        if($checkingSubscribers == 0)
        {
            $data = [
                'heading_data' => "Thank you for subscribing nifticals",
                'paragraph_data' => "Thank you for subscribing us",
            ];
            $geting_email = strtolower($request->input('subscribe_email_name'));
            Mail::to($geting_email)->send(new \App\Mail\SubscriberMail($data));
    
            $data1 = [
                'heading_data' => "Subscribers Mail",
                'paragraph_data' => $geting_email." has subscribe nifticals.io",
            ];
            Mail::to('satirtha64@gmail.com')->send(new \App\Mail\SubscriberMailToOwner($data1));

            $insertArr = [
                'subscriber_email_address' => strtolower($request->input('subscribe_email_name')),
                'admin_status' => 'active'
            ];

            $insertQuery = SubscriberModel::insert($insertArr);
    
            $request->session()->flash('success_msg', 'Successfully sent the mail');
            return redirect()->back();
        }
        else if($checkingSubscribers > 0)
        {
            $request->session()->flash('error_msg','Already subscribed');
            return redirect()->back();
        }
        else
        {
            $request->session()->flash('error_msg','Something went wrong! Try again');
            return redirect()->back();
        }
        
    }
}
