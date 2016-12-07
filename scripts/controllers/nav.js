'use strict';

angular.module('tossApp')
  .controller('NavCtrl', function ($scope, $log, $localStorage) {
    let ctrl = this;
    ctrl.userData = null;

    if ($localStorage.userGuiid != null) {
      ctrl.userData = [];
      ctrl.userData.role = $localStorage.userRole;
      ctrl.userData.userGuiid = $localStorage.userGuiid;
    } else ctrl.userData = null;
  });
