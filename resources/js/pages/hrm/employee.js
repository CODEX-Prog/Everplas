// global variables
var employeeId;
var trowId;
var dataEmp;
var fileName;
var fd;
var userViewPermission = false;
var userDeletePermission = false;
var userUpdatePermission = false;
var userCreatePermission = false;
var crmViewPermission = false;
var crmDeletePermission = false;
var crmUpdatePermission = false;
var crmCreatePermission = false;

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

//     $('#smart').find('input[name="personal-photo"]').change(function(e){
//         $fileName = e.target.files[0].name;
//        alert('The file "' + $fileName +  '" has been selected.');
//    }),

     jQuery('.user-group-select2').select2({
        ajax: {
            url: function (params) {
                if(params.term) {
                    return '/users/getgroups/' + params.term;
                } else {
                    return '/users/getgroups/';
                }
            },
            dataType: 'json',
            processResults: function (data) {
                groups = data.groups;
                var groupArray = groups.map((item, index) => {
                    var temp = {
                        id: item.id,
                        text: item.group_name
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
    $('#smart').submit(function (e) {
    
            // Show some validation message here...
            // var values = $(this).serialize();
            // var personalPhoto =$('#personal-photo').val();
            // alert(values);
        
            // Prevent default and return.
            return e.preventDefault();
        

        // Submit to API via AJAX call.
    }),

jQuery('.create-user').click(function () {
     var fullName = $('#full-name').val();
     var martial = $('#marital').val();
     var nationality = $('#nationality').val();
     var passno = $('#passport-number').val();
     var workingAs = $('#working-as').val();
     var joiningDate = $('#join-date').val();
     var SalaryTransferType = $('#salary-transfer-type').val();
     var lmraFee = $('#lmra-monthly-fee').val();
     var lmraExp =  $('#visa-exp-date').val();
    //  var docCopies = $('#doc-copies').val();
     var totalfiles = document.getElementById('doc-copies').files.length;

     var DrivingLicence = $('#driving-license').val();
     var ComotionsT = $('#commotion-type').val();
     var email = $('#email').val();
     var gender = $('#gender').val();
     var address = $('#address').val();
     var cprExp = $('#cpr-exp-date').val();
     var department = $('#department-id').val();
     var endDate = $('#end-date').val();
     var basicSalary = $('#basic-salary').val();
     var companyCosi = $('#company-cosi').val();
     var Bank = $('#bank-id').val(); 
     var personalPhoto = $('#personal-photo')[0].files[0];
     var emrgContact = $('#emerg-contact-name').val();
     var emrgContactRel =  $('#emg-contact-relation').val();
     var phone = $('#phone').val();
     var dob = $('#birthday').val();
     var cprno = $('#cpr-number').val();
     var passExp =  $('#passport-exp-date').val();
     var designation = $('#destination').val();
     var leaveDays = $('#leaves-day').val();
     var empCosi = $('#employee-cosi').val();
     var lmraVisaFee = $('#lmra-visa-fee').val();
     var iban =  $('#iban').val();
     var bloodType =  $('#blood-type').val();
     var emrgContactNum =  $('#emerg-contact-number').val();

     fd = new FormData();
     for (var index = 0; index < totalfiles; index++) {
        fd.append("files[]", document.getElementById('doc-copies').files[index]);
     }
    fd.append('fullname', fullName);
    fd.append('martial', martial);
    fd.append('nationality', nationality);
    fd.append('passno', passno);
    fd.append('workingAs', workingAs);
    fd.append('joiningDate', joiningDate);
    fd.append('SalaryTransferType', SalaryTransferType);
    fd.append('lmraFee', lmraFee);
    fd.append('lmraExp', lmraExp);
    fd.append('DrivingLicence', DrivingLicence);
    fd.append('ComotionsT', ComotionsT);
    fd.append('cprno', cprno);
    fd.append('email', email);
    fd.append('gender', gender);
    fd.append('address', address);
    fd.append('cprExp', cprExp);
    fd.append('department', department);
    fd.append('endDate', endDate);
    fd.append('basicSalary', basicSalary);
    fd.append('companyCosi', companyCosi);
    fd.append('Bank', Bank);
    fd.append('emrgContact', emrgContact);
    fd.append('emrgContactRel', emrgContactRel);
    fd.append('phone', phone);
    fd.append('dob', dob);
    fd.append('passExp', passExp);
    fd.append('designation',designation);
    fd.append('leaveDays', leaveDays);
    fd.append('empCosi', empCosi);
    fd.append('lmraVisaFee', lmraVisaFee);
    fd.append('iban', iban);
    fd.append('bloodType', bloodType);
    fd.append('emrgContactNum', emrgContactNum);
    fd.append('file',personalPhoto);
     
    //   dataEmp = {
    //     fullname:fullName,
    //     martial: martial,
    //     nationality: nationality,
    //     passno: passno,
    //     workingAs: workingAs,
    //     joiningDate: joiningDate,
    //     SalaryTransferType: SalaryTransferType,
    //     lmraFee: lmraFee,
    //     lmraExp: lmraExp,
    //     docCopies: docCopies,
    //     DrivingLicence: DrivingLicence,
    //     ComotionsT: ComotionsT,
    //     cprno: cprno,
    //     email: email,
    //     gender: gender,
    //     address: address,
    //     cprExp: cprExp,
    //     department: department,
    //     endDate: endDate,
    //     basicSalary: basicSalary,
    //     companyCosi: companyCosi,
    //     Bank: Bank,
    //     personalPhoto: personalPhoto,
    //     emrgContact: emrgContact,
    //     emrgContactRel: emrgContactRel,
    //     phone: phone,
    //     dob: dob,
    //     passExp: passExp,
    //     designation: designation,
    //     leaveDays: leaveDays,
    //     empCosi: empCosi,
    //     lmraVisaFee: lmraVisaFee,
    //     iban: iban,
    //     bloodType: bloodType,
    //     emrgContactNum: emrgContactNum,
    //  };
    //  alert(fd.get('fullname'))
    //  console.log('here user data: ', dataEmp);
     $('#modal-block-fadein-user').modal('hide');



     $('#add-user-full-name').val(fd.get('fullname')).css("background-color", "rgb(240, 248, 255)");
     $('#add-user-email').val(fd.get('email')).css("background-color", "rgb(240, 248, 255)");
 }),

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



    jQuery('.create-withoutuser').on('click', function () { 
        var fullName = $('#full-name').val();
        var martial = $('#marital').val();
        var nationality = $('#nationality').val();
        var passno = $('#passport-number').val();
        var workingAs = $('#working-as').val();
        var joiningDate = $('#join-date').val();
        var SalaryTransferType = $('#salary-transfer-type').val();
        var lmraFee = $('#lmra-monthly-fee').val();
        var lmraExp =  $('#visa-exp-date').val();
        // var docCopies = $('#doc-copies').val();
           // Read selected files
        var totalfiles = document.getElementById('doc-copies').files.length;

        var DrivingLicence = $('#driving-license').val();
        var ComotionsT = $('#commotion-type').val();
        var email = $('#email').val();
        var gender = $('#gender').val();
        var address = $('#address').val();
        var cprExp = $('#cpr-exp-date').val();
        var department = $('#department-id').val();
        var endDate = $('#end-date').val();
        var basicSalary = $('#basic-salary').val();
        var companyCosi = $('#company-cosi').val();
        var Bank = $('#bank-id').val(); 
        var personalPhoto = $('#personal-photo')[0].files[0];
        
        // var personalPhoto =$('#personal-photo').val();
        // var personalPhoto = $('#personal-photo').prop('files')[0].name;
        // var personalPhoto = $('#personal-photo').get(0).files[0];
        var emrgContact = $('#emerg-contact-name').val();
        var emrgContactRel =  $('#emg-contact-relation').val();
        var phone = $('#phone').val();
        var dob = $('#birthday').val();
        var cprno = $('#cpr-number').val();
        var passExp =  $('#passport-exp-date').val();
        var designation = $('#destination').val();
        var leaveDays = $('#leaves-day').val();
        var empCosi = $('#employee-cosi').val();
        var lmraVisaFee = $('#lmra-visa-fee').val();
        var iban =  $('#iban').val();
        var bloodType =  $('#blood-type').val();
        var emrgContactNum =  $('#emerg-contact-number').val();

        var fwd = new FormData();
        // alert(totalfiles)
        for (var index = 0; index < totalfiles; index++) {
            fwd.append("files[]", document.getElementById('doc-copies').files[index]);
         }
        fwd.append('fullname', fullName);
        fwd.append('martial', martial);
        fwd.append('nationality', nationality);
        fwd.append('passno', passno);
        fwd.append('workingAs', workingAs);
        fwd.append('joiningDate', joiningDate);
        fwd.append('SalaryTransferType', SalaryTransferType);
        fwd.append('lmraFee', lmraFee);
        fwd.append('lmraExp', lmraExp);
        fwd.append('DrivingLicence', DrivingLicence);
        fwd.append('ComotionsT', ComotionsT);
        fwd.append('cprno', cprno);
        fwd.append('email', email);
        fwd.append('gender', gender);
        fwd.append('address', address);
        fwd.append('cprExp', cprExp);
        fwd.append('department', department);
        fwd.append('endDate', endDate);
        fwd.append('basicSalary', basicSalary);
        fwd.append('companyCosi', companyCosi);
        fwd.append('Bank', Bank);
        fwd.append('emrgContact', emrgContact);
        fwd.append('emrgContactRel', emrgContactRel);
        fwd.append('phone', phone);
        fwd.append('dob', dob);
        fwd.append('passExp', passExp);
        fwd.append('designation',designation);
        fwd.append('leaveDays', leaveDays);
        fwd.append('empCosi', empCosi);
        fwd.append('lmraVisaFee', lmraVisaFee);
        fwd.append('iban', iban);
        fwd.append('bloodType', bloodType);
        fwd.append('emrgContactNum', emrgContactNum);
        fwd.append('file',personalPhoto);
        // fd.append('file',personalPhoto);

        // alert(fd)
        $.ajax({
            method: "POST",
            url: "/human/create",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: fwd,
            contentType: false,
            processData: false,
            success: function (response) {
                var result = JSON.parse(response);
                // alert(result)
                if(result['status'] == 'success') {
                    var user = result['employee'];



                    jQuery('#modal-block-fadein-user').modal('hide');
                    $(location).attr('href', 'http://erp.co/human/employee')


                } else {
                    console.log('creating user error: ', result['message']);
                    One.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'Create User Failed!'});
                }
            },
            error: function () {
                console.log("here user save error: ");
                One.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'Create User Failed!'});
            }
        })

    }),


    jQuery('#user-save-button').on('click', function () {
        var userTable = jQuery('#user-table').DataTable();
        var empid = $('#employee_id').val();
        var fullName = $('#add-user-full-name').val();
        var userName = $('#add-username').val();
        var password = $('#password').val();
        var confirm_password = $('#password_confirmation').val();
        var email = $('#add-user-email').val();
        var grid = $('#group_id').val();
        var totalfiles = document.getElementById('doc-copies').files.length;

        var martial = fd.get('martial');
        var nationality = fd.get('nationality');
        var passno = fd.get('passno');
        var workingAs = fd.get('workingAs');
        var joiningDate = fd.get('joiningDate');
        var SalaryTransferType = fd.get('SalaryTransferType');
        var lmraFee = fd.get('lmraFee');
        var lmraExp = fd.get('lmraExp');
        var DrivingLicence = fd.get('DrivingLicence');
        var ComotionsT = fd.get('ComotionsT');
        var cprno = fd.get('cprno');
        var gender = fd.get('gender');
        var address = fd.get('address');
        var cprExp = fd.get('cprExp');
        var department = fd.get('department');
        var endDate = fd.get('endDate');
        var basicSalary = fd.get('basicSalary');
        var companyCosi = fd.get('companyCosi');
        var Bank = fd.get('Bank');
        var emrgContact = fd.get('emrgContact');
        var emrgContactRel = fd.get('emrgContactRel');
        var phone = fd.get('phone');
        var dob = fd.get('dob');
        var passExp = fd.get('passExp');
        var designation = fd.get('designation');
        var leaveDays = fd.get('leaveDays');
        var empCosi = fd.get('empCosi');
        var lmraVisaFee = fd.get('lmraVisaFee');
        var iban = fd.get('iban');
        var bloodType = fd.get('bloodType');
        var emrgContactNum = fd.get('emrgContactNum');
        var personalPhoto = $('#personal-photo')[0].files[0];
        var docCopies = []; 
    //    var files = [];
    //    for (var index = 0; index < totalfiles; index++) {
    //     files.push(fd.get('files[]'));
    //    }
    //    $.each(files, function (index, value) {
    //     alert( index + ' : ' + value );
    // });
    //    files.push(fd.get('files[]'));
    //    alert(files)
    //    alert(totalfiles);
    //    for (var index = 0; index < totalfiles; index++) {
    //     // files.push(fd.get('files[]'));
    //     // docCopies.push(document.getElementById('doc-copies').files[index]);
    //     // docCopies = files.associate(document.getElementById('doc-copies').files[index]);
    //  }
//     //    var docCopies = fd.get('files[]');
// alert("f1"+files)
// alert("docCopies"+docCopies)
       
    //    alert('DrivingLicence'+ DrivingLicence)

        if(fullName && userName && password && email && confirm_password ) {
            if(isEmailAddress(email)) {
                if ( password == confirm_password ){
                    var last = new FormData();
                    for (var index = 0; index < totalfiles; index++) {
                        last.append("files[]", document.getElementById('doc-copies').files[index]);
                     }

                    last.append('empid', empid);
                    last.append('grid', grid);
                    last.append('fullname', fullName);
                    last.append('userName', userName);
                    last.append('password', password);
                    last.append('martial', martial);
                    last.append('nationality', nationality);
                    last.append('passno', passno);
                    last.append('workingAs', workingAs);
                    last.append('joiningDate', joiningDate);
                    last.append('SalaryTransferType', SalaryTransferType);
                    last.append('lmraFee', lmraFee);
                    last.append('lmraExp', lmraExp);
                    last.append('DrivingLicence', DrivingLicence);
                    last.append('ComotionsT', ComotionsT);
                    last.append('cprno', cprno);
                    last.append('email', email);
                    last.append('gender', gender);
                    last.append('address', address);
                    last.append('cprExp', cprExp);
                    last.append('department', department);
                    last.append('endDate', endDate);
                    last.append('basicSalary', basicSalary);
                    last.append('companyCosi', companyCosi);
                    last.append('Bank', Bank);
                    last.append('emrgContact', emrgContact);
                    last.append('emrgContactRel', emrgContactRel);
                    last.append('phone', phone);
                    last.append('dob', dob);
                    last.append('passExp', passExp);
                    last.append('designation',designation);
                    last.append('leaveDays', leaveDays);
                    last.append('empCosi', empCosi);
                    last.append('lmraVisaFee', lmraVisaFee);
                    last.append('iban', iban);
                    last.append('bloodType', bloodType);
                    last.append('emrgContactNum', emrgContactNum);
                    last.append('file',personalPhoto);
                    last.append('userViewPermission',userViewPermission == true ? 1 : 0);
                    last.append('userDeletePermission',userDeletePermission == true ? 1 : 0);
                    last.append('userUpdatePermission',userUpdatePermission == true ? 1 : 0);
                    last.append('userCreatePermission',userCreatePermission == true ? 1 : 0);
                    last.append('crmViewPermission',crmViewPermission == true ? 1 : 0);
                    last.append('crmCreatePermission',crmCreatePermission == true ? 1 : 0);
                    last.append('crmDeletePermission',crmDeletePermission == true ? 1 : 0);
                    last.append('crmUpdatePermission',crmUpdatePermission == true ? 1 : 0);

                    // alert("empid"+ empid)
                    // $.each(last, function (index, value) {
                    // alert( index + ' : ' + value );
                    // });
                // var data = {
                //     empid: empid,
                //     grid: grid,
                //     fullName: fullName,
                //     userName: userName,
                //     password: password,
                //     email: email,
                    
                //     martial: martial,
                //     nationality: nationality,
                //     passno: passno,
                //     workingAs: workingAs,
                //     joiningDate: joiningDate,
                //     SalaryTransferType: SalaryTransferType,
                //     lmraFee: lmraFee,
                //     lmraExp: lmraExp,
                //     docCopies: docCopies,
                //     DrivingLicence: DrivingLicence,
                //     ComotionsT: ComotionsT,
                //     cprno: cprno,
     
                //     gender: gender,
                //     address: address,
                //     cprExp: cprExp,
                //     department: department,
                //     endDate: endDate,
                //     basicSalary: basicSalary,
                //     companyCosi: companyCosi,
                //     Bank: Bank,
                //     personalPhoto: personalPhoto,
                //     emrgContact: emrgContact,
                //     emrgContactRel: emrgContactRel,
                //     phone: phone,
                //     dob: dob,
                //     passExp: passExp,
                //     designation: designation,
                //     leaveDays: leaveDays,
                //     empCosi: empCosi,
                //     lmraVisaFee: lmraVisaFee,
                //     iban: iban,
                //     bloodType: bloodType,
                //     emrgContactNum: emrgContactNum,

                //     userViewPermission: userViewPermission == true ? 1 : 0,
                //     userDeletePermission: userDeletePermission == true ? 1 : 0,
                //     userUpdatePermission: userUpdatePermission == true ? 1 : 0,
                //     userCreatePermission: userCreatePermission == true ? 1 : 0,
                //     crmViewPermission: crmViewPermission == true ? 1 : 0,
                //     crmCreatePermission: crmCreatePermission == true ? 1 : 0,
                //     crmDeletePermission: crmDeletePermission == true ? 1 : 0,
                //     crmUpdatePermission: crmUpdatePermission == true ? 1 : 0,
                // };
                // console.log('here user data: ', data);
                $('#modal-block-fadein-user').modal('hide');
                $.ajax({
                    method: "POST",
                    contentType: false,
                    processData: false,
                    url: "/users/createuser",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: last,
                    success: function (response) {
                        var result = JSON.parse(response);
                        // alert(result)
                        if(result['status'] == 'success') {
                            // var user = result['user'];
                            // var newRow = userTable.row.add([
                            //     user['id'],
                            //     user['full_name'],
                            //     user['name'],
                            //     '0 days ago',
                            //     "<div>\n" +
                            //     "</div>"
                            // ]).draw();
                            // console.log('here new row: ', newRow.index());
     
                            

                            jQuery('#modal-block-fadein-user').modal('hide');
                            $(location).attr('href', 'http://erp.co/human/employee');



                        } else {
                            console.log('creating user error: ', result['message']);
                            One.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'Create User Failed!'});
                        }
                    },
                    error: function () {
                        console.log("here user save error: ");
                        One.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'Create User Failed!'});
                    }
                })
                } else {
                    Swal.fire('Password fields does not match!')
                }

            } else {
                Swal.fire('Please Enter valid Email')
            }
        } else {
            Swal.fire('Please Fill all Fields');
        }
        console.log('here user modal save button clicked');
        // $(location).attr('href',"/human/employee");
    }),



);
