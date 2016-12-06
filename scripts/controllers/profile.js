'use strict';

angular.module('tossApp')
  .factory('profileService', profileService)
  .controller('ProfileCtrl', ProfileCtrl);

  function profileService($http, $log, $resource) {
    var factory = {};
    var service = 'php/index.php';

    factory.getProfile = function(id) {
      return $http.post(service + '?action=getprofile&id=' + id).then(function (response) {
        return response.data;
      })
    }

    return factory;
  }

  function ProfileCtrl($scope, $log, dataService, profileService, $stateParams) {
    var ctrl = this;
    var action = 'action=getprofile';
    ctrl.action = 'getprofile';
    ctrl.data = [];
    // Get the id from the params
    ctrl.profileId = $stateParams.profileId;
    var _data = {
      id: ctrl.profileId
    };

    profileService.getProfile(ctrl.profileId).then(function (data) {
      ctrl.data = data.response;
      $log.log(data.response);
    }, function() {
      $log.error('Get profile failed ' + data.status + ' ' + data.message);
    })
  }
