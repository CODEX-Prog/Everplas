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
/******/ 	return __webpack_require__(__webpack_require__.s = 28);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/pages/products/product.js":
/*!************************************************!*\
  !*** ./resources/js/pages/products/product.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

jQuery(document).ready(function () {
  /**
   * Material Select2 implementation
   * */
  jQuery('#material-select2').select2({
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
  /**
   * Category Select2 implementation
   * */

  jQuery('.category-select2').select2({
    ajax: {
      url: function url(params) {
        if (params.term) {
          return '/setting/products/' + params.term;
        } else {
          return '/setting/products/';
        }
      },
      dataType: 'json',
      processResults: function processResults(data) {
        var categories = data['categories'];
        var categoryArray = categories.map(function (item, index) {
          var temp = {
            id: item['id'],
            text: item['name']
          };
          return temp;
        });
        return {
          results: categoryArray
        };
      }
    }
  });
  /**
   * Delete Product event handler
   * */

  jQuery('.delete-product-btn').click(function () {
    var productTable = jQuery('#product-table').DataTable();
    var productId = '';
    var trowId = '';
    var idArray = $(this).attr('id').split('-');
    productId = idArray[2];
    trowId = idArray[3];
    var data = {
      id: productId
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
          url: "/products/product/delete",
          data: data,
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function success(response) {
            var result = JSON.parse(response);

            if (result['status'] == 'success') {
              self.parent().parent().parent().addClass('selected');
              productTable.row('.selected').remove().draw(false);
              Swal.fire('Deleted!', 'Your file has been deleted.', 'success');
            } else {
              One.helpers('notify', {
                type: 'success',
                icon: 'fa fa-check mr-1',
                message: 'Delete Product Success'
              });
            }
          },
          error: function error() {
            console.log("here update user error: ");
            One.helpers('notify', {
              type: 'danger',
              icon: 'fa fa-times mr-1',
              message: 'Delete Product Failed!'
            });
          }
        });
      }
    });
    console.log('here delete company button clicked');
  });
});

/***/ }),

/***/ 28:
/*!******************************************************!*\
  !*** multi ./resources/js/pages/products/product.js ***!
  \******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp-new\htdocs\company-erp-laravel\resources\js\pages\products\product.js */"./resources/js/pages/products/product.js");


/***/ })

/******/ });