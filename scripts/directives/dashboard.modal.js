'use strict';

/**
 * @ngdoc directive
 * @name tossApp.directive:dashboard.modal
 * @description This component handles modal functions using UI Bootstrap
 * # dashboard.modal
 */
 function t_controller(){
   var ctrl = this;
   $ctrl.ok = function(){
     // Delete user from the dashboard
   };
   $ctrl.cancel = function(){
     // Cancel
   };
 }

angular.module('tossApp')
  .component('dashboardModal', {
    controller:t_controller,
    bindings: {
      resolve: '<',
      close:'&',
      dismiss:'&'
    }
  });
