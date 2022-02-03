<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title')</title>
    
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('admin/images/favicon.png')}}">
    <!-- Pignose Calender -->
    <link href="{{asset('admin/plugins/pg-calendar/css/pignose.calendar.min.css')}}" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="{{asset('admin/plugins/chartist/css/chartist.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css')}}">
    <!-- Custom Stylesheet -->
    <link href="{{asset('admin/plugins/toastr/css/toastr.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css/style.css')}}" rel="stylesheet">
    

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <div class="brand-logo">
                <a href="index.html">
                    <b class="logo-abbr"><img src="{{asset('admin/images/kab_badung.png')}}" alt=""> </b>
                    <span class="brand-title">
                        <img src="{{asset('assets/img/dpmptsp_logo.png')}}" width="200px" alt="">
                    </span>
                </a>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">    
            <div class="header-content clearfix">
                
                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
                <div class="header-left">
                    
                </div>
                <div class="header-right">
                    <ul class="clearfix">
                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative"   data-toggle="dropdown">
                                <img src="{{asset('admin/images/user.png')}}" height="40" width="40" alt="">
                            </div>
                            <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="/profil"><i class="icon-user"></i> <span>Profile</span></a>
                                        </li>
                                        <hr class="my-2">
                                        <li><a href="/logout"><i class="icon-key"></i> <span>Logout</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">           
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li>
                        <a href="/dashboard" aria-expanded="false">
                            <i class="fa fa-tachometer"></i><span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="/dashboard/gedung" aria-expanded="false">
                            <i class="fa fa-building"></i></i><span class="nav-text">Data Gedung</span>
                        </a>
                    </li>
                    <li>
                        <a href="/dashboard/sarana" aria-expanded="false">
                            <i class="fa fa-road"></i><span class="nav-text">Data Sarana</span>
                        </a>
                    </li>
                    <li>
                        <a href="/dashboard/masyarakat" aria-expanded="false">
                            <i class="fa fa-users"></i><span class="nav-text">Data Masyarakat</span>
                        </a>
                    </li>
                    <li>
                        <a href="/dashboard/indeks" aria-expanded="false">
                            <i class="fa fa-calculator"></i><span class="nav-text">Data Indeks</span>
                        </a>
                    </li>
                    <li>
                        <a href="/dashboard/kategoriIndeks" aria-expanded="false">
                            <i class="fa fa-list"></i><span class="nav-text">Kategori Klasifikasi</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->
        <div class="content-body">
            @yield('container')
        </div>
        
        
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->

    


    <script src="{{asset('admin/plugins/common/common.min.js')}}"></script>
    <script src="{{asset('admin/js/custom.min.js')}}"></script>
    <script src="{{asset('admin/js/settings.js')}}"></script>
    <script src="{{asset('admin/js/gleek.js')}}"></script>
    <script src="{{asset('admin/js/styleSwitcher.js')}}"></script>
   
    <script src="{{asset('admin/plugins/toastr/js/toastr.min.js')}}"></script>
    <script src="{{asset('admin/plugins/toastr/js/toastr.init.js')}}"></script>


</body>

</html>