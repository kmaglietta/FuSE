'use strict';

angular.module('tossApp')
  .factory('dashboardServices', dashboardServices)
  .controller('ViewSessionDashboardCtrl', ViewSessionDashboardCtrl)
  .controller('AddStudentSessionDashboardCtrl', AddStudentSessionDashboardCtrl)
  .controller('viewAttendedDashboardCtrl', viewAttendedDashboardCtrl)
  .controller('ModalRatingCtrl', ModalRatingCtrl)
  .controller('DashboardCtrl', DashboardCtrl);

  function dashboardServices($http, $resource) {
    var factory = {};
    var service = 'https://lamp.cse.fau.edu/~jherna65/api/action.php';

    factory.dashboardProfile = function(obj) {
      return $http.post(service + '?action=getdashboardprofile', obj).then(function(response) {
        return response.data;
      });
    };

    factory.post = function(q,obj) {
      return $http.post(service + q, obj).then(function(response) {
        return response.data;
      });
    };

    factory.getStudents = function() {
      return $http.get(service + '?action=getstudentmysessions').then(function(response) {
        return response.data;
      });
    };


    return factory;
  }

  function DashboardCtrl($scope, $q, dashboardServices, $log, $localStorage, $state, $timeout) {
    var ctrl = this;
    ctrl.data = [];
    ctrl.userData = null;

    if ($localStorage.userGuiid != null) {
      ctrl.userData = [];
      ctrl.userData.role = $localStorage.userRole;
      ctrl.userData.userGuiid = $localStorage.userGuiid;
      ctrl.userData.userId = $localStorage.userId;

      var _data = {
        role: ctrl.userData.role,
        id: ctrl.userData.userId
      };
    } else ctrl.userData = null;

    dashboardServices.dashboardProfile(_data).then(function(data) {
      $log.debug(data);
      return ctrl.data = data.response[0];
    });

    /*ctrl.id = {
      id: ctrl.userData.id
    }

    $q.when(userService.isAuthorized(ctrl.id)).then(function(value) {
      $log.log(value);
      ctrl.role = value.response.role;
    });*/
    /*userService.isAuthorized(ctrl.id).then(function(data) {
      ctrl.role = data.response.role;
      $log.log(ctrl.role);
    });*/

    /*function logout(){
      // Log user out
      $log.log('logging out...');
      userService.logout().then(function (data) {
        // Clear localStorage data
        //$localStorage.$reset();
        delete $localStorage.userData;
        $timeout(function() {
          $injector.get('$state').go('login');
        });
      }, function(data) {
        $log.error('An error has occurred');
      });
    };*/

    ctrl.logout =  function() {
      $log.log('logging out...');
      if ($localStorage.userGuiid != null) {
        // Delete everything from the NgStorage
        $localStorage.$reset();
        $log.log('Successfully logged out: ' + $localStorage.userGuiid);
        $q.when($localStorage.userGuiid==null).then(function(data) {
          $state.go('login', {}, {reload:true});
        });
      }
    };

  }

  function ViewSessionDashboardCtrl($scope, $log, $q, dashboardServices, $localStorage) {
    var ctrl = this;
    var _data = {
      id: $localStorage.userId
    };
    var action = '?action=getmysessions';
    ctrl.displayCollection = [];
    ctrl.rowCollection = [];
    ctrl.isLoading = true;

    dashboardServices.post(action, _data).then(function(data) {
      $log.log(data);
      if(data.status == 200) {
        ctrl.rowCollection = data.response;
        ctrl.displayCollection = [].concat(ctrl.rowCollection);
        ctrl.isLoading = false;
      }
    }, function (data) {
      $log.error('An error has occurred ' + data.status);
    });
  }

  function AddStudentSessionDashboardCtrl($scope, $log, $q, dashboardServices, $localStorage, NgTableParams, toaster) {
    var ctrl = this;
    var _data = {
      id: $localStorage.userId
    };
    var action = '?action=getsessiondropdown';
    ctrl.options = [];
    ctrl.displayCollection = [];
    ctrl.rowCollection = [];
    ctrl.selectedOption = null;
    ctrl.selected = null;
    ctrl.isLoading = true;

    dashboardServices.post(action, _data).then(function(data) {
      if(data.status == 200) {
        $log.log(data.response);
        var session = data.response;
        ctrl.options = data.response;
      }
    }, function(data) {
      $log.error('An error has occurred '+data.status);
    });

    dashboardServices.getStudents().then(function(data) {
      $log.log(data);
      if(data.status == 200) {
        ctrl.rowCollection = data.response;
        ctrl.displayCollection = [].concat(ctrl.rowCollection);
        ctrl.isLoading = false;
      }
    }, function (data) {
      $log.error('An error has occurred ' + data.status);
    });

    ctrl.addToSession = addToSession;

    function addToSession() {
      action = '?action=addstudentmysession';
      if(ctrl.selected!=null && ctrl.selectedOption!=null) {
        _data = {
          sessionid: ctrl.selectedOption,
          id: ctrl.selected,
          tid: $localStorage.userId
        };
        $log.log(_data);
        // Do ajax call
        dashboardServices.post(action, _data).then(function(data) {
          if(data.status == 200) {
            $log.log(data);
            if(data.response.type==null) {
              toaster.pop({
                type:'success',
                title:'Success',
                body:'A student has been added to your session',
                tapToDismiss: true,
                timeout:3000
              });
            }
            else {
              toaster.pop({
                type:'warning',
                title:'Warning',
                body:'This student has already been added',
                tapToDismiss: true,
                timeout:3000
              });
            }
          }
          else {
            $log.error(data);
            toaster.pop({
              type:'error',
              title:'Error',
              body:'Cannot add a student to your session',
              tapToDismiss: true,
              timeout:3000
            });
          }
        }), function(data) {
          $log.error(data.status + ' ' + data.message);
        };

      } else {
        // Otherwise gives warning
        toaster.pop({
          type:'warning',
          title:'Error',
          body:'Please select your course and/or student to add',
          tapToDismiss: true,
          timeout:3000
        });
      }
    };

  }

  function viewAttendedDashboardCtrl($scope, $log, dashboardServices, $localStorage, toaster, $uibModal, $state) {
    var ctrl = this;
    ctrl.data = [];
    ctrl.isLoading = true;
    ctrl.max = 5;
    ctrl.rowCollection = [];
    ctrl.displayCollection = [];

    if ($localStorage.userGuiid != null) {
      // Assign user id from localStorage
      var _data = {
        role: $localStorage.userRole,
        id: $localStorage.userId
      };
      var action = '?action=viewattendedsessions';
      $log.log(_data);
      dashboardServices.post(action, _data).then(function(data) {
        $log.log(data);
        if(data.status == 200) {
          ctrl.rowCollection = data.response;
          ctrl.displayCollection = [].concat(ctrl.rowCollection);
          ctrl.isLoading = false;
        }
      }, function (data) {
        $log.error('An error has occurred ' + data.status);
      });
    }

    ctrl.openRate = function(row){
      var modalInstance = $uibModal.open({
        animation: true,
        ariaLabelledBy: 'modal-title',
        ariaDescribedBy: 'modal-body',
        templateUrl: 'templates/modal.content.rating.html',
        controller: 'ModalRatingCtrl',
        controllerAs: '$ctrl',
        resolve: {
          items: function(){
            return row;
          }
        }
      });

      modalInstance.result.then(function(item) {
        $log.log(item);
        _data = {
          tssid: item.tssId,
          id: $localStorage.userId,
          sessionid: item.sessionid,
          newRating: item.newRating
        }
        $log.log(_data);
        action = '?action=ratemytutor';
        dashboardServices.post(action, _data).then(function(data) {
          $log.log(data);
          if(data.status == 200) {
            $state.reload();
          }
          else {
            toaster.pop({
              type:'error',
              title:'Warning',
              body:'Cannot rate a tutor',
              tapToDismiss: true,
              timeout:3000
            });
          }
        }, function(data) {
          $log.error('An error has occurred ' + data.status);
        });
      }, function() {
        $log.log('modal dismiss at: ' + new Date());
      });
    };

  }

  function ModalRatingCtrl($uibModalInstance, items) {
    var ctrl = this;
    ctrl.data = items;
    ctrl.selectedOption = null;
    ctrl.showError = false;
    ctrl.ratings = [
      {id:1,rating:1},
      {id:2,rating:2},
      {id:3,rating:3},
      {id:4,rating:4},
      {id:5,rating:5}
    ];
    ctrl.oldRating = ctrl.data.rating;
    ctrl.oldRating = parseInt(ctrl.oldRating);

    ctrl.submit = function() {
      if(ctrl.selectedOption!= null) {
        ctrl.data.newRating = ctrl.selectedOption;
        $uibModalInstance.close(ctrl.data);
      } else {
        ctrl.showError = true;
      }
    };
    ctrl.cancel = function() {
      $uibModalInstance.dismiss('cancel');
    }
  }
