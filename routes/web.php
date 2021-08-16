<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Route;

Route::get('paywithpaypal', array('as' => 'paywithpaypal','uses' => 'PaypalController@payWithPaypal',));
Route::post('paypal', array('as' => 'paypal','uses' => 'PaypalController@postPaymentWithpaypal',));
Route::get('paypal', array('as' => 'status','uses' => 'PaypalController@getPaymentStatus',));
Route::get('order-history-listing','PaypalController@showOrderFx')->name('satirtha.order-history-listing');
// user panel routing
Route::group(['prefix' => '/'], function(){
   
    
    Route::get('/welcome','Front\HomeController@welcome')->name('satirtha.welcome');
	// Home page
	Route::get('/','Front\HomeController@index')->name('satirtha.home');
    Route::get('/categories','Front\CategoryController@index')->name('satirtha.categories');
    Route::get('/product','Front\ProductController@index')->name('satirtha.product');
    Route::get('/contact','Front\ContactController@index')->name('satirtha.contact');
    Route::get('/join','Front\JoinController@index')->name('satirtha.join');

    // the email part 
    // for product email
    Route::post('/store-email','email\MailSendController@store')->name('satirtha.store-email');
    // for contact email
    Route::get('/store-contact-email','email\SendContactController@store')->name('satirtha.store-contact-email');
    // for subscribe email
    Route::get('/store-subcribe-email','email\SubscriberController@store')->name('satirtha.subscriber-email');


    /// frontend ///

        // banner
        Route::get('/banner-show','Front\HomePage\HomeController@bannerPage')->name('satirtha.banner-all-data');

        // product
        Route::get('/products-show','Front\ProductPage\ProductController@allProducts')->name('satirtha.load-all-products');
        Route::get('/products-show-all','Front\ProductPage\ProductController@load_modal_product_data')->name('satirtha.load-modal-product-details');
        // product single details
        Route::get('/single-product-details/{val2}','Front\ProductPage\ProductDetailsController@index')->name('satirtha.show-single-product');
        
        // review
        Route::get('/reviews','Front\Review\ReviewController@index')->name('satirtha.review-on-product');
        Route::get('/product-review-panel-load','Front\Review\ReviewController@review_fx')->name('satirtha.product-review-panel-load');

        // my account 
        Route::get('/my-account','Front\MyAccount\MyAccountController@showPage')->name('satirtha.my-account');
        Route::get('/my-account-show-all','Front\MyAccount\MyAccountController@load_my_account_details')->name('satirtha.my-account-data-load');
        Route::get('/my-account-update-data','Front\MyAccount\MyAccountController@update_my_account_data_fx')->name('satirtha.update-my-account-dataflow');
        Route::get('/my-account-update-field-data','Front\MyAccount\MyAccountController@show_update_myaccount_data_fx')->name('satirtha.my-account-show-data');
        Route::get('/my-account-update-data','Front\MyAccount\MyAccountController@update_my_account_data_fx')->name('satirtha.update-my-account-dataflow');
        Route::get('/my-account-password-change','Front\MyAccount\MyAccountController@my_account_password_change')->name('satirtha.my-account-password-change');


        /// review star count
        Route::get('/review-star-count','Front\ProductPage\ProductDetailsController@review_star_count')->name('satirtha.review-star-count');
        Route::get('/review-product-additional-details','Front\ProductPage\ProductDetailsController@product_details_additional_functional_fx')->name('satirtha.review-product-additional-details');
        Route::get('/show-additional-product-details','Front\ProductPage\ProductDetailsController@show_additional_product_details_fx')->name('satirtha.show-additional-product-details');
        Route::get('/additional-product-skip-fx','Front\ProductPage\ProductDetailsController@additional_product_skip_fx')->name('satirtha.additional-product-skip-fx');

        // cart details 
        Route::get('/cart','Front\Cart\CartController@showPage')->name('satirtha.show-cart-page');
        Route::get('/total-cart-price','Front\Cart\CartController@total_cart_price_fx')->name('satirtha.total-cart-price');
        Route::get('/cart-details','Front\Cart\CartController@cart_details_fx')->name('satirtha.show-cart-details');


        // 19.05.2021 --- cart details 
        Route::get('/product-delete-from-cart','Front\Cart\CartController@product_delete_cart_fx')->name('satirtha.product-delete-cart');        
        Route::get('/product-cart-quantity','Front\Cart\CartController@product_cart_quantity_fx')->name('satirtha.product-cart-quantity-fx');

        // cart country name's
        Route::get('/country-cart','Front\Cart\CartController@load_country_region_fx')->name('satirtha.country-cart-fx');
        

       // order history
       Route::get('/order-history','Front\Cart\CartController@oder_now_fx')->name('satirtha.order-now');


       // Auction 
       Route::get('/auction-products','Front\Auction\AuctionController@index')->name('satirtha.auction-product');
       Route::get('/auction-products-details/{auction_name}','Front\Auction\AuctionController@auction_order_index')->name('satirtha.auction-products-details');
       Route::get('/auction-products-home','Front\Auction\AuctionController@auction_home_fx')->name('satirtha.auction.home-page');
       Route::get('/auction-products-order-details','Front\Auction\AuctionController@auction_order_details_fx')->name('satirtha.auction.order-details');


        // Auction Listing
        Route::get('/auction-products-listing','Front\Auction\AuctionListingController@index')->name('satirtha.auction.listing');
        Route::get('/normal-order-history','Front\Auction\AuctionListingController@normal_order_history_fx')->name('satirtha.normal-order-history');
        Route::get('/auction-listing-products','Front\Auction\AuctionListingController@auctionListedProductsFx')->name('satirtha.auction.listing-products');


       // bid part
       Route::get('/bidding','Front\Auction\Bid\BidController@user_bidding_fx')->name('satirtha.auction-product-bid');
       Route::get('/bidding-timing-status','Front\Auction\Bid\BidController@user_bidding_time_status_fx')->name('satirtha.load-auction-product-status');
       Route::get('/bidding-auction-bidders-for-products','Front\Auction\Bid\BidController@bidding_on_this_products_fx')->name('satirtha.auction-bidders-for-products');
       Route::get('/auction-ended-action','Front\Auction\Bid\BidController@auction_ended_action_fx')->name('satirtha.auction-ended-action');

       


    /// end of frontend ///

});

Route::get('payment', 'PaymentController@index');
Route::post('charge', 'PaymentController@charge');
Route::get('paymentsuccess', 'PaymentController@payment_success');
Route::get('paymenterror', 'PaymentController@payment_error');

Route::post('/login/admin', 'Auth\LoginController@adminLogin')->name('admin.log-submit');
Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm')->name('admin.new-login');
Route::view('/admin', 'admin');
Auth::routes();

// user panel routing
Route::group(['prefix' => '/admin'], function(){
    Route::get('/dashboard','Admin\DashboardController@index')->name('admin.dashboard');
    Route::post('/logout','Admin\DashboardController@logout')->name('admin.logout');
    // product category
    Route::get('/product-category','Admin\CategoryController@showPage')->name('admin.show-category');
    Route::get('/show-product-category','Admin\CategoryController@showProductCategory')->name('admin.show-actual-category');
    Route::get('/product-add-category','Admin\CategoryController@addProductCategory')->name('admin.product-add-category');
    Route::get('/show-edit-actual-category','Admin\CategoryController@showEditProductCategory')->name('admin.show-edit-actual-category');
    Route::get('/product-update-category','Admin\CategoryController@updateProductCategory')->name('admin.product-update-category');
    Route::get('/product-change-action-category','Admin\CategoryController@actionProductCategory')->name('admin.product-change-action-category');
    Route::get('/product-del-action-category','Admin\CategoryController@delProductCategory')->name('admin.product-del-action-category');
    // sub product category
    Route::get('/product-sub-category','Admin\SubCategoryController@showPage')->name('admin.show-sub-category');
        // get category for sub categories
        Route::get('/get-product-cate-sub-category','Admin\SubCategoryController@category_found')->name('admin.get-category-for-subcate');
        Route::get('/get-sub-category-for-subcate','Admin\SubCategoryController@chooseSubCategory')->name('admin.get-sub-category-for-subcate');
        ////////
    Route::get('/show-product-sub-category','Admin\SubCategoryController@showProductCategory')->name('admin.show-actual-sub-category');
    Route::get('/product-add-sub-category','Admin\SubCategoryController@addProductCategory')->name('admin.product-add-sub-category');
    Route::get('/show-edit-actual-sub-category','Admin\SubCategoryController@showEditProductCategory')->name('admin.show-edit-actual-sub-category');
    Route::get('/product-update-sub-category','Admin\SubCategoryController@updateProductCategory')->name('admin.product-update-sub-category');
    Route::get('/product-change-action-sub-category','Admin\SubCategoryController@actionProductCategory')->name('admin.product-change-action-sub-category');
    Route::get('/product-del-action-sub-category','Admin\SubCategoryController@delProductCategory')->name('admin.product-del-action-sub-category');

    // product details
    Route::get('/product-details','Admin\ProductController@showPage')->name('admin.show-product');
    Route::get('/show-product-details','Admin\ProductController@showProduct')->name('admin.show-actual-product');
    Route::post('/product-details-add','Admin\ProductController@addProduct')->name('admin.product-add');
    Route::get('/show-edit-product-details','Admin\ProductController@showEditProduct')->name('admin.show-edit-actual-product');
    Route::post('/product-details-update','Admin\ProductController@updateProduct')->name('admin.product-update');
    Route::get('/product-details-change-action','Admin\ProductController@actionProduct')->name('admin.product-change-action');
    Route::get('/product-details-del-action','Admin\ProductController@delProduct')->name('admin.product-del-action');
    Route::get('/product-gallery-del-action','Admin\ProductController@delGalleryProduct')->name('admin.product-gallery-del-action');

    

    // subscribers data's
    Route::get('/subscriber','Admin\SubscriberController@showPage')->name('admin.show-subscriber');
    Route::get('/subscriber-show','Admin\SubscriberController@subcriberShow')->name('admin.show-actual-subscriber');
    Route::get('/subscriber-action-change','Admin\SubscriberController@subcriberActionChange')->name('admin.subscriber-admin-change-status');
    Route::get('/subscriber-action-del','Admin\SubscriberController@subcriberActionDel')->name('admin.subscriber-admin-del-status');
    Route::get('/subscriber-email-view-panel','Admin\SubscriberController@subscribers_email_view_panel')->name('admin.subscribers_email_view_panel');
    Route::get('/subscribe-email-sending-file','Admin\SubscriberController@subscribe_email_sending_file_fx')->name('admin.subscribe-email-sending-file');

    // payment
    Route::get('/payment','Admin\PaymentController@showPage')->name('admin.payment-show');
    Route::get('/show-payment','Admin\PaymentController@showPayment')->name('admin.show-actual-payment');
    Route::get('/show-edit-actual-payment','Admin\PaymentController@showEditPayment')->name('admin.show-edit-actual-payment');
    Route::get('/product-update-payment','Admin\PaymentController@updatePayment')->name('admin.product-update-payment');
    Route::get('/product-change-action-payment','Admin\PaymentController@actionPayment')->name('admin.product-change-action-payment');
    Route::get('/product-del-action-payment','Admin\PaymentController@delPayment')->name('admin.product-del-action-payment');
    // end of payment


    // banner 
    Route::get('/banner','Admin\BannerController@showPage')->name('admin.show-banner');
    Route::get('/show-banner-details','Admin\BannerController@showProduct')->name('admin.show-actual-banner');
    Route::post('/banner-details-add','Admin\BannerController@addProduct')->name('admin.banner-add');
    Route::get('/show-edit-banner-details','Admin\BannerController@showEditProduct')->name('admin.show-edit-actual-banner');
    Route::post('/banner-details-update','Admin\BannerController@updateProduct')->name('admin.banner-update');
    Route::get('/banner-details-change-action','Admin\BannerController@actionProduct')->name('admin.banner-change-action');
    Route::get('/banner-details-del-action','Admin\BannerController@delProduct')->name('admin.banner-del-action');
    Route::get('/banner-gallery-del-action','Admin\BannerController@delGalleryProduct')->name('admin.banner-gallery-del-action');
    // end of banner


    // order history
    Route::get('/order-details','Admin\OrderHistoryController@index')->name('admin.order-details');
    Route::get('/show-order-details','Admin\OrderHistoryController@showActualPage')->name('admin.show-actual-order-details');
    Route::get('/show-order-tracking-change','Admin\OrderHistoryController@tracking_fx')->name('admin.order-track-admin-check');
    // end of order history


    //  Admin auction 
    Route::get('/auction-product','Admin\Auction\AuctionController@index')->name('admin.auction.product');
    Route::get('/auction-product-details','Admin\Auction\AuctionController@product_details_fx')->name('admin.auction.product-details');
    Route::post('/auction-product-add','Admin\Auction\AuctionController@product_details_add_fx')->name('admin.auction.product-details-add');
    Route::get('/auction-product-del','Admin\Auction\AuctionController@product_details_del_fx')->name('admin.auction.product-details-del');
    Route::get('/auction-product-status','Admin\Auction\AuctionController@product_details_status_fx')->name('admin.auction.product-change-action');
    Route::get('/auction-product-edit','Admin\Auction\AuctionController@product_details_edit_fx')->name('admin.auction.product-details-edit');
    Route::post('/auction-product-update','Admin\Auction\AuctionController@product_details_update_fx')->name('admin.auction.product-details-update');

    

});