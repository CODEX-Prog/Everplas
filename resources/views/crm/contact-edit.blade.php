@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
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
                    Edit Contact
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Contacts</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">Edit Contact</a>
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
                <h3 class="block-title">Contact Details</h3>
            </div>
            <div class="block-content block-content-full">
                <form name="asset-form" id="asset-form" action="{{ url('/crm/updatecontact') }}" method="post" enctype="multipart/form-data">
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
                    <input type="hidden" value="{{ $contact->id }}" name="id">
                    <div class="row push col-lg-12 col-x12">
                        <div class="col-lg-6 col-x6">
                            <div class="form-group">
                                <label for="name">Contact Name</label>
                                <input type="text" class="form-control"  id="edit-contact-name" name="edit-contact-name" value="{{ $contact->contact_name }}" required>
                            </div>
                            <div class="form-group">
                                        <label for="edit-contact-company">Company</label>
                                        <select class="edit-contact-company-select2 form-control" id="edit-contact-company" name="edit-company-id" required>
                                            <option value=""></option>
                                        </select>
                                    </div>

                            <div class="form-group">
                                <label for="name">Telephne</label>
                                <input type="text" class="form-control" id="edit-contact-telephone" name="edit-telephone"  value="{{ $contact->contact_telephone }}" required>
                            </div>

                            <div class="form-group">
                                <label for="name">Country</label>
                                <input type="text" class="form-control" id="edit-contact-country" name="edit-country" value="{{ $contact->contact_country}}" required>
                            </div>
                            <div class="form-group">
                                        <label for="edit-contact-city">City</label>
                                        <input type="text" class="form-control" id="edit-contact-city" name="edit-city" value="{{ $contact->contact_city}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-contact-address">Address</label>
                                        <input type="text" class="form-control" id="edit-contact-address" name="edit-address" value="{{ $contact->contact_address}}" required>
                                    </div>

                            <div class="form-group">
                                <label for="name">Email</label>
                                <input type="text" class="form-control" id="edit-contact-email" name="edit-email" value="{{ $contact->contact_email}}" required>
                            </div>

                            <div class="form-group">
                                <label for="name">Mobile </label>
                                <input type="text" class="form-control" id="edit-contact-mobile" name="edit-mobile" value="{{ $contact->contact_mobile }}" required>
                            </div>

                            <div class="form-group">
                                <label for="name">Mobile 2</label>
                                <input type="text" class="form-control" id="edit-contact-mobile2" name="edit-mobile2" value="{{ $contact->contact_mobile2 }}" required>
                            </div>

                            <div class="form-group">
                                <label for="name">Job Title </label>
                                <input type="text" class="form-control" id="edit-contact-job" name="edit-job-title" value="{{ $contact->contact_mobile }}" required>
                            </div>



                        </div>
                        <div class="col-lg-6 col-x6">

                        <div class="form-group">
                                        <label for="edit-contact-group">Group</label>
                                        <select class="edit-contact-group-select2 form-control" id="edit-contact-group" name="edit-group-id" required>
                                            <option value="-1" >Select an option</option>
                                            <option value="" ></option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Business card</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" data-toggle="custom-file-input" id="edit-contact-card" name="edit-contact-card" required>
                                            <label class="custom-file-label" for="edit-contact-card">Choose file</label>
                                        </div>
                                    </div>




                        </div>
                        <div class="block-content block-content-full text-right">
                            <a href="{{ route('crm.contact') }}">
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
