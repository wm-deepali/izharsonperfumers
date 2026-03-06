<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CCAvenue;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Order;
use App\Mail\AdminPaymentMail;
use Illuminate\Support\Facades\Mail;
class CCAvenueControlller extends Controller
{
    public function encrypt($plainText,$key)
{
	$key = $this->hextobin(md5($key));
	$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
	$openMode = openssl_encrypt($plainText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
	$encryptedText = bin2hex($openMode);
	return $encryptedText;
}

public function decrypt($encryptedText,$key)
{
	$key = $this->hextobin(md5($key));
	$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
	$encryptedText = $this->hextobin($encryptedText);
	$decryptedText = openssl_decrypt($encryptedText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
	return $decryptedText;
}

function hextobin($hexString) 
 { 
	$length = strlen($hexString); 
	$binString="";   
	$count=0; 
	while($count<$length) 
	{       
	    $subString =substr($hexString,$count,2);           
	    $packedString = pack("H*",$subString); 
	    if ($count==0)
	    {
			$binString=$packedString;
	    } 
	    
	    else 
	    {
			$binString.=$packedString;
	    } 
	    
	    $count+=2; 
	} 
        return $binString; 
  } 
  
  public function requesthandler(Request $request){
     $working_key="D4C85E6AED4CC282930B980AEB97C9D7";
	$access_code="AVSL84KG26AF50LSFA";
	$merchant_data='';
	
	foreach ($request->all() as $key => $value){
		$merchant_data.=$key.'='.$value.'&';
	}
	$encrypted_data=$this->encrypt($merchant_data,$working_key); // Method for encrypting the data.
	$data = $request->all();
	$data['transaction_id'] = $request->tid;
	$user = Auth::guard('api')->user();
    $ccavenue = CCAvenue::updateOrCreate(['user_id'=>$user->id,'status'=>'active','order_id'=>$request->order_id],$data);
return	 $production_url='https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction&encRequest='.$encrypted_data.'&access_code='.$access_code;
// return	"<iframe src='$production_url' id='paymentFrame' width='482' height='450' frameborder='0' scrolling='No' ></iframe>";
	
  }
  public function responsehandler(Request $request){
      $workingKey="";		//Working Key should be provided here.
	$encResponse=$request->encResp;			//This is the response sent by the CCAvenue Server
	
	$rcvdString=$this->decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
	
// 	
	$order_status="";
	$decryptValues=explode('&', $rcvdString);
	
	$dataSize=sizeof($decryptValues);
// 	echo "<center>";
    $order_id = "";
	$tracking_id = "";
	$message = "";
	for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
		if($i==3)	$order_status=$information[1];
		if($i==8)	$message=$information[1];
		if($i==0)	$order_id = $information[1];
		if($i==1)	$tracking_id = $information[1];
	}

    $ccavenue = CCAvenue::where('order_id',$order_id)->first();
    $order = Order::where('order_number',$ccavenue->order_id)->first();
	if($order_status==="Success")
	{
	    if($ccavenue){
	        $ccavenue->update(['payment_status'=>$order_status,'status'=>'completed']);
	        $order->update(['payment_status'=>"success",'payment_message'=>$message]);
	       try{
	        $admin= User::first();
	        Mail::to($admin->alert_email)->send(new AdminPaymentMail($order));  
	    }catch(\Exception $ex){
	        
	    }
	    }
	    return Redirect::to('https://izharsonperfumers.com/thankyou/'.encrypt($order->id));

// 		echo "<br>Thank you for shopping with us. Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.";
		
	}
	else if($order_status==="Aborted")
	{
	     if($ccavenue){
	    $ccavenue->update(['payment_status'=>$order_status]);
	    $order->update(['payment_status'=>"failed",'payment_message'=>$message]);
	     }
	     
	     return Redirect::to('https://izharsonperfumers.com/thankyou/'.encrypt($order->id));
// 		echo "<br>Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";
	
	}
	else if($order_status==="Failure")
	{
	   if($ccavenue){
	    $ccavenue->update(['payment_status'=>$order_status]);
	    $order->update(['payment_status'=>"failed",'payment_message'=>$message]);
	   }
	   
	   return Redirect::to('https://izharsonperfumers.com/thankyou/'.encrypt($order->id));
// 		echo "<br>Thank you for shopping with us.However,the transaction has been declined.";
	}
	else
	{
	    if($ccavenue){
	    $ccavenue->update(['payment_status'=>$order_status]);
	    
	    $order->update(['payment_status'=>"failed",'payment_message'=>$message]);
	    
	        
	   
	    
// 		echo "<br>Security Error. Illegal access detected";
	    }
	     return Redirect::to('https://izharsonperfumers.com/thankyou/'.encrypt($order->id));
	
	}

// 	echo "<br><br>";

// 	echo "<table cellspacing=4 cellpadding=4>";
// 	for($i = 0; $i < $dataSize; $i++) 
// 	{
// 		$information=explode('=',$decryptValues[$i]);
// 	    	echo '<tr><td>'.$information[0].'</td><td>'.$information[1].'</td></tr>';
// 	}

// 	echo "</table><br>";
// 	echo "</center>";
  }
}
