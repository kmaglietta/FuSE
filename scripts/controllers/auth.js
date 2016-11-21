'use strict';

angular.module('tossApp')
  .controller('LoginCtrl', login_controller);

  function login_controller($scope, dataService, $log, $rootScope){
    var ctrl = this;
    ctrl.login = {};

    ctrl.beginLogin = function(isValid){
      if(isValid){
        $log.log('Signing in...');
        var _data = {
          user:ctrl.username,
          password:ctrl.password
        };
        $log.info('Login Success');
      } else {
        $log.error('Something went wrong');
      }
  }

  function runAuthChecker($rootScope, $state, $stateParams, dataService){
    $rootScope.$on('$stateChangeStart', function (event, toState, toParams){
      // Track the state that user wants to go to
      $rootScope.toState = toState;
      $rootScope.toStateParams = toStateParams;
      // If resolved, do an authorization check,
      // else it'll be done with the state it resolved
    })
  }
