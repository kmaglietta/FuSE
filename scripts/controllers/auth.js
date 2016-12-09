'use strict';

angular.module('tossApp')
  .factory('userService', userService)
  .controller('LoginCtrl', login_controller);

  function login_controller($scope, userService, $log, $localStorage, $injector, toaster, $http){
    var ctrl = this;
    ctrl.login = {};
    ctrl.data = [];
    ctrl.isAdmin = {
      value: false
    }

    /*ctrl.userLogin = function(){
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
    };*/

    ctrl.userLogin = function() {
      $localStorage.$reset();
      var credentials = 'EmailAddress=' + ctrl.username + '&Password=' + ctrl.password;
      var isAdmin;
      if (ctrl.isAdmin.value == true) isAdmin = '&isAdmin=true';
      else isAdmin = '&isAdmin=false';

      credentials += isAdmin;

      userService.johnLogin(credentials).then(function (data) {
        if (data.success == true) {
          $log.log(data);
          if (data.Record != null) {
            ctrl.data = data.Record[0];
            //$log.log(ctrl.data);
            $localStorage.userGuiid = ctrl.data.guiid;
            $localStorage.userId = ctrl.data.id;
            if (ctrl.data.isAdmin == 1) $localStorage.userRole = 'admin';
            else if (ctrl.data.isTutor == 1) $localStorage.userRole = 'tutor'
            else $localStorage.userRole = 'student';
            //$localStorage.userRole = 'admin';
            $injector.get('$state').go('dashboard');
          } else {
            toaster.pop({
              type:'warning',
              title:'Error',
              body:'Invalid username/password',
              tapToDismiss: true,
              timeout:3000
            });
          }
        }
      }, function(data) {
        $log.error('An Error has occurred ' + data.status + ' ' + data.config);
        toaster.pop({
          type:'error',
          title:data.status,
          body:'Please contact an admin: ppakhapo@fau.edu',
          tapToDismiss: true,
          timeout:3000
        });
      });
    }
  }

  function userService($http, $log) {
    var factory = {};
    var service = 'php/index.php?';
    var exService = 'https://lamp.cse.fau.edu/~jherna65/apiTest/?';

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

    factory.johnLogin = function(q) {
      return $http.post(exService + 'action=getuser&' + q).then(function (response) {
        return response.data;
      });
    };

    factory.johnDashboard = function(q) {
      return $http.post(exService + 'action=getprofile&StudentId=' + q).then(function (response) {
        return response.data;
      });
    };


    return factory;
  }
