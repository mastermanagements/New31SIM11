<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset('login/fonts/material-icon/css/material-design-iconic-font.min.css') }}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('login/css/style.css') }}">
</head>
<body>

<div class="main">

    <div class="container">
        <form method="POST" class="appointment-form" id="appointment-form">
            <h2>
                Form to get an account on the master management application</h2>
            <div class="form-group-1">
                <input type="text" name="title" id="title" placeholder="Title" required />
                <input type="text" name="name" id="name" placeholder="Your Name" required />
                <input type="email" name="email" id="email" placeholder="Email" required />
            </div>
            <div class="form-check">
                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree to the  <a href="#" class="term-service">Terms and Conditions</a></label>
            </div>
            <div class="form-submit">
                <input type="submit" name="submit" id="submit" class="submit" value="Request an appointment" />
            </div>
        </form>
    </div>

</div>

<!-- JS -->
<script src="{{ asset('login/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('login/js/main.js') }}"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>