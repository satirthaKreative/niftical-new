<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\CartModel;
use App\Model\ReviewModel;
use App\Model\ProductModel;
use App\Model\CountryModel;
use App\Model\ProductImageModel;
use App\Model\ProductAdditionalData;
use App\Model\OrderDetailModel;
use App\Model\ShippingModel;
use Auth;



use Validator;
use URL;
use Session;
use Redirect;
use Input;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;


use Illuminate\Support\Facades\Mail;
use App\Mail\OrderDetailsMailClient;


class PaypalController extends Controller
{
    private $_api_context;
    
    public function __construct()
    {
            
        $paypal_configuration = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_configuration['client_id'], $paypal_configuration['secret']));
        $this->_api_context->setConfig($paypal_configuration['settings']);
    }

    public function payWithPaypal()
    {
        return view('satirtha.order-now');
    }

    public function postPaymentWithpaypal(Request $request)
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

    	$item_1 = new Item();

        $item_1->setName('Product 1')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($request->get('amount'));

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($request->get('amount'));

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Enter Your transaction description');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('status'))
            ->setCancelUrl(URL::route('status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));            
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error','Connection timeout');
                return Redirect::route('satirtha.order-now');                
            } else {
                \Session::put('error','Some error occur, sorry for inconvenient');
                return Redirect::route('satirtha.order-now');                
            }
        }

        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        
        Session::put('paypal_payment_id', $payment->getId());

        if(isset($redirect_url)) {   
			$shippingArr = [
				"user_id" => Auth::user()->id, 
				"first_name" => $request->input('fname'), 
				"last_name" => $request->input('lname'), 
				"company_name" => $request->input('cname'), 
				"country_name" => $request->input('country_region_name'), 
				"street_one" => $request->input('sname1'), 
				"street_two" => $request->input('sname2'), 
				"city_name" => $request->input('town_city'), 
				"zip_code" => $request->input('zip_code'), 
				"phone_num" => $request->input('phone_num'), 
				"email_address" => $request->input('email_address'), 
				"admin_action" => 'yes', 
				"created_at" => date('Y-m-d'), 
				"updated_at" => date('Y-m-d'),
			];
			
			$shippingQuery = ShippingModel::insert( $shippingArr );
			
			
		
			
			
            return Redirect::away($redirect_url);
        }

        \Session::put('error','Unknown error occurred');
    	return Redirect::route('satirtha.order-now');
    }

    public function getPaymentStatus(Request $request)
    {        
        $payment_id = Session::get('paypal_payment_id');

        Session::forget('paypal_payment_id');
        if (empty($request->input('PayerID')) || empty($request->input('token'))) {
            \Session::put('error','Payment failed');
            return Redirect::route('satirtha.order-now');
        }
        $payment = Payment::get($payment_id, $this->_api_context);        
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));        
        $result = $payment->execute($execution, $this->_api_context);
        
        if ($result->getState() == 'approved') {   
			
			// 
			$cartQuery = CartModel::where([ 'user_id' => Auth::user()->id, 'admin_action' => 'active' ])->get();
			if(count($cartQuery) > 0)
			{
                $html_cart = "";
                $html_price = 0;
				foreach($cartQuery as $ctQuery)
				{
					$insertArr = [
						"cart_id" => $ctQuery->id, 
						"user_id" => Auth::user()->id, 
						"user_ip" => $_SERVER['REMOTE_ADDR'], 
						"product_id" => $ctQuery->product_id, 
						"product_name" => $ctQuery->product_name, 
						"additional_product_id" => $ctQuery->additional_product_id, 
						"product_price" => $ctQuery->product_price, 
						"product_quantity" => $ctQuery->product_quantity, 
						"admin_action" => 'active', 
						"created_at" => date('Y-m-d'), 
						"updated_at" => date('Y-m-d')	
					];
					
					$cartInsertQuery = OrderDetailModel::insert($insertArr);

                    // mail image
                    $mailImageQuery = ProductImageModel::where('product_id',$ctQuery->product_id)->get();
                    foreach($mailImageQuery as $mailImg)
                    {
                        $order_img = str_replace('public','storage/app/public',asset($mailImg->product_images));
                    }

                    // mail client 
                    $html_cart .= '<tr>
                                    <td align="center" style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;  border-bottom: 1px solid #dedede;  padding: 20px 0;">
                                    <table>
                                        <tr style="background: #fff;">
                                               
                                                <td width="30" style="vertical-align:top;padding: 0px 10px;" >
                                                    <img border="0" class="banner" alt="banner" src="'.$order_img.'" style="display: block;-ms-interpolation-mode: bicubic;border: 2px solid #4D008D;height: auto;line-height: 100%;outline: none;text-decoration: none;width: 100%;">
                                                    
                                                </td>
                                                <td width="300" style="vertical-align:top;    padding: 0 20px;" >
                                                  
                                                    <p style="font-weight: 600;color: #000;margin-bottom: 0;background: #fff;margin-top:0px;text-align: left;font-size: 13px;line-height: 17px;display: block;text-decoration: none;">Mauris non condimentum rutrum
                                                        <span style="font-weight: 400;color: #4D008D;  margin-bottom: 0;background: #fff;margin-top: 0px;    text-align: left;font-size: 10px;display: block;">'.$ctQuery->product_name.'</span>
                                                    </p>
                                                </td>
                                                <td width="200" style="vertical-align:top;padding: 0 20px;" >
                                                    
                                                    <p style="font-weight: 300;color: #000;margin-bottom: 0;background: #fff;margin-top: 15px;text-align: center;font-size: 14px;line-height: 17px;display: block;text-decoration: none;">
                                                        <span style="font-weight: 600;color: #4D008D;margin-bottom: 0;background: #fff;margin-top: 0px;text-align: right;font-size: 19px;display: block;">$'.$ctQuery->product_price.'</span>
                                                    </p>
                                                </td>
                                        </tr>
                                    </table>
                                    </td>
                                </tr>';

                                $html_price .= $html_price + $ctQuery->product_price;
				}

                $data = [
                    'cart_details' => $html_cart,
                    'cart_price' => $html_price, 
                ];
                Mail::to('satirtha63@gmail.com')->send(new \App\Mail\OrderDetailsMailClient($data));
				
				$cartQuery = CartModel::where([ 'user_id' => Auth::user()->id ])->update([ 'admin_action' => 'inactive' ]);
			}
			
			// cart insert Array
			
            \Session::put('success','Payment success !!');
            return Redirect::route('satirtha.order-now');
        }

        \Session::put('error','Payment failed !!');
		return Redirect::route('satirtha.order-now');
    }
	
	
	public function showOrderFx(Request $request)
	{
		$orderQuery = OrderDetailModel::where('user_id',Auth::user()->id)->get();
		
		$html = '<tr>
                        <th>image</th>
                        <th>name</th>
                        <th>quantity</th>
                        <th>price</th>
                    </tr>';
		if(count($orderQuery) > 0)
		{
			foreach($orderQuery as $oQuery){
				
				$pQuery = ProductModel::where(['id' => $oQuery->product_id])->get();
				foreach($pQuery as $allProduct)
				{
					$product_img = $allProduct->product_thumbnail;
				}
				$html .= '<tr>
								<td><img src="'.str_replace('public','storage/app/public',asset($product_img)).'"></td>
								<td>'.$oQuery->product_name.'</td>
								<td>'.$oQuery->product_quantity.'</td>
								<td>$'.$oQuery->product_price.'</td>
							</tr>';
			}
		}
		else
		{
			$html .= '<tr><td colspan=5><i class="fa fa-times"></i> No Data</td></tr>';
		}
		
		echo json_encode($html);
	}
}
