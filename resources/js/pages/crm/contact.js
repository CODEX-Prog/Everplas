var contactId;
var trowId;

jQuery(document).ready(

    jQuery('#create-contact-form').on('submit', function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            method: "POST",
            url: "/crm/createcontact",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                var result = JSON.parse(response);
                if(result['status'] == 'success') {
                    var contact = result['contact'];
                    var contactTable = jQuery('#contact-table').DataTable();
                    var newRow = contactTable.row.add([
                        contact['contact_name'],
                        'Company' + '-' + contact['id'],
                        'VIP',
                        contact['contact_mobile'],
                        contact['contact_email'],
                        "<div>\n" +
                        "</div>"
                    ]).draw();
                    var newRowNode = newRow.node();
                    $($(newRowNode).children()[0]).addClass('font-w600');
                    $($(newRowNode).children()[1]).addClass('font-w600');
                    $($(newRowNode).children()[2]).addClass('font-w600');
                    $($(newRowNode).children()[3]).addClass('font-w600');
                    $($(newRowNode).children()[4]).addClass('font-w600');
                    $($(newRowNode).children()[5]).addClass('text-center');
                    var buttonWrapper = $($(newRowNode).children()[5]).children()[0];
                    $(buttonWrapper).addClass('btn-group');
                    buttonWrapper.innerHTML =
                        "<button type=\"button\" class=\"btn btn-sm btn-primary edit-contact-btn\"\n" +
                        "</button>\n" +
                        "<button type=\"button\" class=\"btn btn-sm btn-primary delete-contact-btn\"\n" +
                        "</button>";
                    $($(buttonWrapper).children()[0]).attr('id', `edit-contact-${contact['id']}-${newRow.index()}`);
                    $($(buttonWrapper).children()[1]).attr('id', `delete-contact-${contact['id']}-${newRow.index()}`);
                    $(buttonWrapper).children()[0].innerHTML = "<i class=\"fa fa-fw fa-pencil-alt\"></i>";
                    $(buttonWrapper).children()[1].innerHTML = "<i class=\"fa fa-fw fa-times\"></i>";
                    $($(buttonWrapper).children()[0]).click(function() {
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
                            success: function (response) {
                                var result = JSON.parse(response);
                                if(result['status'] == 'success') {
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
                            error: function () {
                                console.log("here get company error: ");
                            }
                        });
                    });
                    $($(buttonWrapper).children()[1]).click(function() {
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
                        }).then((result) => {
                            if (result.value) {
                                $.ajax({
                                    method: "POST",
                                    url: "/crm/deletecontact",
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    data: data,
                                    success: function (response) {
                                        var result = JSON.parse(response);
                                        console.log("here delete user success", response);
                                        if(result['status'] == 'success') {
                                            self.parent().parent().parent().addClass('selected');
                                            contactTable.row('.selected').remove().draw(false);
                                            Swal.fire(
                                                'Deleted!',
                                                'Your file has been deleted.',
                                                'success'
                                            )
                                        } else {
                                            One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Delete User Success'});
                                        }

                                    },
                                    error: function () {
                                        console.log("here update user error: ");
                                        One.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'Delete User Failed!'});
                                    }
                                });
                            }
                        });
                        console.log('delete contact button is clicked');
                    });
                    jQuery('#create-contact-modal').modal('hide');
                } else {
                    One.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'Create Contact Failed!'});
                }
            },
            error: function () {
                console.log("here user save error: ");
                One.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'Create Contact Failed!'});
            }
        });
    }),

    jQuery('.edit-contact-btn').click(function () {
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
            success: function (response) {
                var result = JSON.parse(response);
                if(result['status'] == 'success') {
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
            error: function () {
                console.log("here get company error: ");
            }
        });
        // console.log('here edit contact button clicked: ', trowId, contactTable.row(trowId).data());
    }),

    jQuery('#edit-contact-form').on('submit', function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append('id', contactId);
        $.ajax({
            method: "POST",
            url: "/crm/updatecontact",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                var result = JSON.parse(response);
                var contactTable = jQuery('#contact-table').DataTable();
                if(result['status'] == 'success') {
                    var contact = result['contact'];
                    ($(contactTable.row(trowId).node()).children()[0]).innerHTML = contact['contact_name'];
                    // $($(contactTable.row(trowId).node()).children()[0]).children()[0].innerHTML = contactCompany;
                    $($(contactTable.row(trowId).node()).children()[3]).innerHTML = contact['contact_mobile'];
                    $($(contactTable.row(trowId).node()).children()[4]).innerHTML = contact['contact_email'];
                    jQuery('#edit-contact-modal').modal('hide');
                    console.log("here update user success", response);
                    One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Edit Contact Success!'});
                } else {
                    One.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'Edit Contact Failed!'});
                }
            },
            error: function () {
                console.log("here update user error: ");
                One.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'Edit Contact Failed!'});
            }
        })
    }),

    jQuery('.delete-contact-btn').click(function () {
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
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    method: "POST",
                    url: "/crm/deletecontact",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    success: function (response) {
                        var result = JSON.parse(response);
                        console.log("here delete user success", response);
                        if(result['status'] == 'success') {
                            self.parent().parent().parent().addClass('selected');
                            contactTable.row('.selected').remove().draw(false);
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        } else {
                            One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Delete User Success'});
                        }

                    },
                    error: function () {
                        console.log("here update user error: ");
                        One.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'Delete User Failed!'});
                    }
                });
            }
        });
    }),

    jQuery('.create-contact-group-select2').select2({
            ajax: {
                url: function (params) {
                    if(params.term) {
                        return '/crm/getgroups/' + params.term;
                    } else {
                        return '/crm/getgroups/';
                    }
                },
                dataType: 'json',
                processResults: function (data) {
                    groups = data.groups;
                    var groupArray = groups.map((item, index) => {
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
        }
    ),


    jQuery('.edit-contact-group-select2').select2({
        // placeholder: {
        //     id: "1",
        //     placeholder: "Select an option"
        // },
            ajax: {
                url: function (params) {
                    if(params.term) {
                        return '/crm/getgroups/' + params.term;
                    } else {
                        return '/crm/getgroups/';
                    }
                },
                dataType: 'json',
                processResults: function (data) {
                    groups = data.groups;
                    var groupArray = groups.map((item, index) => {
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
        }
    ),

    jQuery('.create-contact-company-select2').select2({
            ajax: {
                url: function (params) {
                    if(params.term) {
                        return '/crm/getcompanies/' + params.term;
                    } else {
                        return '/crm/getcompanies/';
                    }
                },
                dataType: 'json',
                processResults: function (data) {
                    companies = data.companies;
                    var companyArray = companies.map((item, index) => {
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
        }
    ),

    jQuery('.edit-contact-company-select2').select2({
        ajax: {
            url: function (params) {
                if(params.term) {
                    return '/crm/getcompanies/' + params.term;
                } else {
                    return '/crm/getcompanies/';
                }
            },
            dataType: 'json',
            processResults: function (data) {
                companies = data.companies;
                var companyArray = companies.map((item, index) => {
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
    }
),
);
