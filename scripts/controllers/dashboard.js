'use strict';

angular.module('tossApp')
  .controller('DashboardCtrl', function (
    $scope, $q, $log, $localStorage, $injector, $state, profileService, $timeout) {
    var ctrl = this;
    var action = 'action=getprofile';
    ctrl.data = [];
    ctrl.userData = null;

    if ($localStorage.userGuiid != null) {
      ctrl.userData = [];
      ctrl.userData.role = $localStorage.userRole;
      ctrl.userData.userGuiid = $localStorage.userGuiid;
      ctrl.userData.userId = $localStorage.userId;
    } else ctrl.userData = null;

    /*ctrl.id = {
      id: ctrl.userData.id
    }

    $q.when(userService.isAuthorized(ctrl.id)).then(function(value) {
      $log.log(value);
      ctrl.role = value.response.role;
    });*/
    /*userService.isAuthorized(ctrl.id).then(function(data) {
      ctrl.role = data.response.role;
      $log.log(ctrl.role);
    });*/

    /*function logout(){
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
    };*/

    ctrl.logout =  function() {
      $log.log('logging out...');
      if ($localStorage.userGuiid != null) {
        // Delete everything from the NgStorage
        $localStorage.$reset();
        $log.log('Successfully logged out: ' + $localStorage.userGuiid);
        $q.when($localStorage.userGuiid==null).then(function() {
          $state.go('login');
        })

      }

    }

  });
