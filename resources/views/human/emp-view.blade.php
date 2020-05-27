@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/sweetalert2/sweetalert2.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" integrity="sha256-PZLhE6wwMbg4AB3d35ZdBF9HD/dI/y4RazA3iRDurss=" crossorigin="anonymous" />
@endsection

@section('css-after')
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js" integrity="sha256-P93G0oq6PBPWTP1IR8Mz/0jHHUpaWL0aBJTKauisG7Q=" crossorigin="anonymous"></script>
    <script>
    $(document).ready(function() {
        $('.gallerys').magnificPopup({type:'image', delegate:'a',     gallery: {
      enabled: true
    } });
    });
    </script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/hrm/tables_datatables.js') }}"></script>
    <script src="{{ asset('js/pages/users/dialogs.min.js') }}"></script>
    <script src="{{ asset('js/pages/hrm/employee.js') }}"></script>
@endsection

@section('content')
   <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    {{ $employee->full_name }} - Profile
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">HRM</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">Employee Profile</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <div class="d-xl-none push">
            <div class="row gutters-tiny">
                <div class="col-6">
                    <button type="button" class="btn btn-light btn-block" data-toggle="class-toggle" data-target=".js-ecom-div-nav" data-class="d-none">
                        <i class="fa fa-fw fa-bars text-muted mr-1"></i> Navigation
                    </button>
                </div>
                <div class="col-6">
                    <button type="button" class="btn btn-light btn-block" data-toggle="class-toggle" data-target=".js-ecom-div-cart" data-class="d-none">
                        <i class="fa fa-fw fa-shopping-cart text-muted mr-1"></i> Cart (3)
                    </button>
                </div>
            </div>
        </div>
         <!-- 2 buttons to Edit and Download -->
 <a href="{{ url('human/editemployee/'.$employee->id) }}" style="display:inline; margin-top: 10px; margin-left: 90%; background-color: DodgerBlue;  border: none; color: white;  padding: 12px 16px; font-size: 16px; cursor: pointer;  background-color: RoyalBlue;"><i class="fa fa-edit"></i> Edit </a>
 
        <div class="row">
            <div class="col-xl-4 order-xl-1">
                <div class="block js-ecom-div-nav d-none d-xl-block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Information</h3>
                    </div>
                    <div class="block-content">
                        <ul class="nav nav-pills flex-column push">
                            <li class="nav-item mb-1">
                                <a class="nav-link d-flex justify-content-between align-items-center" href="javascript:void(0)">
                                    Phone Number
                                    <span class="badge badge-pill badge-secondary ml-1">
                                        {{ $employee->phone }}
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item mb-1">
                                <a class="nav-link d-flex justify-content-between align-items-center" href="javascript:void(0)">
                                    Email
                                    <span class="badge badge-pill badge-secondary ml-1">
                                        {{ $employee->email }}
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item mb-1">
                                <a class="nav-link d-flex justify-content-between align-items-center" href="javascript:void(0)">
                                Marital Status
                                    <span class="badge badge-pill badge-secondary ml-1">
                                        @switch($employee->gender)
                                            @case(0)
                                                Single
                                                @break
                                            @case(1)
                                                Married
                                                @break
                                        @endswitch
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item mb-1">
                                <a class="nav-link d-flex justify-content-between align-items-center" href="javascript:void(0)">
                                Address
                                    <span class="badge badge-pill badge-secondary ml-1">
                                        {{ $employee->address }}
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item mb-1">
                                <a class="nav-link d-flex justify-content-between align-items-center" href="javascript:void(0)">
                                Nationality
                                    <span class="badge badge-pill badge-secondary ml-1">
                                        {{ $employee->nationality }}
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item mb-1">
                                <a class="nav-link d-flex justify-content-between align-items-center" href="javascript:void(0)">
                                Date of birth
                                    <span class="badge badge-pill badge-secondary ml-1">
                                        {{ $employee->birthday }}
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item mb-1">
                                <a class="nav-link d-flex justify-content-between align-items-center" href="javascript:void(0)">
                                    Gender
                                    <span class="badge badge-pill badge-secondary ml-1">
                                        @switch($employee->gender)
                                            @case(0)
                                                Male
                                                @break
                                            @case(1)
                                                Female
                                                @break
                                        @endswitch
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="block js-ecom-div-cart d-none d-xl-block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Emergency contact</h3>
                    </div>
                    <div class="block-content">
                        <ul class="nav nav-pills flex-column push">
                            <li class="nav-item mb-1">
                                <a class="nav-link d-flex justify-content-between align-items-center" href="javascript:void(0)">
                                Contact name <span class="badge badge-pill badge-secondary ml-1">{{ $employee->emerg_contact_name }}</span>
                                </a>
                            </li>
                            <li class="nav-item mb-1">
                                <a class="nav-link d-flex justify-content-between align-items-center" href="javascript:void(0)">
                                Contact Number <span class="badge badge-pill badge-secondary ml-1">{{ $employee->emerg_contact_number }}</span>
                                </a>
                            </li>
                            <li class="nav-item mb-1">
                                <a class="nav-link d-flex justify-content-between align-items-center" href="javascript:void(0)">
                                Contact Relationship <span class="badge badge-pill badge-secondary ml-1">{{ $employee->emerg_contact_relation }}</span>
                                </a>
                            </li>
                            <li class="nav-item mb-1">
                                <a class="nav-link d-flex justify-content-between align-items-center" href="javascript:void(0)">
                                Blood type <span class="badge badge-pill badge-secondary ml-1">{{ $employee->blood_type }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
            <div class="col-xl-8 order-xl-0">
                <div class="block">
                    <div class="block-content">
                        <div class="row items-push">
                        <div class= 'col no-gutters gallerys' >  
                        <div class="col-lg">
                        <a href="{{ asset($employee->personal_photo) }}" target="_blank">
                        <img class="img-fluid" src="{{url( $employee->personal_photo )}}" alt="avatar">
                        </a>   <a href="{{ route('human.download', $employee->id) }}" class="btn btn-outline-warning" style="margin-left:30px;">Download </a>
                        </div>
                        </div>
                            <div class="col-md-9">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="font-size-sm font-w600">Full Name {{ $employee->full_name }}</div>
                                        <div class="font-size-sm text-muted">Department - Designation</div>  
                                        <!-- NOTE -->
                                    </div>
                                    <div class="font-size-h2 font-w700">
                                        Day Age
                                         <!-- NOTE -->
                                    </div>
                                </div>
                                    <div class="py-3"></div>
                                    <div class="font-size-h4">Personal Information</div><br>
                                        <div class="row col-md-12">
                                            <div class="col-md-4">
                                                <strong>CPR #: </strong>{{ $employee->cpr_number }}
                                            </div>
                                            <div class="col-md-4">
                                                <strong>Passport #: </strong>{{ $employee->passport_number }}
                                            </div>
                                            <div class="col-md-4">
                                             <!-- NOTE -->
                                                <strong>Visa: </strong>
                                                @php
                                                            use Carbon\Carbon;
                                                            $today_date = Carbon::now();

                                                            $expire_date = Carbon::createFromFormat('Y-m-d', $employee->visa_exp_date);
                                                            $data_difference = $today_date->diffInDays($expire_date, false);  //false param

                                                            if($data_difference > 0) {
                                                                  echo  "<span style='color:green;'><b>Active</b>  </span>";
                                                            }
                                                            elseif($data_difference < 0) {
                                                                echo  "<span style='color:red;'> <b>Not Active </b> </span>";
                                                            } else {
                                                                //today
                                                            }
                                                @endphp
                                                

                                            </div>
                                        </div>
                                        <div class="row col-md-12">
                                            <div class="col-md-4">
                                                <strong>CPR Expiry: </strong> <br>{{ $employee->cpr_exp }}
                                            </div>
                                            <div class="col-md-4">
                                                <strong>Passport Expiry: </strong> <br>{{ $employee->passport_exp }}
                                            </div>
                                            <div class="col-md-4">
                                                <strong>Visa Expiry: </strong> <br>{{ $employee->visa_exp_date }}
                                            </div>
                                        </div>
                                </div>
                        </div>
                        <div class="block block-rounded block-bordered">
                        <div class="font-size-h4">Career Details</div>
                            <div class="block-content block-content-full d-flex justify-content-between align-items-center">

                                <div class="row col-md-12">
                                    <div class="col-md-4">
                                        <strong>Working As: </strong>
                                        @switch($employee->working_as)
                                            @case(1)
                                                Full time
                                                @break
                                            @case(2)
                                                Part time
                                                @break
                                            @case(3)
                                                Contractor
                                                @break
                                            @default
                                                Full time
                                        @endswitch
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Joining Date: </strong>{{ $employee->join_date }}
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Ending Date: </strong>{{ $employee->end_date }}
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Leaves days: </strong>{{ $employee->leaves_day.' ' .'Days' }}
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Driving license: </strong>
                                        @switch($employee->driving_license)
                                            @case(0)
                                                No
                                                @break
                                            @case(1)
                                                Yes
                                                @break
                                            @default
                                                Yes
                                        @endswitch
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block block-rounded block-bordered">
                        <div class="font-size-h4">Salary Details</div>
                            <div class="block-content block-content-full d-flex justify-content-between align-items-center">

                                <div class="row col-md-12">
                                    <div class="col-md-4">
                                        <strong>Transfer type: </strong>
                                        @switch($employee->salary_transfer_type)
                                            @case(1)
                                                Cash
                                                @break
                                            @case(2)
                                                Cheque
                                                @break
                                            @case(3)
                                                Bank Transfer
                                                @break
                                            @default
                                                Cash
                                        @endswitch
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Basic Salary: </strong>{{ $employee->basic_salary.' BD'}}
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Employee COSI (%): </strong>{{ $employee->employee_cosi.' BD'}}
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Company COSI (%): </strong>{{ $employee->company_cosi.' BD'}}
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Total Salary: </strong>{{ $employee->basic_salary.' BD'}}
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Bank Name: </strong>{{ $bank->name }}
                                    </div>
                                    <div class="col-md-4">
                                        <strong>IBAN: </strong>{{ $employee->iban }}
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Commotions type: </strong>
                                        {{ $employee->commotion_type == 1 ? '%' : 'Fix' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block block-rounded block-bordered">
                        <div class="font-size-h4">LMRA & VISA Details</div>
                            <div class="block-content block-content-full d-flex justify-content-between align-items-center">

                                <div class="row col-md-12">
                                    <div class="col-md-4">
                                        <strong>LMRA VISA Fees: </strong>{{ $employee->lmra_visa_fee }}
                                    </div>
                                    <div class="col-md-4">
                                        <strong>LMRA Monthly fees: </strong>{{ $employee->lmra_monthly_fee }}
                                    </div>
                                    <div class="col-md-4">
                                        <strong>LMRA VISA Expiry date: </strong>{{ $employee->visa_exp_date }}
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="block block-rounded block-bordered">
                            <div class="font-size-h4">Attachment</div>
                            <div class="block-content block-content-full d-flex justify-content-between align-items-center">
                                <div class="row col-md-12">






                        <form name="zips" action="{{ route('human.zip') }}" method="post">  
                           @csrf
                           <table class="table table-hover">  
                               <tr>  
                                   <th><input type="checkbox" onClick="toggle(this)" />  Select All</th>  
                                   <th>File Name</th>  
                               </tr>  
                               <tr>  
                               @foreach($attaches_doc as $attach_doc)
                               @if(strlen($attach_doc) > 0)
                                   <td><input type="checkbox" name="files[]" value="{{ public_path().$attach_doc }}" /></td>  
                                   <td>{{ substr($attach_doc,24) }}</td>  
                                   <tr>  
                                   @endif
                           @endforeach
                               <td colspan="2"><input type="submit" class="btn btn-outline-warning" name="createpdf" value="Download as ZIP" />&nbsp;  
                               <input type="reset" name="reset" class="btn btn-outline-warning" value="Reset" /></td>  
                          </tr> 

                     
                               </tr>  
                               </table> 
                               </form>  

                               <script language="JavaScript">
                            function toggle(source) {  alert("vfvfv");
  checkboxes = document.getElementsByName('files[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
</script>
                               
<!-- 
                                    <div class="col-4">
                                    <a href="{{ route('human.download', $employee->id) }}" class="btn btn-outline-warning">Download 
                                               <img src="{{ url($attaches_photo) }}" alt="attach" width="100%" height="100%">
                                               </a>
                                            </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <!-- END Page Content -->
@endsection
