
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Order Conirmation - Izharson Perfumers</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .wrapper {
            margin: 40px 0;
        }
        .container {
            max-width: 800px;
            background-color: #ffff;
            padding: 0;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.05);
        }
        .p-4.bg-dark.text-white.text-center img {
            width: 200px;
        }
        .mt-4.heading h5 {
            font-weight: 600;
        }

        .mt-4.heading {
            padding: 0 25px;
            padding-bottom: 25px;
        }

        hr {
            color: #9e9e9e;
            border-top: 1.7px solid #9e9e9e;
        }
        .container.mt-3 {
	box-shadow: none;
	padding: 0 25px;
}
a {
	color: #515457;
	text-decoration: none;
}
a:hover {
	color: #515457;
}
.btn-btnverify {
	width: 150px;
	background: orange;
	color: #fff;
	font-weight: 600;
	padding: 10px 10px;
	text-align: center;
	border-radius: 2px;
}
.footer-logo img {
	width: 170px;
}
.p-1 {
	padding-left: 20px !important;
}
.mt-4.heading h2 {
	font-size: 40px;
	font-weight: 800;
	margin-bottom: 20px;
}
.mt-4.heading p {
	margin-bottom: 30px;
	font-weight: 600;
}
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <div class="p-1">
<img src="{{ URL::asset('storage/' . $headerdata->header_logo) }}" style="height: 50px;">
</div>
            <div class="mt-4 heading">
                <h2>Order Confirmation</h2>
                <p><b>Name:-</b>{{$data['name']}}</p>
                <p><b>Email Id:-</b>{{$data['email']}}</p>
                <p><b>Mobile Number:-</b>{{$data['mobile_number']}}</p>
                <p><b>Order Number:-</b>#{{$data['order_id']}}</p>
                <p><b>Order Date:-</b>{{date('d-m-Y H:i:s')}}</p>
                <p><b>Delivery Type:-</b>{{$data['order']['address_type']}}</p>
                <p><b>Payment:-</b>{{$data['order']['payment_status']}}</p>
                <p><b>Transaction Id:-</b>#{{$data['order']['transaction_number']}}</p>
                <p><b>Shipping Address:-</b>{{ $data['order']['address'] }}, {{ $data['order']['cities']['name'] }}, {{ $data['order']['states']['name'] }}, {{ $data['order']['countries']['name'] }}, {{ $data['order']['pincode'] }}</p>
            </div>
            <div>
                <p>Hello <b>{{$data['name']}}</b>,
        Thank you for your order. We’ll send a confirmation when your order ships. Your estimated delivery will be done somewhere between 7 - 10 Working Days,  If you would like to view the status of your order or make any changes to it, please visit Your Orders on {{url('/')}} 
        
        Your Order Summary as Follows
       #{{$data['order_id']}}
       {{date('d-m-Y H:i:s')}}
        
        To ensure your safety, the Delivery Agent will drop the package at your doorstep, ring the doorbell and then move back to maintain adequate distance while waiting for you to collect your package.
        
        We hope to see you again soon
        Izharson Perfumers
</p>
            </div>
        </div>
        <div class="container mt-3">
            <div class="footer-logo">
                  <img src="{{ URL::asset('storage/' . $headerdata->footer_logo) }}" style="height: 50px;">      
            </div>
            <div class="footer-copyright">
                &copy; {{date('Y')}} IZARHSON PERFUMERS PVT. LTD.
            </div>
        </div>
    </div>
</body>

</html>

