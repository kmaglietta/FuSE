'use strict';

/**
 * @ngdoc function
 * @name tossApp.controller:NavCtrl
 * @description
 * # NavCtrl
 * Controller of the tossApp
 */
angular.module('tossApp')
  .controller('NavCtrl', ['$scope', function ($scope) {
    $scope.isNavCollapsed = true;
  }]);
