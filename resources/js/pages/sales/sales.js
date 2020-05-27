let productsInfo;
let prodList = [];
let final = {
    subTotal: 0,
    totalVat: 0,
    discount: 0,
    total: 0
};

var arrData=[];

var IdentifyButton;

console.log("FIRST:", final);



jQuery(document).ready(function() {
    /**
     * Get Product Information
     * */
   


    $.when(getAllProductsInfo()).done(function(response){
        console.log(response);
        let cool = JSON.parse(response);
        productsInfo = cool['products'];
        console.log("productsInfo",productsInfo);
  
    
// console.log(result);
    /**
     * Select Product button event handler
     * */
    $('#prod-add-btn').on('click', function () {
        let prodId = $('#product').val();
        let prodName = $('#product option:selected').text();
       

        console.log("PRODUCT ID ::",prodId);
        


        if (prodId) {
            if (!checkProdItemExist(prodId)) {
                console.log("not exists add")
                $.each(productsInfo , function(key, value){
                    if (prodId == productsInfo[key]['id'] ){
                        console.log(`${key}: ${value}`);

                        console.log(productsInfo[key]['id'] );

                        let price = parseFloat(productsInfo[key]['price']);

                        let OriginalPrice = price;
                        console.log("OriginalPrice", OriginalPrice);
                        price = price + (price * 0.05);
        
                        console.log("befor adding",price);
        
                        let trow = `<tr class="main">
                                        <td>
                                            <input name="des" rows="2" type="text" disabled class="form-control" placeholder="Description">
                                        </td>
                                        <td>
                                            <textarea name="long-des" rows="2" class="form-control long-desc" placeholder="Long Description"></textarea>
                                        </td>
                                        <td>
                                        <input type="number" name="quantity" min="0" value="1" class="form-control qty" >
                                          </td>
                                     <td>
                                       <input type="number" name="rate" min="0"  class="form-control unit" value="${OriginalPrice}" >
                                         </td>
                                      <td>
                                       <input type="number" name="vat" disabled class="form-control vat" placeholder="%5">
                                         </td>
                                         <td>
                                         <input type="number" name="amount" disabled class="form-control amount" value="${price.toFixed(3)}" >
                                        </td>
                                        <td>
                                            <button type="button" class="btn pull-right btn-danger">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>`;
                                    $('#prod-select-table tbody').append(trow);
                                    $('#prod-select-table tbody tr:last td:first input').val(prodName);
                                    // $("#prod-select-table tbody tr:last textarea").attr("id", `description-${prodId}`);
                                    // $("#prod-select-table tbody tr:last input[name='quantity']").attr("id", `quantity-${prodId}`);
                                    // $("#prod-select-table tbody tr:last input[name='rate']").attr("id", `rate-${prodId}`);
                                    // $("#prod-select-table tbody tr:last input[name='vat']").attr("id", `vat-${prodId}`);
                                    // $("#prod-select-table tbody tr:last input[name='amount']").attr("id", `amount-${prodId}`);
                                    $("#prod-select-table tbody tr:last button").attr("id", `remove-${prodId}`);
        
                                   
                                    defpr();
                                    // Default price
                                    function defpr(){
                                        var defTotal = 0
                                        $(".amount").each(function(){

                                            defTotal += parseFloat($(this).val()||0);

                                        });
                                        final.subTotal = defTotal.toFixed(3)
                                        final.total = defTotal.toFixed(3)
                                        $('#td-subtotal').html(final.subTotal); 
                                        $('#td-total').html(final.total);
                                        // fnAlltotalWithout();
                                        VatEachRow();
                                    }
                                    
                                    VatCal();
                                    // Calculate total vat
                                    function VatCal(){
                                        var VatCalc = 0;
                                        $(".unit").each(function(){
                                            console.log("testing123", VatCalc)
                                            var qtyWithoutForVat = $(this).parent().prev().children().val();
                                            VatCalc += parseFloat($(this).val()||0) * qtyWithoutForVat;
                                           
                                        });
                                        VatCalcAfter = VatCalc*0.05
                                        final.totalVat = (VatCalcAfter).toFixed(3)
                                        console.log("Total final vat",final.totalVat );
                                        $('#td-totalVat').html((final.totalVat)); 
                                        // $('.vat').val((VatCalc*0.05).toFixed(3)); 
                                    }

                                    // Calculate Discount
                                    // function DisCalc(){
                                    //     var DisCalc = 0;

                                    // }
                                   
                                    // Will calculate quantity and price on input
                                     // Event trigger for quantity
                                    $(".qty").on('input', function () {
                                        console.log("qty");
                                        var self = $(this);
                                        var unitVal = self.parent().next().children().val()
                                        var VatEach = self.val() * unitVal * 0.05
                                        self.parent().next().next().next().children().val(((unitVal * self.val()) *0.05 +(unitVal * self.val())).toFixed(3) );
                                        self.parent().next().next().children().val(VatEach.toFixed(3));
                                       fnAlltotal();
                                    //    fnAlltotalWithout();
                                       VatCal();
                                    });
                                    

                                    // Event trigger for rate
                                    $(".unit").on('input', function () {
                                        console.log("unit");
                                        var self = $(this);
                                        var qtyVal = self.parent().prev().children().val();
                                        var VatEach = self.val() * qtyVal * 0.05
                                        self.parent().next().next().children().val(((qtyVal * self.val()) *0.05 + (qtyVal * self.val())).toFixed(3) );
                                        self.parent().next().children().val(VatEach.toFixed(3));
                                      fnAlltotal();
                                    //   fnAlltotalWithout();
                                      VatCal();
                                    });


                                    // Event trigger for discount
                                    $("#td-discount").on('input', function () {
                                        console.log("discount");
                                        var self = $(this);
                                        // var TotVat = parseFloat(self.parent().parentsUntil("tbody").prev().find("td").eq(1).children().find("span").html());
                                        // console.log("parent vat",parseFloat(self.parent().parentsUntil("tbody").prev().find("td").eq(1).children().find("span").html()));

                                        // var SuBtot = parseFloat(self.parent().parentsUntil("tbody").prev().prev().children().eq(1).children().find("span").html());
                                        var SuBtot = self.parent().parentsUntil("tbody").prev().prev().children().eq(1).children().find("span").html();
                                        console.log("parent sub",self.parent().parentsUntil("tbody").prev().prev().children().eq(1).children().find("span").html());

                                        // Grand Total
                                        var GrandTotal = SuBtot - self.val();
                                        final.discount = self.val();
                                        final.total = GrandTotal.toFixed(3);
                                        console.log("GrandTotal", GrandTotal);
                                        $('#td-total').html(final.total); 
                                    });

                                  
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
                                    function fnAlltotal(){
                                        console.log("TOTAL hit")
                                        var subTotal=0;
                                   
                                        $(".amount").each(function(){
                                            subTotal += parseFloat($(this).val()||0);
                                        });

                                        
                                        final.subTotal = subTotal
                                        final.total = subTotal
                                        $('#td-subtotal').html(( final.subTotal).toFixed(3)); 
                                        $('#td-total').html(( final.total).toFixed(3));
                                    }

                                    // Calculate Sub total without VAT
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
                                    function VatEachRow(){
                                       
                                        $(".unit").each(function(){
                                            var self = $(this);     
                                            var qtyvat = self.parent().prev().children().val();
                                            self.parent().next().children().val((self.val()*qtyvat*0.05).toFixed(3))
                                            console.log("recent",parseFloat(self.parent().next().children().val((self.val()*qtyvat*0.05).toFixed(3))))
                                        });

                                    }


                                    // Calculate Grand total


                                    $('#prod-select-table tbody tr:last button').click(function () {
                                        $(this).parent().parent().remove();
                                        // $('#td-subtotal').html(0.000);
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
                                       function RemovefnAlltotal(){
                                        console.log("TOTAL hit remove")
                                        var removesubTotal=0;
                                   
                                        $(".amount").each(function(){
                                            removesubTotal += parseFloat($(this).val()||0);
                                        });

                                        final.subTotal = removesubTotal
                                        final.total = removesubTotal
                                        console.log("removesubTotal",  final.subTotal);
                                       
                                        $('#td-subtotal').html((final.subTotal).toFixed(3)); 
                                        $('#td-total').html(( final.subTotal).toFixed(3));
                                    }

                                    RemoveVatCal();
                                    // Calculate total vat
                                    function RemoveVatCal(){
                                        var VatCalc = 0;
                                        $(".unit").each(function(){
                                            console.log("testing123", VatCalc)
                                            var qtyWithoutForVat = $(this).parent().prev().children().val();
                                            VatCalc += parseFloat($(this).val()||0) * qtyWithoutForVat;
                                           
                                        });
                                        VatCalcAfter = VatCalc*0.05
                                        final.totalVat = (VatCalcAfter).toFixed(3)
                                        console.log("Total final vat",final.totalVat );
                                        $('#td-totalVat').html((final.totalVat)); 
                                        // $('.vat').val((VatCalc*0.05).toFixed(3)); 
                                    }
                                      
                                    //    VatCal();
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
                                       
                                        let id = (($(this).attr('id')).split('-'))[1];
                                        removeItemFromList(id);
                                        // calculateFinal();

                               


                                });
                    }
                    else{
                        // console.log(productsInfo[0]['name']);
                        // console.log(prodId);
                    }
                   
                  });
                

                // Add Product item to productList
                let prodItem = {
                    id: prodId,
                    name: prodName,

                };
                prodList.push(prodItem);
                console.log("PROLIST:", prodList);
                // Append new Product item row
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
                One.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'Product already selected!'});
            }
        } else {
            One.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'Please Select Product!'});
        }
        console.log('here product add btn click event: ', prodId, prodName);
    });

}) ;

/////   Looping each row in table
$(".create-btn-lead").one('click',function(){
   
    $("#prod-select-table tbody tr:not(:first)").each(function(key, value){

    var currentRow=$(this);
    var col1_value=currentRow.find("td:eq(0)").find('input[type=text]').val();
    var col2_value=currentRow.find("td:eq(1)").find('.long-desc').val();
    var col3_value=currentRow.find("td:eq(2)").find('input[type=number]').val(); 
    var col4_value=currentRow.find("td:eq(3)").find('input[type=number]').val();
    var col5_value=currentRow.find("td:eq(4)").find('input[type=number]').val();
    var col6_value=currentRow.find("td:eq(5)").find('input[type=number]').val();
    var data=col1_value+"\n"+col2_value+"\n"+col3_value+"\n"+col4_value+"\n"+col5_value+"\n"+col6_value;
    alert(data);

   
    console.log("PROLIST:", prodList[key]['id']);

    var obj={};
    obj.id=prodList[key]['id'];
    obj.name=col1_value;
    obj.des=col2_value;
    obj.qty=col3_value;
    obj.rate=col4_value;
    obj.vat=col5_value;
    obj.amount=col6_value;

    IdentifyButton = 'SaveLead';
    alert('Lead Button pressed:'+ IdentifyButton );
    
    arrData.push(obj);
    alert(obj.id);
});


// alert(arrData[1]);
// console.log(arrData[1]);

});



// /////   Looping each row in table 
$(".create-btn-sale").one('click',function(){
   
    $("#prod-select-table tbody tr:not(:first)").each(function(key, value){

    var currentRowSale=$(this);
    var s1_value=currentRowSale.find("td:eq(0)").find('input[type=text]').val();
    var s2_value=currentRowSale.find("td:eq(1)").find('.long-desc').val();
    var s3_value=currentRowSale.find("td:eq(2)").find('input[type=number]').val(); 
    var s4_value=currentRowSale.find("td:eq(3)").find('input[type=number]').val();
    var s5_value=currentRowSale.find("td:eq(4)").find('input[type=number]').val();
    var s6_value=currentRowSale.find("td:eq(5)").find('input[type=number]').val();
    var Saledata=s1_value+"\n"+s2_value+"\n"+s3_value+"\n"+s4_value+"\n"+s5_value+"\n"+s6_value;
    alert(Saledata);

   
    console.log("PROLIST:", prodList[key]['id']);

    var SaleObj={};
    SaleObj.id=prodList[key]['id'];
    SaleObj.name=s1_value;
    SaleObj.des=s2_value;
    SaleObj.qty=s3_value;
    SaleObj.rate=s4_value;
    SaleObj.vat=s5_value;
    SaleObj.amount=s6_value;

    IdentifyButton = 'MoveToSales';

    alert('Sale Button pressed:'+ IdentifyButton);

    arrData.push(SaleObj);
    alert(SaleObj.id);
});

});


    /**
     * Sales-Lead Client Select2 implementation
     * */
    $('.client-select2').select2({
        ajax: {
            url: function (params) {
                if(params.term) {
                    return '/crm/companies-contacts/' + params.term;
                } else {
                    return '/crm/companies-contacts';
                }
            },
            dataType: 'json',
            processResults: function (data) {
                const companies = data['companies'];
                const contacts = data['contacts'];
                const companyArray = companies.map((item, index) => {
                    return  {
                        id: "com" + item['id'],
                        text: item['company_name'],
                        address: item['address'],
                        country: item['country'],
                        city: item['city'],
                        telephone: item['telephone'],
                        Email: item['Email'],
                    };
                });

                ////////////  TESTING
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
                const contactArray = contacts.map((item, index) => {
                    return {
                        id: "con" + item['id'],
                        text: item['contact_name']
                    };
                });

                return {
                    results: [...companyArray, ...contactArray]
                };
            },
        },
    });

    
// EVENT TO SET VALUES ON SELECT
    $('.client-select2').on('select2:select', function (e) {
        var data = e.params.data;
        console.log("SELECTED", data);

        
            console.log(data.id);//access value
            console.log(data.text);//access the text
            console.log(data.address);//access the text
            console.log(data.country);//access the text
            console.log(data.Email);//access the text

            $('#address').val(data.address).css("background-color", "rgb(240, 248, 255)");
            $('#country').val(data.country).css("background-color", "rgb(240, 248, 255)");
            $('#city').val(data.city).css("background-color", "rgb(240, 248, 255)");
            $('#email').val(data.Email).css("background-color", "rgb(240, 248, 255)");
            $('#phone').val(data.telephone).css("background-color", "rgb(240, 248, 255)");
            // $('#city').val(data[x]['city']).css("background-color", "rgb(240, 248, 255)");
            // console.log(data[x]['telephone']);//access the text
            // $('#phone').val(data[x]['telephone']).css("background-color", "rgb(240, 248, 255)");
          

    });


    /**
     * Sales-Lead Employee Select2 implementation
     * */
    $('.employee-select2').select2({
        ajax: {
            url: function (params) {
                if(params.term) {
                    return '/human/employees/' + params.term;
                } else {
                    return '/human/employees';
                }
            },
            dataType: 'json',
            processResults: function (data) {
                const employees = data['employees'];
                const employeeArr = employees.map((item) => {
                    return  {
                        id: item['id'],
                        text: item['full_name']
                    };
                });

                return {
                    results: employeeArr
                };
            },
        },
    });

    /**
     * Sales-Lead Product Select2 implementation
     * */
    $('.product-select2').select2({
        ajax: {
            url: function (params) {
                if(params.term) {
                    return '/product/products/' + params.term;
                } else {
                    return '/product/products';
                }
            },
            dataType: 'json',
            processResults: function (data) {
                const products = data['products'];
                const prodArr = products.map((item) => {
                    return {
                        id: item['id'],
                        text: item['name']
                    };
                });

                return {
                    results: prodArr
                };
            },
        },
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
        let subTotalInput = $("<input>")
            .attr("type", "hidden")
            .attr("name", "sub-total").val(final.subTotal);
        let totalVatInput = $("<input>")
            .attr("type", "hidden")
            .attr("name", "total-vat").val(final.totalVat);
        let discountInput = $("<input>")
            .attr("type", "hidden")
            .attr("name", "discount").val(final.discount); 
        let totalInput = $("<input>")
            .attr("type", "hidden")
            .attr("name", "total").val(final.total);
        let IButton = $("<input>")
            .attr("type", "hidden")
            .attr("name", "IdentifyButton").val(IdentifyButton);    
        let prodListInput = $("<input>")
            .attr("type", "hidden")
            .attr("name", "prod-list").val(JSON.stringify(arrData));

        $(this).append(subTotalInput);
        $(this).append(totalVatInput);
        $(this).append(discountInput);
        $(this).append(totalInput);
        $(this).append(IButton);
        $(this).append(prodListInput);

        return true;
    });


    // leads delete btn
    $('.lead-delete-btn').click(function () {
        let leadTable = $('#lead-table').DataTable();
        let idArr = ($(this).attr('id')).split('-');
        let leadId = idArr[3];
        let trow = idArr[4];
        let self = $(this);

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(result => {
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
                    success: function (response) {
                        let result = JSON.parse(response);
                        if (result['status'] === 'success') {
                            self.parent().parent().parent().addClass('selected');
                            leadTable.row('.selected').remove().draw(false);
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            );
                        } else {
                            One.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'Delete Lead Failed!'});
                        }
                    },
                    error: function () {
                        One.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'Delete Lead Failed!'});
                    }
                })

            }
        });
    });



    // Sales delete btn
    $('.sale-delete-btn').click(function () {
        let leadTable = $('#sales-table').DataTable();
        let idArr = ($(this).attr('id')).split('-');
        let leadId = idArr[3];
        let trow = idArr[4];
        let self = $(this);

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(result => {
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
                    success: function (response) {
                        let result = JSON.parse(response);
                        if (result['status'] === 'success') {
                            self.parent().parent().parent().addClass('selected');
                            leadTable.row('.selected').remove().draw(false);
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            );
                        } else {
                            One.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'Delete Lead Failed!'});
                        }
                    },
                    error: function () {
                        One.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'Delete Lead Failed!'});
                    }
                })

            }
        });
    });


// Approving from leads to sales
    jQuery('.approve-leads-btn').click(function () {
        let jobTable = jQuery('#lead-table').DataTable();
        let idArray = ($(this).attr('id')).split('-');
        let jobId = idArray[2];
        let trowId = idArray[3];
        let data = {
            id: jobId
        };
        let self = $(this);
        Swal.fire({
            title: 'Are you sure?',
            text: "You can revert this!",
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Approve it!'
        }).then(result => {
            if(result.value) {
                $.ajax({
                    method: "POST",
                    url: "/leads/approve",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    success: function (response) {
                        var result = JSON.parse(response);
                        if(result['status'] == 'success') {
                            var approvedJo = result['jo'];
                            self.parent().parent().parent().addClass('selected');
                            jobTable.row('.selected').remove().draw(false);
                            // Swal.fire(
                            //     'Approved!',
                            //     'Job Order has been approved.',
                            //     'success'
                            // );
                            location.reload(true);
                        } else {
                            One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Approving Job Order Failed!'});
                        }
                    },
                    error: function () {
                        One.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'Approving Job Order Failed!'});
                    }
                });
            }
        });
    });




// Approving sales to archives
    jQuery('.approve-jo-btn').click(function () {
        let jobTable = jQuery('#sales-table').DataTable();
        let idArray = ($(this).attr('id')).split('-');
        let jobId = idArray[2];
        let trowId = idArray[3];
        let data = {
            id: jobId
        };
        let self = $(this);
        Swal.fire({
            title: 'Are you sure?',
            text: "You can revert this!",
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Approve it!'
        }).then(result => {
            if(result.value) {
                $.ajax({
                    method: "POST",
                    url: "/sales/approve",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    success: function (response) {
                        var result = JSON.parse(response);
                        if(result['status'] == 'success') {
                            var approvedJo = result['jo'];
                            self.parent().parent().parent().addClass('selected');
                            jobTable.row('.selected').remove().draw(false);
                            // Swal.fire(
                            //     'Approved!',
                            //     'Job Order has been approved.',
                            //     'success'
                            // );
                            location.reload(true);
                        } else {
                            One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Approving Job Order Failed!'});
                        }
                    },
                    error: function () {
                        One.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'Approving Job Order Failed!'});
                    }
                });
            }
        });
    });






});

function calculateFinal() {
    console.log("Inside calc", productsInfo);
    resetFinal();

    prodList.map(prod => {
        let target = productsInfo.find(el => el.id === parseInt(prod.id));
        final.subTotal += target['price'] * prod['quantity'];
        final.totalVat += (target['price'] * prod['vat'] / 100);
    });
    final.total = final.subTotal + final.totalVat - final.discount;

    // refreshTotalDom();
}

function refreshTotalDom() {
    // set final values to elements
    $('#td-subtotal').html((final.subTotal).toFixed(3));
    $('#td-totalVat').html((final.totalVat).toFixed(3));
    $('#td-total').html((final.total).toFixed(3));
}

function resetFinal() {
    final = {
        ...final,
        subTotal: 0,
        totalVat: 0,
        total: 0
    };
}

function getAllProductsInfo() {
   
return  $.ajax({
        method: "GET",
        url: "/product/products",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            let result = JSON.parse(response);
            productsInfo = result['products'];
            console.log('here get all products info response: ', productsInfo);

        },
        error: function () {
            console.log('here get products info error');
        }
    });
}


function checkProdItemExist(id) {
    let result = prodList.find((prod) => prod.id === id);
    return result ? true : false;
}

function updateItem(id, key, value) {
    prodList = prodList.map((prod) => {
        if (prod.id === id) {
            let temp = { ...prod };
            temp[key] = value;
            return temp;
        } else {
            return prod;
        }
    });
    console.log("updated",prodList);
}

function removeItemFromList(id) {
    prodList = prodList.filter(prod => (prod.id !== id));



}
