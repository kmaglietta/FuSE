'use strict';

angular.module('tossApp')
  .factory('dataService', function($http, toastr, $log, $resource){
    // This is to connect to API
    var factory = {};
    var service = 'php/index.php?action=';

    factory.toast = function (data){
      var status = data.status;
      if (status === "error" ){
        toastr.error(data.message, data.status);
      } else if (this.status === "success"){
        toastr.success(data.message, data.status);
      } else {
        toastr.info('???', 'An unknown error has occurred');
      }
    };
    factory.post = function(q, object) {
      return $http.post(service + q, object).then(function (result) {
        return result.data;
      });
    };
    factory.get = function (q) {
      return $http.get(service + q).then(function (result) {
        return result.data;
      })
    };
    factory.put = function (q, object) {
      return $http.put(service + q, object).then(function (result) {
        return result.data;
      });
    };
    factory.delete = function (q) {
      return $http.delete(service + q).then(function (result) {
        return result.data;
      })
    };
    factory.actionCall = function (q) {
      return $resource('/php/index.php?action=:actionType');
    };

    return factory;

  });
