'use strict';

/**
 * @ngdoc directive
 * @name tossApp.directive:myTable
 * @description
 * # myTable
 */
function m_controller($scope, $log, $q, dataService, NgTableParams, DTOptionsBuilder, DTColumnBuilder){
    var ctrl = this;
    ctrl.data = [];
    ctrl.dataArray = [];

    // Get data from an ACTUAL database using AJAX and Promise
    /*dataService.get('getusers').then(function (results) {
      ctrl.data = results;

      ctrl.tableParams = new NgTableParams({
        page: 1,
        count: 10,
        sorting: {
          endtime: 'asc'
        }
      }, {
        total: ctrl.data.response.length,
        dataset: ctrl.data.response
      });
      // Return the data for later use
      return ctrl.tableParams;
    });*/
    /*ctrl.tableParams = new NgTableParams({
      page: 1,
      count: 10,
      filter: {
        $: ctrl.search
      },
      sorting: {
        endtime: 'asc'
      }
    }, {
      getData: function(params, $defer) {
        return dataService.get('getusers').then(function (data) {
          ctrl.data = data;
          params.total(data.inlineCount); // Count the total page
          $log.log(data.response);
          return ctrl.data.response;
        });
      }
    });*/

    // DataTable configuration
    ctrl.dtOptions = DTOptionsBuilder.fromFnPromise(function () {
      /*var defer = $q.defer();
      dataService.get('getusers').then(function (data) {
        defer.resolve(data.response);
      });
      return defer.promise;*/
      return dataService.get('getusers').then(function (data) {
        return data.response;
      });
    })
    .withDOM('frtip')
    .withBootstrap() // Use Bootstrap styling
    .withPaginationType('full_numbers')
    .withOption('resposive', true)
    .withOption('deferRender', true)
    .withOption('order', [
      5, 'asc'
    ])
    .withOption('initComplete', function() {
      angular.element('.dataTables_filter input').attr('placeholder', 'Search table');
    });
    ctrl.dtColumns = [
      DTColumnBuilder.newColumn('class').withTitle('Class').notSortable(),
      DTColumnBuilder.newColumn('coursename').withTitle('Course Name'),
      DTColumnBuilder.newColumn('name').withTitle('Name'),
      DTColumnBuilder.newColumn('location').withTitle('Location'),
      DTColumnBuilder.newColumn('starttime').withTitle('Start Time'),
      DTColumnBuilder.newColumn('endtime').withTitle('End Time'),
    ];

    // Clear the input field
    ctrl.clearSearch = function(){
      // Nullify the variable
      ctrl.searchTutor.class='';
      // Clean the form of root scope
      $scope.searchForm.$setPristine();
    }

}

angular.module('tossApp')
  .component('myTable', {
    templateUrl: 'templates/table.main.html',
    bindings: {
      // Two-way binding
      info: '<'
    },
    controller:m_controller
  });
