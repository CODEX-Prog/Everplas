@extends('layouts.backend')

@section('css_before')
<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="{{ asset('js/plugins/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
@endsection

@section('css_after')
@endsection

@section('js_after')
<!-- Page JS Plugins -->
<script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('js/plugins/es6-promise/es6-promise.auto.min.js') }}"></script>
<script src="{{ asset('js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('js/plugins/select2/js/select2.min.js') }}"></script>

<!-- Page JS Code -->
<script src="{{ asset('js/pages/hrm/tables_datatables.js') }}"></script>
<script src="{{ asset('js/pages/hrm/create.js') }}"></script>
<script src="{{ asset('js/pages/hrm/employee.js') }}"></script>
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                Human resource
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">HRM</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">New Employee</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <div class="block">
            <div class="block-header">
                <h3 class="block-title">Employee Information</h3>
            </div>
            <div class="block-content block-content-full">
                <form id="smart" enctype="multipart/form-data">

                    @isset($errors)
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    @endisset
                    <div class="row push col-lg-12 col-x12">
                        <div class="col-lg-4 col-x4">
                            <div class="form-group">
                                <label for="full-name">Full Name</label>
                                <input type="text" class="form-control" id="full-name" name="full-name" required>
                            </div>
                            <div class="form-group">
                                <label for="marital">Marital Status</label>
                                <select class="form-control" id="marital" name="marital" >
                                    <option value="0">Single</option>
                                    <option value="1">Married</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nationality">Nationality</label>
                                <input type="text" class="form-control" id="nationality" name="nationality" required>
                            </div>
                            <div class="form-group">
                                <label for="passport-number">Passport number</label>
                                <input type="number" class="form-control" id="passport-number" name="passport-number" required>
                            </div>
                            <div class="form-group">
                                <label for="working-as">Working As </label>
                                <select class="form-control" id="working-as" name="working-as" >
                                    <option value="1">Full Time</option>
                                    <option value="2">Part Time</option>
                                    <option value="3">Contractor</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="join-date">Joining Date</label>
                                <input type="date" class="form-control" id="join-date" name="join-date" required>
                            </div>
                            <div class="form-group">
                                <label for="salary-transfer-type">Salary Transfer type</label>
                                <select class="form-control" id="salary-transfer-type" name="salary-transfer-type" required>
                                    <option value="1">Cash</option>
                                    <option value="2">Cheque</option>
                                    <option value="3">Bank Transfer</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="lmra-monthly-fee">LMRA Monthly fees</label>
                                <input type="number" class="form-control" id="lmra-monthly-fee" name="lmra-monthly-fee" required>
                            </div>
                            <div class="form-group">
                                <label for="visa-exp-date">LMRA VISA Expiry date</label>
                                <input type="date" class="form-control" id="visa-exp-date" name="visa-exp-date" required>
                            </div>
                            <div class="form-group">
                                <label for="doc-copies">Doc copies</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" data-toggle="custom-file-input"
                                        id="doc-copies" name="doc-copies[]" multiple>
                                    <label class="custom-file-label" for="doc-copies">
                                        Choose files
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="driving-license">Driving license</label>
                                <select class="form-control" id="driving-license" name="driving-license" required>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="commotion-type">Commotions type </label>
                                <select class="form-control" id="commotion-type" name="commotion-type" required>
                                    <option value="1">%</option>
                                    <option value="2">Fix</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-x4">
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select class="form-control" id="gender" name="gender" required>
                                    <option value="0">Male</option>
                                    <option value="1">Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address" required>
                            </div>
                            <div class="form-group">
                                <label for="cpr-exp-date">CPR Expiry Date</label>
                                <input type="date" class="form-control" id="cpr-exp-date" name="cpr-exp-date" required>
                            </div>
                            <div class="form-group">
                                <label for="department-id">Department</label>
                                <select class="create-employee-department-select2 form-control" id="department-id" name="department-id" required>
                                    <option value="">Please select Department</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="end-date">Ending Date</label>
                                <input type="date" class="js-flatpickr form-control bg-white" id="end-date" name="end-date">
                            </div>
                            <div class="form-group">
                                <label for="basic-salary">Basic Salary</label>
                                <input type="number" class="form-control" id="basic-salary" name="basic-salary" required>
                            </div>
                            <div class="form-group">
                                <label for="company-cosi">Company COSI (%)</label>
                                <input type="number" class="form-control" id="company-cosi" name="company-cosi" required>
                            </div>
                            <div class="form-group">
                                <label for="bank-id">Bank Name</label>
                                <select class="create-employee-bank-select2 form-control" id="bank-id" name="bank-id" required>
                                    <option value="-">Please select Bank</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="personal-photo">Personal photo</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" data-toggle="custom-file-input"
                                        id="personal-photo" name="personal-photo">
                                    <label class="custom-file-label" for="personal-photo">Choose Photo</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="emerg-contact-name">Emergency contact name</label>
                                <input type="text" class="form-control" id="emerg-contact-name" name="emerg-contact-name" required>
                            </div>
                            <div class="form-group">
                                <label for="emg-contact-relation">Emergency contact Relationship</label>
                                <select class="form-control" id="emg-contact-relation" name="emg-contact-relation" required>
                                    <option value="Brother">Brother</option>
                                    <option value="Sister">Sister</option>
                                    <option value="Son">Son</option>
                                    <option value="Friend">Friend</option>
                                    <option value="Mother">Mother</option>
                                    <option value="Father">Father</option>
                                    <option value="Wife">Wife</option>
                                    <option value="Grandfather">Grandfather</option>
                                    <option value="Grandmother">Grandmother</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-x4">
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="text" class="form-control" id="phone" name="phone" required>
                            </div>
                            <div class="form-group">
                                <label for="birthday">Date of birth</label>
                                <input type="date" class="form-control" id="birthday" name="birthday" required>
                            </div>
                            <div class="form-group">
                                <label for="cpr-number">CPR number</label>
                                <input type="number" class="form-control" id="cpr-number" name="cpr-number" required>
                            </div>
                            <div class="form-group">
                                <label for="passport-exp-date">Passport Expiry Date</label>
                                <input type="date" class="form-control" id="passport-exp-date" name="passport-exp-date" required>
                            </div>
                            <div class="form-group">
                                <label for="destination">Designation</label>
                                <input type="text" class="form-control" id="destination" name="destination" required>
                            </div>
                            <div class="form-group">
                                <label for="leaves-day">Leaves days</label>
                                <input type="number" class="form-control" id="leaves-day" name="leaves-day" required>
                            </div>
                            <div class="form-group">
                                <label for="employee-cosi">Employee COSI (%)</label>
                                <input type="number" class="form-control" id="employee-cosi" name="employee-cosi" required>
                            </div>
                            <div class="form-group">
                                <label for="lmra-visa-fee">LMRA VISA Fees</label>
                                <input type="number" class="form-control" id="lmra-visa-fee" name="lmra-visa-fee" required>
                            </div>
                            <div class="form-group">
                                <label for="iban">IBAN</label>
                                <input type="text" class="form-control" id="iban" name="iban" required>
                            </div>
                            <div class="form-group">
                                <label for="blood-type">Blood type</label>
                                <select class="form-control" id="blood-type" name="blood-type" required>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="emerg-contact-number">Emergency contact Number</label>
                                <input type="text" class="form-control" id="emerg-contact-number" name="emerg-contact-number" required>
                            </div>
                            <div class="form-group" style="text-align: right; padding-top: 36px;">
                                <a href="{{ route('human.list') }}" class="mr-3">
                                    <button type="button"  class="btn btn-sm btn-light cancel-btn" style="padding: 5px 30px;">
                                        Cancel
                                    </button>
                                </a>
                                <button type="submit" id="modal"   data-target="#exampleModalCenter"  class="btn btn-sm btn-primary " style="padding: 5px 30px;">
                                    <i class="fa fa-check mr-1"></i>
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END Page Content -->


    <!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Create User Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Do you also want to create User account for this employee ?
      </div>
      <div class="modal-footer">
        <button type="submit" data-dismiss="modal" class="btn btn-secondary create-withoutuser" id="create-withoutuser">Save without User</button>
        <button type="submit"  class="btn btn-primary create-user" id="create-user" data-dismiss="modal" data-toggle="modal" data-target="#modal-block-fadein-user">Yes</button>
      </div>
    </div>
  </div>
</div>



    <!-- Fade In Block Modal -->
    <div class="modal fade" id="modal-block-fadein-user" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <i class="si si-magnifier-add pr-2"></i>
                        <h3 class="block-title">New User</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content font-size-sm">
                        <form  enctype="multipart/form-data">
                            <div class="row push">
                                <div class="col-lg-8 col-xl-12">

                                    <div class="form-group">
                                       <label for="add-user-full-name">Full Name</label>
                                       <input type="text" class="form-control" id="add-user-full-name" name="full-name"  placeholder="full name" required>
                                    </div>
                                    <div class="form-group">
                                       <label for="add-username">Username</label>
                                       <input type="text" class="form-control" id="add-username" name="username"  placeholder="username" required>
                                    </div>


                                    <div class="form-group">
                                    <label for="password">Password</label>
                                        <input type="password" class="form-control " id="password" name="password" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                    <label for="password_confirmation">Re-type Password</label>
                                        <input type="password" class="form-control " id="password_confirmation" name="password_confirmation" placeholder="Password Confirm">
                                    </div>

                                    <div class="form-group">
                                       <label for="add-user-email">Email</label>
                                       <input type="text" class="form-control" id="add-user-email" name="email" placeholder="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="group_id">Groups</label>
{{--                                        <select class="form-control permission-group" id="permission-group" name="group_id" required >--}}
{{--                                           <option value="">Please select Group</option>--}}
{{--                                        </select>--}}
                                        <select class="user-group-select2 form-control ml-3" id="group_id">
                                            <option value="">Please select Group</option>
                                        </select>
                                    </div>
                                   <div class="form-group special-permission-section-user" id="special-permission-section-user">
                                        <label for="email">Special Permission</label>
                                        <label class="d-block">Users & Groups</label>
                                        <div class="custom-control custom-switch custom-control-inline">
                                            <input type="checkbox" class="custom-control-input" id="user-view-permission" name="user-view-permission">
                                            <label class="custom-control-label" for="user-view-permission">View</label>
                                        </div>
                                        <div class="custom-control custom-switch custom-control-inline">
                                            <input type="checkbox" class="custom-control-input" id="user-delete-permission" name="user-delete-permission">
                                            <label class="custom-control-label" for="user-delete-permission">Delete</label>
                                        </div>
                                        <div class="custom-control custom-switch custom-control-inline">
                                            <input type="checkbox" class="custom-control-input" id="user-update-permission" name="user-update-permission">
                                            <label class="custom-control-label" for="user-update-permission">Update</label>
                                        </div>
                                        <div class="custom-control custom-switch custom-control-inline">
                                            <input type="checkbox" class="custom-control-input" id="user-create-permission" name="user-create-permission">
                                            <label class="custom-control-label" for="user-create-permission">Create</label>
                                        </div>
                                        <label class="d-block">CRM</label>
                                        <div class="custom-control custom-switch custom-control-inline">
                                            <input type="checkbox" class="custom-control-input" id="crm-view-permission" name="crm-view-permission">
                                            <label class="custom-control-label" for="crm-view-permission">View</label>
                                        </div>
                                        <div class="custom-control custom-switch custom-control-inline">
                                            <input type="checkbox" class="custom-control-input" id="crm-delete-permission" name="crm-delete-permission">
                                            <label class="custom-control-label" for="crm-delete-permission">Delete</label>
                                        </div>
                                        <div class="custom-control custom-switch custom-control-inline">
                                            <input type="checkbox" class="custom-control-input" id="crm-update-permission" name="crm-update-permission">
                                            <label class="custom-control-label" for="crm-update-permission">Update</label>
                                        </div>
                                        <div class="custom-control custom-switch custom-control-inline">
                                            <input type="checkbox" class="custom-control-input" id="crm-create-permission" name="crm-create-permission">
                                            <label class="custom-control-label" for="crm-create-permission">Create</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="block-content block-content-full text-right border-top">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success user-save-button" id="user-save-button"><i class="fa fa-check mr-1"></i>Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END Fade In Block Modal -->

@endsection
