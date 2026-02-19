<?php
  
  function getheaderData(){
   $data = DB::table('header_settings')->get();
  
  }
  function random_code(){
 
    return rand(1111, 9999);
  }
 
 // function getallLinksShowInH(){
 //  $data = DB::table('social_link_settings')->get();
 //  print_r($data);
 //    return $data;

 // }
  
  function allUpper($str){
    return strtoupper($str);
  }
   function siteaddress(){
    $addres = DB::table('general_settings')->get();
    return $addres;
  }

     function productName($product_id){
    $productName = DB::table('products')->where('id',$product_id)->first()->name ?? Null;
    return $productName;
  }
     function productSlug($product_id){
    $productSlug = DB::table('products')->where('id',$product_id)->first()->slug ?? Null;
    return $productSlug;
  }

    function productImages($product_id){
    $productImages = DB::table('products')->where('id',$product_id)->first()->image ?? Null;
    return $productImages;
  }

    function productRating($product_id){
    $productRating = DB::table('products')->where('id',$product_id)->first()->rating ?? Null;
    return $productRating;
  }

  function getCityName($id){
    $getCityName = DB::table('cities')->where('id',$id)->first()->name ?? Null;
    return $getCityName;
  }

   function getCountryName($id){
    $getCountryName = DB::table('countries')->where('id',$id)->first()->name ?? NUll;
    return $getCountryName;
  }
   function getStateName($id){
    $getStateName = DB::table('states')->where('id',$id)->first()->name ?? Null;
    return $getStateName;
  }
  
    function wishlist_status($id) {
            if (Auth::guard('customer')->check()) {
                $customer = Auth::guard('customer')->user();
                $wishlist = App\Models\Wishlist::where('customer_id',$customer->id)->where('product_id',$id)->first();
                if($wishlist) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        
           function CountWishlist() {
            if (Auth::guard('customer')->check()) {
                $customer = Auth::guard('customer')->user();
                // print_r( $customer );
                $wishlist = App\Models\Wishlist::where('customer_id',$customer->id)->count();
               // echo  $wishlist;

                if($wishlist) {
                    return  $wishlist;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }