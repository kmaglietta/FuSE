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
    'ui.bootstrap',
    'toaster',
    'ngTable',
    'smart-table',
    'ngStorage',
    'datatables',
    'datatables.bootstrap'
  ])
  .config(function ($stateProvider, $urlRouterProvider) {
    $stateProvider
      .state('home', {
        url:'/',
        views:{
          "nav":{
            templateUrl: 'templates/nav.html'
          },
          "":{
            templateUrl: 'templates/main.html',
            controller: 'MainCtrl',
            controllerAs: 'vm'
          }
        }
      })
      .state('dashboard', {
        url:'/dashboard',
        resolve: {
          authenticate: authenticate
        },
        views:{
          "nav":{
            templateUrl: 'templates/nav.html'
          },
          "":{
            templateUrl: 'templates/dashboard.html',
            controller: 'DashboardCtrl',
            controllerAs: 'vm'
          }
        }
      })
      .state('dashboard.sessionadmin', {
        url:'/sessionadmin',
        resolve: {
          authenticate: authenticate
        },
        views: {
          "nav":{
            templateUrl: 'templates/nav.html'
          },
          '@':{
            templateUrl: 'templates/dashboard.sessionadmin.html',
            controller: 'DashboardCtrl',
            controllerAs: 'vm'
          }
        }
      })
      .state('dashboard.sessiontutor', {
        url:'/sessiontutor',
        resolve: {
          authenticate: authenticate
        },
        views: {
          "nav":{
            templateUrl: 'templates/nav.html'
          },
          '@':{
            templateUrl: 'templates/dashboard.sessiontutor.html',
            controller: 'DashboardCtrl',
            controllerAs: 'vm'
          }
        }
      })
      .state('dashboard.sessionstudent', {
        url:'/sessionstudent',
        resolve: {
          authenticate: authenticate
        },
        views: {
          "nav":{
            templateUrl: 'templates/nav.html'
          },
          '@':{
            templateUrl: 'templates/dashboard.sessionstudent.html',
            controller: 'DashboardCtrl',
            controllerAs: 'vm'
          }
        }
      })
      .state('dashboard.sessionlocation', {
        url:'/location',
        resolve: {
          authenticate: authenticate
        },
        views: {
          "nav":{
            templateUrl: 'templates/nav.html'
          },
          '@':{
            templateUrl: 'templates/dashboard.sessionlocation.html',
            controller: 'DashboardCtrl',
            controllerAs: 'vm'
          }
        }
      })
      .state('dashboard.sessionclass', {
        url:'/classes',
        resolve: {
          authenticate: authenticate
        },
        views: {
          "nav":{
            templateUrl: 'templates/nav.html'
          },
          '@':{
            templateUrl: 'templates/dashboard.sessionclass.html',
            controller: 'DashboardCtrl',
            controllerAs: 'vm'
          }
        }
      })
      .state('dashboard.sessionclassinfo', {
        url:'/classinfo',
        resolve: {
          authenticate: authenticate
        },
        views: {
          "nav":{
            templateUrl: 'templates/nav.html'
          },
          '@':{
            templateUrl: 'templates/dashboard.sessionclassinfo.html',
            controller: 'DashboardCtrl',
            controllerAs: 'vm'
          }
        }
      })
      .state('dashboard.addstudent', {
        url:'/addstudent',
        resolve: {
          authenticate: authenticate
        },
        views: {
          "nav":{
            templateUrl: 'templates/nav.html'
          },
          '@':{
            templateUrl: 'templates/dashboard.addstudent.html',
            controller: 'AddStudentSessionDashboardCtrl',
            controllerAs: 'vm'
          }
        }
      })
      .state('dashboard.viewsession', {
        url:'/viewsession',
        resolve: {
          authenticate: authenticate
        },
        views: {
          "nav":{
            templateUrl: 'templates/nav.html'
          },
          '@':{
            templateUrl: 'templates/dashboard.viewsession.html',
            controller: 'ViewSessionDashboardCtrl',
            controllerAs: 'vm'
          }
        }
      })
      .state('dashboard.viewattended', {
        url:'/attended',
        resolve: {
          authenticate: authenticate
        },
        views: {
          "nav":{
            templateUrl: 'templates/nav.html'
          },
          '@':{
            templateUrl: 'templates/dashboard.viewattended.html',
            controller: 'viewAttendedDashboardCtrl',
            controllerAs: 'vm'
          }
        }
      })
      .state('livesession', {
        url:'/livesession',
        views:{
          "nav":{
            templateUrl: 'templates/nav.html'
          },
          "":{
            templateUrl: 'templates/dashboard.cycletable.html',
            controller: 'DashboardCycleCtrl',
            controllerAs: 'vm'
          }
        }
      })
      .state('analytics', {
        url:'/analytics',
        resolve: {
          authenticate: authenticate
        },
        templateUrl: 'templates/analytics.html',
        controller: 'AnalyticsCtrl',
        controllerAs: 'vm'
      })
      .state('login', {
        url:'/login',
        views:{
          "nav":{
            templateUrl: 'templates/nav.html'
          },
          "":{
            templateUrl: 'templates/login.html',
            controller: 'LoginCtrl',
            controllerAs: 'vm'
          }
        }
      })
      .state('profile', {
        url:'/profile/:profileId',
        views:{
          "nav":{
            templateUrl: 'templates/nav.html'
          },
          "":{
            templateUrl: 'templates/profile.html',
            controller: 'ProfileCtrl',
            controllerAs: 'vm'
          }
        }
      })
      .state('message', {
        url:'/message',
        views:{
          "nav":{
            templateUrl: 'templates/nav.html'
          },
          "":{
            templateUrl: 'templates/message.html',
            controller: 'MessageCtrl',
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


  function authenticate($q, $localStorage, $state, $timeout) {
    // Check user's login status through the use of ui router resolve

    if ($localStorage.userGuiid != null) {
      // Resolve the promise successfully
      return $q.when('Authorized');
    } else {
      // The next bit of code is asynchronously tricky
      $timeout(function() {
        // This runs after the authentication promise has been rejected
        // Go to the login page
        $state.go('login');
      });
      // Reject the authentication promise to prevent the state from being loaded
      return $q.reject('Not Authorized');
    }
    /*var defer = $q.defer();
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
    return defer.promise;*/

  }
