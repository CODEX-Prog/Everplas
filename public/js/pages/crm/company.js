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
/******/ 	return __webpack_require__(__webpack_require__.s = 11);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/pages/crm/company.js":
/*!*******************************************!*\
  !*** ./resources/js/pages/crm/company.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var companyId;
var trowId;
jQuery(document).ready(jQuery('#create-company-form').on('submit', function (e) {
  e.preventDefault();
  var formData = new FormData(this);
  $.ajax({
    method: "POST",
    url: "/crm/createcompany",
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function success(response) {
      var result = JSON.parse(response);

      if (result['status'] == 'success') {
        var company = result['company'];
        var companyTable = jQuery('#company-table').DataTable();
        var newRow = companyTable.row.add([company['company_name'], company['telephone'], result['contacts'], "<div>\n" + "</div>"]).draw();
        console.log('here new row: ', newRow.index());
        var newRowNode = newRow.node();
        $($(newRowNode).children()[0]).addClass('font-w600');
        $($(newRowNode).children()[1]).addClass('text-muted');
        $($(newRowNode).children()[2]).addClass('text-muted');
        $($(newRowNode).children()[3]).addClass('text-center');
        var buttonWrapper = $($(newRowNode).children()[3]).children()[0];
        $(buttonWrapper).addClass('btn-group');
        buttonWrapper.innerHTML = "<button type=\"button\" class=\"btn btn-sm btn-primary edit-contact-btn\"\n" + "</button>\n" + "<button type=\"button\" class=\"btn btn-sm btn-primary delete-contact-btn\"\n" + "</button>";
        $($(buttonWrapper).children()[0]).attr('id', "edit-contact-".concat(company['id'], "-").concat(newRow.index()));
        $($(buttonWrapper).children()[1]).attr('id', "delete-contact-".concat(company['id'], "-").concat(newRow.index()));
        $(buttonWrapper).children()[0].innerHTML = "<i class=\"fa fa-fw fa-pencil-alt\"></i>";
        $(buttonWrapper).children()[1].innerHTML = "<i class=\"fa fa-fw fa-times\"></i>";
        jQuery('#create-company-modal').modal('hide');
        $($(buttonWrapper).children()[0]).click(function () {
          companyId = '';
          trowId = '';
          var idArray = $(this).attr('id').split('-');
          companyId = idArray[2];
          trowId = idArray[3];
          var data = {
            id: companyId
          };
          $.ajax({
            method: "GET",
            url: "/crm/getcompany",
            data: data,
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function success(response) {
              var result = JSON.parse(response);

              if (result['status'] == 'success') {
                jQuery('#edit-company-modal').modal('show');
                var company = result['company'];
                jQuery('#edit-company-name').val(company['company_name']);
                jQuery('#edit-company-vat-number').val(company['vat_number']);
                jQuery('#edit-company-telephone').val(company['telephone']);
                jQuery('#edit-company-fax').val(company['fax']);
                jQuery('#edit-company-website').val(company['website']);
                jQuery('#edit-company-address').val(company['address']);
                jQuery('#edit-company-city').val(company['city']);
                jQuery('#edit-company-country').val(company['country']);
                jQuery('#edit-company-card').val(company['company_card']);
                jQuery('#edit-company-email').val(company['Email']);
                console.log("here get company success", result);
              } else {
                console.log("here get company error: ");
              }
            },
            error: function error() {
              console.log("here get company error: ");
            }
          });
        });
        $($(buttonWrapper).children()[1]).click(function () {
          var companyTable = jQuery('#company-table').DataTable();
          companyId = '';
          trowId = '';
          var idArray = $(this).attr('id').split('-');
          companyId = idArray[2];
          trowId = idArray[3];
          var data = {
            id: companyId
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
                url: "/crm/deletecompany",
                data: data,
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function success(response) {
                  var result = JSON.parse(response);
                  console.log("here delete user success", response);

                  if (result['status'] == 'success') {
                    self.parent().parent().parent().addClass('selected');
                    companyTable.row('.selected').remove().draw(false);
                    Swal.fire('Deleted!', 'Your file has been deleted.', 'success');
                  } else {
                    One.helpers('notify', {
                      type: 'success',
                      icon: 'fa fa-check mr-1',
                      message: 'Delete Company Success'
                    });
                  }
                },
                error: function error() {
                  console.log("here update user error: ");
                  One.helpers('notify', {
                    type: 'danger',
                    icon: 'fa fa-times mr-1',
                    message: 'Delete Company Failed!'
                  });
                }
              });
            }
          });
          console.log('here delete company button clicked');
        });
      } else {
        One.helpers('notify', {
          type: 'danger',
          icon: 'fa fa-times mr-1',
          message: 'Create Company Failed!'
        });
      }
    },
    error: function error() {
      console.log("here user save error: ");
      One.helpers('notify', {
        type: 'danger',
        icon: 'fa fa-times mr-1',
        message: 'Create Company Failed!'
      });
    }
  });
}), // edit company button event handler
jQuery('.edit-company').click(function () {
  companyId = '';
  trowId = '';
  var idArray = $(this).attr('id').split('-');
  companyId = idArray[2];
  trowId = idArray[3];
  var data = {
    id: companyId
  };
  $.ajax({
    method: "GET",
    url: "/crm/getcompany",
    data: data,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function success(response) {
      var result = JSON.parse(response);

      if (result['status'] == 'success') {
        jQuery('#edit-company-modal').modal('show');
        var company = result['company'];
        jQuery('#edit-company-name').val(company['company_name']);
        jQuery('#edit-company-vat-number').val(company['vat_number']);
        jQuery('#edit-company-telephone').val(company['telephone']);
        jQuery('#edit-company-fax').val(company['fax']);
        jQuery('#edit-company-website').val(company['website']);
        jQuery('#edit-company-address').val(company['address']);
        jQuery('#edit-company-city').val(company['city']);
        jQuery('#edit-company-country').val(company['country']);
        jQuery('#edit-company-card').val(company['company_card']);
        jQuery('#edit-company-email').val(company['Email']);
        console.log("here get company success", result);
      } else {
        console.log("here get company error: ");
      }
    },
    error: function error() {
      console.log("here get company error: ");
    }
  });
}), jQuery('#edit-company-form').on('submit', function (e) {
  e.preventDefault();
  var formData = new FormData(this);
  formData.append('id', companyId);
  $.ajax({
    method: "POST",
    url: "/crm/updatecompany",
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function success(response) {
      var companyTable = jQuery('#company-table').DataTable();
      var result = JSON.parse(response);

      if (result['status'] == 'success') {
        var company = result['company'];
        console.log(company);
        jQuery('#edit-company-modal').modal('hide');
        $(companyTable.row(trowId).node()).children()[0].innerHTML = company['company_name'];
        $(companyTable.row(trowId).node()).children()[1].innerHTML = company['telephone'];
        console.log("here update user success", response);
        One.helpers('notify', {
          type: 'success',
          icon: 'fa fa-check mr-1',
          message: 'Successfully Edit Company'
        });
      } else {
        One.helpers('notify', {
          type: 'danger',
          icon: 'fa fa-times mr-1',
          message: 'Edit Company Failed!'
        });
      }
    },
    error: function error() {
      console.log("here user save error: ");
      One.helpers('notify', {
        type: 'danger',
        icon: 'fa fa-times mr-1',
        message: 'Edit Company Failed!'
      });
    }
  });
}), // delete company button event handler
jQuery('.delete-company').click(function () {
  var companyTable = jQuery('#company-table').DataTable();
  var idArray = $(this).attr('id').split('-');
  companyId = idArray[2];
  trowId = idArray[3];
  var data = {
    id: companyId
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
        url: "/crm/deletecompany",
        data: data,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function success(response) {
          var result = JSON.parse(response);
          console.log("here delete user success", response);

          if (result['status'] == 'success') {
            self.parent().parent().parent().addClass('selected');
            companyTable.row('.selected').remove().draw(false);
            Swal.fire('Deleted!', 'Your file has been deleted.', 'success');
          } else {
            One.helpers('notify', {
              type: 'success',
              icon: 'fa fa-check mr-1',
              message: 'Delete Company Success'
            });
          }
        },
        error: function error() {
          console.log("here update user error: ");
          One.helpers('notify', {
            type: 'danger',
            icon: 'fa fa-times mr-1',
            message: 'Delete Company Failed!'
          });
        }
      });
    }
  });
  console.log('here delete company button clicked');
}), jQuery('.create-company-group-select2').select2({
  ajax: {
    url: function url(params) {
      if (params.term) {
        return '/crm/getgroups/' + params.term;
      } else {
        return '/crm/getgroups/';
      }
    },
    dataType: 'json',
    processResults: function processResults(data) {
      groups = data.groups;
      var groupArray = groups.map(function (item, index) {
        var temp = {
          id: item.id,
          text: item.name
        };
        return temp;
      });
      return {
        results: groupArray
      };
    }
  }
}), jQuery('.edit-company-group-select2').select2({
  ajax: {
    url: function url(params) {
      if (params.term) {
        return '/crm/getgroups/' + params.term;
      } else {
        return '/crm/getgroups/';
      }
    },
    dataType: 'json',
    processResults: function processResults(data) {
      groups = data.groups;
      var groupArray = groups.map(function (item, index) {
        var temp = {
          id: item.id,
          text: item.name
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

/***/ 11:
/*!*************************************************!*\
  !*** multi ./resources/js/pages/crm/company.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp-new\htdocs\company-erp-laravel\resources\js\pages\crm\company.js */"./resources/js/pages/crm/company.js");


/***/ })

/******/ });