'use strict';

/**
 * @ngdoc directive
 * @name tossApp.directive:myTable
 * @description
 * # myTable
 */
function m_controller($scope, studentsFactory, $log){
    var ctrl = this;
    var _query = 'class';
    ctrl.sortType = null;
    ctrl.sortReverse = true;
    ctrl.searchTutor = {  class:''  };

    // Get data from factory service
    studentsFactory.getTutors().then(function(response){
      ctrl.instructors = response.data;
      $log.log(ctrl.instructors);
    }, function(response){
      $log.log("An error has occurred: ", response.status);
    });

    ctrl.showDetail = function(value){
      if ($scope.active != value.name) {
        $log.log(value.name);
        $scope.active = value.name;
      } else {
        $scope.active = '';
        $log.log($scope.active);
      }
    };

    ctrl.sortBy = function(sortType){
      ctrl.sortReverse = (ctrl.sortType === sortType) ? !ctrl.sortReverse : false;
      ctrl.sortType = sortType;
    };
}

angular.module('tossApp')
  .component('myTable', {
    templateUrl: 'templates/table.main.html',
    bindings: {
      // One-way binding
      info: '<'
    },
    controller:m_controller
  });
