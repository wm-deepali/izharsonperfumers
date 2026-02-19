<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\FrontendController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CCAvenueControlller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group(['middleware' => ['XSS','cors']], function () {
    Route::post('send-mobile-otp', [FrontendController::class, 'sendMobileOTP']);
    Route::post('verify-mobile-otp', [FrontendController::class, 'verifyOTP']);
    Route::post('/subscribers', [FrontendController::class,'subscribers']);
    Route::post('/contact-us',[FrontendController::class,'contact_us']);
    Route::post('/feedback',[FrontendController::class,'feedback']);
    Route::post('/book-appointment', [FrontendController::class,'bookappointment']);
    Route::post('/login', [FrontendController::class,'login']);
    Route::post('/add-garage', [FrontendController::class,'addgarage']);
    Route::post('/register', [FrontendController::class,'register']);
    Route::post('/filter-product-with-price', [FrontendController::class,'filterproductwithprice']);
    Route::post('/filter-product-with-brand', [FrontendController::class,'filterproductwithbrand']);
    Route::post('/filter-product', [FrontendController::class,'filterproduct']);
    Route::get('auth', [FrontendController::class, 'redirectToAuth']);
    Route::get('auth/callback', [FrontendController::class, 'handleAuthCallback']);
    //unauth cart service api
    Route::post('get-cart-service-unauth', [FrontendController::class, 'getCartserviceUnauthenticated']);
    Route::post('store-cart-service-unauth', [FrontendController::class, 'storeCartserviceUnauthenticated']);
    Route::post('remove-item-from-cart-service-unauth/{cart_item_id}', [FrontendController::class, 'removeItemFromCartserviceUnauthenticated']);
     Route::post('get-cart-unauth', [FrontendController::class, 'getCartUnauthenticated']);
    Route::post('store-cart-unauth', [FrontendController::class, 'storeCartUnauthenticated']);
    Route::post('remove-item-from-cart-unauth/{cart_item_id}', [FrontendController::class, 'removeItemFromCartUnauthenticated']);
     Route::post('increase-cart-item-quantity-unauth/{cart_item_id}', [FrontendController::class, 'increaseCartItemQuantityUnauthenticated']);
    Route::post('decrease-cart-item-quantity-unauth/{cart_item_id}', [FrontendController::class, 'decreaseCartItemQuantityUnauthenticated']);
    Route::post('/check-pincode-delivery',[FrontendController::class,'CheckPincodeDelivery']);
    Route::post('/getshippingtype',[FrontendController::class,'getshippingtype']);
    Route::post('forget-password', [UserController::class, 'submitForgetPassword']); 
    Route::post('reset-password', [UserController::class, 'submitResetPassword']); 
    Route::post('reason', [UserController::class, 'reasons']); 
    Route::post('add-to-wishlist-unauth', [UserController::class, 'addtowishlistunauth']); 
     Route::post('/email-verification',[FrontendController::class,'EmailVerification']);
    Route::post('/send-email-verification',[FrontendController::class,'sendEmailVerificationLink']);
    Route::post('get-wishlist-unauth', [UserController::class, 'getwishlistunauth']); 
    Route::post('remove-wishlist-unauth', [UserController::class, 'removefromwishlistunauth']); 

    
    
    //auth api start
    Route::group(['middleware' => ['XSS','auth:api','cors']], function () {
        
   
    Route::post('/add-customer-address', [FrontendController::class,'addcustomeraddress']);
    // Route::get('/get-customer-address', [FrontendController::class,'getcustomeraddress']);
    Route::put('/update-customer-address/{id}', [FrontendController::class,'updatecustomeraddress']);
    Route::put('/update-customer-shipping-address/{id}', [FrontendController::class,'updatecustomershippingaddress']);
    Route::put('/update-customer-billing-address/{id}', [FrontendController::class,'updatecustomerbillingaddress']);
    Route::get('/customer-address', [FrontendController::class,'getcustomeraddress']);
    Route::get('/customer-billing-address/{id}', [FrontendController::class,'getcustomerbillingaddress']);
    Route::get('/customer-shipping-address/{id}', [FrontendController::class,'getcustomershippingaddress']);
    Route::delete('/delete-customer-shipping-address/{id}', [FrontendController::class,'deletecustomershippingaddress']);
    Route::delete('/delete-customer-billing-address/{id}', [FrontendController::class,'deletecustomerbillingaddress']);
    Route::post('/update-customer-profile', [FrontendController::class,'updatecustomerprofile']);
    Route::post('cart', [FrontendController::class,'cart']);
    
     //auth cart service api
      Route::post('/apply-coupon-service', [FrontendController::class,'applycouponservice']);
      Route::post('/remove-coupon-service', [FrontendController::class,'removeCouponservice']);
     Route::get('get-cart-service', [FrontendController::class, 'getCartservice']);
    Route::post('store-cart-service', [FrontendController::class, 'storeCartservice']);
    Route::post('remove-item-from-cart-service/{cart_item_id}', [FrontendController::class, 'removeItemFromCartservice']);
    
    Route::get('get-cart', [FrontendController::class, 'getCart']);
    Route::post('store-cart', [FrontendController::class, 'storeCart']);
    Route::post('remove-item-from-cart/{cart_item_id}', [FrontendController::class, 'removeItemFromCart']);
    Route::post('increase-cart-item-quantity/{cart_item_id}', [FrontendController::class, 'increaseCartItemQuantity']);
    Route::post('decrease-cart-item-quantity/{cart_item_id}', [FrontendController::class, 'decreaseCartItemQuantity']);
     Route::post('/apply-coupon', [FrontendController::class,'applycoupon']);
    Route::post('/remove-coupon', [FrontendController::class,'removeCoupon']);
     Route::post('/apply-coupon-oilgrade', [FrontendController::class,'applycouponoilgrade']);
    Route::post('submit-order',[FrontendController::class,'submitOrder']);
    Route::post('service-booking',[FrontendController::class,'servicebooking']);
    Route::post('oilgrade-service-booking',[FrontendController::class,'oilgradeservicebooking']);
    Route::post('submit-order-review',[FrontendController::class,'submitOrderReview']);
    Route::post('update-profile-photo',[UserController::class,'updateProfilePhoto']);
    Route::get('dashboard',[UserController::class,'dashboard']);
     Route::post('orders',[UserController::class,'orders']);
    Route::get('order/{order_id}',[UserController::class,'order']);
    Route::get('orderdata/{order_id}',[UserController::class,'orderdata']);
    Route::get('track-order-status/{order_id}',[UserController::class,'orderstatus']);
    Route::post('cancel-order',[UserController::class,'cancelOrder']);
     Route::post('/update-password', [UserController::class,'updatepassword']);
     Route::get('/get-customer', [UserController::class,'getcustomer']);
     Route::post('/order-services', [UserController::class,'orderservices']);
     Route::post('/cancel-order-service', [UserController::class,'cancelorderservice']);
     Route::get('/order-service/{order_id}', [UserController::class,'orderservice']);
      Route::post('return-order', [UserController::class, 'returnorderproduct']); 
    Route::post('seller-order-feedback', [UserController::class, 'sellerorderfeedback']); 
    Route::post('add-to-wishlist', [UserController::class, 'addtowishlist']); 
    Route::get('get-wishlist', [UserController::class, 'getwishlist']); 
    Route::post('remove-from-wishlist', [UserController::class,'removfromewishlist']);
     Route::get('/logout', [UserController::class,'logout']);
     Route::get('/orderreviewfeedback', [UserController::class,'orderratingfeedback']);
    

});
//auth api end
});


Route::group(['middleware' => ['cors']], function () {
Route::get('/policy/{name}',[FrontendController::class,'policies']);
Route::get('/about-us',[FrontendController::class,'about_us']);
Route::get('/sliders',[FrontendController::class,'sliders']);
Route::get('/manage-career',[FrontendController::class,'managecareer']);
Route::get('/blogs',[FrontendController::class,'blogs']);
Route::get('/recent-blogs',[FrontendController::class,'recentblogs']);
Route::get('/blogdetail/{slug}',[FrontendController::class,'blogdetail']);

Route::get('/latest-blogs',[FrontendController::class,'latestblog']);
Route::get('/faqs',[FrontendController::class,'faqs']);
Route::get('/service-categories',[FrontendController::class,'service_management_category']);
Route::get('/service-services',[FrontendController::class,'service_management_services']);
Route::get('/fleet-services',[FrontendController::class,'fleet_service']);
Route::get('/site-settings', [FrontendController::class,'sitesettings']);
Route::get('/social-settings', [FrontendController::class,'social_sett']);
Route::get('/header-settings', [FrontendController::class,'header_sett']);
Route::get('/footer-settings', [FrontendController::class,'footer_sett']);
Route::get('/manage-brands', [FrontendController::class,'managebrands']);
Route::get('/manage-teams', [FrontendController::class,'manageteams']);
Route::get('/manage-garage', [FrontendController::class,'managegarage']);
Route::get('/manage-garage', [FrontendController::class,'managegarage']);
Route::get('/manage-shipping', [FrontendController::class,'manageshipping']);
Route::get('/manage-product/{id?}', [FrontendController::class,'manageproduct']);
Route::get('/premium-product/{id?}', [FrontendController::class,'premiumproduct']);
Route::get('/best-deal-product/{id?}', [FrontendController::class,'bestdealproduct']);
Route::get('/top-product/{id?}', [FrontendController::class,'topsellingproduct']);
Route::get('/max-discount-product', [FrontendController::class,'maxdiscountproduct']);
Route::get('/new-arrival-product/{id?}', [FrontendController::class,'newarrivalproduct']);
Route::get('/value-added-service', [FrontendController::class,'valueaddedservice']);
Route::get('/other-services', [FrontendController::class,'otherservices']);
Route::get('/oil-grade-package', [FrontendController::class,'oilgradepackage']);
Route::get('/product-categories', [FrontendController::class,'productcategories']);
Route::get('/filter-product-with-category/{id}', [FrontendController::class,'filterproductwithcategory']);
Route::get('/manage-product-with-category/{id}', [FrontendController::class,'manageproductwithcategory']);
Route::get('/manage-product-with-category-all', [FrontendController::class,'manageproductwithcategoryall']);
Route::get('/price-range', [FrontendController::class,'pricerange']);
Route::get('/country', [FrontendController::class,'country']);
Route::get('/car-model/{id}', [FrontendController::class,'carmodel']);
Route::get('/manage-volume', [FrontendController::class,'carmake']);
Route::get('/manage-brand', [FrontendController::class,'carorigin']);
Route::get('/manage-packaging', [FrontendController::class,'cylinder']);
Route::get('/fragrance', [FrontendController::class,'oilgrade']);
Route::get('/state/{id}', [FrontendController::class,'state']);
Route::get('/city/{id}', [FrontendController::class,'city']);
Route::get('/garage', [FrontendController::class,'garageall']);
Route::post('/garage-search', [FrontendController::class,'garagesearch']);
Route::post('/filter-oilgrade-package', [FrontendController::class,'filteroilgradepackage']);
Route::get('/get-promotions', [FrontendController::class,'getpromotion']);
Route::get('/manage-page/{pages}', [FrontendController::class,'pages']);
Route::post('/google/login', [UserController::class,'googlelogin']); 
 Route::get('/homepagewidget', [UserController::class,'homepagewidget']);
Route::get('/company-address', [UserController::class,'companyaddress']);
 Route::get('/razorpaydata', [UserController::class,'razorpaydata']);
 Route::get('/bankaccount', [UserController::class,'bankaccount']);
 Route::get('/getpincodedata/{pincode}', [FrontendController::class,'getpincodedata']);
 Route::post('/importcity', [FrontendController::class,'importcity']);
 Route::post('/requesthandler', [CCAvenueControlller::class,'requesthandler']);
 Route::post('/responsehandler', [CCAvenueControlller::class,'responsehandler']);




});
