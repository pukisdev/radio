<!DOCTYPE html>
<html lang="en" ng-app="appRoot">
<!-- <html lang="en"> -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="<?=asset('css/font-awesome.min.css')?>">
    <link rel="stylesheet" href="<?=asset('css/google.font.css')?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="<?= asset('ext/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= asset('ext/bootstrap-datepicker/css/bootstrap-datepicker.min.css') ?>">
    <link rel="stylesheet" href="<?= asset('app/lib/datatables/media/css/dataTables.bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= asset('app/lib/angular-datatables-master/dist/css/angular-datatables.min.css') ?>">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <link href="<?= asset('ext/jquery-gritter/css/jquery.gritter.css') ?>" rel="stylesheet">
    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }

        .glyphicon-refresh-animate {
        -animation: spin .7s infinite linear;
        -webkit-animation: spin2 .7s infinite linear;
        }

        @-webkit-keyframes spin2 {
            from { -webkit-transform: rotate(0deg);}
            to { -webkit-transform: rotate(360deg);}
        }

        @keyframes spin {
            from { transform: scale(1) rotate(0deg);}
            to { transform: scale(1) rotate(360deg);}
        }

        .loader {
           position: fixed;
           top: 0;
           right: 0;
           bottom: 0;
           left: 0;
           z-index: 1100;
           background-color: white;
           opacity: .6;
           padding-top: 20%;
        }

/*        .pagination-edit1 {
            margin : 0 0;
        }
*/
    </style>
</head>
<body id="app-layout">
    <div class="loader vcenter text-center" data-loading>
        <button class="btn btn-lg btn-warning"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...</button>
    </div>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Laravel
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">Home</a></li>
                    @if (!Auth::guest())
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Master <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/mst/pms/produk') }}">Produk & Tarif</a></li>
                                <li><a href="{{ url('/mst/pms/libur') }}">Tanggal Merah</a></li>
                                <li><a href="{{ url('/mst/pms/customer') }}">Customer</a></li>
                                <li><a href="{{ url('/mst/pms/pnwrMst') }}">Penawaran</a></li>
                                <li><a href="{{ url('/mst/pms/fpMst') }}">Faktur Penjualan</a></li>
                                <li><a href="{{ url('/mst/hkm/spks') }}">Order SPKS</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Produksi <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/prod/realisasi') }}">Realisasi Produksi</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Hukum <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/mst/hkm/spks') }}">SPKS</a></li>
                            </ul>
                        </li>
                    <!-- <li><a href="{{ url('/directive/produk') }}">Directive</a></li> -->
                    <!-- <li><a href="{{ url('/mst/pms/libur') }}">Datatables</a></li> -->
                    @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>


    <!-- JavaScripts -->
    <script src="<?= asset('js/jquery-1.12.3.js') ?>" ></script>
    
    
    <script src="<?= asset('app/lib/angular-1.5.5/angular.min.js') ?>"></script>
    <script src="<?= asset('app/lib/angular-1.5.5/angular-route.min.js') ?>"></script>
    
    <!-- JavaScripts Datatables -->
    <script src="<?= asset('app/lib/datatables/media/js/jquery.dataTables.js') ?>" ></script>
    <script src="<?= asset('app/lib/angular-datatables-master/dist/angular-datatables.min.js') ?>"></script>
    <!-- -->
    
    <script src="<?= asset('ext/bootstrap/js/bootstrap.min.js')?>" ></script>
    <!-- <script src="<?= asset('app/lib/ui-date-master/dist/date.js') ?>" ></script> -->
    <script src="<?= asset('js/ui-bootstrap-tpls-1.3.3.min.js')?>" ></script>
    <script src="<?= asset('js/angular-currency-mask.js')?>" ></script>
    <script src="<?= asset('ext/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>" ></script>
    <script src="<?= asset('app/lib/datatables/media/js/dataTables.bootstrap.min.js') ?>" ></script>
    <script src="<?= asset('app/lib/angular-1.5.5/angular-messages.min.js') ?>"></script>
    <script src="<?= asset('app/lib/angular-1.5.5/dirPagination.js') ?>"></script>
    <script src="<?= asset('ext/jquery-gritter/js/jquery.gritter.min.js') ?>"></script>
    
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script> -->
    <script src="<?= asset('app/app.js') ?>"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    
    @yield('content')

</body>
</html>
