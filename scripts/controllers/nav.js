'use strict';

angular.module('tossApp')
  .controller('NavCtrl', function ($scope, $log, $localStorage, $q, $timeout, $state, $injector) {
    let ctrl = this;
    ctrl.userData = null;
    ctrl.isNavCollapsed = true;

    if ($localStorage.userGuiid != null && ctrl.userData==null) {
      ctrl.userData = [];
      ctrl.userData.role = $localStorage.userRole;
      ctrl.userData.userGuiid = $localStorage.userGuiid;
    } else ctrl.userData = null;

    ctrl.logout =  function() {
      $log.log('logging out...');
      if ($localStorage.userGuiid != null) {
        // Delete everything from the NgStorage
        $localStorage.$reset();
        $log.log('Successfully logged out: ' + $localStorage.userGuiid);
        $q.when($localStorage.userGuiid==null).then(function() {
          $state.go('login')
        });
      }
    };

  });
