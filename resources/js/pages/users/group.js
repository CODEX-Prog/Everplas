var groupId;
var trowId;

jQuery(document).ready(
    // save group button event handler
    jQuery("#save-group-btn").click(function () {
        var groupTable = $('#group-table').DataTable();
        var groupName = jQuery('#group_name').val();
        if(groupName) {
            var data = {
                groupName: groupName
            };

            $.ajax({
                type: "POST",
                url: '/users/creategroup',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    var result = JSON.parse(response);
                    if(result['status'] == 'success') {
                        var group = result['group'];
                        var newRow = groupTable.row.add([
                            group['group_name'],
                            '3 days ago',
                            "<div>\n" +
                            "</div>"
                        ]).draw();
                        console.log('here new row: ', newRow.index());
                        var newRowNode = newRow.node();
                        $($(newRowNode).children()[0]).addClass('font-w600');
                        $($(newRowNode).children()[1]).addClass('text-muted');
                        $($(newRowNode).children()[2]).addClass('text-center');
                        var buttonWrapper = $($(newRowNode).children()[2]).children()[0];
                        $(buttonWrapper).addClass('btn-group');
                        buttonWrapper.innerHTML =
                            "<button type=\"button\" class=\"btn btn-sm btn-primary edit-group-btn\"\n" +
                            "</button>\n" +
                            "<button type=\"button\" class=\"btn btn-sm btn-primary delete-group-btn\"\n" +
                            "</button>";
                        $($(buttonWrapper).children()[0]).attr('id', `edit-group-${group['id']}-${newRow.index()}`);
                        $($(buttonWrapper).children()[1]).attr('id', `delete-group-${group['id']}-${newRow.index()}`);
                        $(buttonWrapper).children()[0].innerHTML = "<i class=\"fa fa-fw fa-pencil-alt\"></i>";
                        $(buttonWrapper).children()[1].innerHTML = "<i class=\"fa fa-fw fa-times\"></i>";
                        jQuery('#modal-block-fadein-group').modal('hide');
                        $('#group_name').val('');
                        $($(buttonWrapper).children()[0]).click(function() {
                            groupId = '';
                            trowId = '';
                            var idArray = ($(this).attr('id')).split('-');
                            groupId = idArray[2];
                            trowId = idArray[3];

                            var data = {
                                id: groupId
                            };

                            $.ajax({
                                method: "GET",
                                url: "/users/getgroup",
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: data,
                                success: function (response) {
                                    var result = JSON.parse(response);
                                    if(result['status'] == 'success') {
                                        jQuery('#modal-block-edit-group').modal('show');
                                        var group = result['group'];
                                        jQuery('#edit-group_name').val(group['group_name']);
                                        console.log("here get group success", result);
                                    } else {
                                        console.log("here get group error: ");
                                    }
                                },
                                error: function () {
                                    console.log("here get group error: ");
                                }
                            });
                            console.log('here edit group button click: ', groupId, trowId);
                        });
                        $($(buttonWrapper).children()[1]).click(function() {
                            var groupTable = jQuery('#group-table').DataTable();
                            groupId = '';
                            trowId = '';
                            var idArray = ($(this).attr('id')).split('-');
                            groupId = idArray[2];
                            trowId = idArray[3];
                            var data = {
                                id: groupId,
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
                                        url: "/users/deletegroup",
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        data: data,
                                        success: function (response) {
                                            var result = JSON.parse(response);
                                            console.log("here delete user success", response);
                                            if(result['status'] == 'success') {
                                                self.parent().parent().parent().addClass('selected');
                                                groupTable.row('.selected').remove().draw(false);
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
                            console.log('here delete group button click: ', groupId, trowId);
                        });
                        One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Creat new Group success'});
                    } else {
                        console.log('here create group error: ', result['message']);
                        One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Create Group Fail'});
                    }
                    $('#modal-block-fadein-group').modal('hide');
                },
                error: function () {
                    console.log('here save group ajax error: ');
                    One.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'Create Group Failed!'});
                }
            });
        } else {
            Swal.fire('Please Fill all Fields');
        }

    }),

    // edit group button event handler
    jQuery('.edit-group').click(function () {
        groupId = '';
        trowId = '';
        var idArray = ($(this).attr('id')).split('-');
        groupId = idArray[2];
        trowId = idArray[3];

        var data = {
            id: groupId
        };
        $.ajax({
            method: "GET",
            url: "/users/getgroup",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: data,
            success: function (response) {
                var result = JSON.parse(response);
                if(result['status'] == 'success') {
                    jQuery('#modal-block-edit-group').modal('show');
                    var group = result['group'];
                    jQuery('#edit-group_name').val(group['group_name']);
                    console.log("here get group success", result);
                } else {
                    console.log("here get group error: ");
                }
            },
            error: function () {
                console.log("here get group error: ");
            }
        });
        console.log('here edit group button click: ', groupId, trowId);
    }),

    // edit group modal footer save button handler
    jQuery('#save-group-edit-btn').click(function () {
        var groupTable = jQuery('#group-table').DataTable();
        var groupName = jQuery('#edit-group_name').val();

        if(groupName) {
            var data = {
                id: groupId,
                group_name: groupName
            };
            console.log('here save button is clicked: ', data);

            $.ajax({
                method: "POST",
                url: "/users/updategroup",
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    var result = JSON.parse(response);
                    if(result['status'] == 'success') {
                        console.log("here update user success", result['status']);
                        ($(groupTable.row(trowId).node()).children()[0]).innerHTML = groupName;
                        One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Edit Group Success'});
                    } else {
                        console.log("here update group error", result['status'], result['message']);
                        One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Edit Group Fail'});
                    }
                },
                error: function () {
                    console.log("here update user error: ");
                    One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Edit Group Fail'});
                }
            });

            jQuery('#edit-group_name').val('');
            jQuery('#modal-block-edit-group').modal('hide');
        } else {
            Swal.fire('Please Fill all Fields');
        }
    }),

    // edit group modal footer cancel button handler
    jQuery('#cancel-group-edit-btn').click(function () {
        console.log('here cancel button is clicked: ');
        jQuery('#modal-block-edit-group').modal('hide');
    }),

    //delete group button event handler
    jQuery('.delete-group').click(function () {
        var groupTable = jQuery('#group-table').DataTable();
        groupId = '';
        trowId = '';
        var idArray = ($(this).attr('id')).split('-');
        groupId = idArray[2];
        trowId = idArray[3];
        var data = {
            id: groupId,
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
                    url: "/users/deletegroup",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    success: function (response) {
                        var result = JSON.parse(response);
                        console.log("here delete user success", response);
                        if(result['status'] == 'success') {
                            self.parent().parent().parent().addClass('selected');
                            groupTable.row('.selected').remove().draw(false);
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
        console.log('here delete group button click: ', groupId, trowId);
    }),
);
