'use strict';

angular.module('tossApp')
  .controller('DashboardCycleCtrl', function ($scope, $interval, $q, $log,
    $state, $timeout, $compile, dataService, DTOptionsBuilder, DTColumnBuilder){
    var ctrl = this;
    var usr = [];
    ctrl.dtInstance = {};
    ctrl.data = [];
    ctrl.user = {};
    ctrl.timer

    // DataTable configuration
    ctrl.dtOptions = DTOptionsBuilder.fromFnPromise(function () {
      /*var defer = $q.defer();
      dataService.get('getusers').then(function (data) {
        defer.resolve(data.response);
      });
      return defer.promise;*/
      return dataService.johnAction('action=getdashboardlist').then(function (data) {
        $log.debug(data.data);
        return data.data;
      });
    })
    .withDOM('irt')
    .withBootstrap() // Use Bootstrap styling
    .withPaginationType('full_numbers')
    .withDisplayLength(10)
    .withOption('resposive', true)
    .withOption('order', [
      [0,'asc'],[5,'asc'], [6,'asc']
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
      DTColumnBuilder.newColumn('SessionStartTime').withTitle('Session Starting Time').notVisible().notSortable(),
      DTColumnBuilder.newColumn('class').withTitle('Class'),
      DTColumnBuilder.newColumn('coursename').withTitle('Course Name'),
      DTColumnBuilder.newColumn('name').withTitle('Name'),
      DTColumnBuilder.newColumn('location').withTitle('Location'),
      DTColumnBuilder.newColumn('starttime').withTitle('Start Time'),
      DTColumnBuilder.newColumn('endtime').withTitle('End Time'),
      DTColumnBuilder.newColumn('status').withTitle('Status').notSortable()
        .renderWith(sessionStatus),
    ];


    ctrl.backAState = function() {
      $log.log('Go back');
      $timeout(function() {
        $state.go('dashboard',{},{reload:true});
      }, 50);
    };

    ctrl.dtInstanceCallback = function (instance) {
      ctrl.dtInstance = instance;
      $log.debug(instance);
      ctrl.timer = $interval(function() {
        $log.log('OK');
        if(ctrl.dtInstance.DataTable.page()===ctrl.dtInstance.DataTable.page('last').page()){
          ctrl.dtInstance.reloadData();
        } else {
          ctrl.dtInstance.DataTable.page('next');
        }
        ctrl.dtInstance.DataTable.draw('page');
      }, 6000);
    };

    // Destroy interval timer on state change
    $scope.$on('$destroy', function() {
      $interval.cancel(ctrl.timer);
    });
    function createdRow(row, data, dataIndex) {
      // Recompiling so we can bind Angular directive to the DT
      $compile(angular.element(row).contents())($scope);
    }
    function sessionStatus(data, type, full, meta) {
      // Create a link to tutor's profile
      usr[data.status] = data;
      //ctrl.user[data.status] = data;
      return '<div class="'+usr[data.status]+'">'+usr[data.status]+'</div>';
    }
  });
