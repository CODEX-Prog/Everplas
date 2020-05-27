jQuery(document).ready(function () {
    jQuery('.mainten-asset-select2').select2({
        ajax: {
            url: function (params) {
                if(params.term) {
                    return '/inventory/getassets/' + params.term;
                } else {
                    return '/inventory/getassets';
                }
            },
            dataType: 'json',
            processResults: function (data) {
                var assets = data['assets'];
                var assetArray = assets.map((item, index) => {
                    var temp = {
                        id: item['id'],
                        text: item['name']
                    };
                    return temp;
                });
                return {
                    results: assetArray
                };
            },
        },
    });

    jQuery('.mainten-company-select2').select2({
        ajax: {
            url: function (params) {
                if(params.term) {
                    return '/crm/getcompanies/' + params.term;
                } else {
                    return '/crm/getcompanies';
                }
            },
            dataType: 'json',
            processResults: function (data) {
                var companies = data['companies'];
                var companyArray = companies.map((item, index) => {
                    var temp = {
                        id: item['id'],
                        text: item['company_name']
                    };
                    return temp;
                });
                return {
                    results: companyArray
                };
            },
        },
    });

    jQuery('.mainten-employee-select2').select2({
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
        },
    });

    jQuery('.super-employee-select2').select2({
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
        },
    });

    jQuery('.review-employee-select2').select2({
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
        },
    });

    jQuery('.delete-mainten-btn').click(function () {
        var maintenanceTable = jQuery('#maintenance-table').DataTable();
        maintenanceId = '';
        trowId = '';
        var idArray = $(this).attr('id').split('-');
        maintenanceId = idArray[2];
        trowId = idArray[3];
        var data = {
            id: maintenanceId
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
                    url: "/inventory/deletemainten",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    success: function (response) {
                        var result = JSON.parse(response);
                        console.log("here delete user success", response);
                        if(result['status'] == 'success') {
                            self.parent().parent().parent().parent().addClass('selected');
                            maintenanceTable.row('.selected').remove().draw(false);
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        } else {
                            One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Delete Maintenance Success'});
                        }

                    },
                    error: function () {
                        console.log("here update user error: ");
                        One.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'Delete Maintenance Failed!'});
                    }
                });
            }
        });
        console.log('here delete button click: ', idArray, data)
    })
});
