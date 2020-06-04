@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/sweetalert2/sweetalert2.min.css') }}">
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
    <script src="{{ asset('js/pages/crm/tables_datatables.js') }}"></script>
    <script src="{{ asset('js/pages/crm/contact.js') }}"></script>
    <script src="{{ asset('js/pages/crm/dialogs.min.js') }}"></script>

    <!-- Page JS Helpers (BS Notify Plugin) -->
    <script>jQuery(function(){ One.helpers('notify'); });</script>
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Contacts
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Client</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">Contacts</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        @if(session()->has('notif'))
            <div class="row">
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
                        {{ session()->get('notif') }}
                    </button>
                </div>
            </div>
        @endif
        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header">
                <h3 class="block-title"> Contacts Table </h3>
                <button type="button" class="btn btn-sm btn-info push" data-toggle="modal" data-target="#create-contact-modal">Add New Contact</button>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full user-table" id="contact-table">
                    <thead>
                    <tr>
                        <th> Client Name </th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;"> Company </th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;"> Group </th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;"> Mobile </th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;"> Email </th>
                        <th class="text-center" style="width: 100px;"> Actions </th>
                    </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < count($contacts); $i++)
                            <tr>
                                <td class="font-w600">
                                    {{ $contacts[$i]->contact_name }}
                                </td>
                                <td class="font-w600">
                                    Company-{{ $i }}
                                </td>
                                <td class="font-w600">
                                    VIP
                                </td>
                                <td class="font-w600">
                                    {{ $contacts[$i]->contact_mobile }}
                                </td>
                                <td class="font-w600">
                                    {{ $contacts[$i]->contact_email }}
                                </td>
                                <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ url('crm/viewcontact/'.$contacts[$i]->id) }}">
                                        <button type="button" class="btn btn-sm btn-primary"  data-toggle="tooltip" title="View"  >
                                            <i class="fa fa-fw fa-book-open"></i>
                                        </button>
                                        </a>
                                        <a href="{{ url('crm/editContact/'.$contacts[$i]->id) }}">
                                        <button type="button" class="btn btn-sm btn-primary"  data-toggle="tooltip" edit-contact-btn title="Edit"   >
                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                        </button>
                                        </a>
                                        <!-- <button type="button" class="btn btn-sm btn-primary edit-contact-btn" id="edit-contact-{{ $contacts[$i]->id }}-{{ $i }}">
                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                        </button> -->
                                        
                                        <button type="button" class="btn btn-sm btn-primary delete-contact-btn" id="delete-contact-{{ $contacts[$i]->id }}-{{ $i }}"  data-toggle="tooltip" title="Delete">
                                            <i class="fa fa-fw fa-times"></i>
                                        </button>   
                                    </div>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>

    <!-- Fade In Block Create Contact Modal -->
    <div class="modal fade" id="create-contact-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">New Contact</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content font-size-sm">
                        <form id="create-contact-form">
                            <div class="row push">
                                <div class="col-lg-6 col-xl-6">
                                    <div class="form-group">
                                       <label for="create-contact-name">Contact Name</label>
                                       <input type="text" class="form-control" id="create-contact-name" name="contact-name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="create-contact-telephone">Telephone</label>
                                        <input type="number" class="form-control" id="create-contact-telephone" name="telephone" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="create-contact-mobile2">Mobile 2</label>
                                        <input type="number" class="form-control" id="create-contact-mobile2" name="mobile2" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="create-contact-company">Company</label>
                                        <select class="create-contact-company-select2 form-control" id="create-contact-company" name="company-id" required>
                                            <option value="">Select Company</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="create-contact-country">Country</label>
                                        <input type="text" class="form-control" id="create-contact-country" name="country" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="create-contact-city">City</label>
                                        <input type="text" class="form-control" id="create-contact-city" name="city" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="create-contact-address">Address</label>
                                        <input type="text" class="form-control" id="create-contact-address" name="address" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xl-6">
                                    <div class="form-group">
                                        <label for="create-contact-email">eMail</label>
                                        <input type="text" class="form-control" id="create-contact-email" name="email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="create-contact-mobile">Mobile</label>
                                        <input type="number" class="form-control" id="create-contact-mobile" name="mobile" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="create-contact-job">Job Title</label>
                                        <input type="text" class="form-control" id="create-contact-job" name="job-title" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="create-contact-group">Group</label>
                                        <select class="create-contact-group-select2 form-control" id="create-contact-group" name="group-id" required>
                                            <option value="-">Select Employee</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Business card</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" data-toggle="custom-file-input" id="create-contact-card" name="create-contact-card" required>
                                            <label class="custom-file-label" for="create-contact-card">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="block-content block-content-full text-right border-top">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success contact-save-btn" id="contact-create-save-btn">
                                    <i class="fa fa-check mr-1"></i>Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Fade In Block Modal -->

    <!-- Fade In Block view Contact Modal -->
    <div class="modal fade" id="view-contact-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <i class="fa fa-view pr-2"></i>
                        <h3 class="block-title">view Contact</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content font-size-sm">
                        <form id="view-contact-form">
                            <div class="row push">
                                <div class="col-lg-4 col-xl-6">
                                    <div class="form-group">
                                        <label for="view-contact-name">Contact Name</label>
                                        <input type="text" class="form-control" id="view-contact-name" name="view-contact-name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="view-contact-telephone">Telephone</label>
                                        <input type="text" class="form-control" id="view-contact-telephone" name="view-telephone" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="view-contact-mobile2">Mobile 2</label>
                                        <input type="text" class="form-control" id="view-contact-mobile2" name="view-mobile2" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="view-contact-company">Company</label>
                                        <select class="view-contact-company-select2 form-control" id="view-contact-company" name="view-company-id" required>
                                            <option value="">Select Company</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="view-contact-country">Country</label>
                                        <input type="text" class="form-control" id="view-contact-country" name="view-country" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xl-6">
                                    <div class="form-group">
                                        <label for="view-contact-email">eMail</label>
                                        <input type="text" class="form-control" id="view-contact-email" name="view-email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="view-contact-mobile">Mobile</label>
                                        <input type="text" class="form-control" id="view-contact-mobile" name="view-mobile" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="view-contact-job">Job Title</label>
                                        <input type="text" class="form-control" id="view-contact-job" name="view-job-title" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="view-contact-group">Group</label>
                                        <select class="view-contact-group-select2 form-control" id="view-contact-group" name="view-group-id" required>
                                            <option value="">Select Employee</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Business card</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" data-toggle="custom-file-input" id="view-contact-card" name="view-contact-card" required>
                                            <label class="custom-file-label" for="view-contact-card">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="block-content block-content-full text-right border-top">
                                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Fade In Block Modal -->



   
    <!-- Fade In Block Edit Contact Modal -->
    <div class="modal fade" id="edit-contact-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <i class="fa fa-edit pr-2"></i>
                        <h3 class="block-title">Edit Contact</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content font-size-sm">
                        <form id="edit-contact-form">
                            <div class="row push">
                                <div class="col-lg-4 col-xl-6">
                                    <div class="form-group">
                                        <label for="edit-contact-name">Contact Name</label>
                                        <input type="text" class="form-control" id="edit-contact-name" name="edit-contact-name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-contact-telephone">Telephone</label>
                                        <input type="text" class="form-control" id="edit-contact-telephone" name="edit-telephone" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-contact-mobile2">Mobile 2</label>
                                        <input type="text" class="form-control" id="edit-contact-mobile2" name="edit-mobile2" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-contact-company">Company</label>
                                        <select class="edit-contact-company-select2 form-control" id="edit-contact-company" name="edit-company-id" required>
                                            <option value="">Select Company</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-contact-country">Country</label>
                                        <input type="text" class="form-control" id="edit-contact-country" name="edit-country" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xl-6">
                                    <div class="form-group">
                                        <label for="edit-contact-email">eMail</label>
                                        <input type="text" class="form-control" id="edit-contact-email" name="edit-email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-contact-mobile">Mobile</label>
                                        <input type="text" class="form-control" id="edit-contact-mobile" name="edit-mobile" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-contact-job">Job Title</label>
                                        <input type="text" class="form-control" id="edit-contact-job" name="edit-job-title" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-contact-group">Group</label>
                                        <select class="edit-contact-group-select2 form-control" id="edit-contact-group" name="edit-group-id" required>
                                            <option value="">Select Employee</option>
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
                            </div>
                            <div class="block-content block-content-full text-right border-top">
                                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-sm btn-success contact-save-button" id="contact-edit-save-button"><i class="fa fa-check mr-1"></i>Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Fade In Block Modal -->


     

    <!-- END Page Content -->
@endsection
