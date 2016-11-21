/*
 * This file serves as an app configuration page
*/

'use strict';

angular
  .module('tossApp', [
    'ngAnimate',
    'ngCookies',
    'ngResource',
    'ngSanitize',
    'ngTouch',
    'ui.router',
    'toastr',
    'ngStorage',
    'datatables',
    'datatables.bootstrap',
    'ngTable'
  ])
  .config(function ($stateProvider, $urlRouterProvider) {
    $stateProvider
      .state('home', {
        url:'/',
        abstract: false,
        templateUrl: 'templates/main.html',
        controller: 'MainCtrl',
        controllerAs: 'vm'
      })
      .state('profile', {
        url:'/profile',
        templateUrl: 'templates/profile.html',
        controller: 'ProfileCtrl',
        controllerAs: 'vm'
      })
      .state('contact', {
        url:'/contact',
        templateUrl:'templates/contact.html',
        controller:'ContactCtrl',
        controllerAs:'vm'
      })
      .state('dashboard', {
        url:'/dashboard',
        abstract: true,
        data:{
          authenticated: true
        },
        templateUrl:'templates/dashboard.html',
        controller:'DashboardCtrl',
        controllerAs:'vm'
      })
      .state('analytics', {
        url:'/analytics',
        templateUrl:'templates/analytics.html',
        controller:'AnalyticsCtrl',
        controllerAs:'vm'
      })
      .state('login', {
        url:'/login',
        abstract: false,
        templateUrl:'templates/login.html',
        controller:'LoginCtrl',
        controllerAs:'vm'
      })
      .state('error', {
        templateUrl:'templates/404.html'
    });

    // Define route when the field is empty
    // Redirect it to the main page
    $urlRouterProvider.when('', '/');

    $urlRouterProvider.otherwise(function($injector, $location){
      var state = $injector.get('$state');
      //state.go('error');
      state.go('main');
      return $location.path();
    });

  })
  .config(function(toastrConfig) {
    // Toaster configuration
    angular.extend(toastrConfig, {
      autoDismiss: true,
      containerId: 'toast-container',
      maxOpened: 0,
      newestOnTop: true,
      positionClass: 'toast-top-center',
      preventDuplicates: false,
      preventOpenDuplicates: false,
      target: 'body',
      timeOut: 3000
    });
  });
