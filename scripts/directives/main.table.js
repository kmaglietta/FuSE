'use strict';

/**
 * @ngdoc directive
 * @name tossApp.directive:myTable
 * @description
 * # myTable
 */
function m_controller($scope, $log, $compile, $q, dataService, DTOptionsBuilder, DTColumnBuilder){
    var ctrl = this;
    ctrl.data = [];
    ctrl.dtInstance = {};
    ctrl.user = {};

    // DataTable configuration
    ctrl.dtOptions = DTOptionsBuilder.fromFnPromise(function () {
      /*var defer = $q.defer();
      dataService.get('getusers').then(function (data) {
        defer.resolve(data.response);
      });
      return defer.promise;*/
      return dataService.get('action=getusers').then(function (data) {
        return data.response;
      });
    })
    .withDOM('frtip')
    .withBootstrap() // Use Bootstrap styling
    .withPaginationType('full_numbers')
    .withDisplayLength(10)
    .withOption('resposive', true)
    .withOption('deferRender', true)
    .withOption('createdRow', createdRow)
    .withOption('order', [
      5, 'asc'
    ])
    .withLanguage({
      'sLoadingRecords': 'Loading...',
      'sZeroRecords': 'No records found'
    });
    /*.withOption('initComplete', function() {
      angular.element('.dataTables_filter input').attr('placeholder', 'Search table');
    });*/
    ctrl.dtColumns = [
      DTColumnBuilder.newColumn('sessionId').withTitle('ID').notVisible(),
      DTColumnBuilder.newColumn('class').withTitle('Class').notSortable(),
      DTColumnBuilder.newColumn('coursename').withTitle('Course Name'),
      DTColumnBuilder.newColumn('name').withTitle('Name'),
      DTColumnBuilder.newColumn('location').withTitle('Location'),
      DTColumnBuilder.newColumn('starttime').withTitle('Start Time'),
      DTColumnBuilder.newColumn('endtime').withTitle('End Time'),
      DTColumnBuilder.newColumn('profileId').withTitle('PID').notVisible(),
      DTColumnBuilder.newColumn(null).withTitle('Actions').notSortable()
            .renderWith(profileLink)
    ];
    ctrl.reloadData = reloadData;
    ctrl.dtInstance = {};


    // Clear the input field
    ctrl.clearSearch = function(){
      // Empty the string
      ctrl.searchTutor.class='';
      // Clean the form of root scope
      $scope.searchForm.$setPristine();
    }

    function createdRow(row, data, dataIndex) {
      // Recompiling so we can bind Angular directive to the DT
      $compile(angular.element(row).contents())($scope);
    }
    function profileLink(data, type, full, meta) {
      // Create a link to tutor's profile
      ctrl.user[data.profileId] = data.profileId;
      return '<a ui-sref="profile({ profileId: $ctrl.user[' + data.profileId + ']})">View Profile</a>';
    }
    function reloadData() {
      // Reload the data on the table
        var resetPaging = true;
        ctrl.dtInstance.reloadData(callback, resetPaging);
    }

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
