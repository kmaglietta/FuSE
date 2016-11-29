'use strict';

angular.module('tossApp')
  .controller('MainCtrl', function ($scope, $log, $localStorage, userService) {
    var ctrl = this;
    ctrl.userData = [];
    ctrl.dismiss = false;


  });
