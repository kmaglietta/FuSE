'use strict';

angular.module('tossApp')
  .factory('profileService', profileService)
  .controller('ProfileCtrl', ProfileCtrl);

  function profileService($http, $log, $resource) {
    var factory = {};
    var service = 'php/index.php?';
    var exService = 'http://lamp.cse.fau.edu/~jherna65/apiTest/?';

    factory.getProfile = function(id) {
      return $http.post(service + 'action=getprofile&id=' + id).then(function (response) {
        return response.data;
      })
    };

    factory.getJohnProfile = function(q, id) {
      return $http.post(exService + q + '&StudentId=' + id).then(function (response) {
        return response.data;
      })
    };

    return factory;
  }

  function ProfileCtrl($scope, $log, profileService, $stateParams, NgTableParams) {
    var ctrl = this;
    var action = 'action=getprofile';
    ctrl.isReadonly = true;
    ctrl.max = 5;
    ctrl.rate = 5;
    ctrl.data = [];
    ctrl.profile = [];
    // Get the id from the params
    ctrl.profileId = $stateParams.profileId;
    var _data = {
      id: ctrl.profileId
    };

    /*profileService.getProfile(ctrl.profileId).then(function (data) {
      ctrl.data = data.response;
      $log.log(data.response);
    }, function() {
      $log.error('Get profile failed ' + data.status + ' ' + data.message);
    });*/

    profileService.getJohnProfile(action, ctrl.profileId).then(function (data) {
      ctrl.data = data.Records[0];
      $log.log(ctrl.data);
      ctrl.rate = ctrl.data.AverageRating;
    }, function() {
      $log.error('Get profile failed ' + data.status + ' ' + data.message);
    });

    ctrl.tableParams = new NgTableParams({}, {
      getData: function(params) {
        // ajax request to api
        action = 'action=getTutorclasses';
        return profileService.getJohnProfile(action, ctrl.profileId).then(function (data) {
          params.total(data.inlineCount); // recal. page nav controls
          return data.Records;
        }, function(data) {
          $log.error('Get profile failed ' + data.status + ' ' + data.message);
        });
      }
    });

    ctrl.hoverOver = function (val) {
      ctrl.overStar = val;
      ctrl.percent = 100 * (val / ctrl.max);
    };
  }
