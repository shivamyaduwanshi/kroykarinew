<!DOCTYPE html>
<html>
<head>
    <title>Email Verification</title>
    <style type="text/css">
        .email .body{
            padding: 50px 15px;
        }
        .email .body h1 {
            font-size: 26px;
            margin: 0 0 5px;
            color: #000;
        }
        .email .body p{
            font-size: 15px;
            color: #000;
            margin: 0 0 10px;
        }
        .email .body a {
            color: #fff;
            background: #000;
            padding: 10px 15px;
            display: inline-block;
            text-decoration: none;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 600;
        }
        .email .header{
            background: black;
            padding: 15px;
        }
        .email .header img{
            width: 120px;
        }
        .email .footer{
            background: black;
            padding: 10px 15px;
        }
        .email .footer p{
            margin: 0;
            color: #fff;
            text-align: center;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="email">
        <div class="header">
             <img src="{{asset('public/assets/backend')}}/images/nav-logo2.png">
        </div>
        <div class="body">
            <h1>Hello,</h1>
            <p>You are receiving this email because we received a password reset request for your account.</p>
            <a href="{{$url}}">Confirm Email</a>
            <p>If you did not request a password reset, no further action is required.</p>
            <p>Regards,<p>
            <p>Laravel<p>
        </div>
        <div class="footer">
            <p>Copyright reserved to Buy&Sell</p>
        </div>
    </div>
</body>
</html>