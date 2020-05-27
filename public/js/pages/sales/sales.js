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
/******/ 	return __webpack_require__(__webpack_require__.s = 25);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/pages/sales/sales.js":
/*!*******************************************!*\
  !*** ./resources/js/pages/sales/sales.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(source, true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(source).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance"); }

function _iterableToArray(iter) { if (Symbol.iterator in Object(iter) || Object.prototype.toString.call(iter) === "[object Arguments]") return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = new Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } }

var productsInfo;
var prodList = [];
var _final = {
  subTotal: 0,
  totalVat: 0,
  discount: 0,
  total: 0
};
var arrData = [];
var IdentifyButton;
console.log("FIRST:", _final);
jQuery(document).ready(function () {
  /**
   * Get Product Information
   * */
  $.when(getAllProductsInfo()).done(function (response) {
    console.log(response);
    var cool = JSON.parse(response);
    productsInfo = cool['products'];
    console.log("productsInfo", productsInfo); // console.log(result);

    /**
     * Select Product button event handler
     * */

    $('#prod-add-btn').on('click', function () {
      var prodId = $('#product').val();
      var prodName = $('#product option:selected').text();
      console.log("PRODUCT ID ::", prodId);

      if (prodId) {
        if (!checkProdItemExist(prodId)) {
          console.log("not exists add");
          $.each(productsInfo, function (key, value) {
            if (prodId == productsInfo[key]['id']) {
              // Default price
              var defpr = function defpr() {
                var defTotal = 0;
                $(".amount").each(function () {
                  defTotal += parseFloat($(this).val() || 0);
                });
                _final.subTotal = defTotal.toFixed(3);
                _final.total = defTotal.toFixed(3);
                $('#td-subtotal').html(_final.subTotal);
                $('#td-total').html(_final.total); // fnAlltotalWithout();

                VatEachRow();
              };

              // Calculate total vat
              var VatCal = function VatCal() {
                var VatCalc = 0;
                $(".unit").each(function () {
                  console.log("testing123", VatCalc);
                  var qtyWithoutForVat = $(this).parent().prev().children().val();
                  VatCalc += parseFloat($(this).val() || 0) * qtyWithoutForVat;
                });
                VatCalcAfter = VatCalc * 0.05;
                _final.totalVat = VatCalcAfter.toFixed(3);
                console.log("Total final vat", _final.totalVat);
                $('#td-totalVat').html(_final.totalVat); // $('.vat').val((VatCalc*0.05).toFixed(3)); 
              }; // Calculate Discount
              // function DisCalc(){
              //     var DisCalc = 0;
              // }
              // Will calculate quantity and price on input
              // Event trigger for quantity


              // Event trigger for vat future work
              // $(".vat").on('input', function () {
              //     var CurrentVatRow = 0
              //     var tot = 0
              //     var self = $(this);
              //     var priceV = self.parent().prev().children().val();
              //     var qty = self.parent().prev().prev().children().val();
              //     var vat = self.val()/100
              //     var tot = qty * priceV +vat;
              //     console.log("price after vat",tot)
              //      CurrentVatRow = priceV * vat;
              //     console.log("price vat",priceV)
              //     console.log(" vat",self.val()/100)
              //     console.log("CurrentVatRow vat",CurrentVatRow)
              //     self.parent().next().children().val(tot);
              //     //  vat = self.parent().children().val();
              // //    $('#td-totalVat').html(vat); 
              // fnTotVat();
              // });
              // Calculate Total Vat
              // function fnTotVat(){
              //     var TotalVat = 0
              //     $(".vat").each(function(){
              //         TotalVat += parseFloat($(this).val()||0);
              //     });
              //     $('#td-totalVat').html(TotalVat); 
              // }
              // Calculate Sub total with VAT
              var fnAlltotal = function fnAlltotal() {
                console.log("TOTAL hit");
                var subTotal = 0;
                $(".amount").each(function () {
                  subTotal += parseFloat($(this).val() || 0);
                });
                _final.subTotal = subTotal;
                _final.total = subTotal;
                $('#td-subtotal').html(_final.subTotal.toFixed(3));
                $('#td-total').html(_final.total.toFixed(3));
              }; // Calculate Sub total without VAT
              // function fnAlltotalWithout(){
              //     console.log("TOTAL hit without")
              //     var subTotalWithout=0;
              //     $(".unit").each(function(){
              //         var qtyWithout = $(this).parent().prev().children().val();
              //         subTotalWithout += parseFloat($(this).val()||0)* qtyWithout;
              //         console.log("subTotalWithout", subTotalWithout)
              //     });
              //     // GrandTotal =subTotal + totalVat - discount;
              //     $('#td-subtotal-without').html((subTotalWithout).toFixed(3)); 
              // }
              // Vat for Each Row


              var VatEachRow = function VatEachRow() {
                $(".unit").each(function () {
                  var self = $(this);
                  var qtyvat = self.parent().prev().children().val();
                  self.parent().next().children().val((self.val() * qtyvat * 0.05).toFixed(3));
                  console.log("recent", parseFloat(self.parent().next().children().val((self.val() * qtyvat * 0.05).toFixed(3))));
                });
              }; // Calculate Grand total


              console.log("".concat(key, ": ").concat(value));
              console.log(productsInfo[key]['id']);
              var price = parseFloat(productsInfo[key]['price']);
              var OriginalPrice = price;
              console.log("OriginalPrice", OriginalPrice);
              price = price + price * 0.05;
              console.log("befor adding", price);
              var trow = "<tr class=\"main\">\n                                        <td>\n                                            <input name=\"des\" rows=\"2\" type=\"text\" disabled class=\"form-control\" placeholder=\"Description\">\n                                        </td>\n                                        <td>\n                                            <textarea name=\"long-des\" rows=\"2\" class=\"form-control long-desc\" placeholder=\"Long Description\"></textarea>\n                                        </td>\n                                        <td>\n                                        <input type=\"number\" name=\"quantity\" min=\"0\" value=\"1\" class=\"form-control qty\" >\n                                          </td>\n                                     <td>\n                                       <input type=\"number\" name=\"rate\" min=\"0\"  class=\"form-control unit\" value=\"".concat(OriginalPrice, "\" >\n                                         </td>\n                                      <td>\n                                       <input type=\"number\" name=\"vat\" disabled class=\"form-control vat\" placeholder=\"%5\">\n                                         </td>\n                                         <td>\n                                         <input type=\"number\" name=\"amount\" disabled class=\"form-control amount\" value=\"").concat(price.toFixed(3), "\" >\n                                        </td>\n                                        <td>\n                                            <button type=\"button\" class=\"btn pull-right btn-danger\">\n                                                <i class=\"fa fa-times\"></i>\n                                            </button>\n                                        </td>\n                                    </tr>");
              $('#prod-select-table tbody').append(trow);
              $('#prod-select-table tbody tr:last td:first input').val(prodName); // $("#prod-select-table tbody tr:last textarea").attr("id", `description-${prodId}`);
              // $("#prod-select-table tbody tr:last input[name='quantity']").attr("id", `quantity-${prodId}`);
              // $("#prod-select-table tbody tr:last input[name='rate']").attr("id", `rate-${prodId}`);
              // $("#prod-select-table tbody tr:last input[name='vat']").attr("id", `vat-${prodId}`);
              // $("#prod-select-table tbody tr:last input[name='amount']").attr("id", `amount-${prodId}`);

              $("#prod-select-table tbody tr:last button").attr("id", "remove-".concat(prodId));
              defpr();
              VatCal();
              $(".qty").on('input', function () {
                console.log("qty");
                var self = $(this);
                var unitVal = self.parent().next().children().val();
                var VatEach = self.val() * unitVal * 0.05;
                self.parent().next().next().next().children().val((unitVal * self.val() * 0.05 + unitVal * self.val()).toFixed(3));
                self.parent().next().next().children().val(VatEach.toFixed(3));
                fnAlltotal(); //    fnAlltotalWithout();

                VatCal();
              }); // Event trigger for rate

              $(".unit").on('input', function () {
                console.log("unit");
                var self = $(this);
                var qtyVal = self.parent().prev().children().val();
                var VatEach = self.val() * qtyVal * 0.05;
                self.parent().next().next().children().val((qtyVal * self.val() * 0.05 + qtyVal * self.val()).toFixed(3));
                self.parent().next().children().val(VatEach.toFixed(3));
                fnAlltotal(); //   fnAlltotalWithout();

                VatCal();
              }); // Event trigger for discount

              $("#td-discount").on('input', function () {
                console.log("discount");
                var self = $(this); // var TotVat = parseFloat(self.parent().parentsUntil("tbody").prev().find("td").eq(1).children().find("span").html());
                // console.log("parent vat",parseFloat(self.parent().parentsUntil("tbody").prev().find("td").eq(1).children().find("span").html()));
                // var SuBtot = parseFloat(self.parent().parentsUntil("tbody").prev().prev().children().eq(1).children().find("span").html());

                var SuBtot = self.parent().parentsUntil("tbody").prev().prev().children().eq(1).children().find("span").html();
                console.log("parent sub", self.parent().parentsUntil("tbody").prev().prev().children().eq(1).children().find("span").html()); // Grand Total

                var GrandTotal = SuBtot - self.val();
                _final.discount = self.val();
                _final.total = GrandTotal.toFixed(3);
                console.log("GrandTotal", GrandTotal);
                $('#td-total').html(_final.total);
              });
              $('#prod-select-table tbody tr:last button').click(function () {
                $(this).parent().parent().remove(); // $('#td-subtotal').html(0.000);
                // $('#td-totalVat').html(0.000);  
                /////////////////////////////////////////////////////////////////////////////////
                //     removeQty = $(this).parent().prevAll().eq(3).children().val()
                //     console.log("Removing qty",$(this).parent().prevAll().eq(3).children().val())
                //     var removeUnitVal = $(this).parent().prevAll().eq(2).children().val()
                //     console.log("Removing unit",$(this).parent().prevAll().eq(2).children().val())
                //     var VatEach = removeQty * removeUnitVal * 0
                //     // self.parent().next().next().next().children().val(((unitVal * self.val()) *0.05 +(unitVal * self.val())).toFixed(3) );
                //    console.log("RemoveVat", VatEach)
                //      $(this).parent().prevAll().eq(1).children().val(0) 
                //     self.parent().next().next().children().val(VatEach.toFixed(3));

                RemovefnAlltotal();

                function RemovefnAlltotal() {
                  console.log("TOTAL hit remove");
                  var removesubTotal = 0;
                  $(".amount").each(function () {
                    removesubTotal += parseFloat($(this).val() || 0);
                  });
                  _final.subTotal = removesubTotal;
                  _final.total = removesubTotal;
                  console.log("removesubTotal", _final.subTotal);
                  $('#td-subtotal').html(_final.subTotal.toFixed(3));
                  $('#td-total').html(_final.subTotal.toFixed(3));
                }

                RemoveVatCal(); // Calculate total vat

                function RemoveVatCal() {
                  var VatCalc = 0;
                  $(".unit").each(function () {
                    console.log("testing123", VatCalc);
                    var qtyWithoutForVat = $(this).parent().prev().children().val();
                    VatCalc += parseFloat($(this).val() || 0) * qtyWithoutForVat;
                  });
                  VatCalcAfter = VatCalc * 0.05;
                  _final.totalVat = VatCalcAfter.toFixed(3);
                  console.log("Total final vat", _final.totalVat);
                  $('#td-totalVat').html(_final.totalVat); // $('.vat').val((VatCalc*0.05).toFixed(3)); 
                } //    VatCal();
                //    function VatCal(){
                //     var VatCalc = 0;
                //     $(".unit").each(function(){
                //         console.log("testing123", VatCalc)
                //         var qtyWithoutForVat = $(this).parent().prev().children().val();
                //         VatCalc += parseFloat($(this).val()||0) * qtyWithoutForVat;
                //     });
                //     console.log("Total vat",VatCalc*0 );
                //     $('#td-totalVat').html((VatCalc*0).toFixed(3)); 
                //     // $('.vat').val((VatCalc*0.05).toFixed(3)); 
                // }
                /////////////////////////////////////////////////////////////////////////////////


                var id = $(this).attr('id').split('-')[1];
                removeItemFromList(id); // calculateFinal();
              });
            } else {// console.log(productsInfo[0]['name']);
              // console.log(prodId);
            }
          }); // Add Product item to productList

          var prodItem = {
            id: prodId,
            name: prodName
          };
          prodList.push(prodItem);
          console.log("PROLIST:", prodList); // Append new Product item row
          // $('#prod-select-table tbody').append(trow);
          // $('#prod-select-table tbody tr:last td:first input').val(prodName);
          // $("#prod-select-table tbody tr:last textarea").attr("id", `description-${prodId}`);
          // $("#prod-select-table tbody tr:last input[name='quantity']").attr("id", `quantity-${prodId}`);
          // $("#prod-select-table tbody tr:last input[name='rate']").attr("id", `rate-${prodId}`);
          // $("#prod-select-table tbody tr:last input[name='vat']").attr("id", `vat-${prodId}`);
          // $("#prod-select-table tbody tr:last input[name='amount']").attr("id", `amount-${prodId}`);
          // $("#prod-select-table tbody tr:last button").attr("id", `remove-${prodId}`);
          // $("#material-table tbody tr td textarea").change(function () {
          //    let id = ($(this).attr('id').split('-'))[1];
          //     updateItem(id, 'description', $(this).val());
          // });
          // $("#prod-select-table tbody tr:last input[name='quantity']").change(function () {
          //     let id = ($(this).attr('id').split('-'))[1];
          //     updateItem(id, 'quantity', $(this).val());
          //     calculateFinal();
          // });
          // $("#prod-select-table tbody tr:last input[name='rate']").change(function () {
          //     let id = ($(this).attr('id').split('-'))[1];
          //     updateItem(id, 'rate', $(this).val());
          // });
          // $("#prod-select-table tbody tr:last input[name='vat']").change(function () {
          //     let id = ($(this).attr('id').split('-'))[1];
          //     updateItem(id, 'vat', $(this).val());
          //     calculateFinal();
          // });
          // $("#prod-select-table tbody tr:last input[name='amount']").change(function () {
          //     let id = ($(this).attr('id').split('-'))[1];
          //     updateItem(id, 'amount', $(this).val());
          // });
        } else {
          One.helpers('notify', {
            type: 'danger',
            icon: 'fa fa-times mr-1',
            message: 'Product already selected!'
          });
        }
      } else {
        One.helpers('notify', {
          type: 'danger',
          icon: 'fa fa-times mr-1',
          message: 'Please Select Product!'
        });
      }

      console.log('here product add btn click event: ', prodId, prodName);
    });
  }); /////   Looping each row in table

  $(".create-btn-lead").one('click', function () {
    $("#prod-select-table tbody tr:not(:first)").each(function (key, value) {
      var currentRow = $(this);
      var col1_value = currentRow.find("td:eq(0)").find('input[type=text]').val();
      var col2_value = currentRow.find("td:eq(1)").find('.long-desc').val();
      var col3_value = currentRow.find("td:eq(2)").find('input[type=number]').val();
      var col4_value = currentRow.find("td:eq(3)").find('input[type=number]').val();
      var col5_value = currentRow.find("td:eq(4)").find('input[type=number]').val();
      var col6_value = currentRow.find("td:eq(5)").find('input[type=number]').val();
      var data = col1_value + "\n" + col2_value + "\n" + col3_value + "\n" + col4_value + "\n" + col5_value + "\n" + col6_value;
      alert(data);
      console.log("PROLIST:", prodList[key]['id']);
      var obj = {};
      obj.id = prodList[key]['id'];
      obj.name = col1_value;
      obj.des = col2_value;
      obj.qty = col3_value;
      obj.rate = col4_value;
      obj.vat = col5_value;
      obj.amount = col6_value;
      IdentifyButton = 'SaveLead';
      alert('Lead Button pressed:' + IdentifyButton);
      arrData.push(obj);
      alert(obj.id);
    }); // alert(arrData[1]);
    // console.log(arrData[1]);
  }); // /////   Looping each row in table 

  $(".create-btn-sale").one('click', function () {
    $("#prod-select-table tbody tr:not(:first)").each(function (key, value) {
      var currentRowSale = $(this);
      var s1_value = currentRowSale.find("td:eq(0)").find('input[type=text]').val();
      var s2_value = currentRowSale.find("td:eq(1)").find('.long-desc').val();
      var s3_value = currentRowSale.find("td:eq(2)").find('input[type=number]').val();
      var s4_value = currentRowSale.find("td:eq(3)").find('input[type=number]').val();
      var s5_value = currentRowSale.find("td:eq(4)").find('input[type=number]').val();
      var s6_value = currentRowSale.find("td:eq(5)").find('input[type=number]').val();
      var Saledata = s1_value + "\n" + s2_value + "\n" + s3_value + "\n" + s4_value + "\n" + s5_value + "\n" + s6_value;
      alert(Saledata);
      console.log("PROLIST:", prodList[key]['id']);
      var SaleObj = {};
      SaleObj.id = prodList[key]['id'];
      SaleObj.name = s1_value;
      SaleObj.des = s2_value;
      SaleObj.qty = s3_value;
      SaleObj.rate = s4_value;
      SaleObj.vat = s5_value;
      SaleObj.amount = s6_value;
      IdentifyButton = 'MoveToSales';
      alert('Sale Button pressed:' + IdentifyButton);
      arrData.push(SaleObj);
      alert(SaleObj.id);
    });
  });
  /**
   * Sales-Lead Client Select2 implementation
   * */

  $('.client-select2').select2({
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
            text: item['company_name'],
            address: item['address'],
            country: item['country'],
            city: item['city'],
            telephone: item['telephone'],
            Email: item['Email']
          };
        }); ////////////  TESTING
        // for(var x in companyArray){
        //     console.log(companyArray[x]['id']);//access value
        //     console.log(companyArray[x]['text']);//access the text
        //     console.log(companyArray[x]['address']);//access the text
        //     // console.log(companyArray[x]['country']);//access the text
        //     // // $('#country').val(companyArray[x]['country']).css("background-color", "rgb(240, 248, 255)");
        //     // console.log(companyArray[x]['city']);//access the text
        //     // $('#city').val(companyArray[x]['city']).css("background-color", "rgb(240, 248, 255)");
        //     // console.log(companyArray[x]['telephone']);//access the text
        //     // $('#phone').val(companyArray[x]['telephone']).css("background-color", "rgb(240, 248, 255)");
        //   }

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
  }); // EVENT TO SET VALUES ON SELECT

  $('.client-select2').on('select2:select', function (e) {
    var data = e.params.data;
    console.log("SELECTED", data);
    console.log(data.id); //access value

    console.log(data.text); //access the text

    console.log(data.address); //access the text

    console.log(data.country); //access the text

    console.log(data.Email); //access the text

    $('#address').val(data.address).css("background-color", "rgb(240, 248, 255)");
    $('#country').val(data.country).css("background-color", "rgb(240, 248, 255)");
    $('#city').val(data.city).css("background-color", "rgb(240, 248, 255)");
    $('#email').val(data.Email).css("background-color", "rgb(240, 248, 255)");
    $('#phone').val(data.telephone).css("background-color", "rgb(240, 248, 255)"); // $('#city').val(data[x]['city']).css("background-color", "rgb(240, 248, 255)");
    // console.log(data[x]['telephone']);//access the text
    // $('#phone').val(data[x]['telephone']).css("background-color", "rgb(240, 248, 255)");
  });
  /**
   * Sales-Lead Employee Select2 implementation
   * */

  $('.employee-select2').select2({
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
            text: item['full_name']
          };
        });
        return {
          results: employeeArr
        };
      }
    }
  });
  /**
   * Sales-Lead Product Select2 implementation
   * */

  $('.product-select2').select2({
    ajax: {
      url: function url(params) {
        if (params.term) {
          return '/product/products/' + params.term;
        } else {
          return '/product/products';
        }
      },
      dataType: 'json',
      processResults: function processResults(data) {
        var products = data['products'];
        var prodArr = products.map(function (item) {
          return {
            id: item['id'],
            text: item['name']
          };
        });
        return {
          results: prodArr
        };
      }
    }
  });
  /**
   * Discount input change event handler
   * */
  // $('#td-discount').on('change', function () {
  //     let discount = parseFloat($(this).val());
  //     final.discount = discount;
  //     calculateFinal();
  // });

  /**
   * Lead create form submit event handler arrData
   * */

  $('#lead-form').submit(function (e) {
    var subTotalInput = $("<input>").attr("type", "hidden").attr("name", "sub-total").val(_final.subTotal);
    var totalVatInput = $("<input>").attr("type", "hidden").attr("name", "total-vat").val(_final.totalVat);
    var discountInput = $("<input>").attr("type", "hidden").attr("name", "discount").val(_final.discount);
    var totalInput = $("<input>").attr("type", "hidden").attr("name", "total").val(_final.total);
    var IButton = $("<input>").attr("type", "hidden").attr("name", "IdentifyButton").val(IdentifyButton);
    var prodListInput = $("<input>").attr("type", "hidden").attr("name", "prod-list").val(JSON.stringify(arrData));
    $(this).append(subTotalInput);
    $(this).append(totalVatInput);
    $(this).append(discountInput);
    $(this).append(totalInput);
    $(this).append(IButton);
    $(this).append(prodListInput);
    return true;
  }); // leads delete btn

  $('.lead-delete-btn').click(function () {
    var leadTable = $('#lead-table').DataTable();
    var idArr = $(this).attr('id').split('-');
    var leadId = idArr[3];
    var trow = idArr[4];
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
          url: "/leads/delete",
          data: {
            id: leadId
          },
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function success(response) {
            var result = JSON.parse(response);

            if (result['status'] === 'success') {
              self.parent().parent().parent().addClass('selected');
              leadTable.row('.selected').remove().draw(false);
              Swal.fire('Deleted!', 'Your file has been deleted.', 'success');
            } else {
              One.helpers('notify', {
                type: 'danger',
                icon: 'fa fa-times mr-1',
                message: 'Delete Lead Failed!'
              });
            }
          },
          error: function error() {
            One.helpers('notify', {
              type: 'danger',
              icon: 'fa fa-times mr-1',
              message: 'Delete Lead Failed!'
            });
          }
        });
      }
    });
  }); // Sales delete btn

  $('.sale-delete-btn').click(function () {
    var leadTable = $('#sales-table').DataTable();
    var idArr = $(this).attr('id').split('-');
    var leadId = idArr[3];
    var trow = idArr[4];
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
          url: "/sales/delete",
          data: {
            id: leadId
          },
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function success(response) {
            var result = JSON.parse(response);

            if (result['status'] === 'success') {
              self.parent().parent().parent().addClass('selected');
              leadTable.row('.selected').remove().draw(false);
              Swal.fire('Deleted!', 'Your file has been deleted.', 'success');
            } else {
              One.helpers('notify', {
                type: 'danger',
                icon: 'fa fa-times mr-1',
                message: 'Delete Lead Failed!'
              });
            }
          },
          error: function error() {
            One.helpers('notify', {
              type: 'danger',
              icon: 'fa fa-times mr-1',
              message: 'Delete Lead Failed!'
            });
          }
        });
      }
    });
  }); // Approving from leads to sales

  jQuery('.approve-leads-btn').click(function () {
    var jobTable = jQuery('#lead-table').DataTable();
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
          url: "/leads/approve",
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
  }); // Approving sales to archives

  jQuery('.approve-jo-btn').click(function () {
    var jobTable = jQuery('#sales-table').DataTable();
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
          url: "/sales/approve",
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
});

function calculateFinal() {
  console.log("Inside calc", productsInfo);
  resetFinal();
  prodList.map(function (prod) {
    var target = productsInfo.find(function (el) {
      return el.id === parseInt(prod.id);
    });
    _final.subTotal += target['price'] * prod['quantity'];
    _final.totalVat += target['price'] * prod['vat'] / 100;
  });
  _final.total = _final.subTotal + _final.totalVat - _final.discount; // refreshTotalDom();
}

function refreshTotalDom() {
  // set final values to elements
  $('#td-subtotal').html(_final.subTotal.toFixed(3));
  $('#td-totalVat').html(_final.totalVat.toFixed(3));
  $('#td-total').html(_final.total.toFixed(3));
}

function resetFinal() {
  _final = _objectSpread({}, _final, {
    subTotal: 0,
    totalVat: 0,
    total: 0
  });
}

function getAllProductsInfo() {
  return $.ajax({
    method: "GET",
    url: "/product/products",
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function success(response) {
      var result = JSON.parse(response);
      productsInfo = result['products'];
      console.log('here get all products info response: ', productsInfo);
    },
    error: function error() {
      console.log('here get products info error');
    }
  });
}

function checkProdItemExist(id) {
  var result = prodList.find(function (prod) {
    return prod.id === id;
  });
  return result ? true : false;
}

function updateItem(id, key, value) {
  prodList = prodList.map(function (prod) {
    if (prod.id === id) {
      var temp = _objectSpread({}, prod);

      temp[key] = value;
      return temp;
    } else {
      return prod;
    }
  });
  console.log("updated", prodList);
}

function removeItemFromList(id) {
  prodList = prodList.filter(function (prod) {
    return prod.id !== id;
  });
}

/***/ }),

/***/ 25:
/*!*************************************************!*\
  !*** multi ./resources/js/pages/sales/sales.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp-new\htdocs\company-erp-laravel\resources\js\pages\sales\sales.js */"./resources/js/pages/sales/sales.js");


/***/ })

/******/ });