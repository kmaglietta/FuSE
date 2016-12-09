'use strict';

angular.module('tossApp')
  .controller('DashboardCycleCtrl', function ($scope, $interval, $q, $log, $localStorage, $injector, $state, $timeout){
    var ctrl = this;

    ctrl.backAState = function() {
      $log.log('Go back');
      $timeout(function() {
        $state.go('dashboard');
      });
    };
  });
