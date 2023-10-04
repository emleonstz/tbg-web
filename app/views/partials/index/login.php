<!DOCTYPE html>
<html>
<head>
    <title>Document</title>
    <style>
         @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

        .wrapper {
            max-width: 350px;
            min-height: 500px;
            margin: 80px auto;
            padding: 40px 30px 30px 30px;
            background-color: #ecf0f3;
            border-radius: 15px;
            box-shadow: 13px 13px 20px #cbced1, -13px -13px 20px #fff
        }

        .logo {
            width: 80px;
            margin: auto
        }

        .logo img {
            width: 100%;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
            box-shadow: 0px 0px 3px #5f5f5f, 0px 0px 0px 5px #ecf0f3, 8px 8px 15px #a7aaa7, -8px -8px 15px #fff
        }

        .wrapper .name {
            font-weight: 600;
            font-size: 1.4rem;
            letter-spacing: 1.3px;
            padding-left: 10px;
            color: #555
        }

        .wrapper .form-field input {
            width: 100%;
            display: block;
            border: none;
            outline: none;
            background: none;
            font-size: 1.2rem;
            color: #666;
            padding: 10px 15px 10px 10px
        }

        .wrapper .form-field {
            padding-left: 10px;
            margin-bottom: 20px;
            border-radius: 20px;
            box-shadow: inset 8px 8px 8px #cbced1, inset -8px -8px 8px #fff
        }

        .wrapper .form-field .fas {
            color: #555
        }

        .wrapper .btn {
            box-shadow: none;
            width: 100%;
            height: 40px;
            background-color: #03A9F4;
            color: #fff;
            border-radius: 25px;
            box-shadow: 3px 3px 3px #b1b1b1, -3px -3px 3px #fff;
            letter-spacing: 1.3px
        }

        .wrapper .btn:hover {
            background-color: #039BE5
        }

        .wrapper a {
            text-decoration: none;
            font-size: 0.8rem;
            color: #03A9F4
        }

        .wrapper a:hover {
            color: #039BE5
        }

        @media(max-width: 380px) {
            .wrapper {
                margin: 30px 20px;
                padding: 40px 15px 15px 15px
            }
        }

        /* Styles for Google Play button */

        .btn-store {
            color: #777777;
            min-width: 254px;
            padding: 12px 20px !important;
            border-color: #212121 !important;
        }

        .btn-store:focus,
        .btn-store:hover {
            color: #ffffff !important;
            background-color: #168eea;
            border-color: #168eea !important;
        }

        .btn-store .btn-label,
        .btn-store .btn-caption {
            display: block;
            text-align: left;
            line-height: 1;
        }

        .btn-store .btn-caption {
            font-size: 24px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="logo">
            <img class="img-responsive" src="<?php print_link(SITE_LOGO); ?>" />
        </div>
        <div class="text-center mt-4 name"> TBG </div>
        <?php 
            $this::display_page_errors(); 
        ?>
        <form name="loginForm" action="<?php print_link('index/login/?csrf_token=' . Csrf::$token); ?>" class="needs-validation form page-form" method="post">
            <div class="form-field d-flex align-items-center">
                <span class="fa fa-user"></span>
                <input placeholder="Username or Email" name="username" required="required" type="text" />
            </div>
                        <div class="form-field d-flex align-items-center">
                <span class="fa fa-key"></span>
                <input placeholder="Password" required="required" v-model="user.password" name="password" type="password" />
            </div>
            <button class="btn mt-3">Login</button>
            <div class="col mt-3 text-center">
                <label class="">
                    <input value="true" type="checkbox" name="rememberme" />
                    Remember me
                </label>
            </div>
        </form>
        <div class="text-center fs-6">
            <a href="<?php print_link(SITE_ADDR.'forgot/forgot_password.php') ?>">Forgot Password</a>
        </div>
        <div class="text-center text-gray-600 fs-6">
            <a href="<?php print_link('index/register') ?>">
                <p class="h4">Create an account</p>
            </a>
        </div>
    </div>
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9756902424959336"
     crossorigin="anonymous"></script>
    <div class="container">
        <div class="text-center">
            <h5>Team Bus Gamer</h5>
            <br />
            <p>
                <center>
                    <a href="https://play.google.com/store/apps/details?id=com.emleons.team" class="btn btn-store">
                        <span class="fa fa-android fa-3x pull-left"></span>
                        <span class="btn-label">Download on the</span>
                        <span class="btn-caption">Google Play</span>
                    </a>
                </center>
            </p>
        </div>
    </div>
</body>
</html>
