<!DOCTYPE html>
<html lang="en" ng-app="sampleApp">
	<head>
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
	    {!! Html::style('assets/templates/gentelella/css/datatables/tools/css/dataTables.tableTools.css') !!}
	    <!--
	    {!! Html::style('assets/templates/gentelella/css/custom.css') !!}
	    {!! Html::style('assets/templates/gentelella/css/sn.css') !!}
	    {!! Html::style('assets/templates/gentelella/css/maps/jquery-jvectormap-2.0.1.css') !!}
	    {!! Html::style('assets/templates/gentelella/css/icheck/flat/green.css') !!}
	    {!! Html::style('assets/templates/gentelella/css/floatexamples.css') !!}
		-->
		<style>
			.page-break {
			    page-break-after: always;
			}
		</style>
	</head>
	<body class="nav-md">
    	<div class="container body">
	        <div class="main_container">
				
	            <!-- page content -->
	            <div role="main">
            		<div class="row">
	            		<span><img src="{{ URL::to('/') }}/images/solopos-fm.png" width="30%" alt=""></span>
	            		<span><h2>PT. RADIO SOLO AUDIO UTAMA</h2></span>
            		</div>
	            	<div class="row">
                     	@yield('content')
					</div>
	            </div>
	            <!-- /page content -->
    		</div>
    	</div>
	</body>

</html>	

