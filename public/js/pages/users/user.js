/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 6);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/pages/users/user.js":
/*!******************************************!*\
  !*** ./resources/js/pages/users/user.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var userViewPermission = false;
var userDeletePermission = false;
var userUpdatePermission = false;
var userCreatePermission = false;
var crmViewPermission = false;
var crmDeletePermission = false;
var crmUpdatePermission = false;
var crmCreatePermission = false;
var userId;
var trowId;
var pattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

function isEmailAddress(str) {
  return str.match(pattern);
}

jQuery(document).ready(jQuery('#permission-group').on('change', function () {
  console.log(this.value);

  if (this.value > 0) {
    jQuery('#special-permission-section-user').css("display", "block");
  } else {
    jQuery('#special-permission-section-user').css("display", "none");
  }
}), jQuery('#user-save-button').on('click', function () {
  var userTable = jQuery('#user-table').DataTable();
  var empid = $('#employee_id').val();
  var fullName = $('#add-user-full-name').val();
  var userName = $('#add-username').val();
  var password = $('#password').val();
  var confirm_password = $('#password_confirmation').val();
  var email = $('#add-user-email').val();
  var grid = $('#group_id').val();

  if (fullName && userName && password && email && confirm_password) {
    if (isEmailAddress(email)) {
      if (password == confirm_password) {
        var data = {
          empid: empid,
          grid: grid,
          fullName: fullName,
          userName: userName,
          password: password,
          email: email,
          userViewPermission: userViewPermission == true ? 1 : 0,
          userDeletePermission: userDeletePermission == true ? 1 : 0,
          userUpdatePermission: userUpdatePermission == true ? 1 : 0,
          userCreatePermission: userCreatePermission == true ? 1 : 0,
          crmViewPermission: crmViewPermission == true ? 1 : 0,
          crmCreatePermission: crmCreatePermission == true ? 1 : 0,
          crmDeletePermission: crmDeletePermission == true ? 1 : 0,
          crmUpdatePermission: crmUpdatePermission == true ? 1 : 0
        };
        console.log('here user data: ', data);
        $('#modal-block-fadein-user').modal('hide');
        $.ajax({
          method: "POST",
          url: "/users/createuser",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: data,
          success: function success(response) {
            var result = JSON.parse(response);

            if (result['status'] == 'success') {
              var user = result['user'];
              var newRow = userTable.row.add([user['id'], user['full_name'], user['name'], '0 days ago', "<div>\n" + "</div>"]).draw();
              console.log('here new row: ', newRow.index());
              var newRowNode = newRow.node();
              $($(newRowNode).children()[0]).addClass('font-w600');
              $($(newRowNode).children()[1]).addClass('font-w600');
              $($(newRowNode).children()[2]).addClass('text-muted');
              $($(newRowNode).children()[3]).addClass('text-muted');
              $($(newRowNode).children()[4]).addClass('text-center');
              var buttonWrapper = $($(newRowNode).children()[4]).children()[0];
              $(buttonWrapper).addClass('btn-group');
              buttonWrapper.innerHTML = "<button type=\"button\" class=\"btn btn-sm btn-primary edit-user\"\n" + "</button>\n" + "<button type=\"button\" class=\"btn btn-sm btn-primary delete-user\"\n" + "</button>";
              $($(buttonWrapper).children()[0]).attr('id', "edit-user-".concat(user['id'], "-").concat(newRow.index()));
              $($(buttonWrapper).children()[1]).attr('id', "delete-user-".concat(user['id'], "-").concat(newRow.index()));
              $(buttonWrapper).children()[0].innerHTML = "<i class=\"fa fa-fw fa-pencil-alt\"></i>";
              $(buttonWrapper).children()[1].innerHTML = "<i class=\"fa fa-fw fa-times\"></i>";
              jQuery('#modal-block-fadein-user').modal('hide');
              $($(buttonWrapper).children()[0]).click(function () {
                var userTable = jQuery('#user-table').DataTable();
                console.log('here cancel button clicked', userId, trowId);
                var fullName = jQuery('#edit-user-full-name').val();
                var name = jQuery('#edit-user-name').val();
                var email = jQuery('#edit-user-email').val();

                if (fullName && name && email) {
                  var data = {
                    id: userId,
                    fullName: fullName,
                    name: name,
                    email: email
                  };
                  $.ajax({
                    method: "POST",
                    url: "/users/updateuser",
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    success: function success(response) {
                      var result = JSON.parse(response);

                      if (result['status'] == 'success') {
                        $(userTable.row(trowId).node()).children()[1].innerHTML = fullName;
                        console.log("here update user success", response);
                        One.helpers('notify', {
                          type: 'success',
                          icon: 'fa fa-check mr-1',
                          message: 'Edit User Success'
                        });
                      } else {
                        One.helpers('notify', {
                          type: 'danger',
                          icon: 'fa fa-times mr-1',
                          message: 'Edit User Failed!'
                        });
                      }
                    },
                    error: function error() {
                      console.log("here update user error: ");
                      One.helpers('notify', {
                        type: 'danger',
                        icon: 'fa fa-times mr-1',
                        message: 'Edit User Failed!'
                      });
                    }
                  });
                  jQuery('#edit-user-full-name').val('');
                  jQuery('#edit-user-name').val('');
                  jQuery('#edit-user-email').val('');
                  jQuery('#edit-user-modal').modal('hide');
                } else {
                  Swal.fire('Please Fill all Fields');
                }
              });
              $($(buttonWrapper).children()[1]).click(function () {
                var userTable = jQuery('#user-table').DataTable();
                userId = '';
                trowId = '';
                var idArray = this.id.split('-');
                userId = idArray[2];
                trowId = idArray[3];
                var data = {
                  id: userId
                };
                var self = $(this);
                Swal.fire({
                  title: 'Are you sure?',
                  text: "You won't be able to revert this!",
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!'
                }).then(function (result) {
                  if (result.value) {
                    $.ajax({
                      method: "POST",
                      url: "/users/deleteuser",
                      headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      data: data,
                      success: function success(response) {
                        var result = JSON.parse(response);
                        console.log("here delete user success", response);

                        if (result['status'] == 'success') {
                          self.parent().parent().parent().addClass('selected');
                          userTable.row('.selected').remove().draw(false);
                          Swal.fire('Deleted!', 'Your file has been deleted.', 'success');
                        } else {
                          One.helpers('notify', {
                            type: 'success',
                            icon: 'fa fa-check mr-1',
                            message: 'Delete User Success'
                          });
                        }
                      },
                      error: function error() {
                        console.log("here update user error: ");
                        One.helpers('notify', {
                          type: 'danger',
                          icon: 'fa fa-times mr-1',
                          message: 'Delete User Failed!'
                        });
                      }
                    });
                  }
                });
              });
              One.helpers('notify', {
                type: 'success',
                icon: 'fa fa-check mr-1',
                message: 'Creat new Group success'
              });
            } else {
              console.log('creating user error: ', result['message']);
              One.helpers('notify', {
                type: 'danger',
                icon: 'fa fa-times mr-1',
                message: 'Create User Failed!'
              });
            }
          },
          error: function error() {
            console.log("here user save error: ");
            One.helpers('notify', {
              type: 'danger',
              icon: 'fa fa-times mr-1',
              message: 'Create User Failed!'
            });
          }
        });
      } else {
        Swal.fire('Password fields does not match!');
      }
    } else {
      Swal.fire('Please Enter valid Email');
    }
  } else {
    Swal.fire('Please Fill all Fields');
  }

  console.log('here user modal save button clicked');
}), jQuery('#user-view-permission').on('change', function () {
  userViewPermission = this.checked;
}), jQuery('#user-delete-permission').on('change', function () {
  userDeletePermission = this.checked;
}), jQuery('#user-update-permission').on('change', function () {
  userUpdatePermission = this.checked;
}), jQuery('#user-create-permission').on('change', function () {
  userCreatePermission = this.checked;
}), jQuery('#crm-view-permission').on('change', function () {
  crmViewPermission = this.checked;
}), jQuery('#crm-delete-permission').on('change', function () {
  crmDeletePermission = this.checked;
}), jQuery('#crm-update-permission').on('change', function () {
  crmUpdatePermission = this.checked;
}), jQuery('#crm-create-permission').on('change', function () {
  crmCreatePermission = this.checked;
}), jQuery('.edit-user').click(function () {
  var userTable = jQuery('#user-table').DataTable();
  userId = '';
  trowId = '';
  var idArray = this.id.split('-');
  userId = idArray[2];
  trowId = idArray[3];
  var data = {
    id: userId
  };
  $.ajax({
    method: "GET",
    url: "/users/getuser",
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data: data,
    success: function success(response) {
      var result = JSON.parse(response);

      if (result['status'] == 'success') {
        var user = result['user'];
        jQuery('#edit-user-modal').modal('show');
        jQuery('#edit-user-full-name').val(user.full_name);
        jQuery('#edit-user-name').val(user.name);
        jQuery('#edit-user-email').val(user.email);
        console.log("here get user success", result);
      } else {
        console.log("here get user error: ");
      }
    },
    error: function error() {
      console.log("here get user error: ");
    }
  });
  console.log('here edit user button clicked: ', trowId, userTable.row(trowId).data());
}), jQuery('#save-user').click(function () {
  var userTable = jQuery('#user-table').DataTable();
  console.log('here cancel button clicked', userId, trowId);
  var fullName = jQuery('#edit-user-full-name').val();
  var name = jQuery('#edit-user-name').val();
  var email = jQuery('#edit-user-email').val();

  if (fullName && name && email) {
    var data = {
      id: userId,
      fullName: fullName,
      name: name,
      email: email
    };
    $.ajax({
      method: "POST",
      url: "/users/updateuser",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: data,
      success: function success(response) {
        var result = JSON.parse(response);

        if (result['status'] == 'success') {
          $(userTable.row(trowId).node()).children()[1].innerHTML = fullName;
          console.log("here update user success", response);
          One.helpers('notify', {
            type: 'success',
            icon: 'fa fa-check mr-1',
            message: 'Edit User Success'
          });
        } else {
          One.helpers('notify', {
            type: 'danger',
            icon: 'fa fa-times mr-1',
            message: 'Edit User Failed!'
          });
        }
      },
      error: function error() {
        console.log("here update user error: ");
        One.helpers('notify', {
          type: 'danger',
          icon: 'fa fa-times mr-1',
          message: 'Edit User Failed!'
        });
      }
    });
    jQuery('#edit-user-full-name').val('');
    jQuery('#edit-user-name').val('');
    jQuery('#edit-user-email').val('');
    jQuery('#edit-user-modal').modal('hide');
  } else {
    Swal.fire('Please Fill all Fields');
  }
}), jQuery('#cancel-user').click(function () {
  console.log('here cancel button clicked');
  jQuery('#edit-user-modal').modal('hide');
}), jQuery('.delete-user').click(function () {
  var userTable = jQuery('#user-table').DataTable();
  userId = '';
  trowId = '';
  var idArray = this.id.split('-');
  userId = idArray[2];
  trowId = idArray[3];
  var data = {
    id: userId
  };
  var self = $(this);
  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then(function (result) {
    if (result.value) {
      $.ajax({
        method: "POST",
        url: "/users/deleteuser",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: data,
        success: function success(response) {
          var result = JSON.parse(response);
          console.log("here delete user success", response);

          if (result['status'] == 'success') {
            self.parent().parent().parent().addClass('selected');
            userTable.row('.selected').remove().draw(false);
            Swal.fire('Deleted!', 'Your file has been deleted.', 'success');
            location.reload(true);
          } else {
            One.helpers('notify', {
              type: 'success',
              icon: 'fa fa-check mr-1',
              message: 'Delete User Success'
            });
          }
        },
        error: function error() {
          console.log("here update user error: ");
          One.helpers('notify', {
            type: 'danger',
            icon: 'fa fa-times mr-1',
            message: 'Delete User Failed!'
          });
        }
      });
    }
  });
}),
/**
* Sales-Lead Employee Select2 implementation
* */
jQuery('.employee-select2').select2({
  ajax: {
    url: function url(params) {
      if (params.term) {
        return '/human/employees/' + params.term;
      } else {
        return '/human/employees';
      }
    },
    dataType: 'json',
    processResults: function processResults(data) {
      var employees = data['employees'];
      var employeeArr = employees.map(function (item) {
        return {
          id: item['id'],
          text: item['full_name'],
          email: item['email']
        };
      }); ////////////  TESTING

      for (var x in employeeArr) {
        console.log(employeeArr[x]['id']); //access value

        console.log(employeeArr[x]['text']); //access the text

        console.log(employeeArr[x]['email']); //access the text
      }

      return {
        results: employeeArr
      };
    }
  }
}), // EVENT TO SET VALUES ON SELECT
jQuery('.employee-select2').on('select2:select', function (e) {
  var data = e.params.data;
  console.log("SELECTED", data);
  console.log(data.id); //access value

  console.log(data.text); //access the text

  console.log(data.email); //access the text

  $('#add-user-full-name').val(data.text).css("background-color", "rgb(240, 248, 255)");
  $('#add-user-email').val(data.email).css("background-color", "rgb(240, 248, 255)");
}), jQuery('.user-group-select2').select2({
  ajax: {
    url: function url(params) {
      if (params.term) {
        return '/users/getgroups/' + params.term;
      } else {
        return '/users/getgroups/';
      }
    },
    dataType: 'json',
    processResults: function processResults(data) {
      groups = data.groups;
      var groupArray = groups.map(function (item, index) {
        var temp = {
          id: item.id,
          text: item.group_name
        };
        return temp;
      });
      return {
        results: groupArray
      };
    }
  }
}));

/***/ }),

/***/ 6:
/*!************************************************!*\
  !*** multi ./resources/js/pages/users/user.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp-new\htdocs\company-erp-laravel\resources\js\pages\users\user.js */"./resources/js/pages/users/user.js");


/***/ })

/******/ });