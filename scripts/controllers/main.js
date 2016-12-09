'use strict';

angular.module('tossApp')
  .controller('MainCtrl', MainCtrl);

  function MainCtrl($scope, $log, $localStorage, dataService) {
    var ctrl = this;
    ctrl.userData = [];
  }
