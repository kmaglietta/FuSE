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
    'datatables.bootstrap'
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
      .state('sessionadmin', {
        url:'/sessionadmin',
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
            templateUrl: 'templates/dashboard.sessionadmin.html',
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
      .state('sessiontutor', {
        url:'/sessiontutor',
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
            templateUrl: 'templates/dashboard.sessiontutor.html',
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
      .state('sessionstudent', {
        url:'/sessionstudent',
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
            templateUrl: 'templates/dashboard.sessionstudent.html',
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
      .state('sessionlocation', {
        url:'/sessionlocation',
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
            templateUrl: 'templates/dashboard.sessionlocation.html',
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
      .state('sessionclass', {
        url:'/sessionclass',
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
            templateUrl: 'templates/dashboard.sessionclass.html',
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
      .state('profile', {
        url:'/profile/:profileId',
        views: {
          'header':{
            templateUrl: 'templates/nav.html',
            controller: 'NavCtrl',
            controllerAs: 'vm'
          },
          'content':{
            templateUrl: 'templates/profile.html',
            controller: 'ProfileCtrl',
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

  });


  function authenticate($q, userService, $state, $timeout) {
    // Check user's login status through the use of ui router resolve

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
