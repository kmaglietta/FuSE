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
    'toaster',
    'ngStorage',
    'datatables',
    'datatables.bootstrap',
    'ngTable'
  ])
  .config(function ($stateProvider, $urlRouterProvider) {
    $stateProvider
      .state('home', {
        url:'/',
        views: {
          'header':{
            templateUrl: 'templates/nav.html',
            controller: 'NavCtrl',
            controllerAs: 'vm'
          },
          'content':{
            templateUrl: 'templates/main.html',
            controller: 'MainCtrl',
            controllerAs: 'vm'
          },
          'footer':{
            templateUrl: 'templates/footer.html',
            controller: 'FooterCtrl',
            controllerAs: 'vm'
          }
        }
      })
      .state('contact', {
        url:'/contact',
        views: {
          'header':{
            templateUrl: 'templates/nav.html',
            controller: 'NavCtrl',
            controllerAs: 'vm'
          },
          'content':{
            templateUrl: 'templates/contact.html',
            controller: 'ContactCtrl',
            controllerAs: 'vm'
          },
          'footer':{
            templateUrl: 'templates/footer.html',
            controller: 'FooterCtrl',
            controllerAs: 'vm'
          }
        }
      })
      .state('dashboard', {
        url:'/dashboard',
        resolve: {
          authenticate: authenticate
        },
        views: {
          'header':{
            templateUrl: 'templates/nav.html',
            controller: 'NavCtrl',
            controllerAs: 'vm'
          },
          'content':{
            templateUrl: 'templates/dashboard.html',
            controller: 'DashboardCtrl',
            controllerAs: 'vm'
          },
          'footer':{
            templateUrl: 'templates/footer.html',
            controller: 'FooterCtrl',
            controllerAs: 'vm'
          }
        }
      })
      .state('analytics', {
        url:'/analytics',
        resolve: {
          authenticate: authenticate
        },
        views: {
          'header':{
            templateUrl: 'templates/nav.html',
            controller: 'NavCtrl',
            controllerAs: 'vm'
          },
          'content':{
            templateUrl: 'templates/analytics.html',
            controller: 'AnalyticsCtrl',
            controllerAs: 'vm'
          },
          'footer':{
            templateUrl: 'templates/footer.html',
            controller: 'FooterCtrl',
            controllerAs: 'vm'
          }
        }
      })
      .state('login', {
        url:'/login',
        views: {
          'header':{
            templateUrl: 'templates/nav.html',
            controller: 'NavCtrl',
            controllerAs: 'vm'
          },
          'content':{
            templateUrl: 'templates/login.html',
            controller: 'LoginCtrl',
            controllerAs: 'vm'
          },
          'footer':{
            templateUrl: 'templates/footer.html',
            controller: 'FooterCtrl',
            controllerAs: 'vm'
          }
        }
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
  .constant('AUTH_EVENTS', {
    loginSuccess: 'auth-login-success',
    loginFailed: 'auth-login-failed',
    logoutSuccess: 'auth-logout-success',
    sessionTimeout: 'auth-session-timeout',
    notAuthenticated: 'auth-not-authenticated',
    notAuthorized: 'auth-not-authorized'
  });


  function authenticate($q, userService, $state, $timeout) {
    /*if (userService.isAuthenticated()) {
      // Resolve the promise successfully
      return $q.when();
    } else {
      // The next bit of code is asynchronously tricky
      $timeout(function() {
        // This runs after the authentication promise has been rejected
        // Go to the login page
        $state.go('login');
      });
      // Reject the authentication promise to prevent the state from being loaded
      return $q.reject('guest');
    }*/
    var defer = $q.defer();
    userService.isAuthenticated().then(function(data){
      if (data.response.username != 'guest') {
        defer.resolve('Allowed');
      } else {
        $timeout(function() {
          // This runs after the authentication promise has been rejected
          // Go to the login page
          $state.go('login');
        });
        defer.reject('Not Allowed');
      }
    });
    return defer.promise;

  }
