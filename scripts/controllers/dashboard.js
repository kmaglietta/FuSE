'use strict';

/**
 * @ngdoc function
 * @name tossApp.controller:DashboardCtrl
 * @description Controller for the tutor's dashboard
 * # DashboardCtrl
 * Controller of the tossApp
 */
angular.module('tossApp')
  .controller('DashboardCtrl', ['$scope','studentsFactory','$uibModal','$document','$log', function ($scope, studentsFactory, $uibModal, $document, $log) {
    var ctrl = this;
    ctrl.message = 'Are you sure you would like to remove this user?';

    // Get the name of the current signed-in instructor onto the rootScope
    studentsFactory.getTutors().then(function(response) {
      // Success Handler
      var data = response.data,
        status = response.status;
      $log.log("Success!", status);
      // Sample user's data
      $scope.dashName = data[1]["name"];
      $scope.dashDescipt = data[1]["description"];
    }, function(response) {
      //Error Handler
      var data = response.data,
        status = response.status,
        header = response.header;
      $log.log("An error has occurred:", status, header);
    });

    // Modal using component
    ctrl.openModalComponent = function(){
      var modalInstance = $uibModal.open({
        component: 'modalComponent',
        resolve:{
          message: function(){
            return ctrl.message;
          }
        }
      })
    }
  }])
    .component('modalComponent', {
      templateUrl:'dashboard.modal.html',
      bindings:{
        resolve:'<',
        close:'&',
        dismiss:'&'
      },
      controller: function(){
        var ctrl = this;

        ctrl.$onInit = function(){
          ctrl.message = ctrl.resolve.message;
        };

        ctrl.ok = function(){
          ctrl.close({ $value: 'yes' });
        };

        ctrl.cancel = function(){
          ctrl.dissmiss({ $value: 'cancel' });
        };
      }

    });
