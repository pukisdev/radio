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

		<?=!empty($v_url_css) ? $v_url_css : '' ;?>

	{!! Html::script('assets/templates/gentelella/js/jquery.min.js') !!}

    {!! Html::script('assets/templates/gentelella/js/nprogress.js') !!}
    {!! Html::script('assets/templates/gentelella/js/bootstrap.min.js') !!}
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

