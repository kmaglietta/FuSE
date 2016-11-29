'use strict';

angular.module('tossApp')
  .controller('NavCtrl', function ($scope, $log, $localStorage) {
    let ctrl = this;
    ctrl.userData = null;

    if ($localStorage.userData != null) {
      ctrl.userData = [];
      ctrl.userData = $localStorage.userData;
    } else ctrl.userData = null;
  });
