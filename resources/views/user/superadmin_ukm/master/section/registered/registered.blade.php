<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Master Management</title>
    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset('login/fonts/material-icon/css/material-design-iconic-font.min.css') }}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('login/css/style.css') }}">
</head>
<body>

<div class="main">
    <div class="container">
        <form method="POST" class="appointment-form" action="{{ url('registered') }}" id="appointment-form">
            <h2>
                Register to get a master management application account
            </h2>
            <div class="form-group-1">
                <input type="text" name="nama" id="title" placeholder="Your name" required />
                <input type="email" name="alamat_email" id="email" placeholder="Your email" required />
                <input type="password" name="kata_kunci" id="name" placeholder="Your password" required />
            </div>
            <div class="form-check">
                <input type="checkbox" name="agree_term" id="agree-term" class="agree-term" required/>
                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree to the  <a href="#" class="term-service">Terms and Conditions</a></label>
            </div>
            <div class="form-submit" >
                {{ csrf_field() }}
                <input type="submit" name="submit" id="submit" class="submit" value="Request an appointment" style="width:100%" />
            </div>
            <div align="center">
                <a href="{{ url('login-page') }}" id="submit"  class="submit" style="width: 80%; text-decoration:none">Back To Login Page</a>
            </div>
            <div class="form-group-1">
                @if(!empty(session('message_success')))
                    <p style="color: green">{{ session('message_success')}}</p>
                @elseif(!empty(session('message_fail')))
                    <p style="color: red">{{ session('message_fail') }}</p>
                @endif
            </div>
        </form>
    </div>
</div>

<!-- JS -->
<script src="{{ asset('login/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('login/js/main.js') }}"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>