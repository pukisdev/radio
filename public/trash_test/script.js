// script.js

    // create the module and name it scotchApp
        // also include ngRoute for all our routing needs
    var scotchApp = angular.module('scotchApp', ['ngRoute','ngAnimate']);//,'angularModalService']);

    // configure our routes
    scotchApp.config(function($routeProvider, $locationProvider) {
        $routeProvider

            // route for the home page
            .when('/', {
                // templateUrl : 'pages/home.html',
                templateUrl : 'trash_test/home.html',
                controller  : 'mainController'
            })

            // route for the about page
            .when('/about', {
                // templateUrl : 'pages/about.html',
                templateUrl : 'trash_test/about.html',
                controller  : 'aboutController'
            })

            // route for the contact page
            .when('/contact', {
                // templateUrl : 'pages/contact.html',
                templateUrl : 'trash_test/contact.html',
                controller  : 'contactController'
            })
            // route for the contact page
            .when('/contact/:id', {
                // templateUrl : 'pages/contact.html',
                templateUrl : 'trash_test/contactDetail.html',
                controller  : 'contactDetailController'
            });
        // use the HTML5 History API
        $locationProvider.html5Mode(true);
    });

    // create the controller and inject Angular's $scope
    scotchApp.controller('mainController', function($scope) {
    // scotchApp.controller('mainController', function($scope, ModalService) {
        // create a message to display in our view
        $scope.message = 'Everyone come and see how good I look!';
        // $scope.pageClass = 'page-home';
        // $scope.show = function(){
        //     ModalService.showModal({
        //         templateUrl : 'modal.html',
        //         controller  : 'modalController'
        //     }).then(function(modal){
        //         modal.close.then(function(result) {
        //             console.log('nothing');
        //         });
        //     });
        // }
    });

    scotchApp.controller('aboutController', function($scope) {
        $scope.message = 'Look! I am an about page.';
        // $scope.pageClass = 'page-about';
    });

    scotchApp.controller('contactController', function($scope, $http, $routeParams) {
        $scope.message = 'Contact us! JK. This is just a demo.';
        $http({
            'method'    : 'GET',
            'url'       : 'http://radio.green/pms/produk?page=1' 
        }).success(function(response){
            console.log(response);
            $scope.produks        = response.data;
        }).error(function(response){
            console.log(response);
        });

        $scope.buat = function(){
            console.log($scope.loopnya);
            $scope.loopnyaArray = Array.apply(0, Array($scope.loopnya)).map(function(val, i) { return i; });
        }
    });

    scotchApp.controller('contactDetailController', function($scope, $http, $routeParams) {
        $scope.message = 'Contact us! JK. This is just a demo.';
        $http({
            'method'    : 'GET',
            'url'       : 'http://radio.green/pms/produk/'+$routeParams.id 
        }).success(function(response){
            console.log(response);
            $scope.values = response;
        }).error(function(response){
            console.log(response);
        });
    });

    // scotchApp.controller('modalController', function($scope, close) {
      
    //     $scope.close = function(result) {
    //        close(result, 500); // close, but give 500ms for bootstrap to animate
    //     };

    // });    