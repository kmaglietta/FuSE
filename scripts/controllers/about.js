'use strict';

/**
 * @ngdoc function
 * @name tossApp.controller:AboutCtrl
 * @description
 * # AboutCtrl
 * Controller of the tossApp
 */
angular.module('tossApp')
  .controller('AboutCtrl', ['$scope', function ($scope) {
    $scope.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];
  }]);
