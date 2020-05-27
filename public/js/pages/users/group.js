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
/******/ 	return __webpack_require__(__webpack_require__.s = 7);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/pages/users/group.js":
/*!*******************************************!*\
  !*** ./resources/js/pages/users/group.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var groupId;
var trowId;
jQuery(document).ready( // save group button event handler
jQuery("#save-group-btn").click(function () {
  var groupTable = $('#group-table').DataTable();
  var groupName = jQuery('#group_name').val();

  if (groupName) {
    var data = {
      groupName: groupName
    };
    $.ajax({
      type: "POST",
      url: '/users/creategroup',
      data: data,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function success(response) {
        var result = JSON.parse(response);

        if (result['status'] == 'success') {
          var group = result['group'];
          var newRow = groupTable.row.add([group['group_name'], '3 days ago', "<div>\n" + "</div>"]).draw();
          console.log('here new row: ', newRow.index());
          var newRowNode = newRow.node();
          $($(newRowNode).children()[0]).addClass('font-w600');
          $($(newRowNode).children()[1]).addClass('text-muted');
          $($(newRowNode).children()[2]).addClass('text-center');
          var buttonWrapper = $($(newRowNode).children()[2]).children()[0];
          $(buttonWrapper).addClass('btn-group');
          buttonWrapper.innerHTML = "<button type=\"button\" class=\"btn btn-sm btn-primary edit-group-btn\"\n" + "</button>\n" + "<button type=\"button\" class=\"btn btn-sm btn-primary delete-group-btn\"\n" + "</button>";
          $($(buttonWrapper).children()[0]).attr('id', "edit-group-".concat(group['id'], "-").concat(newRow.index()));
          $($(buttonWrapper).children()[1]).attr('id', "delete-group-".concat(group['id'], "-").concat(newRow.index()));
          $(buttonWrapper).children()[0].innerHTML = "<i class=\"fa fa-fw fa-pencil-alt\"></i>";
          $(buttonWrapper).children()[1].innerHTML = "<i class=\"fa fa-fw fa-times\"></i>";
          jQuery('#modal-block-fadein-group').modal('hide');
          $('#group_name').val('');
          $($(buttonWrapper).children()[0]).click(function () {
            groupId = '';
            trowId = '';
            var idArray = $(this).attr('id').split('-');
            groupId = idArray[2];
            trowId = idArray[3];
            var data = {
              id: groupId
            };
            $.ajax({
              method: "GET",
              url: "/users/getgroup",
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              data: data,
              success: function success(response) {
                var result = JSON.parse(response);

                if (result['status'] == 'success') {
                  jQuery('#modal-block-edit-group').modal('show');
                  var group = result['group'];
                  jQuery('#edit-group_name').val(group['group_name']);
                  console.log("here get group success", result);
                } else {
                  console.log("here get group error: ");
                }
              },
              error: function error() {
                console.log("here get group error: ");
              }
            });
            console.log('here edit group button click: ', groupId, trowId);
          });
          $($(buttonWrapper).children()[1]).click(function () {
            var groupTable = jQuery('#group-table').DataTable();
            groupId = '';
            trowId = '';
            var idArray = $(this).attr('id').split('-');
            groupId = idArray[2];
            trowId = idArray[3];
            var data = {
              id: groupId
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
                  url: "/users/deletegroup",
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  data: data,
                  success: function success(response) {
                    var result = JSON.parse(response);
                    console.log("here delete user success", response);

                    if (result['status'] == 'success') {
                      self.parent().parent().parent().addClass('selected');
                      groupTable.row('.selected').remove().draw(false);
                      Swal.fire('Deleted!', 'Your file has been deleted.', 'success');
                    } else {
                      One.helpers('notify', {
                        type: 'success',
                        icon: 'fa fa-check mr-1',
                        message: 'Delete Group Failed!'
                      });
                    }
                  },
                  error: function error() {
                    console.log("here update user error: ");
                    One.helpers('notify', {
                      type: 'danger',
                      icon: 'fa fa-times mr-1',
                      message: 'Delete Group Failed!'
                    });
                  }
                });
              }
            });
            console.log('here delete group button click: ', groupId, trowId);
          });
          One.helpers('notify', {
            type: 'success',
            icon: 'fa fa-check mr-1',
            message: 'Creat new Group success'
          });
        } else {
          console.log('here create group error: ', result['message']);
          One.helpers('notify', {
            type: 'success',
            icon: 'fa fa-check mr-1',
            message: 'Create Group Fail'
          });
        }

        $('#modal-block-fadein-group').modal('hide');
      },
      error: function error() {
        console.log('here save group ajax error: ');
        One.helpers('notify', {
          type: 'danger',
          icon: 'fa fa-times mr-1',
          message: 'Create Group Failed!'
        });
      }
    });
  } else {
    Swal.fire('Please Fill all Fields');
  }
}), // edit group button event handler
jQuery('.edit-group').click(function () {
  groupId = '';
  trowId = '';
  var idArray = $(this).attr('id').split('-');
  groupId = idArray[2];
  trowId = idArray[3];
  var data = {
    id: groupId
  };
  $.ajax({
    method: "GET",
    url: "/users/getgroup",
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data: data,
    success: function success(response) {
      var result = JSON.parse(response);

      if (result['status'] == 'success') {
        jQuery('#modal-block-edit-group').modal('show');
        var group = result['group'];
        jQuery('#edit-group_name').val(group['group_name']);
        console.log("here get group success", result);
      } else {
        console.log("here get group error: ");
      }
    },
    error: function error() {
      console.log("here get group error: ");
    }
  });
  console.log('here edit group button click: ', groupId, trowId);
}), // edit group modal footer save button handler
jQuery('#save-group-edit-btn').click(function () {
  var groupTable = jQuery('#group-table').DataTable();
  var groupName = jQuery('#edit-group_name').val();

  if (groupName) {
    var data = {
      id: groupId,
      group_name: groupName
    };
    console.log('here save button is clicked: ', data);
    $.ajax({
      method: "POST",
      url: "/users/updategroup",
      data: data,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function success(response) {
        var result = JSON.parse(response);

        if (result['status'] == 'success') {
          console.log("here update user success", result['status']);
          $(groupTable.row(trowId).node()).children()[0].innerHTML = groupName;
          One.helpers('notify', {
            type: 'success',
            icon: 'fa fa-check mr-1',
            message: 'Edit Group Success'
          });
        } else {
          console.log("here update group error", result['status'], result['message']);
          One.helpers('notify', {
            type: 'success',
            icon: 'fa fa-check mr-1',
            message: 'Edit Group Fail'
          });
        }
      },
      error: function error() {
        console.log("here update user error: ");
        One.helpers('notify', {
          type: 'success',
          icon: 'fa fa-check mr-1',
          message: 'Edit Group Fail'
        });
      }
    });
    jQuery('#edit-group_name').val('');
    jQuery('#modal-block-edit-group').modal('hide');
  } else {
    Swal.fire('Please Fill all Fields');
  }
}), // edit group modal footer cancel button handler
jQuery('#cancel-group-edit-btn').click(function () {
  console.log('here cancel button is clicked: ');
  jQuery('#modal-block-edit-group').modal('hide');
}), //delete group button event handler
jQuery('.delete-group').click(function () {
  var groupTable = jQuery('#group-table').DataTable();
  groupId = '';
  trowId = '';
  var idArray = $(this).attr('id').split('-');
  groupId = idArray[2];
  trowId = idArray[3];
  var data = {
    id: groupId
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
        url: "/users/deletegroup",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: data,
        success: function success(response) {
          var result = JSON.parse(response);
          console.log("here delete user success", response);

          if (result['status'] == 'success') {
            self.parent().parent().parent().addClass('selected');
            groupTable.row('.selected').remove().draw(false);
            Swal.fire('Deleted!', 'Your file has been deleted.', 'success');
          } else {
            One.helpers('notify', {
              type: 'success',
              icon: 'fa fa-check mr-1',
              message: 'Delete Group Failed!'
            });
          }
        },
        error: function error() {
          console.log("here update user error: ");
          One.helpers('notify', {
            type: 'danger',
            icon: 'fa fa-times mr-1',
            message: 'Delete Group Failed!'
          });
        }
      });
    }
  });
  console.log('here delete group button click: ', groupId, trowId);
}));

/***/ }),

/***/ 7:
/*!*************************************************!*\
  !*** multi ./resources/js/pages/users/group.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp-new\htdocs\company-erp-laravel\resources\js\pages\users\group.js */"./resources/js/pages/users/group.js");


/***/ })

/******/ });