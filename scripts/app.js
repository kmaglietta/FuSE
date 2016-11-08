'use strict';

angular
  .module('tossApp', [
    'ngAnimate',
    'ngCookies',
    'ngResource',
    'ngRoute',
    'ngSanitize',
    'ngTouch',
    'ui.router',
    'ui.bootstrap'
  ])
  .config(function ($stateProvider, $urlRouterProvider) {
    $stateProvider
      .state('root', {
        url:'',
        abstract: false,
        templateUrl: 'templates/main.html',
        controller: 'MainCtrl',
        controllerAs: 'vm'
      })
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
        templateUrl:'templates/login.html',
        controller:'LoginCtrl',
        controllerAs:'vm'
      })
      .state('error', {
        templateUrl:'templates/404.html'
      });

    $urlRouterProvider.otherwise(function($injector, $location){
      var state = $injector.get('$state');
      state.go('error');
      return $location.path();
    });

  });
  /*
  .factory('studentsFactory', function($http){
    // This function is to retreive JSON file
    var d_factory = {};

    // Load data from JSON file
    d_factory.getTutors = function () {
      return $http.get('../data/data.json');
    };

    return d_factory;
  })
  .factory('tutorsFactory', function($http){
    var t_factory = {};

    t_factory.getStudents = function(){
      return $http.get('../data/tutorData.json');
    };

    return t_factory;
  });*/
