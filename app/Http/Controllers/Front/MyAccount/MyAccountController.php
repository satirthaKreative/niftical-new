<?php

namespace App\Http\Controllers\Front\MyAccount;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Model\MyAccountModel;
use App\User;
use App\Model\CountryModel;

class MyAccountController extends Controller
{
    
    public function showPage(Request $request)
    {
        $countryCodeQuery = CountryModel::where('phonecode', '!=', 0)->groupBy('phonecode')->orderBy('phonecode','ASC')->get();
        return view('frontend.pages.my-account', compact('countryCodeQuery'));
    } 

    public function load_my_account_details(Request $request)
    {

        // my account data
        $myAccountQuery = MyAccountModel::where('user_id',$_GET['logged_user_id'])->get();
        if(count($myAccountQuery) > 0){
            foreach($myAccountQuery as $myQuery){
                $html['phone_num'] = "+ ".$myQuery->country_phone_num." ".$myQuery->phone_num;
                $html['user_birth'] = date('M/d/y',strtotime($myQuery->user_birth));
                $html['user_street'] = $myQuery->user_street;
                $html['user_city'] = $myQuery->user_city;
                $html['user_state'] = $myQuery->user_state;
                $html['user_state_code'] = $myQuery->user_state_code;
                $html['zipcode'] = $myQuery->zipcode;
            }
        }
        else
        {
                $html['phone_num'] = "No Phone Number";
                $html['user_birth'] = "No Birth Day";
                $html['user_street'] = "No Street";
                $html['user_city'] = "No City Name";
                $html['user_state'] = "No State";
                $html['user_state_code'] = "No State Code";
                $html['zipcode'] = "No Zipcode";
        }


        // user main details
        $userQuery = User::where('id',$_GET['logged_user_id'])->get();
        foreach($userQuery as $uQuery)
        {
            $html['user_actual_name'] = $uQuery->name;
            $html['user_actual_email'] = $uQuery->email;
        }

        echo json_encode($html);
    }


    /// my account update data
    public function update_my_account_data_fx(Request $request)
    {
        $user_session_id = Auth::user()->id; 

        // user table  query

        $user_name = $_GET['update_my_account_username'];
        $user_email = $_GET['update_my_account_usermail'];

        $userQuery = User::where(['name' => $user_name, 'email' => $user_email, 'id' => $user_session_id])->get();
        if(count($userQuery) == 0)
        {
            $userUpdateQuery = User::where('email',$user_email)->where('id','!=',$user_session_id)->get();
            if(count($userUpdateQuery) == 0)
            {
                $myQuery = User::where(['id' => $user_session_id])->update(['email' => $user_email, 'name' => $user_name]);
            }
            else
            {
                echo json_encode("already");
                
            }
        }


        // my account query
        $updateArr = [
            'user_id' => Auth::user()->id, 
            'phone_num' => $_GET['update_my_account_phone_code'], 
            'country_phone_num' => $_GET['update_my_account_countrycode'], 
            'user_birth' => $_GET['update_my_account_date_code'], 
            'user_street' => $_GET['update_my_account_street_code'], 
            'user_city' => $_GET['update_my_account_city_code'], 
            'user_state' => $_GET['update_my_account_country_name'], 
            'user_state_code' => $_GET['update_my_account_country_code'], 
            'zipcode' => $_GET['update_my_account_zipcode_name'], 
            'updated_at' => date('Y-m-d')
        ];
        $myAccountCheckIdQuery = MyAccountModel::where('user_id',Auth::user()->id)->get();
        if(count($myAccountCheckIdQuery) > 0)
        {
            $mainAccountQuery = MyAccountModel::where('user_id',Auth::user()->id)->update($updateArr);
            $msg = "error";
            if($mainAccountQuery)
            {
                $msg = "success";
            }

            echo json_encode($msg);
        }
        else
        {
            $updateArr = [
                'user_id' => Auth::user()->id, 
                'phone_num' => $_GET['update_my_account_phone_code'], 
                'country_phone_num' => $_GET['update_my_account_countrycode'], 
                'user_birth' => $_GET['update_my_account_date_code'], 
                'user_street' => $_GET['update_my_account_street_code'], 
                'user_city' => $_GET['update_my_account_city_code'], 
                'user_state' => $_GET['update_my_account_country_name'], 
                'user_state_code' => $_GET['update_my_account_country_code'], 
                'zipcode' => $_GET['update_my_account_zipcode_name'], 
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ];

            $mainAccountQuery = MyAccountModel::where('user_id',Auth::user()->id)->insert($updateArr);
            $msg = "error";
            if($mainAccountQuery)
            {
                $msg = "success";
            }

            echo json_encode($msg);
        }

        
    }

    /// my account update field data's
    public function show_update_myaccount_data_fx(Request $request)
    {

        // user panel
        $userQuery = User::where('id',Auth::user()->id)->get();
        $html['user_panel_name'] = "";
        $html['user_panel_email'] = "";
        if(count($userQuery) > 0)
        {
            foreach($userQuery as $uQuery)
            {
                $html['update_my_account_username'] = $uQuery->name;
                $html['update_my_account_usermail'] = $uQuery->email;
            }
        }

        //  user address & details panel
        $userDetailsQuery = MyAccountModel::where('user_id',Auth::user()->id)->get();
        $html['update_my_account_countrycode'] = "";
        $html['update_my_account_phone_code'] = "";
        $html['update_my_account_date_code'] = "";
        $html['update_my_account_street_code'] = "";
        $html['update_my_account_city_code'] = "";
        $html['update_my_account_country_code'] = "";
        $html['update_my_account_country_name'] = "";
        $html['update_my_account_zipcode_name'] = "";

        if(count($userDetailsQuery) > 0)
        {
            foreach($userDetailsQuery as $uQuery)
            {
                $html['update_my_account_countrycode'] = $uQuery->country_phone_num;
                $html['update_my_account_phone_code'] = $uQuery->phone_num;
                $html['update_my_account_date_code'] = date('Y-m-d',strtotime($uQuery->user_birth));
                $html['update_my_account_street_code'] = $uQuery->user_street;
                $html['update_my_account_city_code'] = $uQuery->user_city;
                $html['update_my_account_country_code'] = $uQuery->user_state_code;
                $html['update_my_account_country_name'] = $uQuery->user_state;
                $html['update_my_account_zipcode_name'] = $uQuery->zipcode;
            }
        }

        echo json_encode($html);
    }

    /// password change 

    public function my_account_password_change(Request $request)
    {
        $insertQuery = User::where(['id' => Auth::user()->id ])->update(['password' => Hash::make($_GET['new_pass'])]);
        echo json_encode('success');    
    }
}
