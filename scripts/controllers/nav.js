'use strict';

angular.module('tossApp')
  .controller('NavCtrl', function ($scope, $log, $localStorage, $q, $state) {
    var ctrl = this;
    //ctrl.isNavCollapsed = true;

    if ($localStorage.userGuiid != null) {
      ctrl.userData = [];
      ctrl.userData.role = $localStorage.userRole;
      ctrl.userData.userGuiid = $localStorage.userGuiid;
      ctrl.userData.userId = $localStorage.userId;
    } else ctrl.userData = null;

    ctrl.logout = function() {
      $log.log('logging out...');
      if ($localStorage.userGuiid != null) {
        // Delete everything from the NgStorage
        $localStorage.$reset();
        $log.log('Successfully logged out: ' + $localStorage.userGuiid);
        $q.when($localStorage.userGuiid==null).then(function(data) {
          $state.go('login', {}, {reload:true});
        });
      }
    };

  });
