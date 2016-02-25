'use strict';

angular
    .module('j3appApp', ['ngAnimate', 'ngAria', 'ngCookies', 'ngMessages', 'ngResource', 'ui.router', 'ngSanitize', 'ngTouch','toastr'])
    .constant('API_URL', 'http://localhost/j3safetysolutions')
    .config(function($stateProvider, $urlRouterProvider,$httpProvider) {
        $httpProvider.defaults.useXDomain = true;
        delete $httpProvider.defaults.headers.common['X-Requested-With'];
        $stateProvider
            .state('home', {
                url: '/',
                templateUrl: 'assets/app/components/home/mainView.html',
                controller: 'MainCtrl'
            })
            .state('login', {
                url: '/login',
                templateUrl: 'assets/app/components/login/loginView.html',
                controller: 'loginController'
            })
            .state('signout', {
                url: '/signout',
                templateUrl: 'assets/app/components/signout/signoutView.html',
                controller: 'signOutController'
            })
            .state('trainings', {
                url: '/trainings',
                templateUrl: 'assets/app/components/trainings/trainingsView.html',
                controller: 'trainingsController'
            })
            .state('participants', {
                url: '/participants',
                templateUrl: 'assets/app/components/participants/participantsView.html',
                controller: 'participantsController'
            })
            .state('attendance', {
                url: '/attendance',
                templateUrl: 'assets/app/components/reports/attendanceSheetView.html',
                controller: 'attendanceSheetController'
            })
            .state('certificate', {
                url: '/certificate',
                templateUrl: 'assets/app/components/reports/printCertificateView.html',
                controller: 'printCertificateController'
            });

        $urlRouterProvider.otherwise('/');
    });
