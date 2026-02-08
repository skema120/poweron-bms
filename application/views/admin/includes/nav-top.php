<body class="fix-header fix-sidebar card-no-border">
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
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header  border-end">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>

                     <div  class="navbar-brand  d-none d-md-block text-center">
                        <a style="color:white; margin-left: 20px;" class="sidebartoggler waves-effect waves-light d-flex align-items-center side-start" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu fs-5"></i>
                             <span class="navigation-text ml-3"> Navigation</span>
                         </a>
                    </div>

                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>      
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                         <!-- This is  -->
                        <!-- <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu fs-5"></i></a></li> -->

                        <li class="nav-item">
                             <a class="nav-link d-none d-md-block" href="">
                                  <!-- Logo icon -->
                                    <b class="logo-icon">
                                        <!-- You can put here icon as well // -->
                                        <!--  <i class="wi wi-sunset"></i>  -->
                                        <!-- Dark Logo icon -->
                                        <!-- <img  width="40px" src="<?php #echo base_url() ?>/assets/images/poweronlogo.png" alt="homepage" class="dark-logo" /> -->
                                        <!-- Light Logo icon -->
                                        <img  width="40px" src="<?php echo base_url() ?>/assets/images/poweronlogo.png" alt="homepage" class="light-logo" />
                                    </b>
                                    <!--End Logo icon -->

                                    <!-- Logo text -->
                                         <!--  <span style="color: white;font-size: 14px" class="logo-text">Power On BMS</span>  -->
                                    <span class="logo-text">
                                         <!-- dark Logo text -->
                                        <!--  <img src="<?php #echo base_url() ?>/assets/images/dark-poweron-logo-text.png" alt="homepage" class="dark-logo"> -->
                                         <!-- Light Logo text -->    
                                         <img src="<?php echo base_url() ?>/assets/images/light-poweron-logo-text.png" class="light-logo" alt="homepage">
                                    </span>
                             </a>
                        </li>

                    </ul>
                   
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                         
                        <!-- ============================================================== -->
                        <!-- Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url() ?>assets/images/users/<?php echo $userdata['image'] ?>?>" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img"><img style="width: 50px " src="<?php echo base_url() ?>assets/images/users/<?php echo $userdata['image'] ?>?>" alt="user"></div>
                                            <div class="u-text">
                                                <h5>WELCOME!</h5>
                                                <h4><?php echo $userdata['first_name'] ?></h4> 
                                        </div>
                                    </li> 
                                    <li role="separator" class="divider"></li>
                                    <li><a href="<?php echo base_url('admin/login/logout') ?>"><i class="mdi mdi-logout"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li> 
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->