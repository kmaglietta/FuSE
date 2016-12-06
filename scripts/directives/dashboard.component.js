'use strict';

angular.module('tossApp')
  .component('adminDashboard', {
    templateUrl: 'templates/dashboard.admin.html',
    bindings: {
      // One-way binding
      info: '<'
    },
    controller:da_controller
  })
  .component('tutorDashboard', {
    templateUrl: 'templates/dashboard.tutor.html',
    bindings: {
      // One-way binding
      info: '<'
    },
    controller:dt_controller
  })
  .component('studentDashboard', {
    templateUrl: 'templates/dashboard.student.html',
    bindings: {
      // One-way binding
      info: '<'
    },
    controller:ds_controller
  });


function da_controller($scope, $log, $q, dataService, profileService) {
  // Main controller for admin dashboard
  var ctrl = this;
}

function dt_controller($scope, $log, $q, dataService, profileService) {
  // Main controller for tutor dashboard
  var ctrl = this;
}

function ds_controller($scope, $log, $q, dataService, profileService) {
  // Main controller for student dashboard
  var ctrl = this;
}
