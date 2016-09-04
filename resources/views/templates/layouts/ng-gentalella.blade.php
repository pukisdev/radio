<!DOCTYPE html>
<html lang="en" ng-app="appRoot">
	<head>
        @include('templates.gentalella.angularjs.head') 									<!-- load header 	-->
	</head>
	<body class="nav-md">
	    <div class="loader vcenter text-center" data-loading>
	        <button class="btn btn-lg btn-warning"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...</button>
	    </div>
    	<div class="container body">
	        <div class="main_container">
				
				<!-- left menu -->
	            <div class="col-md-3 left_col">
        			@include('templates.gentalella.left') 						<!-- load left 	-->
	            </div>
				<!-- /left menu -->

	            <!-- top navigation -->
	            <div class="top_nav">
	            	 @include('templates.gentalella.top')			 			<!-- load left 	 -->
	            </div>	
	            <!-- /top navigation -->

	            <!-- page content -->
	            <div class="right_col" role="main">
	            	<div class="row">
                     @yield('content') 											<!-- load menu 		 -->
					</div>

	                <!-- footer content -->
	                <footer>
	                    <div class="">
	                        <p class="pull-right">Developed by. |
	                            <span class="lead"> <i class="fa fa-paw"></i> TIM JAGo!</span>
	                        </p>
	                    </div>
	                    <div class="clearfix"></div>
	                </footer>
	                <!-- /footer content -->

	            </div>
	            <!-- /page content -->
    		</div>
    	</div>
	    <div id="custom_notifications" class="custom-notifications dsp_none">
	        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
	        </ul>
	        <div class="clearfix"></div>
	        <div id="notif-group" class="tabbed_notifications"></div>
	    </div>
    		<!--  -->
	</body>

</html>	

