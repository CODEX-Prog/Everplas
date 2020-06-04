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
/******/ 	return __webpack_require__(__webpack_require__.s = 10);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/pages/crm/contact.js":
/*!*******************************************!*\
  !*** ./resources/js/pages/crm/contact.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var contactId;
var trowId;
jQuery(document).ready(jQuery('#create-contact-form').on('submit', function (e) {
  e.preventDefault();
  var formData = new FormData(this);
  $.ajax({
    method: "POST",
    url: "/crm/createcontact",
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
        var contact = result['contact'];
        var contactTable = jQuery('#contact-table').DataTable();
        var newRow = contactTable.row.add([contact['contact_name'], 'Company' + '-' + contact['id'], 'VIP', contact['contact_mobile'], contact['contact_email'], "<div>\n" + "</div>"]).draw();
        var newRowNode = newRow.node();
        $($(newRowNode).children()[0]).addClass('font-w600');
        $($(newRowNode).children()[1]).addClass('font-w600');
        $($(newRowNode).children()[2]).addClass('font-w600');
        $($(newRowNode).children()[3]).addClass('font-w600');
        $($(newRowNode).children()[4]).addClass('font-w600');
        $($(newRowNode).children()[5]).addClass('text-center');
        var buttonWrapper = $($(newRowNode).children()[5]).children()[0];
        $(buttonWrapper).addClass('btn-group');
        buttonWrapper.innerHTML = "<button type=\"button\" class=\"btn btn-sm btn-primary edit-contact-btn\"\n" + "</button>\n" + "<button type=\"button\" class=\"btn btn-sm btn-primary delete-contact-btn\"\n" + "</button>";
        $($(buttonWrapper).children()[0]).attr('id', "edit-contact-".concat(contact['id'], "-").concat(newRow.index()));
        $($(buttonWrapper).children()[1]).attr('id', "delete-contact-".concat(contact['id'], "-").concat(newRow.index()));
        $(buttonWrapper).children()[0].innerHTML = "<i class=\"fa fa-fw fa-pencil-alt\"></i>";
        $(buttonWrapper).children()[1].innerHTML = "<i class=\"fa fa-fw fa-times\"></i>";
        $($(buttonWrapper).children()[0]).click(function () {
          var contactTable = jQuery('#contact-table').DataTable();
          contactId = '';
          trowId = '';
          var idArray = $(this).attr('id').split('-');
          contactId = idArray[2];
          trowId = idArray[3];
          var data = {
            id: contactId
          };
          $.ajax({
            method: "GET",
            url: "/crm/getcontact",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: data,
            success: function success(response) {
              var result = JSON.parse(response);

              if (result['status'] == 'success') {
                jQuery('#edit-contact-modal').modal('show');
                var contact = result['contact'];
                jQuery('#edit-contact-name').val(contact['contact_name']);
                jQuery('#edit-contact-email').val(contact['contact_email']);
                jQuery('#edit-contact-telephone').val(contact['contact_telephone']);
                jQuery('#edit-contact-mobile').val(contact['contact_mobile']);
                jQuery('#edit-contact-job').val(contact['contact_job']);
                jQuery('#edit-contact-country').val(contact['contact_country']);
                jQuery('#edit-contact-city').val(contact['contact_city']);
                jQuery('#edit-contact-address').val(contact['contact_address']);
                jQuery('#edit-contact-card').val(contact['contact_business_card']);
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
          var contactTable = jQuery('#contact-table').DataTable();
          contactId = '';
          trowId = '';
          var idArray = $(this).attr('id').split('-');
          contactId = idArray[2];
          trowId = idArray[3];
          var data = {
            id: contactId
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
                url: "/crm/deletecontact",
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
                success: function success(response) {
                  var result = JSON.parse(response);
                  console.log("here delete user success", response);

                  if (result['status'] == 'success') {
                    self.parent().parent().parent().addClass('selected');
                    contactTable.row('.selected').remove().draw(false);
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
          console.log('delete contact button is clicked');
        });
        jQuery('#create-contact-modal').modal('hide');
      } else {
        One.helpers('notify', {
          type: 'danger',
          icon: 'fa fa-times mr-1',
          message: 'Create Contact Failed!'
        });
      }

      location.reload(true);
    },
    error: function error() {
      console.log("here user save error: ");
      One.helpers('notify', {
        type: 'danger',
        icon: 'fa fa-times mr-1',
        message: 'Create Contact Failed!'
      });
    }
  });
}), jQuery('.edit-contact-btn').click(function () {
  contactId = '';
  trowId = '';
  var idArray = $(this).attr('id').split('-');
  contactId = idArray[2];
  trowId = idArray[3];
  var data = {
    id: contactId
  };
  $.ajax({
    method: "GET",
    url: "/crm/getcontact",
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data: data,
    success: function success(response) {
      var result = JSON.parse(response);

      if (result['status'] == 'success') {
        jQuery('#edit-contact-modal').modal('show');
        var contact = result['contact'];
        jQuery('#edit-contact-name').val(contact['contact_name']);
        jQuery('#edit-contact-email').val(contact['contact_email']);
        jQuery('#edit-contact-telephone').val(contact['contact_telephone']);
        jQuery('#edit-contact-mobile').val(contact['contact_mobile']);
        jQuery('#edit-contact-mobile2').val(contact['contact_mobile2']);
        jQuery('#edit-contact-job').val(contact['contact_job']);
        jQuery('#edit-contact-country').val(contact['contact_country']);
        jQuery('#edit-contact-city').val(contact['contact_city']);
        jQuery('#edit-contact-address').val(contact['contact_address']);
        console.log("here get company success", result);
      } else {
        console.log("here get company error: ");
      }
    },
    error: function error() {
      console.log("here get company error: ");
    }
  }); // console.log('here edit contact button clicked: ', trowId, contactTable.row(trowId).data());
}), jQuery('#edit-contact-form').on('submit', function (e) {
  e.preventDefault();
  var formData = new FormData(this);
  formData.append('id', contactId);
  $.ajax({
    method: "POST",
    url: "/crm/updatecontact",
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function success(response) {
      var result = JSON.parse(response);
      var contactTable = jQuery('#contact-table').DataTable();

      if (result['status'] == 'success') {
        var contact = result['contact'];
        $(contactTable.row(trowId).node()).children()[0].innerHTML = contact['contact_name']; // $($(contactTable.row(trowId).node()).children()[0]).children()[0].innerHTML = contactCompany;

        $($(contactTable.row(trowId).node()).children()[3]).innerHTML = contact['contact_mobile'];
        $($(contactTable.row(trowId).node()).children()[4]).innerHTML = contact['contact_email'];
        jQuery('#edit-contact-modal').modal('hide');
        console.log("here update user success", response);
        One.helpers('notify', {
          type: 'success',
          icon: 'fa fa-check mr-1',
          message: 'Edit Contact Success!'
        });
      } else {
        One.helpers('notify', {
          type: 'danger',
          icon: 'fa fa-times mr-1',
          message: 'Edit Contact Failed!'
        });
      }
    },
    error: function error() {
      console.log("here update user error: ");
      One.helpers('notify', {
        type: 'danger',
        icon: 'fa fa-times mr-1',
        message: 'Edit Contact Failed!'
      });
    }
  });
}), jQuery('.delete-contact-btn').click(function () {
  var contactTable = jQuery('#contact-table').DataTable();
  contactId = '';
  trowId = '';
  var idArray = $(this).attr('id').split('-');
  contactId = idArray[2];
  trowId = idArray[3];
  var data = {
    id: contactId
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
        url: "/crm/deletecontact",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: data,
        success: function success(response) {
          var result = JSON.parse(response);
          console.log("here delete user success", response);

          if (result['status'] == 'success') {
            self.parent().parent().parent().addClass('selected');
            contactTable.row('.selected').remove().draw(false);
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
}), jQuery('.create-contact-group-select2').select2({
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
}), jQuery('.edit-contact-group-select2').select2({
  // placeholder: {
  //     id: "1",
  //     placeholder: "Select an option"
  // },
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
}), jQuery('.create-contact-company-select2').select2({
  ajax: {
    url: function url(params) {
      if (params.term) {
        return '/crm/getcompanies/' + params.term;
      } else {
        return '/crm/getcompanies/';
      }
    },
    dataType: 'json',
    processResults: function processResults(data) {
      companies = data.companies;
      var companyArray = companies.map(function (item, index) {
        var temp = {
          id: item.id,
          text: item['company_name']
        };
        return temp;
      });
      return {
        results: companyArray
      };
    }
  }
}), jQuery('.edit-contact-company-select2').select2({
  ajax: {
    url: function url(params) {
      if (params.term) {
        return '/crm/getcompanies/' + params.term;
      } else {
        return '/crm/getcompanies/';
      }
    },
    dataType: 'json',
    processResults: function processResults(data) {
      companies = data.companies;
      var companyArray = companies.map(function (item, index) {
        var temp = {
          id: item.id,
          text: item['company_name']
        };
        return temp;
      });
      return {
        results: companyArray
      };
    }
  }
}));

/***/ }),

/***/ 10:
/*!*************************************************!*\
  !*** multi ./resources/js/pages/crm/contact.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp-new\htdocs\company-erp-laravel\resources\js\pages\crm\contact.js */"./resources/js/pages/crm/contact.js");


/***/ })

/******/ });