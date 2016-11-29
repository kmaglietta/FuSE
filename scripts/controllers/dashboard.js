'use strict';

angular.module('tossApp')
  .controller('DashboardCtrl', function ($scope, $log, $localStorage, $injector, $rootScope, userService) {
    var ctrl = this;
    ctrl.userData = [];
    ctrl.userData = $localStorage.userData;
    
    ctrl.logout = function(){
      // Log user out
      $log.log('logging out...');
      userService.logout().then(function (data) {
        //$rootScope.$broadcast(AUTH_EVENTS.logoutSuccess);
        // Clear localStorage data
        $localStorage.$reset();
        $injector.get('$state').go('login');
      }, function(data) {
        $log.error('An error has occurred');
      });
    };

  });
