@extends('layouts.backend')

@section('css_before')
<!-- Page JS Plugins CSS -->
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
<script src="{{ asset('js/plugins/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('js/plugins/es6-promise/es6-promise.auto.min.js') }}"></script>
<script src="{{ asset('js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('js/plugins/select2/js/select2.min.js') }}"></script>

<!-- Page JS Code -->
<script src="{{ asset('js/pages/hrm/tables_datatables.js') }}"></script>
<script src="{{ asset('js/pages/users/dialogs.min.js') }}"></script>
<script src="{{ asset('js/pages/hrm/edit.js') }}"></script>
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
                        <a class="link-fx" href="">Edit Employee</a>
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
                <form name="employee-form" id="employee-form" action="{{ route('human.employee.update') }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="employee-id" value="{{ $employee->id }}">
                    @csrf
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
                                <input type="text" class="form-control" id="full-name" name="full-name" value="{{ $employee->full_name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="marital">Marital Status</label>
                                <select class="form-control" id="marital" name="marital" >
                                    <option value="0" {{ $employee->marital === 0 ? 'selected' : ''}}>Single</option>
                                    <option value="1" {{ $employee->marital === 1 ? 'selected' : ''}}>Married</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nationality">Nationality</label>
                                <input type="text" class="form-control" id="nationality" value="{{ $employee->nationality }}" name="nationality" required>
                            </div>
                            <div class="form-group">
                                <label for="passport-number">Passport number</label>
                                <input type="number" class="form-control" id="passport-number" value="{{ $employee->passport_number }}" name="passport-number" required>
                            </div>
                            <div class="form-group">
                                <label for="working-as">Working As </label>
                                <select class="form-control" id="working-as" name="working-as" required>
                                    <option value="1" {{ $employee->working_as === 1 ? 'selected' : ''}}>Full Time</option>
                                    <option value="2" {{ $employee->working_as === 2 ? 'selected' : ''}}>Part Time</option>
                                    <option value="3" {{ $employee->working_as === 3 ? 'selected' : ''}}>Contractor</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="join-date">Joining Date</label>
                                <input type="date" class="form-control" id="join-date" value="{{ $employee->join_date }}" name="join-date" required>
                            </div>
                            <div class="form-group">
                                <label for="salary-transfer-type">Salary Transfer type</label>
                                <select class="form-control" id="salary-transfer-type" name="salary-transfer-type" required>
                                    <option value="1" {{ $employee->salary_transfer_type === 1 ? 'selected' : ''}}>Cash</option>
                                    <option value="2" {{ $employee->salary_transfer_type === 2 ? 'selected' : ''}}>Cheque</option>
                                    <option value="3" {{ $employee->salary_transfer_type === 3 ? 'selected' : ''}}>Bank Transfer</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="lmra-monthly-fee">LMRA Monthly fees</label>
                                <input type="number" class="form-control" id="lmra-monthly-fee" name="lmra-monthly-fee" value="{{ $employee->lmra_monthly_fee }}" required>
                            </div>
                            <div class="form-group">
                                <label for="visa-exp-date">LMRA VISA Expiry date</label>
                                <input type="date" class="form-control" id="visa-exp-date" name="visa-exp-date" value="{{ $employee->visa_exp_date }}" required>
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
                                    <option value="1" {{ $employee->driving_license === 1 ? 'selected' : ''}}>Yes</option>
                                    <option value="0" {{ $employee->driving_license === 0 ? 'selected' : ''}}>No</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="commotion-type">Commotions type </label>
                                <select class="form-control" id="commotion-type" name="commotion-type" required>
                                    <option value="1" {{ $employee->commotion_type === 0 ? 'selected' : ''}}>%</option>
                                    <option value="2" {{ $employee->commotion_type === 0 ? 'selected' : ''}}>Fix</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-x4">
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select class="form-control" id="gender" name="gender" required>
                                    <option value="0" {{ $employee->gender === 0 ? 'selected' : ''}}>Male</option>
                                    <option value="1" {{ $employee->gender === 1 ? 'selected' : ''}}>Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $employee->email }}" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{ $employee->address }}" required>
                            </div>
                            <div class="form-group">
                                <label for="cpr-exp-date">CPR Expiry Date</label>
                                <input type="date" class="form-control" id="cpr-exp-date" name="cpr-exp-date" value="{{ $employee->cpr_exp }}" required>
                            </div>
                            <div class="form-group">
                                <label for="department-id">Department</label>
                                <select class="edit-employee-department-select2 form-control" id="department-id" name="department-id" required>
                                    <option value="-">Please select Department</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="end-date">Ending Date</label>
                                <input type="date" class="js-flatpickr form-control bg-white" id="end-date" name="end-date" value="{{ $employee->end_date }}">
                            </div>
                            <div class="form-group">
                                <label for="basic-salary">Basic Salary</label>
                                <input type="number" class="form-control" id="basic-salary" name="basic-salary" value="{{ $employee->basic_salary }}" required>
                            </div>
                            <div class="form-group">
                                <label for="company-cosi">Company COSI (%)</label>
                                <input type="number" class="form-control" id="company-cosi" name="company-cosi" value="{{ $employee->company_cosi }}" required>
                            </div>

                            <div class="form-group">
                                <label for="bank-id">Bank Name</label>
                                <select class="edit-employee-bank-select2 form-control" id="bank-id" name="bank-id">
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
                                <input type="text" class="form-control" id="emerg-contact-name" name="emerg-contact-name" value="{{ $employee->emerg_contact_name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="emg-contact-relation">Emergency contact Relationship</label>
                                <select class="form-control" id="emg-contact-relation" name="emg-contact-relation" required>
                                    <option value="Brother" {{ $employee->emerg_contact_relation === "Brother" ? 'selected' : ''}}>Brother</option>
                                    <option value="Sister" {{ $employee->emerg_contact_relation === "Sister" ? 'selected' : ''}}>Sister</option>
                                    <option value="Son" {{ $employee->emerg_contact_relation === "Son" ? 'selected' : ''}}>Son</option>
                                    <option value="Friend" {{ $employee->emerg_contact_relation === "Friend" ? 'selected' : ''}}>Friend</option>
                                    <option value="Mother" {{ $employee->emerg_contact_relation === "Mother" ? 'selected' : ''}}>Mother</option>
                                    <option value="Father" {{ $employee->emerg_contact_relation === "Father" ? 'selected' : ''}}>Father</option>
                                    <option value="Wife" {{ $employee->emerg_contact_relation === "Wife" ? 'selected' : ''}}>Wife</option>
                                    <option value="Grandfather" {{ $employee->emerg_contact_relation === "Grandfather" ? 'selected' : ''}}>Grandfather</option>
                                    <option value="Grandmother" {{ $employee->emerg_contact_relation === "Grandmother" ? 'selected' : ''}}>Grandmother</option>
                                    <option value="Other" {{ $employee->emerg_contact_relation === "Other" ? 'selected' : ''}}>Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-x4">
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ $employee->phone }}" required>
                            </div>
                            <div class="form-group">
                                <label for="birthday">Date of birth</label>
                                <input type="date" class="form-control" id="birthday" name="birthday" value="{{ $employee->birthday }}" required>
                            </div>
                            <div class="form-group">
                                <label for="cpr-number">CPR number</label>
                                <input type="number" class="form-control" id="cpr-number" name="cpr-number" value="{{ $employee->cpr_number }}" required>
                            </div>
                            <div class="form-group">
                                <label for="passport-exp-date">Passport Expiry Date</label>
                                <input type="date" class="form-control" id="passport-exp-date" name="passport-exp-date" value="{{ $employee->passport_exp }}" required>
                            </div>
                            <div class="form-group">
                                <label for="destination">Designation</label>
                                <input type="text" class="form-control" id="destination" name="destination" value="{{ $employee->destination }}" required>
                            </div>
                            <div class="form-group">
                                <label for="leaves-day">Leaves days</label>
                                <input type="number" class="form-control" id="leaves-day" name="leaves-day" value="{{ $employee->leaves_day }}" required>
                            </div>
                            <div class="form-group">
                                <label for="employee-cosi">Employee COSI (%)</label>
                                <input type="number" class="form-control" id="employee-cosi" name="employee-cosi" value="{{ $employee->employee_cosi }}" required>
                            </div>
                            <div class="form-group">
                                <label for="lmra-visa-fee">LMRA VISA Fees</label>
                                <input type="number" class="form-control" id="lmra-visa-fee" name="lmra-visa-fee" value="{{ $employee->lmra_visa_fee }}" required>
                            </div>
                            <div class="form-group">
                                <label for="iban">IBAN</label>
                                <input type="text" class="form-control" id="iban" name="iban" value="{{ $employee->iban }}" required>
                            </div>
                            <div class="form-group">
                                <label for="blood-type">Blood type</label>
                                <select class="form-control" id="blood-type" name="blood-type" required>
                                    <option value="A+" {{ $employee->commotion_type === "A+" ? 'selected' : ''}}>A+</option>
                                    <option value="A-" {{ $employee->commotion_type === "A-" ? 'selected' : ''}}>A-</option>
                                    <option value="B+" {{ $employee->commotion_type === "B+" ? 'selected' : ''}}>B+</option>
                                    <option value="B-" {{ $employee->commotion_type === "B-" ? 'selected' : ''}}>B-</option>
                                    <option value="O+" {{ $employee->commotion_type === "O+" ? 'selected' : ''}}>O+</option>
                                    <option value="O-" {{ $employee->commotion_type === "O-" ? 'selected' : ''}}>O-</option>
                                    <option value="AB+" {{ $employee->commotion_type === "AB+" ? 'selected' : ''}}>AB+</option>
                                    <option value="AB-" {{ $employee->commotion_type === "AB-" ? 'selected' : ''}}>AB-</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="emerg-contact-number">Emergency contact Number</label>
                                <input type="text" class="form-control" id="emerg-contact-number" name="emerg-contact-number" value="{{ $employee->emerg_contact_number }}" required>
                            </div>
                            <div class="form-group" style="text-align: right; padding-top: 36px;">
                                <a href="{{ route('human.list') }}" class="mr-3">
                                    <button type="button" class="btn btn-sm btn-light cancel-btn" style="padding: 5px 30px;">
                                        Cancel
                                    </button>
                                </a>
                                <button type="submit" class="btn btn-sm btn-primary create-btn" style="padding: 5px 30px;">
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
@endsection
