'use strict';

angular.module('tossApp')
  .controller('ContactCtrl', function ($scope,$state) {

    // Function to submit the form after validated
    $scope.submitForm = function(isValid) {
      // Check to make sure the form is valid
      if (isValid) {
        console.log('The form has been submitted successfully');
        $state.reload();
      }
    }
  });
