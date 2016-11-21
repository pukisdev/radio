    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>pukisdev.com</title>


    <!-- load bootstrap from a local -->

    {!! Html::style('assets/templates/gentelella/css/bootstrap.min.css') !!}

    {!! Html::style('assets/templates/gentelella/fonts/css/font-awesome.min.css') !!}
    {!! Html::style('assets/templates/gentelella/css/animate.min.css') !!}


    <!-- Custom styling plus plugins -->
    {!! Html::style('assets/templates/gentelella/css/custom.css') !!}
    {!! Html::style('assets/templates/gentelella/css/sn.css') !!}
    {!! Html::style('assets/templates/gentelella/css/maps/jquery-jvectormap-2.0.1.css') !!}
    {!! Html::style('assets/templates/gentelella/css/icheck/flat/green.css') !!}
    {!! Html::style('assets/templates/gentelella/css/floatexamples.css') !!}
    {!! Html::style('assets/templates/gentelella/css/datatables/tools/css/dataTables.tableTools.css') !!}
    <!-- {!! Html::style('assets/templates/gentelella/css/datatables/tools/css/dataTables.tableTools.css') !!} -->
    {!! Html::style('assets/ng/others/rte-angular-master/src/rte/rte.css') !!}

    <style>
        /*body { 
            font-family: 'Lato';
        }
        .fa-btn {
            margin-right: 6px;
        }
*/

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
    </style>

		<?=!empty($v_url_css) ? $v_url_css : '' ;?>

    {!! Html::script('assets/templates/gentelella/js/jquery.min.js') !!}

    <!-- Angularjs -->
    {!! Html::script('assets/ng/others/angular-1.5.5/angular.min.js') !!}
    {!! Html::script('assets/ng/others/angular-1.5.5/angular-route.min.js') !!}
    {!! Html::script('assets/templates/gentelella/js/bootstrap.min.js') !!}
    {!! Html::script('assets/ng/others/tambahan/ui-bootstrap-tpls-1.3.3.min.js') !!}
    {!! Html::script('assets/ng/others/tambahan/angular-currency-mask.js') !!}
    {!! Html::script('assets/ng/others/tambahan/ngMask.js') !!}
    {!! Html::script('assets/ng/others/bootstrap-datepicker/js/bootstrap-datepicker.min.js') !!}
    {!! Html::script('assets/ng/others/angular-1.5.5/angular-messages.min.js') !!}
    {!! Html::script('assets/ng/others/angular-1.5.5/dirPagination.js') !!}
    {!! Html::script('assets/ng/others/rte-angular-master/src/rte/rte.js') !!}
    {!! Html::script('assets/ng/others/jquery-gritter/js/jquery.gritter.min.js') !!}

    <!-- -- >
    {!! Html::script('assets/templates/gentelella/js/nprogress.js') !!}
    <!-- gauge js -->
    <!--
    {!! Html::script('/assets/templates/gentelella/js/gauge/gauge.min.js') !!}
    {!! Html::script('/assets/templates/gentelella/js/gauge/gauge_demo.js') !!}
    -->
    <!-- chart js -->
    <!-- {!! Html::script('assets/templates/gentelella/js/chartjs/chart.min.js') !!} -->
    <!-- bootstrap progress js -->
    {!! Html::script('assets/templates/gentelella/js/progressbar/bootstrap-progressbar.min.js') !!}
    {!! Html::script('assets/templates/gentelella/js/nicescroll/jquery.nicescroll.min.js') !!}
    <!-- icheck -->
    {!! Html::script('assets/templates/gentelella/js/icheck/icheck.min.js') !!}
    <!-- daterangepicker -->
    {!! Html::script('/assets/templates/gentelella/js/moment.min.js') !!}
    {!! Html::script('/assets/templates/gentelella/js/datepicker/daterangepicker.js') !!}

    {!! Html::script('assets/templates/gentelella/js/sparkline/jquery.sparkline.min.js') !!}
    {!! Html::script('assets/templates/gentelella/js/custom.js') !!}

    <!-- flot js -->
    <!--[if lte IE 8]><script type="text/javascript" src="js/excanvas.min.js') !!}<![endif]-->
    {!! Html::script('/assets/templates/gentelella/js/flot/jquery.flot.js') !!}
    {!! Html::script('/assets/templates/gentelella/js/flot/jquery.flot.pie.js') !!}
    {!! Html::script('/assets/templates/gentelella/js/flot/jquery.flot.orderBars.js') !!}
    {!! Html::script('/assets/templates/gentelella/js/flot/jquery.flot.time.min.js') !!}
    {!! Html::script('/assets/templates/gentelella/js/flot/date.js') !!}
    {!! Html::script('/assets/templates/gentelella/js/flot/jquery.flot.spline.js') !!}
    {!! Html::script('/assets/templates/gentelella/js/flot/jquery.flot.stack.js') !!}
    {!! Html::script('/assets/templates/gentelella/js/flot/curvedLines.js') !!}
    {!! Html::script('/assets/templates/gentelella/js/flot/jquery.flot.resize.js') !!}
    <!-- knob -->
    {!! Html::script('/assets/templates/gentelella/js/knob/jquery.knob.min.js') !!}

    <!-- skycons -->
    {!! Html::script('assets/templates/gentelella/js/skycons/skycons.js') !!}

    <!-- Datatables -->
    {!! Html::script('assets/templates/gentelella/js/datatables/js/jquery.dataTables.js') !!}
    {!! Html::script('assets/templates/gentelella/js/datatables/tools/js/dataTables.tableTools.js') !!}

    <!-- form validation -->
    {!! Html::script('assets/templates/gentelella/js/validator/validator.js') !!}


    <!-- PNotify -->
    {!! Html::script('/assets/templates/gentelella/js/notify/pnotify.core.js') !!}
    {!! Html::script('/assets/templates/gentelella/js/notify/pnotify.buttons.js') !!}
    {!! Html::script('/assets/templates/gentelella/js/notify/pnotify.nonblock.js') !!}
    


	    <?=!empty($v_url_js) ? $v_url_js : '' ;?>

