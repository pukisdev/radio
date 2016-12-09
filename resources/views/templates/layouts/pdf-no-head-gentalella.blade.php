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
	
	    {!! Html::style('assets/templates/gentelella/fonts/css/font-awesome.min.css') !!}
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
                     	@yield('content')
					</div>
	            </div>
	            <!-- /page content -->
    		</div>
    	</div>
	</body>

</html>	

