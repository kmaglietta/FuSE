'use strict';

angular.module('tossApp')
  .factory('userService', userService)
  .controller('LoginCtrl', login_controller);

  //

  function login_controller($scope, userService, $log, $rootScope, $localStorage, $injector){
    var ctrl = this;
    ctrl.login = {};
    ctrl.data = [];
    ctrl.isAdmin = {
      value: false
    }

    ctrl.userLogin = function(){
      $log.log('Signing in...');
      if (ctrl.isAdmin.value == true) {
        var _data = {
          username:ctrl.username,
          password:ctrl.password,
          role:'admin'
        };
      } else {
        var _data = {
          username:ctrl.username,
          password:ctrl.password,
          role:'user'
        };
      }
      userService.login(_data).then(function(data) {
        // If success
        if (data.status === 200) {
          //ctrl.data = data;
          //ctrl.data = data.response;
          // Store user's data inside local storage
          $localStorage.userData = data.response;
          $injector.get('$state').go('dashboard');
        } else {
          $log.error(data.status + ' ' + data.message);
        }

      }, function() {
        $log.error('Sign in failed ' + data.status + ' ' + data.message);
      });
    };
  }

  function userService($http, $log) {
    var factory = {};
    var service = 'php/index.php?';
    //var service = 'http://lamp.cse.fau.edu/~jherna65/apiTest/?';

    factory.login = function(credentials) {
      return $http.post(service + 'action=login', credentials)
      .then(function (response) {
        return response.data;
      });
    };
    factory.isAuthenticated = function () {
      // Check for user's session
      return $http.get(service + 'action=getsession')
      .then(function (response) {
        return response.data;
      });
    };
    factory.isAuthorized = function (userId) {
      // Check user's role using id
      return $http.post(service + 'action=getrole', userId)
      .then(function (response) {
        return response.data;
      });
    };
    factory.logout = function() {
      // Log user out
      return $http.get(service + 'action=logout')
      .then(function (response) {
        return response.data;
      });
    };

    return factory;
  }
