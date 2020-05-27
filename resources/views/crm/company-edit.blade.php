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
    <script src="{{ asset('js/plugins/es6-promise/es6-promise.auto.min.js') }}"></script>
    <script src="{{ asset('js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('js/plugins/select2/js/select2.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/hrm/tables_datatables.js') }}"></script>
    <script src="{{ asset('js/pages/crm/tables_datatables.js') }}"></script>
    <script src="{{ asset('js/pages/crm/contact.js') }}"></script>
    <script src="{{ asset('js/pages/crm/dialogs.min.js') }}"></script>
  
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Edit Company
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Companies</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">Edit Company</a>
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
                <h3 class="block-title">Company Details</h3>
            </div>
            <div class="block-content block-content-full">
                <form name="asset-form" id="asset-form" action="{{ url('/crm/updatecompany') }}" method="post" enctype="multipart/form-data">
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
                    <input type="hidden" value="{{ $company->id }}" name="id">
                    <div class="row push col-lg-12 col-x12">
                        <div class="col-lg-6 col-x6">
                        <div class="form-group">
                                        <label for="edit-company-name">Company Name</label>
                                        <input type="text" class="form-control" id="edit-company-name" name="company_name" value="{{ $company->company_name }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-company-telephone">Telephone</label>
                                        <input type="text" class="form-control" id="edit-company-telephone" name="telephone" value="{{ $company->telephone }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-company-website">Website</label>
                                        <input type="text" class="form-control" id="edit-company-website" name="website" value="{{ $company->website }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-company-address">Address</label>
                                        <input type="text" class="form-control" id="edit-company-address" name="address" value="{{ $company->address }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-company-country">Country</label>
                                        <input type="text" class="form-control" id="edit-company-country" name="country" value="{{ $company->country }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-company-email">Email</label>
                                        <input type="text" class="form-control" id="edit-company-email" name="email" value="{{ $company->Email }}" required>
                                    </div>
                                </div>
                <div class="col-lg-4 col-xl-6 col-md-6">
                                    <div class="form-group">
                                        <label for="edit-company-vat-number">VAT Number</label>
                                        <input type="text" class="form-control" id="edit-company-vat-number" name="vat_number" value="{{ $company->vat_number }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-company-fax">Fax</label>
                                        <input type="text" class="form-control" id="edit-company-fax" name="fax" value="{{ $company->fax }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="edit-company-city">City</label>
                                        <input type="text" class="form-control" id="edit-company-city" name="city" value="{{ $company->city }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="edit-contact-group">Group</label>
                                        <select class="edit-contact-group-select2 form-control" id="group_id" name="group_id" required>
                                            <option value="">Select Employee</option>
                                        </select>
                                    </div>



                                    <div class="form-group">
                                        <label for="company-logo">Company Logo</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" data-toggle="custom-file-input"
                                                   id="company-edit-logo" name="company-logo" >
                                            <label class="custom-file-label">Choose Photos</label>
                                        </div>
                                    </div>



                             </div>
               

 




                        <div class="block-content block-content-full text-right">
                            <a href="{{ route('crm.company') }}">
                                <button type="button" class="btn btn-sm btn-light">Close</button>
                            </a>
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fa fa-check mr-1"></i>
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
