<!DOCTYPE html>
<html lang="en">

<head>
    <title>Plateforme evenementiel </title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description"
        content="Mega Able Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
    <meta name="keywords"
        content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
    <meta name="author" content="codedthemes" />
    <!-- Favicon icon -->
    <link rel="icon" href="{{asset('assets/admin/images/favicon.ico')}}" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- waves.css -->
    <link rel="stylesheet" href="{{asset('assets/admin/pages/waves/css/waves.min.css')}}" type="text/css" media="all">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/bootstrap/css/bootstrap.min.css')}}">
    <!-- themify icon -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/icon/themify-icons/themify-icons.css')}}">
    <!-- scrollbar.css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/jquery.mCustomScrollbar.css')}}">
    <!-- am chart export.css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css"
        media="all" />
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/style.css')}}">
    <!-- Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

    <!-- jQuery (nécessaire pour toastr) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</head>

<body>
    <script>
        $(document).ready(function(){
          toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "5000",         // Durée d'affichage : 5 secondes
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
          };
      

        });
      </script>
      

    <div class="theme-loader">
        <div class="loader-track">
            <div class="preloader-wrapper">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-yellow">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            @include('admin.includes.header')
            @yield('content')
            @include('admin.includes.footer')


        </div>
    </div>
    </div>
    </div>
    </div>

    <!-- Required Jquery -->
    <script type="text/javascript" src="{{asset('assets/admin/js/jquery/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/admin/js/jquery-ui/jquery-ui.min.js')}} "></script>
    <script type="text/javascript" src="{{asset('assets/admin/js/popper.js/popper.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/admin/js/bootstrap/js/bootstrap.min.js')}} "></script>
    <script type="text/javascript" src="{{asset('assets/admin/pages/widget/excanvas.js')}} "></script>
    <!-- waves js -->
    <script src="{{asset('assets/admin/pages/waves/js/waves.min.js')}}"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="{{asset('assets/admin/js/jquery-slimscroll/jquery.slimscroll.js')}} "></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="{{asset('assets/admin/js/modernizr/modernizr.js')}} "></script>
    <!-- slimscroll js -->
    <script type="text/javascript" src="{{asset('assets/admin/js/SmoothScroll.js')}}"></script>
    <script src="{{asset('assets/admin/js/jquery.mCustomScrollbar.concat.min.js')}} "></script>
    <!-- Chart js -->
    <script type="text/javascript" src="{{asset('assets/admin/js/chart.js/Chart.js')}}"></script>
    <!-- amchart js -->
    <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="{{asset('assets/admin/pages/widget/amchart/gauge.js')}}"></script>
    <script src="{{asset('assets/admin/pages/widget/amchart/serial.js')}}"></script>
    <script src="{{asset('assets/admin/pages/widget/amchart/light.js')}}"></script>
    <script src="{{asset('assets/admin/pages/widget/amchart/pie.min.js')}}"></script>
    <script src="https:/admin//www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <!-- menu js -->
    <script src="{{asset('assets/admin/js/pcoded.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/vertical-layout.min.js')}} "></script>
    <!-- custom js -->
    <script type="text/javascript" src="{{asset('assets/admin/pages/dashboard/custom-dashboard.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/admin/js/script.js')}} "></script>
</body>
