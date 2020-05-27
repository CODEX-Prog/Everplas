var paymentId;
var prodCategoryId;
var taskCategoryId;
var itemCategoryId;
var departmentId;
var bankId;
var trowId;

jQuery(document).ready(
    jQuery('#create-payment-method-btn').click(function() {
       jQuery('#create-pay-modal').modal('show');
    }),

    jQuery('#save-pay-create-btn').click(function() {
        var paymentMethodTable = $('#payment-method-table').DataTable();
        var paymentName = $('#create-pay-name').val();
        if(paymentName) {
            var data = {
                name: paymentName,
            };
            $.ajax({
                type: "POST",
                url: '/setting/createpayment',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    var result = JSON.parse(response);
                    if(result['status'] == 'success') {
                        var paymentMethod = result['paymentMethod'];
                        var newRow = paymentMethodTable.row.add([
                            paymentMethod['id'],
                            paymentMethod['name'],
                            "<div>\n" +
                            "</div>"
                        ]).draw();
                        console.log('here new row: ', newRow.index());
                        var newRowNode = newRow.node();
                        $($(newRowNode).children()[2]).addClass('text-center');
                        var buttonWrapper = $($(newRowNode).children()[2]).children()[0];
                        $(buttonWrapper).addClass('btn-group');
                        buttonWrapper.innerHTML =
                            "<button type=\"button\" class=\"btn btn-sm btn-primary edit-pay-btn\"\n" +
                            "</button>\n" +
                            "<button type=\"button\" class=\"btn btn-sm btn-primary delete-pay-btn\"\n" +
                            "</button>";
                        $($(buttonWrapper).children()[0]).attr('id', `edit-pay-${paymentMethod['id']}-${newRow.index()}`);
                        $($(buttonWrapper).children()[1]).attr('id', `delete-pay-${paymentMethod['id']}-${newRow.index()}`);
                        $(buttonWrapper).children()[0].innerHTML = "<i class=\"fa fa-fw fa-pencil-alt\"></i>";
                        $(buttonWrapper).children()[1].innerHTML = "<i class=\"fa fa-fw fa-times\"></i>";
                        jQuery('#create-pay-modal').modal('hide');
                        $('#create-pay-name').val('');
                        $($(buttonWrapper).children()[0]).click(function() {
                            paymentId = '';
                            trowId = '';
                            var idArray = ($(this).attr('id')).split('-');
                            paymentId = idArray[2];
                            trowId = idArray[3];

                            var data = {
                                id: paymentId
                            };

                            $.ajax({
                                method: "GET",
                                url: "/setting/getpayment",
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: data,
                                success: function (response) {
                                    var result = JSON.parse(response);
                                    if(result['status'] == 'success') {
                                        jQuery('#edit-pay-modal').modal('show');
                                        var paymentMethod = result['paymentMethod'];
                                        jQuery('#edit-pay-name').val(paymentMethod['name']);
                                        console.log("here get group success", result);
                                    } else {
                                        console.log("here get group error: ");
                                    }
                                },
                                error: function () {
                                    console.log("here get group error: ");
                                }
                            });
                            console.log('here edit group button click: ', paymentId, trowId);
                        });
                        $($(buttonWrapper).children()[1]).click(function() {
                            var paymentTable = jQuery('#payment-method-table').DataTable();
                            paymentId = '';
                            trowId = '';
                            var idArray = ($(this).attr('id')).split('-');
                            paymentId = idArray[2];
                            trowId = idArray[3];

                            var data = {
                                id: paymentId
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
                                    console.log('here button parent: ', self.parent().parent().parent());
                                    $.ajax({
                                        method: "POST",
                                        url: "/setting/deletepayment",
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        data: data,
                                        success: function (response) {
                                            var result = JSON.parse(response);
                                            console.log("here delete user success", response);
                                            if(result['status'] == 'success') {
                                                self.parent().parent().parent().addClass('selected');
                                                paymentTable.row('.selected').remove().draw(false);
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
                        One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Creat new Payment Method success'});
                    } else {
                        console.log('here create group error: ', result['message']);
                        One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Create Payment Method Fail'});
                    }
                    $('#modal-block-fadein-group').modal('hide');
                },
                error: function () {
                    console.log('here save group ajax error: ');
                    One.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'Create Payment Method Failed!'});
                }
            });
        } else {
            One.helpers('notify', {type: 'danger', icon: 'fa fa-exclamation mr-1', message: 'Please Fill Fields!'});
        }
    }),

    jQuery('#create-product-cat-btn').click(function() {
        jQuery('#create-prod-modal').modal('show');
    }),

    jQuery('#save-prod-cat-create-btn').click(function() {
        var prodCatTable = $('#product-cat-table').DataTable();
        var prodCatName = $('#create-prod-cat-name').val();
        if(prodCatName) {
            var data = {
                name: prodCatName,
            };
            $.ajax({
                type: "POST",
                url: '/setting/createprodcategory',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    var result = JSON.parse(response);
                    if(result['status'] == 'success') {
                        var productCategory = result['productCategory'];
                        var newRow = prodCatTable.row.add([
                            productCategory['id'],
                            productCategory['name'],
                            "<div>\n" +
                            "</div>"
                        ]).draw();
                        console.log('here new row: ', newRow.index());
                        var newRowNode = newRow.node();
                        $($(newRowNode).children()[2]).addClass('text-center');
                        var buttonWrapper = $($(newRowNode).children()[2]).children()[0];
                        $(buttonWrapper).addClass('btn-group');
                        buttonWrapper.innerHTML =
                            "<button type=\"button\" class=\"btn btn-sm btn-primary edit-pay-btn\"\n" +
                            "</button>\n" +
                            "<button type=\"button\" class=\"btn btn-sm btn-primary delete-pay-btn\"\n" +
                            "</button>";
                        $($(buttonWrapper).children()[0]).attr('id', `edit-pay-${productCategory['id']}-${newRow.index()}`);
                        $($(buttonWrapper).children()[1]).attr('id', `delete-pay-${productCategory['id']}-${newRow.index()}`);
                        $(buttonWrapper).children()[0].innerHTML = "<i class=\"fa fa-fw fa-pencil-alt\"></i>";
                        $(buttonWrapper).children()[1].innerHTML = "<i class=\"fa fa-fw fa-times\"></i>";
                        jQuery('#create-prod-modal').modal('hide');
                        $('#create-prod-cat-name').val('');
                        $($(buttonWrapper).children()[0]).click(function() {
                            prodCategoryId = '';
                            trowId = '';
                            var idArray = ($(this).attr('id')).split('-');
                            prodCategoryId = idArray[2];
                            trowId = idArray[3];

                            var data = {
                                id: prodCategoryId
                            };

                            $.ajax({
                                method: "GET",
                                url: "/setting/getprodcategory",
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: data,
                                success: function (response) {
                                    var result = JSON.parse(response);
                                    if(result['status'] == 'success') {
                                        var productCategory = result['productCategory'];
                                        jQuery('#edit-prod-cat-name').val(productCategory['name']);
                                        jQuery('#edit-prod-modal').modal('show');
                                        console.log("here get group success", result);
                                    } else {
                                        console.log("here get group error: ");
                                    }
                                },
                                error: function () {
                                    console.log("here get group error: ");
                                }
                            });
                            console.log('here edit group button click: ', prodCategoryId, trowId);
                        });
                        $($(buttonWrapper).children()[1]).click(function() {
                            var prodCatTable = jQuery('#product-cat-table').DataTable();
                            prodCategoryId = '';
                            trowId = '';
                            var idArray = ($(this).attr('id')).split('-');
                            prodCategoryId = idArray[2];
                            trowId = idArray[3];

                            var data = {
                                id: prodCategoryId
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
                                        url: "/setting/deleteprodcategory",
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        data: data,
                                        success: function (response) {
                                            var result = JSON.parse(response);
                                            console.log("here delete user success", response);
                                            if(result['status'] == 'success') {
                                                self.parent().parent().parent().addClass('selected');
                                                prodCatTable.row('.selected').remove().draw(false);
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
                        One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Creat new Product Category success'});
                    } else {
                        console.log('here create group error: ', result['message']);
                        One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Create Product Category Fail'});
                    }
                    $('#modal-block-fadein-group').modal('hide');
                },
                error: function () {
                    console.log('here save group ajax error: ');
                    One.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'Create Product Category Failed!'});
                }
            });
        } else {
            One.helpers('notify', {type: 'danger', icon: 'fa fa-exclamation mr-1', message: 'Please Fill Fields!'});
        }
    }),

    jQuery('#create-task-cat-btn').click(function() {
        jQuery('#create-task-modal').modal('show');
    }),

    jQuery('#save-create-task-cat-btn').click(function() {
        var taskCatTable = $('#task-cat-table').DataTable();
        var taskCatName = $('#create-task-cat-name').val();
        if(taskCatName) {
            var data = {
                name: taskCatName,
            };
            $.ajax({
                type: "POST",
                url: '/setting/createtaskcategory',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    var result = JSON.parse(response);
                    if(result['status'] == 'success') {
                        var taskCategory = result['taskCategory'];
                        var newRow = taskCatTable.row.add([
                            taskCategory['id'],
                            taskCategory['name'],
                            "<div>\n" +
                            "</div>"
                        ]).draw();
                        console.log('here new row: ', newRow.index());
                        var newRowNode = newRow.node();
                        $($(newRowNode).children()[2]).addClass('text-center');
                        var buttonWrapper = $($(newRowNode).children()[2]).children()[0];
                        $(buttonWrapper).addClass('btn-group');
                        buttonWrapper.innerHTML =
                            "<button type=\"button\" class=\"btn btn-sm btn-primary edit-pay-btn\"\n" +
                            "</button>\n" +
                            "<button type=\"button\" class=\"btn btn-sm btn-primary delete-pay-btn\"\n" +
                            "</button>";
                        $($(buttonWrapper).children()[0]).attr('id', `edit-pay-${taskCategory['id']}-${newRow.index()}`);
                        $($(buttonWrapper).children()[1]).attr('id', `delete-pay-${taskCategory['id']}-${newRow.index()}`);
                        $(buttonWrapper).children()[0].innerHTML = "<i class=\"fa fa-fw fa-pencil-alt\"></i>";
                        $(buttonWrapper).children()[1].innerHTML = "<i class=\"fa fa-fw fa-times\"></i>";
                        jQuery('#create-task-modal').modal('hide');
                        $('#create-task-cat-name').val('');
                        $($(buttonWrapper).children()[0]).click(function() {
                            taskCategoryId = '';
                            trowId = '';
                            var idArray = ($(this).attr('id')).split('-');
                            taskCategoryId = idArray[2];
                            trowId = idArray[3];

                            var data = {
                                id: taskCategoryId
                            };

                            $.ajax({
                                method: "GET",
                                url: "/setting/gettaskcategory",
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: data,
                                success: function (response) {
                                    var result = JSON.parse(response);
                                    if(result['status'] == 'success') {
                                        var taskCategory = result['taskCategory'];
                                        jQuery('#edit-task-cat-name').val(taskCategory['name']);
                                        jQuery('#edit-task-modal').modal('show');
                                        console.log("here get group success", result);
                                    } else {
                                        console.log("here get group error: ");
                                    }
                                },
                                error: function () {
                                    console.log("here get group error: ");
                                }
                            });
                            console.log('here edit group button click: ', taskCategoryId, trowId);
                        });
                        $($(buttonWrapper).children()[1]).click(function() {
                            var taskCatTable = jQuery('#task-cat-table').DataTable();
                            taskCategoryId = '';
                            trowId = '';
                            var idArray = ($(this).attr('id')).split('-');
                            taskCategoryId = idArray[2];
                            trowId = idArray[3];

                            var data = {
                                id: taskCategoryId
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
                                        url: "/setting/deletetaskcategory",
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        data: data,
                                        success: function (response) {
                                            var result = JSON.parse(response);
                                            console.log("here delete user success", response);
                                            if(result['status'] == 'success') {
                                                self.parent().parent().parent().addClass('selected');
                                                taskCatTable.row('.selected').remove().draw(false);
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
                        One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Creat new Task Category success'});
                    } else {
                        console.log('here create group error: ', result['message']);
                        One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Create Task Category Fail'});
                    }
                    $('#modal-block-fadein-group').modal('hide');
                },
                error: function () {
                    console.log('here save group ajax error: ');
                    One.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'Create Task Category Failed!'});
                }
            });
        } else {
            One.helpers('notify', {type: 'danger', icon: 'fa fa-exclamation mr-1', message: 'Please Fill Fields!'});
        }
    }),

    jQuery('#create-item-cat-btn').click(function() {
        jQuery('#create-item-modal').modal('show');
    }),

    jQuery('#save-item-cat-create-btn').click(function() {
        var itemCatTable = $('#item-cat-table').DataTable();
        var itemCatName = $('#create-item-cat-name').val();
        if(itemCatName) {
            var data = {
                name: itemCatName,
            };
            $.ajax({
                type: "POST",
                url: '/setting/createitemcategory',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    var result = JSON.parse(response);
                    if(result['status'] == 'success') {
                        var itemCategory = result['itemCategory'];
                        var newRow = itemCatTable.row.add([
                            itemCategory['id'],
                            itemCategory['name'],
                            "<div>\n" +
                            "</div>"
                        ]).draw();
                        console.log('here new row: ', newRow.index());
                        var newRowNode = newRow.node();
                        $($(newRowNode).children()[2]).addClass('text-center');
                        var buttonWrapper = $($(newRowNode).children()[2]).children()[0];
                        $(buttonWrapper).addClass('btn-group');
                        buttonWrapper.innerHTML =
                            "<button type=\"button\" class=\"btn btn-sm btn-primary edit-pay-btn\"\n" +
                            "</button>\n" +
                            "<button type=\"button\" class=\"btn btn-sm btn-primary delete-pay-btn\"\n" +
                            "</button>";
                        $($(buttonWrapper).children()[0]).attr('id', `edit-pay-${itemCategory['id']}-${newRow.index()}`);
                        $($(buttonWrapper).children()[1]).attr('id', `delete-pay-${itemCategory['id']}-${newRow.index()}`);
                        $(buttonWrapper).children()[0].innerHTML = "<i class=\"fa fa-fw fa-pencil-alt\"></i>";
                        $(buttonWrapper).children()[1].innerHTML = "<i class=\"fa fa-fw fa-times\"></i>";
                        jQuery('#create-item-modal').modal('hide');
                        $('#create-item-cat-name').val('');
                        $($(buttonWrapper).children()[0]).click(function() {
                            itemCategoryId = '';
                            trowId = '';
                            var idArray = ($(this).attr('id')).split('-');
                            itemCategoryId = idArray[2];
                            trowId = idArray[3];

                            var data = {
                                id: itemCategoryId
                            };

                            $.ajax({
                                method: "GET",
                                url: "/setting/getitemcategory",
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: data,
                                success: function (response) {
                                    var result = JSON.parse(response);
                                    if(result['status'] == 'success') {
                                        var itemCategory = result['itemCategory'];
                                        jQuery('#edit-item-cat-name').val(itemCategory['name']);
                                        jQuery('#edit-item-modal').modal('show');
                                        console.log("here get group success", result);
                                    } else {
                                        console.log("here get group error: ");
                                    }
                                },
                                error: function () {
                                    console.log("here get group error: ");
                                }
                            });
                            console.log('here edit group button click: ', taskCategoryId, trowId);
                        });
                        $($(buttonWrapper).children()[1]).click(function() {
                            var itemCatTable = jQuery('#item-cat-table').DataTable();
                            itemCategoryId = '';
                            trowId = '';
                            var idArray = ($(this).attr('id')).split('-');
                            itemCategoryId = idArray[2];
                            trowId = idArray[3];

                            var data = {
                                id: itemCategoryId
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
                                    console.log('here button parent: ', self.parent().parent().parent());
                                    $.ajax({
                                        method: "POST",
                                        url: "/setting/deleteitemcategory",
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        data: data,
                                        success: function (response) {
                                            var result = JSON.parse(response);
                                            console.log("here delete user success", response);
                                            if(result['status'] == 'success') {
                                                self.parent().parent().parent().addClass('selected');
                                                itemCatTable.row('.selected').remove().draw(false);
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

                        One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Creat new Item Category success'});
                    } else {
                        console.log('here create group error: ', result['message']);
                        One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Create Item Category Fail'});
                    }
                    $('#modal-block-fadein-group').modal('hide');
                },
                error: function () {
                    console.log('here save group ajax error: ');
                    One.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'Create Item Category Failed!'});
                }
            });
        } else {
            One.helpers('notify', {type: 'danger', icon: 'fa fa-exclamation mr-1', message: 'Please Fill Fields!'});
        }
    }),

    jQuery('.edit-pay-btn').click(function() {
        paymentId = '';
        trowId = '';
        var idArray = ($(this).attr('id')).split('-');
        paymentId = idArray[2];
        trowId = idArray[3];

        var data = {
            id: paymentId
        };

        $.ajax({
            method: "GET",
            url: "/setting/getpayment",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: data,
            success: function (response) {
                var result = JSON.parse(response);
                if(result['status'] == 'success') {
                    jQuery('#edit-pay-modal').modal('show');
                    var paymentMethod = result['paymentMethod'];
                    jQuery('#edit-pay-name').val(paymentMethod['name']);
                    console.log("here get group success", result);
                } else {
                    console.log("here get group error: ");
                }
            },
            error: function () {
                console.log("here get group error: ");
            }
        });
        console.log('here edit group button click: ', paymentId, trowId);
    }),

    jQuery('#save-pay-edit-btn').click(function() {
        var paymentTable = jQuery('#payment-method-table').DataTable();
        var paymentMethodName = jQuery('#edit-pay-name').val();
        if(paymentMethodName) {
            var data = {
                id: paymentId,
                name: paymentMethodName
            };
            $.ajax({
                method: "POST",
                url: "/setting/updatepayment",
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    var result = JSON.parse(response);
                    if(result['status'] == 'success') {
                        console.log("here update user success", result['status']);
                        $(paymentTable.row(trowId).node()).children()[1].innerHTML = paymentMethodName;
                        One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Edit Payment Method Success'});
                    } else {
                        console.log("here update group error", result['status'], result['message']);
                        One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Edit Payment Method Fail'});
                    }
                },
                error: function () {
                    console.log("here update user error: ");
                    One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Edit Payment Method Fail'});
                }
            });
            jQuery('#edit-pay-name').val('');
            jQuery('#edit-pay-modal').modal('hide');
        } else {
            One.helpers('notify', {type: 'danger', icon: 'fa fa-exclamation mr-1', message: 'Please Fill Fields!'});
        }
    }),

    jQuery('.edit-prod-cat-btn').click(function() {
        prodCategoryId = '';
        trowId = '';
        var idArray = ($(this).attr('id')).split('-');
        prodCategoryId = idArray[2];
        trowId = idArray[3];

        var data = {
            id: prodCategoryId
        };

        $.ajax({
            method: "GET",
            url: "/setting/getprodcategory",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: data,
            success: function (response) {
                var result = JSON.parse(response);
                if(result['status'] == 'success') {
                    var productCategory = result['productCategory'];
                    jQuery('#edit-prod-cat-name').val(productCategory['name']);
                    jQuery('#edit-prod-modal').modal('show');
                    console.log("here get group success", result);
                } else {
                    console.log("here get group error: ");
                }
            },
            error: function () {
                console.log("here get group error: ");
            }
        });
        console.log('here edit group button click: ', prodCategoryId, trowId);
    }),

    jQuery('#save-prod-cat-edit-btn').click(function() {
        var prodCatTable = jQuery('#product-cat-table').DataTable();
        var prodCatName = jQuery('#edit-prod-cat-name').val();
        if(prodCatName) {
            var data = {
                id: prodCategoryId,
                name: prodCatName
            };
            $.ajax({
                method: "POST",
                url: "/setting/updateprodcategory",
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    var result = JSON.parse(response);
                    if(result['status'] == 'success') {
                        console.log("here update user success", result['status']);
                        $(prodCatTable.row(trowId).node()).children()[1].innerHTML = prodCatName;
                        One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Edit Payment Method Success'});
                    } else {
                        console.log("here update group error", result['status'], result['message']);
                        One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Edit Payment Method Fail'});
                    }
                },
                error: function () {
                    console.log("here update user error: ");
                    One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Edit Payment Method Fail'});
                }
            });
            jQuery('#edit-prod-cat-name').val('');
            jQuery('#edit-prod-modal').modal('hide');
        } else {
            One.helpers('notify', {type: 'danger', icon: 'fa fa-exclamation mr-1', message: 'Please Fill Fields!'});
        }
    }),

    jQuery('.edit-task-cat-btn').click(function() {
        taskCategoryId = '';
        trowId = '';
        var idArray = ($(this).attr('id')).split('-');
        taskCategoryId = idArray[2];
        trowId = idArray[3];

        var data = {
            id: taskCategoryId
        };

        $.ajax({
            method: "GET",
            url: "/setting/gettaskcategory",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: data,
            success: function (response) {
                var result = JSON.parse(response);
                if(result['status'] == 'success') {
                    var taskCategory = result['taskCategory'];
                    jQuery('#edit-task-cat-name').val(taskCategory['name']);
                    jQuery('#edit-task-modal').modal('show');
                    console.log("here get group success", result);
                } else {
                    console.log("here get group error: ");
                }
            },
            error: function () {
                console.log("here get group error: ");
            }
        });
        console.log('here edit group button click: ', taskCategoryId, trowId);
    }),

    jQuery('#save-task-cat-edit-btn').click(function() {
        var taskCatTable = jQuery('#task-cat-table').DataTable();
        var taskCatName = jQuery('#edit-task-cat-name').val();
        if(taskCatName) {
            var data = {
                id: taskCategoryId,
                name: taskCatName
            };
            $.ajax({
                method: "POST",
                url: "/setting/updatetaskcategory",
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    var result = JSON.parse(response);
                    if(result['status'] == 'success') {
                        console.log("here update user success", result['status']);
                        $(taskCatTable.row(trowId).node()).children()[1].innerHTML = taskCatName;
                        One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Edit Task Category Success'});
                    } else {
                        console.log("here update group error", result['status'], result['message']);
                        One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Edit Task Category Fail'});
                    }
                },
                error: function () {
                    console.log("here update user error: ");
                    One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Edit Task Category Fail'});
                }
            });
            jQuery('#edit-task-modal').modal('hide');
            jQuery('#edit-task-cat-name').val('');
        } else {
            One.helpers('notify', {type: 'danger', icon: 'fa fa-exclamation mr-1', message: 'Please Fill Fields!'});
        }
    }),

    jQuery('.edit-item-cat-btn').click(function() {
        itemCategoryId = '';
        trowId = '';
        var idArray = ($(this).attr('id')).split('-');
        itemCategoryId = idArray[2];
        trowId = idArray[3];

        var data = {
            id: itemCategoryId
        };

        $.ajax({
            method: "GET",
            url: "/setting/getitemcategory",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: data,
            success: function (response) {
                var result = JSON.parse(response);
                if(result['status'] == 'success') {
                    var itemCategory = result['itemCategory'];
                    jQuery('#edit-item-cat-name').val(itemCategory['name']);
                    jQuery('#edit-item-modal').modal('show');
                    console.log("here get group success", result);
                } else {
                    console.log("here get group error: ");
                }
            },
            error: function () {
                console.log("here get group error: ");
            }
        });
        console.log('here edit group button click: ', taskCategoryId, trowId);
    }),

    jQuery('#save-item-cat-edit-btn').click(function() {
        var itemCatTable = jQuery('#item-cat-table').DataTable();
        var itemCatName = jQuery('#edit-item-cat-name').val();
        if(itemCatName) {
            var data = {
                id: itemCategoryId,
                name: itemCatName
            };
            $.ajax({
                method: "POST",
                url: "/setting/updateitemcategory",
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    var result = JSON.parse(response);
                    if(result['status'] == 'success') {
                        console.log("here update user success", result['status']);
                        $(itemCatTable.row(trowId).node()).children()[1].innerHTML = itemCatName;
                        One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Edit Item Category Success'});
                    } else {
                        console.log("here update group error", result['status'], result['message']);
                        One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Edit Item Category Fail'});
                    }
                },
                error: function () {
                    console.log("here update user error: ");
                    One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Edit Item Category Fail'});
                }
            });
            jQuery('#edit-item-modal').modal('hide');
            jQuery('#edit-item-cat-name').val('');
        } else {
            One.helpers('notify', {type: 'danger', icon: 'fa fa-exclamation mr-1', message: 'Please Fill Fields!'});
        }
    }),

    jQuery('.delete-pay-btn').click(function() {
        var paymentTable = jQuery('#payment-method-table').DataTable();
        paymentId = '';
        trowId = '';
        var idArray = ($(this).attr('id')).split('-');
        paymentId = idArray[2];
        trowId = idArray[3];

        var data = {
            id: paymentId
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
                console.log('here button parent: ', self.parent().parent().parent());
                $.ajax({
                    method: "POST",
                    url: "/setting/deletepayment",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    success: function (response) {
                        var result = JSON.parse(response);
                        console.log("here delete user success", response);
                        if(result['status'] == 'success') {
                            self.parent().parent().parent().addClass('selected');
                            paymentTable.row('.selected').remove().draw(false);
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
    }),

    jQuery('.delete-prod-cat-btn').click(function() {
        var prodCatTable = jQuery('#product-cat-table').DataTable();
        prodCategoryId = '';
        trowId = '';
        var idArray = ($(this).attr('id')).split('-');
        prodCategoryId = idArray[2];
        trowId = idArray[3];

        var data = {
            id: prodCategoryId
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
                    url: "/setting/deleteprodcategory",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    success: function (response) {
                        var result = JSON.parse(response);
                        console.log("here delete user success", response);
                        if(result['status'] == 'success') {
                            self.parent().parent().parent().addClass('selected');
                            prodCatTable.row('.selected').remove().draw(false);
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
    }),

    jQuery('.delete-task-cat-btn').click(function() {
        var taskCatTable = jQuery('#task-cat-table').DataTable();
        taskCategoryId = '';
        trowId = '';
        var idArray = ($(this).attr('id')).split('-');
        taskCategoryId = idArray[2];
        trowId = idArray[3];

        var data = {
            id: taskCategoryId
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
                    url: "/setting/deletetaskcategory",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    success: function (response) {
                        var result = JSON.parse(response);
                        console.log("here delete user success", response);
                        if(result['status'] == 'success') {
                            self.parent().parent().parent().addClass('selected');
                            taskCatTable.row('.selected').remove().draw(false);
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
    }),

    jQuery('.delete-item-cat-btn').click(function() {
        var itemCatTable = jQuery('#item-cat-table').DataTable();
        itemCategoryId = '';
        trowId = '';
        var idArray = ($(this).attr('id')).split('-');
        itemCategoryId = idArray[2];
        trowId = idArray[3];

        var data = {
            id: itemCategoryId
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
                console.log('here button parent: ', self.parent().parent().parent());
                $.ajax({
                    method: "POST",
                    url: "/setting/deleteitemcategory",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    success: function (response) {
                        var result = JSON.parse(response);
                        console.log("here delete user success", response);
                        if(result['status'] == 'success') {
                            self.parent().parent().parent().addClass('selected');
                            itemCatTable.row('.selected').remove().draw(false);
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
    }),

    // Department create update read delete
    jQuery('#create-department-btn').click(function() {
        jQuery('#create-department-modal').modal('show');
    }),

    jQuery('#save-department-create-btn').click(function() {
        var departmentTable = $('#department-table').DataTable();
        var departmentName = $('#create-department-name').val();
        if(departmentName) {
            var data = {
                name: departmentName,
            };
            $.ajax({
                type: "POST",
                url: '/setting/createdepartment',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    var result = JSON.parse(response);
                    if(result['status'] == 'success') {
                        var department = result['department'];
                        var newRow = departmentTable.row.add([
                            department['id'],
                            department['name'],
                            "<div>\n" +
                            "</div>"
                        ]).draw();
                        console.log('here new row: ', newRow.index());
                        var newRowNode = newRow.node();
                        $($(newRowNode).children()[2]).addClass('text-center');
                        var buttonWrapper = $($(newRowNode).children()[2]).children()[0];
                        $(buttonWrapper).addClass('btn-group');
                        buttonWrapper.innerHTML =
                            "<button type=\"button\" class=\"btn btn-sm btn-primary edit-pay-btn\"\n" +
                            "</button>\n" +
                            "<button type=\"button\" class=\"btn btn-sm btn-primary delete-pay-btn\"\n" +
                            "</button>";
                        $($(buttonWrapper).children()[0]).attr('id', `edit-pay-${department['id']}-${newRow.index()}`);
                        $($(buttonWrapper).children()[1]).attr('id', `delete-pay-${department['id']}-${newRow.index()}`);
                        $(buttonWrapper).children()[0].innerHTML = "<i class=\"fa fa-fw fa-pencil-alt\"></i>";
                        $(buttonWrapper).children()[1].innerHTML = "<i class=\"fa fa-fw fa-times\"></i>";
                        jQuery('#create-department-modal').modal('hide');
                        $('#create-department-name').val('');
                        $($(buttonWrapper).children()[0]).click(function() {
                            departmentId = '';
                            trowId = '';
                            var idArray = ($(this).attr('id')).split('-');
                            departmentId = idArray[2];
                            trowId = idArray[3];

                            var data = {
                                id: departmentId
                            };

                            $.ajax({
                                method: "GET",
                                url: "/setting/getdepartment",
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: data,
                                success: function (response) {
                                    var result = JSON.parse(response);
                                    if(result['status'] == 'success') {
                                        var department = result['department'];
                                        jQuery('#edit-department-name').val(department['name']);
                                        jQuery('#edit-department-modal').modal('show');
                                        console.log("here get group success", result);
                                    } else {
                                        console.log("here get group error: ");
                                    }
                                },
                                error: function () {
                                    console.log("here get group error: ");
                                }
                            });
                            console.log('here edit group button click: ', departmentId, trowId);
                        });
                        $($(buttonWrapper).children()[1]).click(function() {
                            var departmentTable = jQuery('#department-table').DataTable();
                            departmentId = '';
                            trowId = '';
                            var idArray = ($(this).attr('id')).split('-');
                            departmentId = idArray[2];
                            trowId = idArray[3];

                            var data = {
                                id: departmentId
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
                                    console.log('here button parent: ', self.parent().parent().parent());
                                    $.ajax({
                                        method: "POST",
                                        url: "/setting/deletedepartment",
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        data: data,
                                        success: function (response) {
                                            var result = JSON.parse(response);
                                            console.log("here delete user success", response);
                                            if(result['status'] == 'success') {
                                                self.parent().parent().parent().addClass('selected');
                                                departmentTable.row('.selected').remove().draw(false);
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

                        One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Creat new Item Department success'});
                    } else {
                        console.log('here create group error: ', result['message']);
                        One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Create Item Department Fail'});
                    }
                    $('#create-department-modal').modal('hide');
                },
                error: function () {
                    console.log('here save group ajax error: ');
                    One.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'Create Item Department Failed!'});
                }
            });
        } else {
            One.helpers('notify', {type: 'danger', icon: 'fa fa-exclamation mr-1', message: 'Please Fill Fields!'});
        }
    }),

    jQuery('.edit-department-btn').click(function() {
        departmentId = '';
        trowId = '';
        var idArray = ($(this).attr('id')).split('-');
        departmentId = idArray[2];
        trowId = idArray[3];

        var data = {
            id: departmentId
        };

        $.ajax({
            method: "GET",
            url: "/setting/getdepartment",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: data,
            success: function (response) {
                var result = JSON.parse(response);
                if(result['status'] == 'success') {
                    var department = result['department'];
                    jQuery('#edit-department-name').val(department['name']);
                    jQuery('#edit-department-modal').modal('show');
                    console.log("here get group success", result);
                } else {
                    console.log("here get group error: ");
                }
            },
            error: function () {
                console.log("here get group error: ");
            }
        });
        console.log('here edit group button click: ', departmentId, trowId);
    }),

    jQuery('#save-department-edit-btn').click(function() {
        var departmentTable = jQuery('#department-table').DataTable();
        var departmentName = jQuery('#edit-department-name').val();
        if(departmentName) {
            var data = {
                id: departmentId,
                name: departmentName
            };
            $.ajax({
                method: "POST",
                url: "/setting/updatedepartment",
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    var result = JSON.parse(response);
                    if(result['status'] == 'success') {
                        console.log("here update user success", result['status']);
                        $(departmentTable.row(trowId).node()).children()[1].innerHTML = departmentName;
                        One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Edit Department Success'});
                    } else {
                        console.log("here update group error", result['status'], result['message']);
                        One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Edit Department Fail'});
                    }
                },
                error: function () {
                    console.log("here update user error: ");
                    One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Edit Department Fail'});
                }
            });
            jQuery('#edit-department-modal').modal('hide');
            jQuery('#edit-department-name').val('');
        } else {
            One.helpers('notify', {type: 'danger', icon: 'fa fa-exclamation mr-1', message: 'Please Fill Fields!'});
        }
    }),

    jQuery('.delete-department-btn').click(function() {
        var departmentTable = jQuery('#department-table').DataTable();
        departmentId = '';
        trowId = '';
        var idArray = ($(this).attr('id')).split('-');
        departmentId = idArray[2];
        trowId = idArray[3];

        var data = {
            id: departmentId
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
                console.log('here button parent: ', self.parent().parent().parent());
                $.ajax({
                    method: "POST",
                    url: "/setting/deletedepartment",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    success: function (response) {
                        var result = JSON.parse(response);
                        console.log("here delete user success", response);
                        if(result['status'] == 'success') {
                            self.parent().parent().parent().addClass('selected');
                            departmentTable.row('.selected').remove().draw(false);
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        } else {
                            One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Delete Department Failed!'});
                        }
                    },
                    error: function () {
                        console.log("here update user error: ");
                        One.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'Delete Department Failed!'});
                    }
                });
            }
        });
    }),

    // Bank create update read delete
    jQuery('#create-bank-btn').click(function() {
        jQuery('#create-bank-modal').modal('show');
    }),

    jQuery('#save-bank-create-btn').click(function() {
        var bankTable = $('#bank-table').DataTable();
        var bankName = $('#create-bank-name').val();
        if(bankName) {
            var data = {
                name: bankName,
            };
            $.ajax({
                type: "POST",
                url: '/setting/createbank',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    var result = JSON.parse(response);
                    if(result['status'] == 'success') {
                        var bank = result['bank'];
                        var newRow = bankTable.row.add([
                            bank['id'],
                            bank['name'],
                            "<div>\n" +
                            "</div>"
                        ]).draw();
                        console.log('here new row: ', newRow.index());
                        var newRowNode = newRow.node();
                        $($(newRowNode).children()[2]).addClass('text-center');
                        var buttonWrapper = $($(newRowNode).children()[2]).children()[0];
                        $(buttonWrapper).addClass('btn-group');
                        buttonWrapper.innerHTML =
                            "<button type=\"button\" class=\"btn btn-sm btn-primary edit-pay-btn\"\n" +
                            "</button>\n" +
                            "<button type=\"button\" class=\"btn btn-sm btn-primary delete-pay-btn\"\n" +
                            "</button>";
                        $($(buttonWrapper).children()[0]).attr('id', `edit-pay-${bank['id']}-${newRow.index()}`);
                        $($(buttonWrapper).children()[1]).attr('id', `delete-pay-${bank['id']}-${newRow.index()}`);
                        $(buttonWrapper).children()[0].innerHTML = "<i class=\"fa fa-fw fa-pencil-alt\"></i>";
                        $(buttonWrapper).children()[1].innerHTML = "<i class=\"fa fa-fw fa-times\"></i>";
                        jQuery('#create-bank-modal').modal('hide');
                        $('#create-bank-name').val('');
                        $($(buttonWrapper).children()[0]).click(function() {
                            bankId = '';
                            trowId = '';
                            var idArray = ($(this).attr('id')).split('-');
                            bankId = idArray[2];
                            trowId = idArray[3];

                            var data = {
                                id: bankId
                            };

                            $.ajax({
                                method: "GET",
                                url: "/setting/getbank",
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: data,
                                success: function (response) {
                                    var result = JSON.parse(response);
                                    if(result['status'] == 'success') {
                                        var bank = result['bank'];
                                        jQuery('#edit-bank-name').val(bank['name']);
                                        jQuery('#edit-bank-modal').modal('show');
                                        console.log("here get group success", result);
                                    } else {
                                        console.log("here get group error: ");
                                    }
                                },
                                error: function () {
                                    console.log("here get group error: ");
                                }
                            });
                            console.log('here edit group button click: ', departmentId, trowId);
                        });
                        $($(buttonWrapper).children()[1]).click(function() {
                            var bankTable = jQuery('#bank-table').DataTable();
                            bankId = '';
                            trowId = '';
                            var idArray = ($(this).attr('id')).split('-');
                            bankId = idArray[2];
                            trowId = idArray[3];

                            var data = {
                                id: bankId
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
                                    console.log('here button parent: ', self.parent().parent().parent());
                                    $.ajax({
                                        method: "POST",
                                        url: "/setting/deletebank",
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        data: data,
                                        success: function (response) {
                                            var result = JSON.parse(response);
                                            console.log("here delete user success", response);
                                            if(result['status'] == 'success') {
                                                self.parent().parent().parent().addClass('selected');
                                                bankTable.row('.selected').remove().draw(false);
                                                Swal.fire(
                                                    'Deleted!',
                                                    'Your file has been deleted.',
                                                    'success'
                                                )
                                            } else {
                                                One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Delete Bank Failed!'});
                                            }
                                        },
                                        error: function () {
                                            console.log("here update user error: ");
                                            One.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'Delete Bank Failed!'});
                                        }
                                    });
                                }
                            });
                        });

                        One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Creat new Bank success'});
                    } else {
                        console.log('here create group error: ', result['message']);
                        One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Create Bank Fail'});
                    }
                    $('#create-department-modal').modal('hide');
                },
                error: function () {
                    console.log('here save group ajax error: ');
                    One.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'Create Bank Failed!'});
                }
            });
        } else {
            One.helpers('notify', {type: 'danger', icon: 'fa fa-exclamation mr-1', message: 'Please Fill Fields!'});
        }
    }),

    jQuery('.edit-bank-btn').click(function() {
        bankId = '';
        trowId = '';
        var idArray = ($(this).attr('id')).split('-');
        bankId = idArray[2];
        trowId = idArray[3];

        var data = {
            id: bankId
        };

        $.ajax({
            method: "GET",
            url: "/setting/getbank",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: data,
            success: function (response) {
                var result = JSON.parse(response);
                if(result['status'] == 'success') {
                    var bank = result['bank'];
                    jQuery('#edit-bank-name').val(bank['name']);
                    jQuery('#edit-bank-modal').modal('show');
                    console.log("here get group success", result);
                } else {
                    console.log("here get group error: ");
                }
            },
            error: function () {
                console.log("here get group error: ");
            }
        });
        console.log('here edit group button click: ', bankId, trowId);
    }),

    jQuery('#save-bank-edit-btn').click(function() {
        var bankTable = jQuery('#bank-table').DataTable();
        var bankName = jQuery('#edit-bank-name').val();
        if(bankName) {
            var data = {
                id: bankId,
                name: bankName
            };
            $.ajax({
                method: "POST",
                url: "/setting/updatebank",
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    var result = JSON.parse(response);
                    if(result['status'] == 'success') {
                        console.log("here update user success", result['status']);
                        $(bankTable.row(trowId).node()).children()[1].innerHTML = bankName;
                        One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Edit Bank Success'});
                    } else {
                        console.log("here update group error", result['status'], result['message']);
                        One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Edit Bank Fail'});
                    }
                },
                error: function () {
                    console.log("here update user error: ");
                    One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Edit Bank Fail'});
                }
            });
            jQuery('#edit-bank-modal').modal('hide');
            jQuery('#edit-bank-name').val('');
        } else {
            One.helpers('notify', {type: 'danger', icon: 'fa fa-exclamation mr-1', message: 'Please Fill Fields!'});
        }
    }),

    jQuery('.delete-bank-btn').click(function() {
        var bankTable = jQuery('#bank-table').DataTable();
        bankId = '';
        trowId = '';
        var idArray = ($(this).attr('id')).split('-');
        bankId = idArray[2];
        trowId = idArray[3];

        var data = {
            id: bankId
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
                console.log('here button parent: ', self.parent().parent().parent());
                $.ajax({
                    method: "POST",
                    url: "/setting/deletebank",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    success: function (response) {
                        var result = JSON.parse(response);
                        console.log("here delete user success", response);
                        if(result['status'] == 'success') {
                            self.parent().parent().parent().addClass('selected');
                            bankTable.row('.selected').remove().draw(false);
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        } else {
                            One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Delete Bank Failed!'});
                        }
                    },
                    error: function () {
                        console.log("here update user error: ");
                        One.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'Delete Bank Failed!'});
                    }
                });
            }
        });
    }),
);
