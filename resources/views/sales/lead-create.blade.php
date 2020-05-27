@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/ion-rangeslider/css/ion.rangeSlider.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/dropzone/dist/min/dropzone.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
@endsection

@section('css_after')
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('js/plugins/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('js/plugins/es6-promise/es6-promise.auto.min.js') }}"></script>
    <script src="{{ asset('js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('js/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('js/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
    <script src="{{ asset('js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ asset('js/plugins/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('js/plugins/flatpickr/flatpickr.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/users/dialogs.min.js') }}"></script>
    <script src="{{ asset('js/pages/sales/tables_datatables.js') }}"></script>
    <script src="{{ asset('js/pages/sales/sales.js') }}"></script>
    <!-- <script src=" js/pages/sales/calc.js "></script> -->
    


    <!-- Page JS Helpers (Flatpickr + BS Datepicker + BS Colorpicker + BS Maxlength + Select2 + Masked Inputs + Ion Range Slider plugins) -->
    <script>jQuery(function(){ One.helpers(['notify', 'flatpickr', 'datepicker', 'colorpicker', 'maxlength', 'select2', 'masked-inputs', 'rangeslider']); });</script>
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    New Lead
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Lead & Sales</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">New Lead</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <form name="lead-form" id="lead-form" action="{{ url('/sales/leads') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Lead details</h3>
                </div>
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6 border-right">
                                    <div class="form-group">
                                        <label for="subject">Subject</label>
                                        <input type="text" class="form-control" id="subject" name="subject" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="related">Related</label>
                                        <select class="form-control" id="related" name="related" required>
                                            <option value="Lead">Lead</option>
                                            <option value="Sales">Sales</option>
                                        </select>
                                    </div>

                                    <label for="client">Client</label>
                                    <div class="input-group">
                                        <select class="form-control client-select2" id="client" name="client" required>
                                            <option></option>
                                        </select>
{{--                                        <div class="input-group-append">--}}
{{--                                            <button type="button" class="btn btn-dark">Quick Add</button>--}}
{{--                                        </div>--}}
                                    </div>

                                    <div class="row pt-3">
                                        <div class="col-md-6">
                                            <div class="form-group" >
                                                <label for="date" class="control-label">Date</label>
                                                <div class="input-group date">
                                                    <input type="date" id="date" name="date"
                                                           class="form-control" value=""  autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" >
                                                <label for="open-till" class="control-label">Open Till</label>
                                                <div class="input-group date">
                                                    <input type="date" id="open-till" name="open-till"
                                                           class="form-control" value="" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select class="form-control" id="status" name="status" required>
                                                    <option value="Draft">Draft</option>
                                                    <option value="Sent">Sent</option>
                                                    <option value="Open">Open</option>
                                                    <option value="Revised">Revised</option>
                                                    <option value="Declined">Declined</option>
                                                    <option value="Accepted">Accepted</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="employee">Assigned</label>
                                                <select class="form-control employee-select2" id="employee" name="employee" required>
                                                    <option></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="address" class="control-label">Address</label>
                                        <input type="text" name="address" id="address" class="form-control" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label" for="country">Country</label>
                                                <input type="text" name="country" id="country" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label" for="city">City</label>
                                                <input type="text" name="city" id="city" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label" for="email">Email</label>
                                                <input type="text" name="email" id="email" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label" for="phone">Phone</label>
                                                <input type="text" name="phone" id="phone" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block">
                <div class="col-md-12">
                    <div class="pt-2 mb-2">
                        <strong class="text-black">
                            Select Product
                        </strong>
                    </div>
                    
       <!-- <div id="txtHint">Customer info will be listed here...</div> -->
       
                <div class="row">
                        <div class="form-group col-6">
                            <div class="row">
                                <div class="col-6 pr-1">
                                    <select class="form-control product-select2"  id="product" name="product" required>
                                        <option></option>
                                    </select>
                                </div>
                                <div class="col-6 pl-0">
                                    <button type="button" class="btn pull-right btn-success pro-item-button"  id="prod-add-btn">
                                        <i class="si si-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive s_table">
                    <table  class="table estimate-items-table items table-main-estimate-edit has-calculations no-mtop prod-select-table" id="prod-select-table">
                        <thead>
                            <tr>
                                <th style="width: 20%; text-align: left">
                                    <i class="fa fa-exclamation-circle" aria-hidden="true" data-toggle="tooltip" data-title="New lines are not supported for item description. Use the item long description instead."></i>
                                    Item
                                </th>
                                <th style="width: 30%; text-align: left">Description</th>
                                <th style="width: 10%; text-align: right" class="qty">Qty</th>
                                <th style="width: 10%; text-align: right">Rate</th>
                                <th style="width: 10%; text-align: right">VAT %5</th>
                                <th style="width: 15%; text-align: right">Amount</th>
                                <th style="width: 5%; text-align: center"><i class="fa fa-cog"></i></th>
                            </tr>
                            </thead>  
                        <tbody class="ui-sortable prod-select-tbody">
                        <tr class="main">
{{--                                <td>--}}
{{--                                    <textarea name="description" rows="2" class="form-control" placeholder="Description"></textarea>--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <textarea name="long-description" rows="2" class="form-control" placeholder="Long description"></textarea>--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <input type="number" name="quantity" min="0" value="1" class="form-control qty" placeholder="Quantity">--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <input type="number" name="rate" class="form-control unit" placeholder="Rate">--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <input type="number" name="vat" class="form-control vat" placeholder="%5">--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                      <input type="number" name="amount" class="form-control amount" placeholder="Total Amount">--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <button type="button" class="btn pull-right btn-danger">--}}
{{--                                        <i class="fa fa-times"></i>--}}
{{--                                    </button>--}}
{{--                                </td>--}}
                            </tr>
                            

                            
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12 col-md-offset-6">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                                <td colspan="4" class="font-w600">Subtotal</td>
                                <td class="text-right">
                                    BD  &nbsp;<b><span id="td-subtotal"> 0.000</span></b>
                                </td>
                            </tr>
                            <!-- <tr>
                                <td colspan="4" class="font-w600">Subtotal</td>
                                <td class="text-right">
                                    BD  &nbsp;<b><span id="td-subtotal-without"> 0.000</span></b>
                                </td>
                            </tr> -->
                            <tr>
                                <td colspan="4" class="font-w600">Total VAT</td>
                                <td class="text-right">
                                BD  &nbsp;<b><span id="td-totalVat"> 0.000</span></b>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" class="font-w600 align-middle">Discount</td>
                                <td class="text-right">
                                    <div class="row">
                                        <div class="col-1" style="margin-left: auto; padding-top: 5px;">
                                            <span class="align-middle"></span>
                                        </div>
                                        <div class="col-2">
                                            <input type="number" class="form-control align-middle" min="0.000" name="td-discount" id="td-discount" value="0.000" step="0.001">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" class="font-w600">Total</td>
                                <td class="text-right">
                                BD  &nbsp;<b><span id="td-total"> 0.000</span></b>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-group pb-4" style="text-align: right; padding-top: 36px;">
                        {{--                    <a href="{{ route('human.list') }}" class="mr-3">--}}
                        {{--                        <button type="button" class="btn btn-sm btn-light cancel-btn" style="padding: 5px 30px;">--}}
                        {{--                            Cancel--}}
                        {{--                        </button>--}}
                        {{--                    </a>--}}
                        <button type="submit" class="btn btn-sm btn-primary create-btn-lead" style="padding: 5px 30px;">
                            <i class="fa fa-check mr-1"></i>
                            Save Lead
                        </button>
                        <!-- <a href="{{ route('sales.list') }}" class="mr-3"> -->
                            <button type="submit" class="btn btn-sm btn-success create-btn-sale" style="padding: 5px 30px;">
                                Move to Sales
                                <i class="fa fa-arrow-right mr-1"></i>
                            </button>
                        <!-- </a> -->
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- <script>
if (document.readyState == 'loading') {
    document.addEventListener('DOMContentLoaded', ready)
} else {    
    ready()
}


function ready() {
    let productsInfoo;
               
var ccc;

var removeCartItemButtons = document.getElementsByClassName('btn-danger')
console.log("length", removeCartItemButtons);
    for (var i = 0; i < removeCartItemButtons.length; i++) {
        var button = removeCartItemButtons[i]
        button.addEventListener('click', removeCartItem);
    }


var quantityInputs = document.getElementsByClassName('pro-qty')
    for (var i = 0; i < quantityInputs.length; i++) {
        var input = quantityInputs[i]
        input.addEventListener('change', quantityChanged)
    }
    
var addToCartButtons = document.getElementsByClassName('pro-item-button');
// getElementById("s_table").querySelectorAll(".prod-select-tbody"); 
for (var i = 0; i < addToCartButtons.length; i++) {
   var button = addToCartButtons[i];
   button.addEventListener('click', addToCartClicked);
   console.log("length", addToCartButtons.length);
}




}

   // Ready Ends                
   
   function removeCartItem(event) {
    var buttonClicked = event.target;
    buttonClicked.parentElement.parentElement.remove();
    console.log("REMOVED");
    updateCartTotal();
}

function quantityChanged(event) {
    var input = event.target
    if (isNaN(input.value) || input.value <= 0) {
        input.value = 1
    }
    updateCartTotal()
}

function addToCartClicked(event) {
console.log("working again", ccc);
var button = event.target;


console.log("button",button )
console.log("productsInfoo",productsInfoo[0]['name'])
    // var shopItem = button.parentElement.parentElement.previousElementSibling.parentElement.parentElement.parentElement.previousElementSibling.parentElement.nextElementSibling.children[0].children[1].children[0];
    for (var i = 0; i < productsInfoo.length; i++) {
        if( productsInfoo[i]['name'] == ccc){

            var ItemName = productsInfoo[i]['name'];
            var ItemPrice = productsInfoo[i]['price'];
                }

        }

    // console.log("shop",shopItem )
    addItemToCart(ItemName, ItemPrice);
    updateCartTotal();
}



function addItemToCart(title, price) {
  

    var cartRow  = document.createElement('tr')
    // cartRow.style.cssText = ' margin-right: 800px; margin-top: 50px; float: left;';
    cartRow.className = "main";
    
    // var cartItems = document.getElementsByClassName('main')[0];
    var cartbody = document.getElementsByClassName('prod-select-tbody')[0];
    console.log("cartbody", cartbody)
    var cartItemNames = cartbody.getElementsByClassName('cart-item-title')
    console.log("cartItemNames", cartItemNames)
    for (var i = 0; i < cartItemNames.length; i++) {
        if (cartItemNames[i].innerText == title) {
            alert('This item is already added to the cart')
            return
        }
    }
    var cartRowContents = `<td>
                                <span class="cart-item-title">${title}</span>
                                </td>
                                <td>
                                    <textarea name="long-des" rows="2" class="form-control" placeholder="Long Description"></textarea>
                                </td>
                                <td>
                                    <input type="number" name="quantity" min="0" value="0" class="form-control pro-qty" placeholder="Quantity">
                                </td>
                                <td>
                                    <span class="cart-price cart-column">${price}</span>
                                   
                                </td>
                                <td>
                                    <input type="number" name="vat" class="form-control" placeholder="%5">
                                </td>
                                <td>
                                <span id="amount" class="amount"></span>  
                               
                                </td>
                                <td>
                                    <button type="button" class="btn pull-right btn-danger">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </td>`;
                            cartRow.innerHTML = cartRowContents
                            cartbody.append(cartRow)
                            cartRow.getElementsByClassName('btn-danger')[0].addEventListener('click', removeCartItem)
                            cartRow.getElementsByClassName('pro-qty')[0].addEventListener('change', quantityChanged)
                            

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // let cartRowContents = `<tr class="main">
    //                             <td>
    //                                 <input name="des" rows="2" disabled class="form-control" placeholder="Description">
    //                             </td>
    //                             <td>
    //                                 <textarea name="long-des" rows="2" class="form-control" placeholder="Long Description"></textarea>
    //                             </td>
    //                             <td>
    //                                 <input type="number" name="quantity" min="0" value="0" class="form-control" placeholder="Quantity">
    //                             </td>
    //                             <td>
    //                                 <input type="number" name="rate" class="form-control" placeholder="Rate">
    //                             </td>
    //                             <td>
    //                                 <input type="number" name="vat" class="form-control" placeholder="%5">
    //                             </td>
    //                             <td>
    //                                 <input type="number" name="amount" class="form-control" placeholder="Total Amount">
    //                             </td>
    //                             <td>
    //                                 <button type="button" class="btn pull-right btn-danger">
    //                                     <i class="fa fa-times"></i>
    //                                 </button>
    //                             </td>
    //                         </tr>`;
    //                         cartRow.innerHTML = cartRowContents

    console.log('title passed',title )

}




function updateCartTotal() {
    console.log("update run")

    var cartItemContainer = document.getElementsByClassName('prod-select-tbody')[0];
    var cartRows = cartItemContainer.getElementsByClassName('main')
    var total = 0
    var RowTotal = 0;
    var listdata = [];
    console.log('cartRows.length',cartRows.length)
    for (var i = 0; i < cartRows.length; i++) {
        console.log('i iteration',i)
        var cartRow = cartRows[i]
        var priceElement = cartRow.getElementsByClassName('cart-column')[0]
        var quantityElement = cartRow.getElementsByClassName('pro-qty')[0]
        console.log(priceElement, quantityElement)
        var price = parseFloat(priceElement.innerText)
        console.log(price)
        var quantity = quantityElement.value
        console.log(quantity)
        total = total + (price * quantity)
        console.log(total)
        RowTotal = price * quantity
        console.log('row totoal',RowTotal)
        listdata.push(RowTotal);

        console.log('listdata',listdata)
        document.getElementById("amount").innerText = listdata;
        console.log('After listdata',document.getElementById("amount").innerText )
        
    }
   
    total = Math.round(total * 100) / 100
    document.getElementById('td-subtotal').innerText =  total
   
}



function myNewFunction(sel){
ccc =sel.options[sel.selectedIndex].text;
console.log(ccc);
getAllProductsInfoo();

}


                      
function getAllProductsInfoo(str){
    var resp = [];
    var xhttp;  
if (str == "") {
// document.getElementById("txtHint").innerHTML = "";
return;
}
xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
if (this.readyState == 4 && this.status == 200) {
//  document.getElementById("txtHint").innerHTML = this.responseText;
 let results = JSON.parse(this.responseText);
 productsInfoo = results['products'];
       console.log('AJAX: ', results['products']);
       resp.push(productsInfoo)
       // my_magic_function(resp);
}
};
xhttp.open("GET", "/product/products/", true);
xhttp.send();
}


function my_magic_function(cool)
{
  //modal.find('.modal-title').text('New message to ' + var);
 console.log("OUTSIDE",cool);
 var b = document.getElementById("prod-select-table");
alert('got it:', b);
var row = b.insertRow();
var c1 = row.insertCell();
var c2 = row.insertCell();
var c3 = row.insertCell();
var c4 = row.insertCell();
var c5 = row.insertCell();
var c6 = row.insertCell();

var i;
for (i = 0; i < cool.length; i++) {
c1.innerHTML = cool[0][i]['id'];
c2.innerHTML = cool[0][i]['id'];
c3.innerHTML = cool[0][i]['id'];
c4.innerHTML = cool[0][i]['price'];
c5.innerHTML = cool[0][i]['id'];
c6.innerHTML = cool[0][i]['id'];
}




}



                    </script> -->

<script>
    // DATE
function getDate() {
  var today = new Date();
  var next = new Date();

  var dd = today.getDate();
  var mm = today.getMonth()+1; //January is 0!
  var yyyy = today.getFullYear();

  var ndd = today.getDate();
  var nmm = today.getMonth()+2; //January is 0!
  var nyyyy = today.getFullYear();
  

  if(dd<10) {
      dd = '0'+dd
  } 

  if(mm<10) {
      mm = '0'+mm
  } 

  if(ndd<10) {
      ndd = '0'+ndd
  } 

  if(nmm<10) {
      nmm = '0'+nmm
  } 


//   today = yyyy + '/' + mm + '/' + dd;
  today = yyyy + '-' + mm + '-' + dd ;
  next = nyyyy + '-' + nmm + '-' + ndd ;

  console.log(today);
  console.log(next);

  document.getElementById("date").value = today;
  document.getElementById("open-till").value = next;

}

window.onload = function() {
  getDate();
};
</script>
    <!-- END Page Content -->
@endsection
