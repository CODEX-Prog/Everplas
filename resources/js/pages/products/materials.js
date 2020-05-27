var materialId;
var trowId;

jQuery(document).ready(

    // save group button event handler
    jQuery("#mat-create-save-btn").click(function () {
        var materialTable = $('#material-table').DataTable();
        var matName = jQuery('#mat-create-name').val();
        var matCode = jQuery('#mat-create-code').val();
        var vendorId = jQuery('#mat-create-supplier').val();
        var data = {
            matName,
            matCode,
            vendorId
        };

        $.ajax({
            type: "POST",
            url: '/products/material/create',
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                var result = JSON.parse(response);
                if(result['status'] == 'success') {
                    var material = result['material'];
                    var supplier = result['supplier'];
                    $('#mat-create-name').val('');
                    $('#mat-create-code').val('');
                    $('#material-create-modal').modal('hide');
                    var newRow = materialTable.row.add([
                        material['name'],
                        material['code'],
                        supplier,
                        "<div>\n" +
                        "</div>"
                    ]).draw();
                    var newRowNode = newRow.node();
                    var buttonWrapper = $($(newRowNode).children()[3]).children()[0];
                    $(buttonWrapper).addClass('btn-group');
                    buttonWrapper.innerHTML =
                        "<button type=\"button\" class=\"btn btn-sm btn-primary edit-contact-btn\"\n" +
                        "</button>\n" +
                        "<button type=\"button\" class=\"btn btn-sm btn-primary delete-contact-btn\"\n" +
                        "</button>";
                    $($(buttonWrapper).children()[0]).attr('id', `edit-contact-${material['id']}-${newRow.index()}`);
                    $($(buttonWrapper).children()[1]).attr('id', `delete-contact-${material['id']}-${newRow.index()}`);
                    $(buttonWrapper).children()[0].innerHTML = "<i class=\"fa fa-fw fa-pencil-alt\"></i>";
                    $(buttonWrapper).children()[1].innerHTML = "<i class=\"fa fa-fw fa-times\"></i>";
                    $($(buttonWrapper).children()[0]).click(function() {
                        materialId = '';
                        trowId = '';
                        var idArray = ($(this).attr('id')).split('-');
                        materialId = idArray[2];
                        trowId = idArray[3];

                        var data = {
                            id: materialId
                        };
                        $.ajax({
                            method: "GET",
                            url: "/products/material",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: data,
                            success: function (response) {
                                var result = JSON.parse(response);
                                if(result['status'] == 'success') {
                                    console.log("here get group success", result);
                                    jQuery('#material-edit-modal').modal('show');
                                    var material = result['material'];
                                    jQuery('#mat-edit-name').val(material['name']);
                                    jQuery('#mat-edit-code').val(material['code']);
                                } else {
                                    console.log("here get group error: ");
                                }
                            },
                            error: function () {
                                console.log("here get group error: ");
                            }
                        });
                    });
                    $($(buttonWrapper).children()[1]).click(function() {
                        var materialTable = jQuery('#material-table').DataTable();
                        materialId = '';
                        trowId = '';
                        var idArray = ($(this).attr('id')).split('-');
                        materialId = idArray[2];
                        trowId = idArray[3];
                        var data = {
                            id: materialId,
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
                        }).then((result) => {
                            if (result.value) {
                                $.ajax({
                                    method: "POST",
                                    url: "/products/material/delete",
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    data: data,
                                    success: function (response) {
                                        var result = JSON.parse(response);
                                        console.log("here delete user success", response);
                                        if(result['status'] == 'success') {
                                            self.parent().parent().parent().addClass('selected');
                                            materialTable.row('.selected').remove().draw(false);
                                            Swal.fire(
                                                'Deleted!',
                                                'Your file has been deleted.',
                                                'success'
                                            )
                                        } else {
                                            One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Delete Group Failed!'});
                                        }
                                    },
                                    error: function () {
                                        console.log("here update user error: ");
                                        One.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'Delete Group Failed!'});
                                    }
                                });
                            }
                        });
                    });
                    One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Creat new Material success'});
                } else {
                    $('#material-create-modal').modal('hide');
                    console.log('here create group error: ', result['message']);
                    One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Create Material Fail'});
                }
            },
            error: function () {
                console.log('here save group ajax error: ');
                One.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'Create Material Failed!'});
            }
        });
    }),

    // edit group button event handler
    jQuery('.edit-btn').click(function () {
        materialId = '';
        trowId = '';
        var idArray = ($(this).attr('id')).split('-');
        materialId = idArray[2];
        trowId = idArray[3];

        var data = {
            id: materialId
        };
        $.ajax({
            method: "GET",
            url: "/products/material",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: data,
            success: function (response) {
                var result = JSON.parse(response);
                if(result['status'] == 'success') {
                    console.log("here get group success", result);
                    jQuery('#material-edit-modal').modal('show');
                    var material = result['material'];
                    jQuery('#mat-edit-name').val(material['name']);
                    jQuery('#mat-edit-code').val(material['code']);
                } else {
                    console.log("here get group error: ");
                }
            },
            error: function () {
                console.log("here get group error: ");
            }
        });
        console.log('here edit group button click: ', materialId, trowId);
    }),

    // edit group modal footer save button handler
    jQuery('#mat-edit-save-btn').click(function () {
        var materialTable = jQuery('#material-table').DataTable();
        var matName = jQuery('#mat-edit-name').val();
        var matCode = jQuery('#mat-edit-code').val();
        var vendorId = jQuery('#mat-edit-supplier').val();
        if(matName && matCode) {
            var data = {
                id: materialId,
                matName,
                matCode,
                vendorId
            };
            console.log('here save button is clicked: ', data);

            $.ajax({
                method: "POST",
                url: "/products/material/update",
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    var result = JSON.parse(response);
                    if(result['status'] == 'success') {
                        var material = result['material'];
                        var supplier = result['supplier'];
                        console.log("here update user success", result['status'], );
                        jQuery('#mat-edit-name').val('');
                        jQuery('#mat-edit-code').val('');
                        jQuery('#material-edit-modal').modal('hide');
                        ($(materialTable.row(trowId).node()).children()[0]).innerHTML = matName;
                        ($(materialTable.row(trowId).node()).children()[1]).innerHTML = matCode;
                        ($(materialTable.row(trowId).node()).children()[2]).innerHTML = supplier;
                        One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Edit Material Success'});
                    } else {
                        jQuery('#mat-edit-name').val('');
                        jQuery('#mat-edit-code').val('');
                        jQuery('#material-edit-modal').modal('hide');
                        console.log("here update group error", result['status'], result['message']);
                        One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Edit Material Fail'});
                    }
                },
                error: function () {
                    jQuery('#mat-edit-name').val('');
                    jQuery('#mat-edit-code').val('');
                    jQuery('#material-edit-modal').modal('hide');
                    console.log("here update user error: ");
                    One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Edit Material Fail'});
                }
            });

        } else {
            Swal.fire('Please Fill all Fields');
        }
    }),

    //delete group button event handler
    jQuery('.delete-btn').click(function () {
        var materialTable = jQuery('#material-table').DataTable();
        materialId = '';
        trowId = '';
        var idArray = ($(this).attr('id')).split('-');
        materialId = idArray[2];
        trowId = idArray[3];
        var data = {
            id: materialId,
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
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    method: "POST",
                    url: "/products/material/delete",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    success: function (response) {
                        var result = JSON.parse(response);
                        console.log("here delete user success", response);
                        if(result['status'] == 'success') {
                            self.parent().parent().parent().addClass('selected');
                            materialTable.row('.selected').remove().draw(false);
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        } else {
                            One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Delete Group Failed!'});
                        }
                    },
                    error: function () {
                        console.log("here update user error: ");
                        One.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'Delete Group Failed!'});
                    }
                });
            }
        });
        console.log('here delete group button click: ', materialId, trowId);
    }),

    jQuery('.material-supplier-select2').select2({
            ajax: {
                url: function (params) {
                    if(params.term) {
                        return '/crm/companies-contacts/' + params.term;
                    } else {
                        return '/crm/companies-contacts/';
                    }
                },
                dataType: 'json',
                processResults: function (data) {
                    var companies = data['companies'];
                    var contacts = data['contacts'];

                    var companyArray = companies.map((item, index) => {
                        var temp = {
                            id: "com" + item['id'],
                            text: item['company_name']
                        };
                        return temp;
                    });
                    var contactArray = contacts.map((item, index) => {
                        var temp = {
                            id: "con" + item['id'],
                            text: item['contact_name']
                        };
                        return temp;
                    });

                    return {
                        results: [...companyArray, ...contactArray]
                    };
                }
            }
        }
    ),
);
