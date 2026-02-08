<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() ?>assets/images/favicon.png">
    <title>Power On Business Management System | Login Portal</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url() ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="<?php echo base_url() ?>assets/css/colors/green-dark.css" id="theme" rel="stylesheet">
    <style> 
    </style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper">
        <div class="login-register" style="background-image:url(<?php echo base_url() ?>assets/images/background/login-background.jpg);">
            <div class="login-box card animated zoomInUp">
                <div class="card-body">


                    <form method="post" class="form-horizontal form-material" id="loginform">

                        <div class="logo text-center">
                            <img src="<?php echo base_url() ?>assets/images/login-logo.png" width="100%" style="margin: auto;">
                        </div>
                        <h1 class="box-title m-b-0 m-t-10 text-center">Business Management System</h1>
                        <h3 class="box-title m-b-20 text-center">Login Portal</h3>
                        <div class="form-group ">
                              <div class="input-group margin-bottom-sm">
                                <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                                <input id="username" class="form-control" type="text" required=""  placeholder="Username"> 
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group margin-bottom-sm">
                                <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                               <!--  <i class="alp fa fa-eye-slash" id="eye"></i> -->
                                <input id="password" class="form-control" type="password" required=""  placeholder="Password"> </div>
                        </div>
                        <div class="form-group m-b-0 hide" id="errorValidation">
                            <div class="col-sm-12 text-center text-danger"><b>Invalid Username or Password<br>Try again</b></a>
                            </div>
                        </div> 
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light animated flip" id="btnLogin" type="submit">Log In</button>
                            </div>
                        </div> 
                        
                    </form> 


                </div>
            </div>
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?php echo base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?php echo base_url() ?>assets/plugins/popper/popper.min.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?php echo base_url() ?>assets/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="<?php echo base_url() ?>assets/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?php echo base_url() ?>assets/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="<?php echo base_url() ?>assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="<?php echo base_url() ?>assets/js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <!-- <script src="assets/plugins/styleswitcher/jQuery.style.switcher.js"></script> -->
    <script>
        $('#loginform').on('submit',function(e){
            e.preventDefault();
            var inputUsername = $('#username');
            var inputPassword = $('#password');
            LoginCredentials(inputUsername.val(),inputPassword.val());
            // if (inputUsername != '' && inputPassword != ''){
            //  system_logs(inputUsername.val(),inputPassword.val());
            // }
        });


        function LoginCredentials(username,password) {
            $.post('<?php echo base_url('admin/login/PowerOnloginAdmin') ?>',
                {username,password},function(data){ 
                    // console.log(username);
                    system_logs(username,password,data);

                    if (data == 'Valid') {
                        $('#errorValidation').addClass('hide');
                        window.location.href = "<?php echo base_url('admin/dashboard') ?>";
                    } else {
                        $('#errorValidation').removeClass('hide');
                    }

                }).fail(function(xhr){
                    console.log(xhr.responseText);
                });
        }


        function system_logs(username,password,data) {
                            $.post('<?php echo base_url('admin/login/system_logs') ?>',
                                {username,password,data},function(data){ 

                                });
                        }

            //     var pwd = document.getElementById('inputPassword');
            //     var eye = document.getElementById('eye');

            //     eye.addEventListener('click',togglePass);

            //     function togglePass(){
            //     eye.classList.toggle('active');


            //     (pwd.type == 'password') ? pwd.type = 'text':
            //      pwd.type = 'password';

            //     if(pwd.type == 'text')
            //     {
            //         $('.alp').removeClass('fa-eye-slash');
            //         $('.alp').addClass('fa-eye');
            //     }else{

            //         $('.alp').removeClass('fa-eye');
            //         $('.alp').addClass('fa-eye-slash');

            //     }

            // }



    </script>

<style>
   .alp {

    position: absolute;
    left: 330px;
    top: 10px;
    /*font-size: 20px;*/
    cursor: pointer;
    color: #999;
   }

   .alp.active{
    color: dodgerblue;
   }

   .login-box{
    top: -80px;
   }

    .logo{
    animation-duration: 4s;
     animation-iteration-count: infinite;
   }


</style> 

</body>

</html>