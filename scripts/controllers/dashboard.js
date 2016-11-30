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
        // Clear localStorage data
        //$localStorage.$reset();
        delete $localStorage.userData;
        $injector.get('$state').go('login');
      }, function(data) {
        $log.error('An error has occurred');
      });
    };

  });
