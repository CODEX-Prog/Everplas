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
/******/ 	return __webpack_require__(__webpack_require__.s = 17);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/pages/hrm/employee.js":
/*!********************************************!*\
  !*** ./resources/js/pages/hrm/employee.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// global variables
var employeeId;
var trowId;

function isEmailAddress(str) {
  var pattern = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
  return str.match(pattern);
}

jQuery(document).ready( // edit employee button event handler
// jQuery('.edit-btn').click(function () {
//     employeeId = '';
//     trowId = '';
//     var idArray = ($(this).attr('id')).split('-');
//     employeeId = idArray[2];
//     trowId = idArray[3];
//
//     var data = {
//         id: employeeId
//     };
//     $.ajax({
//         method: "GET",
//         url: "/human/getemployee",
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
//         data: data,
//         success: function (response) {
//             var result = JSON.parse(response);
//             if(result['status'] == 'success') {
//                 jQuery('#edit-employee-modal').modal('show');
//                 var employee = result['employee'];
//                 console.log("here get group success", result);
//             } else {
//                 console.log("here get group error: ");
//             }
//         },
//         error: function () {
//             console.log("here get group error: ");
//         }
//     });
//     console.log('here edit group button click: ', employeeId, trowId);
// }),
// edit group modal footer save button handler
// jQuery('#save-edit-employee').click(function () {
//     var employeeTable = jQuery('#employee-table').DataTable();
//
//     var data = {
//         id: employeeId
//     };
//     console.log('here save button is clicked: ', data);
//
//     $.ajax({
//         method: "POST",
//         url: "/human/updateemployee",
//         data: data,
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
//         success: function (response) {
//             var result = JSON.parse(response);
//             if(result['status'] == 'success') {
//                 console.log("here update user success", result['status']);
//                 // $($(groupTable.row(trowId).node()).children()[0]).children()[0].innerHTML = groupName;
//                 One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Edit Employee Success'});
//             } else {
//                 console.log("here update group error", result['status'], result['message']);
//                 One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Edit Employee Fail'});
//             }
//         },
//         error: function () {
//             console.log("here update user error: ");
//             One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Edit Employee Fail'});
//         }
//     });
//
//     jQuery('#edit-employee-modal').modal('hide');
// }),
//delete employee button event handler
jQuery('.delete-btn').click(function () {
  var employeeTable = jQuery('#employee-table').DataTable();
  employeeId = '';
  trowId = '';
  var idArray = $(this).attr('id').split('-');
  employeeId = idArray[2];
  trowId = idArray[3];
  var data = {
    id: employeeId
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
        url: "/human/deleteemployee",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: data,
        success: function success(response) {
          var result = JSON.parse(response);
          console.log("here delete user success", response);

          if (result['status'] == 'success') {
            self.parent().parent().parent().addClass('selected');
            employeeTable.row('.selected').remove().draw(false);
            Swal.fire('Deleted!', 'Your file has been deleted.', 'success');
          } else {
            One.helpers('notify', {
              type: 'success',
              icon: 'fa fa-check mr-1',
              message: 'Delete Employee Failed!'
            });
          }
        },
        error: function error() {
          console.log("here update user error: ");
          One.helpers('notify', {
            type: 'danger',
            icon: 'fa fa-times mr-1',
            message: 'Delete Employee Failed!'
          });
        }
      });
    }
  });
  console.log('here delete employee button click: ', employeeId, trowId);
}));

/***/ }),

/***/ 17:
/*!**************************************************!*\
  !*** multi ./resources/js/pages/hrm/employee.js ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp-new\htdocs\company-erp-laravel\resources\js\pages\hrm\employee.js */"./resources/js/pages/hrm/employee.js");


/***/ })

/******/ });