<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">

    <title>VOMS Login</title>
    <link rel="apple-touch-icon" href="{{  asset('public/backend/app-assets/images/ico/apple-icon-120.png')  }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{  asset('public/backend/app-assets/images/ico/favicon.ico')  }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{  asset('public/backend/app-assets/vendors/css/vendors.min.css')  }}">




    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{  asset('public/backend/app-assets/css/bootstrap.css')  }}">
    <link rel="stylesheet" type="text/css" href="{{  asset('public/backend/app-assets/css/bootstrap-extended.css')  }}">
    <link rel="stylesheet" type="text/css" href="{{  asset('public/backend/app-assets/css/colors.css')  }}">
    <link rel="stylesheet" type="text/css" href="{{  asset('public/backend/app-assets/css/components.css')  }}">
    <link rel="stylesheet" type="text/css" href="{{  asset('public/backend/app-assets/css/themes/dark-layout.css')  }}">
    <link rel="stylesheet" type="text/css" href="{{  asset('public/backend/app-assets/css/themes/bordered-layout.css')  }}">
    <link rel="stylesheet" type="text/css" href="{{  asset('public/backend/app-assets/css/themes/semi-dark-layout.css')  }}">



    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{  asset('public/backend/app-assets/css/core/menu/menu-types/vertical-menu.css')  }}">
    <link rel="stylesheet" type="text/css" href="{{  asset('public/backend/app-assets/css/plugins/forms/form-validation.css')  }}">
    <link rel="stylesheet" type="text/css" href="{{  asset('public/backend/app-assets/css/pages/authentication.css')  }}">


    {{-- <link rel="stylesheet" type="text/css" href="{{  asset('public/backend/app-assets/css/core/menu/menu-types/vertical-menu.css')  }}"> --}}


    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{  asset('public/backend/assets/css/style.css')  }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{  asset('public/backend/app-assets/css/core/menu/menu-types/vertical-menu.css')  }}> --}}
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">



    <!-- BEGIN: Content-->
    @yield('admin_login_content')

    <!-- END: Content-->



    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0"><span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2022<a class="ms-25" href="#" target="_blank">JPMB Technologiea</a><span class="d-none d-sm-inline-block">, All rights Reserved</span></span><span class="float-md-end d-none d-md-block">Hand-crafted & Made with<i data-feather="heart"></i></span></p>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{  asset('public/backend/app-assets/vendors/js/vendors.min.js')  }}"></script>


    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{  asset('public/backend/app-assets/vendors/js/forms/validation/jquery.validate.min.js')  }}"></script>

    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{  asset('public/backend/app-assets/js/core/app-menu.js')  }}"></script>
    {{-- <script src="{{  asset('public/backend/app-assets/vendors/js/jquery/jquery.min.js')  }}"></script> --}}
    <script src="{{  asset('public/backend/app-assets/vendors/js/popper/popper.min.js')  }}"></script>
    <script src="{{  asset('public/backend/app-assets/js/core/app.js')  }}"></script>
    <script src="{{  asset('public/backend/app-assets/js/scripts/pages/auth-login.js')  }}"></script>







    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <!-- END: Page JS-->



</body>
<!-- END: Body-->

</html>
