'use strict';

function m_controller($scope, $log, $compile, $q, dataService, DTOptionsBuilder, DTColumnBuilder, DTColumnDefBuilder){
    var ctrl = this;
    var usr = [];
    ctrl.dtInstance = {};
    ctrl.data = [];
    ctrl.user = {};
    ctrl.reloadData = reloadData;

    // DataTable configuration
    ctrl.dtOptions = DTOptionsBuilder.fromFnPromise(function () {
      /*var defer = $q.defer();
      dataService.get('getusers').then(function (data) {
        defer.resolve(data.response);
      });
      return defer.promise;*/
      return dataService.johnAction('action=getlist').then(function (data) {
        return data.data;
      });
    })
    .withDOM('frtip')
    .withBootstrap()
    .withPaginationType('full_numbers')
    .withDisplayLength(10)
    .withOption('resposive', true)
    .withOption('order', [
      5, 'asc'
    ])
    .withOption('deferRender', true)
    .withOption('createdRow', createdRow)
    .withOption('processing', true)
    .withLanguage({
      "sEmptyTable": "No data available in table",
      "sInfo": "Showing _START_ to _END_ of _TOTAL_ entries",
      "sInfoEmpty": "Showing 0 to 0 of 0 entries",
      "sLoadingRecords": "Loading...",
      "sProcessing":"Processing...",
      "sSearch": "Search All Field:",
      "sZeroRecords": "No matching records found",
    });
    /*.withOption('initComplete', function() {
      angular.element('.dataTables_filter input').attr('placeholder', 'Search table');
    });*/

    ctrl.dtColumns = [
      DTColumnBuilder.newColumn('class').withTitle('Class'),
      DTColumnBuilder.newColumn('coursename').withTitle('Course Name'),
      DTColumnBuilder.newColumn('name').withTitle('Name'),
      DTColumnBuilder.newColumn('starttime').withTitle('Start Time'),
      DTColumnBuilder.newColumn('endtime').withTitle('End Time'),
      DTColumnBuilder.newColumn(null).withTitle('Actions').notSortable()
            .renderWith(profileLink),
      DTColumnBuilder.newColumn('location').withTitle('Location'),
      DTColumnBuilder.newColumn('status').withTitle('Status').notSortable()
        .renderWith(sessionStatus),
      DTColumnBuilder.newColumn('studentid').withTitle('SID').notVisible()
    ];

    function createdRow(row, data, dataIndex) {
      // Recompiling so we can bind Angular directive to the DT
      $compile(angular.element(row).contents())($scope);
    }
    function profileLink(data, type, full, meta) {
      // Create a link to tutor's profile
      ctrl.user[data.studentid] = data.studentid;
      return '<a ui-sref="profile({ profileId: $ctrl.user[' + data.studentid + ']})">View Profile</a>';
    }
    function reloadData() {
      // Reload the data on the table
        var resetPaging = true;
        ctrl.dtInstance.reloadData();
    }
    function sessionStatus(data, type, full, meta) {
      // Create a link to tutor's profile
      usr[data.status] = data;
      //ctrl.user[data.status] = data;
      return '<div class="'+usr[data.status]+'">'+usr[data.status]+'</div>';
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
