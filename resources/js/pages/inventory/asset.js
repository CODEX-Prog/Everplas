jQuery(document).ready(function () {
    jQuery('.asset-company-select2').select2({
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
            },
        },
    });

    // jQuery('.asset-contact-select2').select2({
    //     ajax: {
    //         url: function (params) {
    //             if(params.term) {
    //                 return '/crm/getcontacts/' + params.term;
    //             } else {
    //                 return '/crm/getcontacts';
    //             }
    //         },
    //         dataType: 'json',
    //         processResults: function (data) {
    //             var contacts = data['contacts'];
    //             var contactArray = contacts.map((item, index) => {
    //                 var temp = {
    //                     id: item['id'],
    //                     text: item['contact_name']
    //                 };
    //                 return temp;
    //             });
    //             return {
    //                 results: contactArray
    //             };
    //         },
    //     },
    // });

    jQuery('.asset-owner-select2').select2({
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

    jQuery('.delete-asset-btn').click(function () {
        var assetTable = jQuery('#asset-table').DataTable();
        assetId = '';
        trowId = '';
        var idArray = $(this).attr('id').split('-');
        assetId = idArray[2];
        trowId = idArray[3];
        var data = {
            id: assetId
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
                    url: "/inventory/deleteasset",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    success: function (response) {
                        var result = JSON.parse(response);
                        console.log("here delete user success", response);
                        if(result['status'] == 'success') {
                            self.parent().parent().parent().parent().addClass('selected');
                            assetTable.row('.selected').remove().draw(false);
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        } else {
                            One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Delete Asset Success'});
                        }

                    },
                    error: function () {
                        console.log("here update user error: ");
                        One.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'Delete Asset Failed!'});
                    }
                });
            }
        });
        console.log('here delete button click: ', idArray, data)
    })
});
