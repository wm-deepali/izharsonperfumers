<html lang="en"><head>
    <title>Welcome to Izharson Perfumers</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
	width: 220px;
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
.container.b .mt-4 h2 {
	padding-top: 25px;
}
.mt-4.heading p a {
	color: #00b3e4 !important;
	text-decoration: underline;
}
.footer-txt {
	font-weight: 600;
	padding: 10px 0;
}
.un-list-style {
	list-style: none;
	padding: 0;
	margin-top: 20px;
    display: flex;
}
.un-list-style li a {
	margin-right: 20px;
}
.un-list-style li a i {
	padding: 8px 10px;
	background-color: orange;
	color: #fff;
}
.un-list-style li a i:hover {
	padding: 8px 10px;
	background-color: oldlace;
	color: #000;
}
p{
    font-size: 18px;
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
                <h2>Welcome to <span class="bg-text"> IZARHSON PERFUMERS</span></h2>
                <p>We're excited to have you here.</p>
                <p>
                    Sign into your account to access the Dashboard and setup your profile &amp; portfolio to start Investing and Exploring the Services at IZARHSON PERFUMERS.
                </p>
                <a href="https://front.izharsonperfumers.com/login"><div class="btn-btnverify">Sign In</div></a>
            </div>
            
        </div>
        <div class="container b">
            <div class="mt-4 heading">
                <h2>
                    We're here for you
                </h2>
                <p>
                   <a href="https://front.izharsonperfumers.com/FAQs"> Explore</a> our FAQ to learn more about your queries and explore some good options to Invest &amp; Raise Funds with IZARHSON PERFUMERS.
                </p>
            </div>
        </div>
        <div class="container b">
            <div class="mt-4 heading">
                <h2>
                    Did we miss anything?
                </h2>
                <p>
                   Is there anymore information you need in order to Start investments or Raise Funds? Please contact our Support team at <a href="mailto:info@izharsonperfumers.com">info@izharsonperfumers.com</a> or <a href="https://www.izharsonperfumers.com/contact-us">  Click here</a>
                </p>
            </div>
        </div>
        <div class="container mt-3">
            <div class="footer-logo">
            <img src="{{ URL::asset('storage/' . $headerdata->footer_logo) }}" style="height: 50px;">
            
            </div>
            <p class="footer-txt">
                You have received this email because you are registered at IZARHSON PERFUMERS PVT. LTD.
            </p>
            <div class="footer-copyright">
                © {{date('Y')}} IZARHSON PERFUMERS PVT. LTD.
            </div>
            <div class="social-icons">
                <ul class="un-list-style">
                    <li>
                    <a href="https://www.facebook.com/izharsonperfumers"> <i class="fa fa-facebook"></i></a>
                    </li>
                    <li>
                        <a href="https://twitter.com/izharsonperfumers"> <i class="fa fa-twitter"></i></a>
                    </li>
                    <li>
                        
                    <a href="https://www.linkedin.com/company/izharsonperfumers/"> <i class="fa fa-linkedin"></i></a>
                    </li>
                    <li>
                        
                    <a href="https://www.instagram.com/izharsonperfumers/?igshid=Zjc2ZTc4Nzk%3D"> <i class="fa fa-instagram"></i></a>
                    </li>
                    
                </ul>
            </div>
        </div>
    </div>


</body></html>