<?php

use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\CommonController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FaqCategoryController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\GeneralSettingController;
use App\Http\Controllers\Admin\HomepageSettingController;
use App\Http\Controllers\Admin\PincodeController;
use App\Http\Controllers\Admin\PolicyController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\FleetServiceController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ServiceCategoryController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\PackagesController;
use App\Http\Controllers\Admin\ServiceBookingController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\GarageController;
use App\Http\Controllers\Admin\CareerController;
use App\Http\Controllers\Admin\CarOriginContrroller;
use App\Http\Controllers\Admin\BrandModelController;
use App\Http\Controllers\Admin\OilGradeController;
use App\Http\Controllers\Admin\CylinderController;
use App\Http\Controllers\Admin\BookAppointMentController;
use App\Http\Controllers\Admin\ReasonController;
use App\Http\Controllers\Admin\CompanyAddressController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\HomeFeatureController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\CustomerAuthController;
use App\Http\Controllers\Auth\CustomerForgotPasswordController;
use App\Http\Controllers\Auth\GoogleController;

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
// Password Reset links 
Route::get('/clear', function () {
  Artisan::call('optimize:clear');
});

// Frontend Route List 
Route::get('/', [FrontController::class, 'index']);
Route::get('/search-suggestions', [FrontController::class, 'suggestions']);
Route::post('/subscribe', [FrontController::class, 'subscribers'])->name('subscribe');
Route::get('/shop/{categorySlug?}/{subSlug?}', [FrontController::class, 'productList'])->name('shop.category');
Route::get('/about-us', [FrontController::class, 'aboutUs'])->name('about');
Route::get('/product-details/{slug}', [FrontController::class, 'productDetails'])->name('product-details');
Route::get('/faq', [FrontController::class, 'faqs'])->name('faq');

Route::get('/blogs', [FrontController::class, 'blogs'])->name('blogs');
Route::get('/blog/{slug}', [FrontController::class, 'blogDetail'])->name('blog.details');

Route::get('/contact-us', [FrontController::class, 'contactUs'])->name('contact');
Route::post('/contact-submit', [FrontController::class, 'contactStore'])->name('contact.store');

Route::get('/feedback', [FrontController::class, 'feedback'])->name('feedback');
Route::post('/feedback', [FrontController::class, 'feedbackStore'])->name('feedback.store');

Route::post('/wishlist/toggle', [FrontController::class, 'addToWishlist'])->name('wishlist.toggle');
Route::get('/privacy-policy', [FrontController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/terms-conditions', [FrontController::class, 'termsConditions'])->name('terms-conditions');
Route::get('/refund-policy', [FrontController::class, 'refundPolicy'])->name('refund-policy');
Route::get('/cookie-policy', [FrontController::class, 'cookiePolicy'])->name('cookie-policy');
Route::get('/shipping-policy', [FrontController::class, 'shippingPolicy'])->name('shipping-policy');

Route::post('/store-device', function (\Illuminate\Http\Request $request) {
  session(['device_id' => $request->device_id]);
  return response()->json(['ok']);
})->name('device.store');

Route::get('/mini-cart', [CartController::class,'miniCart'])->name('mini.cart');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/store', [CartController::class, 'storeCart'])->name('cart.store');
Route::post('/cart/update/{id}', [CartController::class, 'updateQty']);
Route::post('/cart/remove/{id}', [CartController::class, 'removeItem']);
Route::post('/cart/set-quantity/{id}', [CartController::class, 'setQuantity']);
Route::get('checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::get('/states/{country}', [CheckoutController::class, 'states']);
Route::get('/cities/{state}', [CheckoutController::class, 'cities']);

// Customer Routes list
Route::prefix('customer')->name('customer.')->group(function () {

  Route::get('/login', [CustomerAuthController::class, 'showLogin'])->name('login');
  Route::post('/login', [CustomerAuthController::class, 'login']);

  Route::get('/register', [CustomerAuthController::class, 'showRegister'])->name('register');
  Route::post('/register', [CustomerAuthController::class, 'register']);

  Route::get('forgot-password', [CustomerForgotPasswordController::class, 'showForm'])->name('password.request');
  Route::post('forgot-password', [CustomerForgotPasswordController::class, 'sendResetLink'])->name('password.email');

  Route::get('reset-password/{token}', [CustomerForgotPasswordController::class, 'showResetForm'])->name('password.reset');
  Route::post('reset-password', [CustomerForgotPasswordController::class, 'resetPassword'])->name('password.reset.update');

  Route::get('google', [GoogleController::class, 'redirect'])->name('google.login');
  Route::get('google/callback', [GoogleController::class, 'callback']);

  Route::post('/logout', [CustomerAuthController::class, 'logout'])->name('logout');

  Route::middleware('auth:customer')->group(function () {

    Route::get('/orders', [App\Http\Controllers\DashboardController::class, 'myOrders'])->name('orders');
    Route::get('/orders/{id}', [App\Http\Controllers\DashboardController::class, 'orderDetails'])->name('order.details');
    Route::post('/order-review-submit', [App\Http\Controllers\DashboardController::class, 'submitReview'])->name('review.submit');
    Route::post('/order-cancel', [App\Http\Controllers\DashboardController::class, 'cancelOrder'])->name('order.cancel');
    
    Route::get('/wishlist', [FrontController::class, 'wishlist'])->name('wishlist');
    Route::post('/wishlist/remove', [FrontController::class, 'removeFromWishlist'])->name('wishlist.remove');

    Route::get('invoices', [App\Http\Controllers\DashboardController::class, 'invoices'])->name('invoices');

    Route::get('/account-details', [App\Http\Controllers\DashboardController::class, 'accountDetails'])->name('account-details');
    Route::post('/profile-update', [App\Http\Controllers\DashboardController::class, 'updateProfile'])->name('profile.update');
    Route::post('/update-password',[App\Http\Controllers\DashboardController::class,'updatePassword'])->name('password.update');

    Route::get('/account-address', [App\Http\Controllers\DashboardController::class, 'accountAddress'])->name('account-address');

    Route::post('/cart/apply-coupon', [CartController::class, 'applyCoupon'])->name('cart.applyCoupon');
    Route::post('/cart/remove-coupon', [CartController::class, 'removeCoupon'])->name('cart.removeCoupon');
    Route::post('/billing-address/save', [CheckoutController::class, 'saveBilling']);
    Route::post('/shipping-address/save', [CheckoutController::class, 'saveShipping']);
    Route::post('/copy-billing-to-shipping', [CheckoutController::class,'copyBillingToShipping']);
    Route::post('/place-order', [CheckoutController::class, 'placeOrder']);
    Route::get('/payment/request/{order}', [CheckoutController::class, 'request'])->name('payment.request');
    Route::post('/payment/response', [CheckoutController::class, 'response'])->name('payment.response');
    Route::get('/order-success/{id}', [CheckoutController::class, 'success'])->name('order.success');

  });
});

// Admin Routes list
Auth::routes(['register' => false]);
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');


Route::prefix('admin')->name('admin.')->group(function () {
  Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('/manage-category', CategoryController::class);
    Route::post('/manage-category/change-status/{id}', [CategoryController::class, 'changestatus']);
    Route::get('/manage-category/show-category/{id}', [CategoryController::class, 'showcategory']);

    Route::resource('/manage-team', TeamController::class);
    Route::resource('/manage-garage', GarageController::class);
    Route::resource('/manage-brand', BrandController::class);
    Route::post('/manage-brand/change-status/{id}', [BrandController::class, 'changestatus']);
    Route::resource('/manage-brand-models', BrandModelController::class);
    Route::post('/manage-brand-models/change-status/{id}', [BrandModelController::class, 'changestatus']);
    Route::resource('/manage-cylinder', CylinderController::class);
    Route::post('/manage-cylinder/change-status/{id}', [CylinderController::class, 'changestatus']);
    Route::resource('/manage-oil-grade', OilGradeController::class);
    Route::post('/manage-oil-grade/change-status/{id}', [OilGradeController::class, 'changestatus']);
    Route::resource('/manage-attribute', AttributeController::class);
    Route::resource('/manage-color', ColorController::class);
    Route::resource('/manage-order', OrderController::class);
    Route::get('manage-order/show/{id}', [OrderController::class, 'show']);
    Route::get('manage-order/rating/{id}', [OrderController::class, 'getrating']);
    Route::resource('/manage-career', CareerController::class);
    Route::resource('/manage-carorigin', CarOriginContrroller::class);
    Route::post('/manage-carorigin/change-status/{id}', [CarOriginContrroller::class, 'changestatus']);

    Route::post('/update-order-status', [OrderController::class, 'updateOrderStatus'])->name('update-order-status');
    Route::post('/update-transit-order-status', [OrderController::class, 'updatetransitorderstatus'])->name('update-transit-order-status');
    Route::post('/update-cancel-order-status', [OrderController::class, 'updatecancelorderstatus'])->name('update-cancel-order-status');
    Route::post('/refund', [OrderController::class, 'refund'])->name('refund');
    Route::get('/manage-shipping', [OrderController::class, 'viewShippingDetails'])->name('manage-shipping');
    Route::post('/manage-shipping/change-status/{id}', [OrderController::class, 'changestatus']);
    Route::post('/approvepayment/{id}', [OrderController::class, 'approvepayment']);
    Route::get('/add-new-shipping', [OrderController::class, 'addNewShipping'])->name('add-new-shipping');
    Route::post('/add-shipping', [OrderController::class, 'addShipping'])->name('add-shipping');
    Route::get('/edit-shipping/{id}', [OrderController::class, 'EditShippingDetails'])->name('edit-shipping');
    Route::get('/edit-free-shipping/{id}', [OrderController::class, 'EditFreeShippingDetails'])->name('edit-free-shipping');
    Route::post('/update-shipping/{id}', [OrderController::class, 'updateShipping'])->name('update-shipping');
    Route::post('/update-free-shipping/{id}', [OrderController::class, 'updateFreeShipping'])->name('update-free-shipping');
    Route::delete('/delete-shipping/{id}', [OrderController::class, 'DeleteShipping'])->name('delete-shipping');
    Route::get('/manage-shipping/showshipping/{id}', [OrderController::class, 'showshipping'])->name('delete-shipping');
    Route::get('/online-cancellation-refund', [OrderController::class, 'onlinecancellationrefund'])->name('online-cancellation-refund');
    Route::get('/order-customer-request/{id}', [OrderController::class, 'ordercustomerrequest'])->name('ordercustomerrequest');
    Route::post('/order-customer-request-message', [OrderController::class, 'ordercustomerrequestmessage'])->name('ordercustomerrequestmessage');
    Route::get('/view-all-transactions', [OrderController::class, 'viewalltransaction'])->name('viewalltransaction');
    Route::get('invoice/{order_number}', [OrderController::class, 'invoice'])->name('invoice');
    Route::get('manage-customer-review', [OrderController::class, 'managecustomerreview'])->name('manage-customer-review');
    // Route::get('manage-reasons-category',[OrderController::class,'managereasonscategory'])->name('manage-reasons-category');
    Route::resource('manage-reasons-category', ReasonController::class);
    Route::post('/manage-reasons-category/change-status/{id}', [ReasonController::class, 'changestatus']);
    Route::get('manage-ticket', [OrderController::class, 'manageticket'])->name('manage-ticket');
    Route::resource('/manage-product', ProductController::class);
    Route::post('/product/toggleDeal', [ProductController::class, 'toggleDeal'])->name('product.toggleDeal');
    Route::post('/manage-product/change-status/{id}', [ProductController::class, 'changestatus']);

    Route::post('/getbrandmodel', [ProductController::class, 'getbrandmodel'])->name('getbrandmodel');
    Route::post('/carmodel', [ProductController::class, 'carmodel'])->name('carmodel');
    Route::get('/deletegallery', [ProductController::class, 'deletegallery'])->name('gallery.delete');

    Route::post('/generate-product-row-by-attributes', [ProductController::class, 'generateProductRowByAttributes'])->name('generate-product-row-by-attributes');
    Route::get('/product-option-image/{id}', [ProductController::class, 'productOptionImage'])->name('product-option-image');
    Route::post('/product-option-image/{id}', [ProductController::class, 'uploadOptionImage'])->name('product-option-image');
    Route::delete('/product-option-image/{id}', [ProductController::class, 'deleteOptionImage'])->name('product-option-image');
    Route::get('/delete-variant-image', [ProductController::class, 'deletevariantImage'])->name('delete-variant-image');
    Route::get('/product-option-gallery-image/{id}', [ProductController::class, 'allGalleryImage'])->name('product-option-gallery-image');

    Route::delete('/product-variant-option/{id}', [ProductController::class, 'deleteVariantOptions'])->name('deleteVariantOptions');
    Route::post('/fetch-subcategory-by-category', [ProductController::class, 'fetchsubcategorybycategory'])->name('fetchsubcategorybycategory');

    Route::resource('/manage-about-us', AboutUsController::class);
    Route::resource('/manage-promotion', PromotionController::class);

    Route::resource('/manage-slider', SliderController::class);
    Route::resource('/manage-feedback', FeedbackController::class);
    Route::post('/manage-feedback/change-status/{id}', [FeedbackController::class, 'changestatus']);
    Route::resource('/manage-contact-us', ContactUsController::class);
    Route::get('manage-email-subscriber', [ContactUsController::class, 'emailsubscriber'])->name('email-subscriber');
    Route::delete('manage-email-subscriber/{id}', [ContactUsController::class, 'deleteemailsubscriber'])->name('delete.email-subscriber');
    Route::resource('/manage-blog', BlogController::class);
    Route::resource('/manage-faq-category', FaqCategoryController::class);
    Route::resource('/manage-faq', FaqController::class);
    Route::get('/manage-policy/{name}', [PolicyController::class, 'index'])->name('manage-policy');
    Route::post('/manage-policy/{name}', [PolicyController::class, 'store']);
    Route::resource('manage-pages', PageController::class);
    Route::get('/manage-account', [GeneralSettingController::class, 'accountSetting'])->name('accountSetting');
    Route::post('update-password', [GeneralSettingController::class, 'updatePasswordnew'])->name('update-password-new');
    Route::post('saverazorpay', [GeneralSettingController::class, 'saverazorpay'])->name('saverazorpay');
    Route::post('updatebank', [GeneralSettingController::class, 'updatebank'])->name('updatebank');
    Route::post('logout', [GeneralSettingController::class, 'logout'])->name('logout');
    Route::post('update-admin-profile', [GeneralSettingController::class, 'updateadminprofile'])->name('updateadminprofile');
    Route::post('update-email-setting', [GeneralSettingController::class, 'updateemailsetting'])->name('updateemailsetting');

    Route::get('/manage-customer', [CustomerController::class, 'index'])->name('manageCustomer');
    Route::post('/manage-customer-changepassword/{id}', [CustomerController::class, 'changepassword'])->name('manageCustomer.changepassword');

    Route::resource('manage-companyaddress', CompanyAddressController::class);
    Route::post('/manage-companyaddress/change-status/{id}', [CompanyAddressController::class, 'changestatus'])->name('changestatus');

    Route::get('/manage-customers/{id}', [CustomerController::class, 'viewcustomer'])->name('viewcustomer');
    Route::get('/customer-orders/{id}', [CustomerController::class, 'cutomerOrders'])->name('cutomerOrders');
    Route::post('/update-customer/{id}', [CustomerController::class, 'updateCustomer'])->name('updateCustomer');
    Route::delete('/manage-customers/{id}', [CustomerController::class, 'destroy'])->name('destroycustomer');
    Route::post('fetch-states', [CustomerController::class, 'fetchState']);
    Route::post('fetch-cities', [CustomerController::class, 'fetchCity']);
    Route::get('edit-customer-billing/{id}', [CustomerController::class, 'editcustomerbilling']);
    Route::post('update-customer-billing', [CustomerController::class, 'updatecustomerbilling'])->name('updatecustomerbilling');
    Route::post('update-customer-shipping', [CustomerController::class, 'updatecustomershipping'])->name('updatecustomershipping');
    Route::post('update-customer-profile', [CustomerController::class, 'updatecustomerprofile'])->name('updatecustomerprofile');
    Route::get('edit-customer-shipping/{id}', [CustomerController::class, 'editcustomershipping']);

    // Route for General settings 
    Route::resource('/manage-general-setting', GeneralSettingController::class);

    Route::post('/general-sttings-header', [GeneralSettingController::class, 'saveHeaderSetting'])->name('saveHeaderSetting');

    Route::post('/general-sttings-footer', [GeneralSettingController::class, 'saveFooterSetting'])->name('saveFooterSetting');
    Route::post('/general-sttings-sociallinks', [GeneralSettingController::class, 'saveSocialLinks'])->name('saveSocialLinks');
    Route::post('/general-sttings-save-gst', [GeneralSettingController::class, 'saveGSTDetails'])->name('saveGSTDetails');
    Route::post('/general-sttings-save-cod', [GeneralSettingController::class, 'saveCODDetails'])->name('saveCODDetails');
    Route::post('/general-sttings-save-lang', [GeneralSettingController::class, 'saveLangDetails'])->name('saveLangDetails');

    // end general setting routes

    Route::resource('/manage-homepage-setting', HomepageSettingController::class);
    Route::resource('home-features', HomeFeatureController::class)->names('home-features');
    Route::resource('/manage-pincode', PincodeController::class);
    Route::resource('/manage-coupon', CouponController::class);

    Route::post('/fetch-childs-by-attributes', [CommonController::class, 'fetchChildsByAttributes'])->name('fetch-childs-by-attributes');
    Route::post('/image-upload', [CommonController::class, 'imageUpload'])->name('image-upload');

    // ankit
    Route::resource('/manage-service-category', ServiceCategoryController::class);
    Route::post('/manage-service-category/change-status/{id}', [ServiceCategoryController::class, 'changestatus']);
    Route::get('manage-service-category/show/{id}', [ServiceCategoryController::class, 'showservice']);

    Route::resource('/manage-services', ServicesController::class);
    Route::post('/manage-services/change-status/{id}', [ServicesController::class, 'changestatus']);
    Route::get('manage-services/show/{id}', [ServicesController::class, 'showservices'])->name('services.show');

    Route::resource('/manage-packages', PackagesController::class);
    Route::post('/manage-packages/change-status/{id}', [PackagesController::class, 'changestatus']);

    Route::get('manage-packages/show/{id}', [PackagesController::class, 'showpackage'])->name('manage-packages.showpack');

    Route::resource('/manage-service-bookings', ServiceBookingController::class);
    Route::get('/customer-service-bookings/{id}', [ServiceBookingController::class, 'customerservice'])->name('customer.service');
    Route::resource('/manage-service-fleets', FleetServiceController::class);
    Route::get('getServices/{id}', [PackagesController::class, 'GetServicesByCategory'])->name('services-by-categories');
    Route::get('appointment-booking', [BookAppointMentController::class, 'index'])->name('appointmentbooking');



    Route::get('loyality-program', function () {
      return view('admin.loyality-program.loyality-program');
    });

    Route::get('service-cancellation-refund', function () {
      return view('admin.service-cancellation-refund.service-cancellation-refund');
    });

    Route::get('manage-garages', function () {
      return view('admin.manage-garage.manage-garage');
    });
    Route::get('manage-franchise-inquiry', function () {
      return view('admin.manage-franchise-inquiry.manage-franchise-inquiry');
    });

    Route::get('manage-reasons', function () {
      return view('admin.manage-reasons-category.manage-reasons');
    });



    Route::get('add-garage', function () {
      return view('admin.add-garage.index');
    });
    Route::get('view-garage-detail', function () {
      return view('admin.add-garage.view-garage-detail');
    });


    //

  });
});

Route::get('cities-by-state/{state_id}', [CommonController::class, 'citiesByState'])->name('cities-by-state');