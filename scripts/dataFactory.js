'use strict';

angular.module('tossApp')
  .factory('dataService', function($http, toaster, $log){
    // This is to connect to API
    var factory = {};
    var service = 'php/index.php?';
    var exService = 'http://lamp.cse.fau.edu/~jherna65/apiTest/'

    factory.toast = function (data){
      toaster.pop(data.status, "", data.message, 10000, 'trustedHtml');
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

    return factory;

  });
