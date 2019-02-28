<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Master Management</title>
    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset('login/fonts/material-icon/css/material-design-iconic-font.min.css') }}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('login/css/style.css') }}">
</head>
<body>

<div class="main">
    <div class="container">
        <form method="POST" class="appointment-form" action="{{ url('login-page') }}" id="appointment-form">
            <h2>
                Login to master management application
            </h2>
            <div class="form-group-1">
                <input type="email" name="alamat_email" id="email" placeholder="Your email" required />
                <input type="password" name="kata_kunci" id="name" placeholder="Your password" required />
            </div>
            <div class="form-submit" >
                {{ csrf_field() }}
                <input type="submit" name="submit" id="submit" class="submit" value="Login To Master Management Apps" style="width:100%" />
            </div>
            <div align="center">
                <a href="{{ url('registerApp') }}" id="submit"  class="submit" style="width: 80%; text-decoration:none">Make a Account</a>
            </div>
            <div class="form-group-1">
                <br>
                @if(!empty(session('message_success')))
                    <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
                @elseif(!empty(session('message_fail')))
                    <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
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