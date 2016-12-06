'use strict';

angular.module('tossApp')
  .controller('DashboardCtrl', function (
    $scope, $q, $log, $localStorage, $injector, $rootScope, userService, $timeout) {
    var ctrl = this;

    if ($localStorage.userData != null) {
      ctrl.userData = [];
      ctrl.userData = $localStorage.userData;
    } else ctrl.userData = null;

    ctrl.id = {
      id: ctrl.userData.id
    }

    /*$q.when(userService.isAuthorized(ctrl.id)).then(function(value) {
      $log.log(value);
      ctrl.role = value.response.role;
    });*/
    userService.isAuthorized(ctrl.id).then(function(data) {
      ctrl.role = data.response.role;
      $log.log(ctrl.role);
    });

    ctrl.logout = logout;

    function logout(){
      // Log user out
      $log.log('logging out...');
      userService.logout().then(function (data) {
        // Clear localStorage data
        //$localStorage.$reset();
        delete $localStorage.userData;
        $timeout(function() {
          $injector.get('$state').go('login');
        });
      }, function(data) {
        $log.error('An error has occurred');
      });
    };

  });
