// global variables
var employeeId;
var trowId;

function isEmailAddress(str) {
    var pattern = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
    return str.match(pattern);
}

jQuery(document).ready(

    // edit employee button event handler
    // jQuery('.edit-btn').click(function () {
    //     employeeId = '';
    //     trowId = '';
    //     var idArray = ($(this).attr('id')).split('-');
    //     employeeId = idArray[2];
    //     trowId = idArray[3];
    //
    //     var data = {
    //         id: employeeId
    //     };
    //     $.ajax({
    //         method: "GET",
    //         url: "/human/getemployee",
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         data: data,
    //         success: function (response) {
    //             var result = JSON.parse(response);
    //             if(result['status'] == 'success') {
    //                 jQuery('#edit-employee-modal').modal('show');
    //                 var employee = result['employee'];
    //                 console.log("here get group success", result);
    //             } else {
    //                 console.log("here get group error: ");
    //             }
    //         },
    //         error: function () {
    //             console.log("here get group error: ");
    //         }
    //     });
    //     console.log('here edit group button click: ', employeeId, trowId);
    // }),

    // edit group modal footer save button handler
    // jQuery('#save-edit-employee').click(function () {
    //     var employeeTable = jQuery('#employee-table').DataTable();
    //
    //     var data = {
    //         id: employeeId
    //     };
    //     console.log('here save button is clicked: ', data);
    //
    //     $.ajax({
    //         method: "POST",
    //         url: "/human/updateemployee",
    //         data: data,
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         success: function (response) {
    //             var result = JSON.parse(response);
    //             if(result['status'] == 'success') {
    //                 console.log("here update user success", result['status']);
    //                 // $($(groupTable.row(trowId).node()).children()[0]).children()[0].innerHTML = groupName;
    //                 One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Edit Employee Success'});
    //             } else {
    //                 console.log("here update group error", result['status'], result['message']);
    //                 One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Edit Employee Fail'});
    //             }
    //         },
    //         error: function () {
    //             console.log("here update user error: ");
    //             One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Edit Employee Fail'});
    //         }
    //     });
    //
    //     jQuery('#edit-employee-modal').modal('hide');
    // }),

    //delete employee button event handler
    jQuery('.delete-btn').click(function () {
        var employeeTable = jQuery('#employee-table').DataTable();
        employeeId = '';
        trowId = '';
        var idArray = ($(this).attr('id')).split('-');
        employeeId = idArray[2];
        trowId = idArray[3];
        var data = {
            id: employeeId,
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
                    url: "/human/deleteemployee",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    success: function (response) {
                        var result = JSON.parse(response);
                        console.log("here delete user success", response);
                        if(result['status'] == 'success') {
                            self.parent().parent().parent().addClass('selected');
                            employeeTable.row('.selected').remove().draw(false);
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        } else {
                            One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Delete Employee Failed!'});
                        }
                    },
                    error: function () {
                        console.log("here update user error: ");
                        One.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'Delete Employee Failed!'});
                    }
                });
            }
        });
        console.log('here delete employee button click: ', employeeId, trowId);
    }),
);
