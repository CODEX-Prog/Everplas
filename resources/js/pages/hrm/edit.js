jQuery(document).ready(function () {
    jQuery('.edit-employee-department-select2').select2({
        ajax: {
            url: function (params) {
                if(params.term) {
                    return '/setting/getdepartments/' + params.term;
                } else {
                    return '/setting/getdepartments/';
                }
            },
            dataType: 'json',
            processResults: function (data) {
                var departments = data.departments;
                var departmentArray = departments.map((item, index) => {
                    var temp = {
                        id: item.id,
                        text: item.name
                    };
                    return temp;
                });
                return {
                    results: departmentArray
                };
            }
        }
    });

    jQuery('.edit-employee-bank-select2').select2({
        ajax: {
            url: function (params) {
                if(params.term) {
                    return '/setting/getbanks/' + params.term;
                } else {
                    return '/setting/getbanks/';
                }
            },
            dataType: 'json',
            processResults: function (data) {
                var banks = data.banks;
                var bankArray = banks.map((item, index) => {
                    var temp = {
                        id: item.id,
                        text: item.name
                    };
                    return temp;
                });
                return {
                    results: bankArray
                };
            }
        }
    })
});
