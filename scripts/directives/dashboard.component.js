'use strict';

angular.module('tossApp')
  .factory('dashboardService', dashboardService)
  .controller('modalAdminCtrl', modalAdminCtrl)
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
  })
//  .controller('SessionAdminDashboardCtrl', SessionAdminDashboardCtrl)
//  .controller('SessionClassDashboardCtrl', SessionClassDashboardCtrl)
//  .controller('SessionClassInfoDashboardCtrl', SessionClassInfoDashboardCtrl)
//  .controller('SessionLocationDashboardCtrl', SessionLocationDashboardCtrl)
//  .controller('SessionStudentDashboardCtrl', SessionStudentDashboardCtrl)
//  .controller('SessionTutorDashboardCtrl', SessionTutorDashboardCtrl)
  ;

function dashboardService($http, $log, $resource) {
  var factory = {};
  var service = 'api/index.php?';
  var exService = 'http://lamp.cse.fau.edu/~jherna65/apiTest/?';

  factory.getTableData = function(q) {
    return $http.post(exService + q).then(function(response) {
      return response.data;
    })
  }

  return factory;
}

function modalAdminCtrl($uibModalInstance) {
  // Controller for Modal
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
}

function updateItem(dashboardService, $q) {
  var action = 'updateDirector&';
}

function addItem(dashboardService, $q) {
  var action = 'addDirector&';

  return this.data;
}

function SessionAdminDashboardCtrl($scope, $log, dashboardService, NgTableParams, $uibModal, $document) {
  var ctrl = this;
  var action;
  ctrl.animationEnables = true;
  ctrl.items = [];

  ctrl.cols = [
    {field: "AdminId", title:"Admin ID", show:false},
    {field: "EmailAddress", title:"Email Address", show:true},
    {field: "Password", title:"Password", show:false},
    {field: "FirstName", title:"First Name", show:true},
    {field: "LastName", title:"Last Name", show:true},
    {field: "DateEntered", title:"Date Entered", show:false},
    {field: "null", title:"Edit", show:true}
  ];

  ctrl.tableParams = new NgTableParams({}, {
    getData: function(params) {
      // ajax request to api
      action = 'action=getDirectors';
      return dashboardService.getTableData(action).then(function(data) {
        params.total(data.inlineCount); // recal. page nav controls
        return data.Records;
      }, function() {
        $log.error('Get profile failed ' + data.status + ' ' + data.message);
      });
    }
  });
  ctrl.openAdd = function() {
    var modalInstance = $uibModal.open({
      animation: ctrl.animationsEnabled,
      ariaLabelledBy: 'modal-title',
      ariaDescribedBy: 'modal-body',
      templateUrl: 'templates/modal.content.html',
      controller: 'modalAdminCtrl',
      controllerAs: '$ctrl',
    });

    modalInstance.result.then(function (data) {
      ctrl.items = data;
      $log.log(ctrl.items);
    }, function () {
      $log.info('Modal dismissed at: ' + new Date());
    });
  };

}

/*
---
* Controller for component
---
*/
function da_controller($scope, $log, $q, dashboardService) {
  // Main controller for admin dashboard
  var ctrl = this;
}

function dt_controller($scope, $log, $q, dashboardService) {
  // Main controller for tutor dashboard
  var ctrl = this;
}

function ds_controller($scope, $log, $q, dashboardService) {
  // Main controller for student dashboard
  var ctrl = this;
}
