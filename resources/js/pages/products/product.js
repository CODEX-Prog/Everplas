jQuery(document).ready(function () {
    /**
     * Material Select2 implementation
     * */
    jQuery('#material-select2').select2({
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

    /**
     * Category Select2 implementation
     * */
    jQuery('.category-select2').select2({
        ajax: {
            url: function (params) {
                if(params.term) {
                    return '/setting/products/' + params.term;
                } else {
                    return '/setting/products/';
                }
            },
            dataType: 'json',
            processResults: function (data) {
                var categories = data['categories'];
                var categoryArray = categories.map((item, index) => {
                    var temp = {
                        id: item['id'],
                        text: item['name']
                    };
                    return temp;
                });

                return {
                    results: categoryArray
                };
            }
        }
    })

    /**
     * Delete Product event handler
     * */
    jQuery('.delete-product-btn').click(function () {
        var productTable = jQuery('#product-table').DataTable();
        var productId = '';
        var trowId = '';
        var idArray = ($(this).attr('id')).split('-');
        productId = idArray[2];
        trowId = idArray[3];
        var data = {
            id: productId,
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
                    url: "/products/product/delete",
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        var result = JSON.parse(response);
                        if(result['status'] == 'success') {
                            self.parent().parent().parent().addClass('selected');
                            productTable.row('.selected').remove().draw(false);
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        } else {
                            One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Delete Product Success'});
                        }
                    },
                    error: function () {
                        console.log("here update user error: ");
                        One.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'Delete Product Failed!'});
                    }
                });
            }
        });
        console.log('here delete company button clicked');
    });
});
