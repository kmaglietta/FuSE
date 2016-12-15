'use strict';

angular.module('tossApp')
  .component('adminModalComponent', {
    bindings:{
      resolve:'<',
      close: '&',
      dismiss: '&'
    },
    templateUrl:'templates/modal.content.admin.html',
    controller: function() {
      var ctrl = this;

      ctrl.submit = function(FirstName, LastName, EmailAddress, Password) {
        ctrl.userData = {
          FirstName:FirstName,
          LastName:LastName,
          EmailAddress:EmailAddress,
          Password:Password
        }
        console.log('Record updated');
        $uibModalInstance.close(ctrl.userData);
      };
      ctrl.cancel = function() {
        $uibModalInstance.dismiss('cancel');
      }
    },
    controllerAs: '$ctrl'
  })
