'use strict';

/**
 * @ngdoc directive
 * @name tossApp.directive:tutor.table
 * @description
 * # tutor.table
 */

function t_controller($scope){
  // Controller for the list of all student enrolled with
  // a particular instructor
  var ctrl = this;
  ctrl.sortType = 'zid';
  ctrl.sortReverse = false;
  ctrl.searchStudent = '';
  ctrl.students;

  tutorsFactory.getStudents().then(function(response){
    ctrl.students = response.data;
    console.log(ctrl.students);
  }, function(response){
    console.log("An error has occurred: " + response.status + response.header);
  });

}

angular.module('tossApp')
  .component('tutorTable', {
    templateUrl: 'views/table.tutor.html',
    bindings: {
      // One-way binding
      studentInfo: '<'
    },
    controller:t_controller
  });
