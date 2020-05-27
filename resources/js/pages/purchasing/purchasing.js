let materialListArray = [];

jQuery(document).ready(function () {

    jQuery('.client-select2').select2({
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
                    return {
                        id: "com" + item['id'],
                        text: item['company_name']
                    };
                });
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

    $(".create-btn-pur").one('click',function(){ 


     });

    jQuery('.employee-select2').select2({
        ajax: {
            url: function (params) {
                if(params.term) {
                    return '/human/getemployees/' + params.term;
                } else {
                    return '/human/getemployees';
                }
            },
            dataType: 'json',
            processResults: function (data) {
                var employees = data['employees'];
                var employeeArray = employees.map((item, index) => {
                    var temp = {
                        id: item['id'],
                        text: item['full_name']
                    };
                    return temp;
                });
                return {
                    results: employeeArray
                };
            },
        }
    });


    jQuery('.material-select2').select2({
        ajax: {
            url: function (params) {
                if(params.term) {
                    return '/products/get-material/' + params.term;
                } else {
                    return '/products/get-material/';
                }
            },
            dataType: 'json',
            processResults: function (data) {
                var materials = data['materials'];
                var materialArray = materials.map((item, index) => {
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
        let materialSelect =$('#material-id');
        let materialId = materialSelect.val();
        let materialLabel = $('#material-id option:selected').text();
        if (materialId) {
            if (checkExist(materialId)) {
                let trow = "<tr class=\"main\">\n" +
                    "    <td>\n" +
                    "         <input name='mat-name' class='form-control' type='text' id='mat-name' disabled>\n" +
                    "    </td>\n" +
                    "    <td>\n" +
                    "         <textarea name='mat-description' rows='2' class='form-control' placeholder='description'></textarea>\n" +
                    "    </td>\n" +
                    "    <td>\n" +
                    "         <input type='number' name='quantity' min='1' value='1' class='form-control'>\n" +
                    "    </td>\n" +
                    "    <td>\n" +
                    "         <input type='number' name='weight' min='0' class='form-control' placeholder='KG'>\n" +
                    "    </td>\n" +
                    "    <td>\n" +
                    "         <input type='number' name='mat-amount' min='0' class='form-control' placeholder='Amount'>\n" +
                    "    </td>\n" +
                    "    <td>\n" +
                    "        <button type='button' class='btn pull-right btn-danger cancel-material-btn'>\n" +
                    "              <i class='fa fa-times'></i>\n" +
                    "        </button>\n" +
                    "    </td>\n" +
                    "</tr>";

                const materialList = {
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
                $("#material-table tbody tr:last textarea").attr("id", `mat-description-${materialId}`);
                $("#material-table tbody tr:last input[name='quantity']").attr("id", `mat-quantity-${materialId}`);
                $("#material-table tbody tr:last input[name='weight']").attr("id", `mat-weight-${materialId}`);
                $("#material-table tbody tr:last input[name='mat-amount']").attr("id", `mat-amount-${materialId}`);
                $("#material-table tbody tr:last button").attr("id", `mat-remove-${materialId}`);

                $("#material-table tbody tr td textarea").change(function () {
                    let idArray = ($(this).attr('id')).split('-');
                    changeArrayList(idArray[2], 'description', $(this).val());
                });

                $("#material-table tbody tr td input[name='quantity']").change(function () {
                    let idArray = ($(this).attr('id')).split('-');
                    changeArrayList(idArray[2], 'quantity', $(this).val());
                });

                $("#material-table tbody tr td input[name='weight']").change(function () {
                    let idArray = ($(this).attr('id')).split('-');
                    changeArrayList(idArray[2], 'weight', $(this).val());
                });

                $("#material-table tbody tr td input[name='mat-amount']").change(function () {
                    let idArray = ($(this).attr('id')).split('-');
                    changeArrayList(idArray[2], 'amount', $(this).val());
                });

                $('#material-table tbody tr:last td:last button').click(function () {
                    $(this).parent().parent().remove();
                    let idArray = ($(this).attr('id')).split('-');
                    removeFromMaterialList(idArray[2]);
                });
            } else {
                One.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'Material already selected!'});
            }
        } else {
            One.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'Please Select Material!'});
        }
    });

    jQuery('#job-create-form').submit(function (e) {
        $("<input />").attr("type", "hidden")
            .attr("name", "material-list")
            .attr("value", JSON.stringify({ list: materialListArray}))
            .appendTo("#job-create-form");
        return true;
    });

    jQuery('#job-edit-form').submit(function (e) {
        $("<input />").attr("type", "hidden")
            .attr("name", "material-list")
            .attr("value", JSON.stringify({ list: materialListArray}))
            .appendTo("#job-edit-form");
        return true;
    });


    jQuery('.delete-jo-btn').click(function () {
        let jobTable = jQuery('#jo-table').DataTable();
        let idArray = ($(this).attr('id')).split('-');
        let jobId = idArray[2];
        let trowId = idArray[3];
        let data = {
            id: jobId
        };
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
            if(result.value) {
                $.ajax({
                    method: "DELETE",
                    url: "/receiving/job-order",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    success: function (response) {
                        var result = JSON.parse(response);
                        if(result['status'] == 'success') {
                            self.parent().parent().parent().addClass('selected');
                            jobTable.row('.selected').remove().draw(false);
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        } else {
                            One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Delete Job Order Failed!'});
                        }
                    },
                    error: function () {
                        One.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'Delete Job Order Failed!'});
                    }
                });
            }
        })
    });

    jQuery('.approve-jo-btn').click(function () {
        let jobTable = jQuery('#jo-table').DataTable();
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
                    url: "/purchasing/job-order/approve",
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


    jQuery('.complete-jo-btn').click(function () {
        var approvedJoTable = jQuery('#jo-process-table').DataTable();
        var idArray = ($(this).attr('id')).split('-');
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
        }).then(result => {
            if(result.value) {
                $.ajax({
                    method: "POST",
                    url: "/purchasing/job-order/complete",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    success: function (response) {
                        var result = JSON.parse(response);
                        if(result['status'] == 'success') {
                            var completedJob = result['jo'];
                            self.parent().parent().parent().addClass('selected');
                            approvedJoTable.row('.selected').remove().draw(false);
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


function checkExist(id) {
    let result = materialListArray.find((materialList) => materialList.id === id);
    return !!!result;
}

function changeArrayList(id, key, value) {
    var arrayList = materialListArray.find((materialList) => materialList.id === id);
    arrayList[key] = value;
}

function removeFromMaterialList(id) {
    materialListArray = materialListArray.filter(materialList => {
        return materialList.id !== id;
    });
}