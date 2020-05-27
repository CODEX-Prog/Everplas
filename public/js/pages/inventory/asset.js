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
/******/ 	return __webpack_require__(__webpack_require__.s = 14);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/pages/inventory/asset.js":
/*!***********************************************!*\
  !*** ./resources/js/pages/inventory/asset.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance"); }

function _iterableToArray(iter) { if (Symbol.iterator in Object(iter) || Object.prototype.toString.call(iter) === "[object Arguments]") return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = new Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } }

jQuery(document).ready(function () {
  jQuery('.asset-company-select2').select2({
    ajax: {
      url: function url(params) {
        if (params.term) {
          return '/crm/companies-contacts/' + params.term;
        } else {
          return '/crm/companies-contacts';
        }
      },
      dataType: 'json',
      processResults: function processResults(data) {
        var companies = data['companies'];
        var contacts = data['contacts'];
        var companyArray = companies.map(function (item, index) {
          var temp = {
            id: "com" + item['id'],
            text: item['company_name']
          };
          return temp;
        });
        var contactArray = contacts.map(function (item, index) {
          var temp = {
            id: "con" + item['id'],
            text: item['contact_name']
          };
          return temp;
        });
        return {
          results: [].concat(_toConsumableArray(companyArray), _toConsumableArray(contactArray))
        };
      }
    }
  }); // jQuery('.asset-contact-select2').select2({
  //     ajax: {
  //         url: function (params) {
  //             if(params.term) {
  //                 return '/crm/getcontacts/' + params.term;
  //             } else {
  //                 return '/crm/getcontacts';
  //             }
  //         },
  //         dataType: 'json',
  //         processResults: function (data) {
  //             var contacts = data['contacts'];
  //             var contactArray = contacts.map((item, index) => {
  //                 var temp = {
  //                     id: item['id'],
  //                     text: item['contact_name']
  //                 };
  //                 return temp;
  //             });
  //             return {
  //                 results: contactArray
  //             };
  //         },
  //     },
  // });

  jQuery('.asset-owner-select2').select2({
    ajax: {
      url: function url(params) {
        if (params.term) {
          return '/human/getemployees/' + params.term;
        } else {
          return '/human/getemployees';
        }
      },
      dataType: 'json',
      processResults: function processResults(data) {
        var employees = data['employees'];
        var employeeArray = employees.map(function (item, index) {
          var temp = {
            id: item['id'],
            text: item['full_name']
          };
          return temp;
        });
        return {
          results: employeeArray
        };
      }
    }
  });
  jQuery('.delete-asset-btn').click(function () {
    var assetTable = jQuery('#asset-table').DataTable();
    assetId = '';
    trowId = '';
    var idArray = $(this).attr('id').split('-');
    assetId = idArray[2];
    trowId = idArray[3];
    var data = {
      id: assetId
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
          url: "/inventory/deleteasset",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: data,
          success: function success(response) {
            var result = JSON.parse(response);
            console.log("here delete user success", response);

            if (result['status'] == 'success') {
              self.parent().parent().parent().parent().addClass('selected');
              assetTable.row('.selected').remove().draw(false);
              Swal.fire('Deleted!', 'Your file has been deleted.', 'success');
            } else {
              One.helpers('notify', {
                type: 'success',
                icon: 'fa fa-check mr-1',
                message: 'Delete Asset Success'
              });
            }
          },
          error: function error() {
            console.log("here update user error: ");
            One.helpers('notify', {
              type: 'danger',
              icon: 'fa fa-times mr-1',
              message: 'Delete Asset Failed!'
            });
          }
        });
      }
    });
    console.log('here delete button click: ', idArray, data);
  });
});

/***/ }),

/***/ 14:
/*!*****************************************************!*\
  !*** multi ./resources/js/pages/inventory/asset.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp-new\htdocs\company-erp-laravel\resources\js\pages\inventory\asset.js */"./resources/js/pages/inventory/asset.js");


/***/ })

/******/ });