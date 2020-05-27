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
/******/ 	return __webpack_require__(__webpack_require__.s = 22);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/pages/receiving/receiving.js":
/*!***************************************************!*\
  !*** ./resources/js/pages/receiving/receiving.js ***!
  \***************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance"); }

function _iterableToArray(iter) { if (Symbol.iterator in Object(iter) || Object.prototype.toString.call(iter) === "[object Arguments]") return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = new Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } }

var materialListArray = [];
jQuery(document).ready(function () {
  jQuery('.client-select2').select2({
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
          return {
            id: "com" + item['id'],
            text: item['company_name']
          };
        });
        var contactArray = contacts.map(function (item, index) {
          return {
            id: "con" + item['id'],
            text: item['contact_name']
          };
        });
        return {
          results: [].concat(_toConsumableArray(companyArray), _toConsumableArray(contactArray))
        };
      }
    }
  });
  jQuery('.employee-select2').select2({
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
  jQuery('.material-select2').select2({
    ajax: {
      url: function url(params) {
        if (params.term) {
          return '/products/get-material/' + params.term;
        } else {
          return '/products/get-material/';
        }
      },
      dataType: 'json',
      processResults: function processResults(data) {
        var materials = data['materials'];
        var materialArray = materials.map(function (item, index) {
          var temp = {
            id: item['id'],
            text: item['name']
          };
          return temp;
        });
        return {
          results: materialArray
        };
      }
    }
  });
  jQuery('.material-add-btn').click(function () {
    var materialSelect = $('#material-id');
    var materialId = materialSelect.val();
    var materialLabel = $('#material-id option:selected').text();

    if (materialId) {
      if (checkExist(materialId)) {
        var trow = "<tr class=\"main\">\n" + "    <td>\n" + "         <input name='mat-name' class='form-control' type='text' id='mat-name' disabled>\n" + "    </td>\n" + "    <td>\n" + "         <textarea name='mat-description' rows='2' class='form-control' placeholder='description'></textarea>\n" + "    </td>\n" + "    <td>\n" + "         <input type='number' name='quantity' min='1' value='1' class='form-control'>\n" + "    </td>\n" + "    <td>\n" + "         <input type='number' name='weight' min='0' class='form-control' placeholder='KG'>\n" + "    </td>\n" + "    <td>\n" + "         <input type='number' name='mat-amount' min='0' class='form-control' placeholder='Amount'>\n" + "    </td>\n" + "    <td>\n" + "        <button type='button' class='btn pull-right btn-danger cancel-material-btn'>\n" + "              <i class='fa fa-times'></i>\n" + "        </button>\n" + "    </td>\n" + "</tr>";
        var materialList = {
          id: materialId,
          description: '',
          quantity: 0,
          weight: 0,
          amount: 0
        };
        materialListArray.push(materialList);
        console.log(materialListArray);
        $('#material-table tbody').append(trow);
        $('#material-table tbody tr:last td:first input').val(materialLabel);
        $("#material-table tbody tr:last textarea").attr("id", "mat-description-".concat(materialId));
        $("#material-table tbody tr:last input[name='quantity']").attr("id", "mat-quantity-".concat(materialId));
        $("#material-table tbody tr:last input[name='weight']").attr("id", "mat-weight-".concat(materialId));
        $("#material-table tbody tr:last input[name='mat-amount']").attr("id", "mat-amount-".concat(materialId));
        $("#material-table tbody tr:last button").attr("id", "mat-remove-".concat(materialId));
        $("#material-table tbody tr td textarea").change(function () {
          var idArray = $(this).attr('id').split('-');
          changeArrayList(idArray[2], 'description', $(this).val());
        });
        $("#material-table tbody tr td input[name='quantity']").change(function () {
          var idArray = $(this).attr('id').split('-');
          changeArrayList(idArray[2], 'quantity', $(this).val());
        });
        $("#material-table tbody tr td input[name='weight']").change(function () {
          var idArray = $(this).attr('id').split('-');
          changeArrayList(idArray[2], 'weight', $(this).val());
        });
        $("#material-table tbody tr td input[name='mat-amount']").change(function () {
          var idArray = $(this).attr('id').split('-');
          changeArrayList(idArray[2], 'amount', $(this).val());
        });
        $('#material-table tbody tr:last td:last button').click(function () {
          $(this).parent().parent().remove();
          var idArray = $(this).attr('id').split('-');
          removeFromMaterialList(idArray[2]);
        });
      } else {
        One.helpers('notify', {
          type: 'danger',
          icon: 'fa fa-times mr-1',
          message: 'Material already selected!'
        });
      }
    } else {
      One.helpers('notify', {
        type: 'danger',
        icon: 'fa fa-times mr-1',
        message: 'Please Select Material!'
      });
    }
  });
  jQuery('#job-create-form').submit(function (e) {
    $("<input />").attr("type", "hidden").attr("name", "material-list").attr("value", JSON.stringify({
      list: materialListArray
    })).appendTo("#job-create-form");
    return true;
  });
  jQuery('#job-edit-form').submit(function (e) {
    $("<input />").attr("type", "hidden").attr("name", "material-list").attr("value", JSON.stringify({
      list: materialListArray
    })).appendTo("#job-edit-form");
    return true;
  });
  jQuery('.delete-jo-btn').click(function () {
    var jobTable = jQuery('#jo-table').DataTable();
    var idArray = $(this).attr('id').split('-');
    var jobId = idArray[2];
    var trowId = idArray[3];
    var data = {
      id: jobId
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
          method: "DELETE",
          url: "/receiving/job-order/delete",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: data,
          success: function success(response) {
            var result = JSON.parse(response);

            if (result['status'] == 'success') {
              self.parent().parent().parent().addClass('selected');
              jobTable.row('.selected').remove().draw(false);
              Swal.fire('Deleted!', 'Your file has been deleted.', 'success');
            } else {
              One.helpers('notify', {
                type: 'success',
                icon: 'fa fa-check mr-1',
                message: 'Delete Job Order Failed!'
              });
            }
          },
          error: function error() {
            One.helpers('notify', {
              type: 'danger',
              icon: 'fa fa-times mr-1',
              message: 'Delete Job Order Failed!'
            });
          }
        });
      }
    });
  });
  jQuery('.approve-jo-btn').click(function () {
    var jobTable = jQuery('#jo-table').DataTable();
    var idArray = $(this).attr('id').split('-');
    var jobId = idArray[2];
    var trowId = idArray[3];
    var data = {
      id: jobId
    };
    var self = $(this);
    Swal.fire({
      title: 'Are you sure?',
      text: "You can revert this!",
      type: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Approve it!'
    }).then(function (result) {
      if (result.value) {
        $.ajax({
          method: "POST",
          url: "/receiving/job-order/approve",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: data,
          success: function success(response) {
            var result = JSON.parse(response);

            if (result['status'] == 'success') {
              var approvedJo = result['jo'];
              self.parent().parent().parent().addClass('selected');
              jobTable.row('.selected').remove().draw(false); // Swal.fire(
              //     'Approved!',
              //     'Job Order has been approved.',
              //     'success'
              // );

              location.reload(true);
            } else {
              One.helpers('notify', {
                type: 'success',
                icon: 'fa fa-check mr-1',
                message: 'Approving Job Order Failed!'
              });
            }
          },
          error: function error() {
            One.helpers('notify', {
              type: 'danger',
              icon: 'fa fa-times mr-1',
              message: 'Approving Job Order Failed!'
            });
          }
        });
      }
    });
  });
  jQuery('.complete-jo-btn').click(function () {
    var approvedJoTable = jQuery('#jo-process-table').DataTable();
    var idArray = $(this).attr('id').split('-');
    var jobId = idArray[2];
    var trowId = idArray[3];
    var data = {
      id: jobId
    };
    var self = $(this);
    Swal.fire({
      title: 'Are you sure?',
      text: "You can revert this!",
      type: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Approve it!'
    }).then(function (result) {
      if (result.value) {
        $.ajax({
          method: "POST",
          url: "/receiving/job-order/complete",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: data,
          success: function success(response) {
            var result = JSON.parse(response);

            if (result['status'] == 'success') {
              var completedJob = result['jo'];
              self.parent().parent().parent().addClass('selected');
              approvedJoTable.row('.selected').remove().draw(false); // Swal.fire(
              //     'Approved!',
              //     'Job Order has been approved.',
              //     'success'
              // );

              location.reload(true);
            } else {
              One.helpers('notify', {
                type: 'success',
                icon: 'fa fa-check mr-1',
                message: 'Approving Job Order Failed!'
              });
            }
          },
          error: function error() {
            One.helpers('notify', {
              type: 'danger',
              icon: 'fa fa-times mr-1',
              message: 'Approving Job Order Failed!'
            });
          }
        });
      }
    });
  });
});

function checkExist(id) {
  var result = materialListArray.find(function (materialList) {
    return materialList.id === id;
  });
  return !!!result;
}

function changeArrayList(id, key, value) {
  var arrayList = materialListArray.find(function (materialList) {
    return materialList.id === id;
  });
  arrayList[key] = value;
}

function removeFromMaterialList(id) {
  materialListArray = materialListArray.filter(function (materialList) {
    return materialList.id !== id;
  });
}

/***/ }),

/***/ 22:
/*!*********************************************************!*\
  !*** multi ./resources/js/pages/receiving/receiving.js ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp-new\htdocs\company-erp-laravel\resources\js\pages\receiving\receiving.js */"./resources/js/pages/receiving/receiving.js");


/***/ })

/******/ });