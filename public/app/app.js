//app.js

var app = angular
			.module('appRoot', ['ngMessages','angularUtils.directives.dirPagination', 'ngRoute', 'currencyMask','ui.bootstrap'])//,'datatables'
			.constant('API_URL', 'http://radio.green/')
			.config(function($interpolateProvider){ 
				$interpolateProvider.startSymbol('[[');
			    $interpolateProvider.endSymbol(']]');
		    })
		    .directive('loading', ['$http',function($http){
		    	return {
		    		restrict: 'A',
		    		link : function(scope, element, attrs){
		    			scope.isLoading = function(){
		    				return $http.pendingRequests.length > 0;
		    			};

		    			scope.$watch(scope.isLoading, function(value){
		    				if(value){
		    					element.show();	
		    				} else{
		    					element.hide();
		    				}
		    			})
		    		}
		    	}
		    }]);
		    // .filter('mcDbDateFormatter', function() {
	     //        return function(dateSTR) {
	     //            var o = dateSTR.replace(/-/g, "/"); // Replaces hyphens with slashes
	     //            return Date.parse(o + " -0000"); // No TZ subtraction on this sample
	     //        }
	     //    });