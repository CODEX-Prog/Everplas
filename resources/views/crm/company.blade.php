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
    <script src="{{ asset('js/pages/crm/dialogs.min.js') }}"></script>
    <script src="{{ asset('js/pages/crm/company.js') }}"></script>


    <!-- Page JS Helpers (BS Notify Plugin) -->
    <script>jQuery(function(){ One.helpers('notify'); });</script>
    @endsection

    @section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Companies
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Client</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">Companies</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header">
                <h3 class="block-title"> Companies Table </h3>
                <button type="button" class="btn btn-sm btn-info push" data-toggle="modal" data-target="#create-company-modal">Add New company</button>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full company-table" id="company-table">
                    <thead>
                        <tr>
                            <th> Company Name </th>
                            <th class="d-none d-sm-table-cell" style="width: 30%;"> Telephone </th>
                            <th class="d-none d-sm-table-cell" style="width: 30%;"> Total Contacts </th>
                            <th class="text-center" style="width: 100px;"> Actions </th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < count($companies); $i++)
                            <tr>
                                <td class="font-w600">
                                    {{ $companies[$i]->company_name }}
                                </td>
                                <td class="d-none d-sm-table-cell text-muted">
                                    {{ $companies[$i]->telephone }}
                                </td>
                                <td class="text-muted">
                                    {{ count($companies[$i]->contacts) }}
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                    <a href="{{ url('crm/viewcompany/'.$companies[$i]->id) }}">
                                        <button type="button" class="btn btn-sm btn-primary"  data-toggle="tooltip" title="View"  >
                                            <i class="fa fa-fw fa-book-open"></i>
                                        </button>
                                        </a>
                                        <a href="{{ url('crm/editCompany/'.$companies[$i]->id) }}">
                                        <button type="button" class="btn btn-sm btn-primary"  data-toggle="tooltip" edit-contact-btn title="Edit"   >
                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                        </button>
                                        </a>
                                        <!-- <button type="button" class="btn btn-sm btn-primary edit-company" id="edit-company-{{ $companies[$i]->id }}-{{ $i }}">
                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                        </button> -->
                                        <button type="button" class="btn btn-sm btn-primary delete-company" id="delete-company-{{ $companies[$i]->id }}-{{ $i }}" data-toggle="tooltip" title="Delete">
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

    <!-- Fade In Create Company Modal -->
    <div class="modal fade" id="create-company-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <i class="si si-magnifier-add pr-2"></i>
                        <h3 class="block-title">New Company</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content font-size-sm">
                        <form id="create-company-form">
                            <div class="row push">
                                <div class="col-lg-4 col-xl-6 col-md-6">
                                    <div class="form-group">
                                       <label for="create-company-name">Company Name</label>
                                       <input type="text" class="form-control" id="create-company-name" name="company_name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="createcompany-telephone">Telephone</label>
                                        <input type="text" class="form-control" id="createcompany-telephone" name="telephone">
                                    </div>
                                    <div class="form-group">
                                        <label for="create-company-website">Website</label>
                                        <input type="text" class="form-control" id="create-company-website" name="website">
                                    </div>
                                    <div class="form-group">
                                        <label for="create-company-address">Address</label>
                                        <input type="text" class="form-control" id="create-company-address" name="address" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="create-company-country">Country</label>
                                        <input type="text" class="form-control" id="create-company-country" name="country" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="create-company-city">City</label>
                                        <input type="text" class="form-control" id="create-company-city" name="city" required>
                                    </div>

                                </div>
                                <div class="col-lg-4 col-xl-6 col-md-6">
                                    <div class="form-group">
                                        <label for="create-company-vat-number">VAT Number</label>
                                        <input type="text" class="form-control" id="create-company-vat-number" name="vat">
                                    </div>
                                    <div class="form-group">
                                        <label for="create-company-fax">Fax</label>
                                        <input type="text" class="form-control" id="create-company-fax" name="fax" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="group-id">Groups</label>
                                        <select class="create-company-group-select2 form-control" id="create-group-id" name="group-id">
                                            <option value="-">Please select Group</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="create-company-email">Email</label>
                                        <input type="text" class="form-control" id="create-company-email" name="email" required>
                                    </div>

                                    <div class="form-group" >
                                        <label for="company-logo" >Company Logo</label>
                                        <div class="custom-file" >
                                            <input type="file" class="custom-file-input" data-toggle="custom-file-input"
                                                   id="company-create-logo" name="company-logo" required>
                                            <label class="custom-file-label">Choose Photos</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="block-content block-content-full text-right border-top">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success company-create-button" id="company-create-button">
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

    <!-- Fade In Edit Company Modal -->
    <div class="modal fade" id="edit-company-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <i class="fa fa-edit pr-2"></i>
                        <h3 class="block-title">Edit Company</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content font-size-sm">
                        <form id="edit-company-form">
                            <div class="row push">
                                <div class="col-lg-4 col-xl-6 col-md-6">
                                    <div class="form-group">
                                        <label for="edit-company-name">Company Name</label>
                                        <input type="text" class="form-control" id="edit-company-name" name="company_name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-company-telephone">Telephone</label>
                                        <input type="text" class="form-control" id="edit-company-telephone" name="telephone">
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-company-website">Website</label>
                                        <input type="text" class="form-control" id="edit-company-website" name="website">
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-company-address">Address</label>
                                        <input type="text" class="form-control" id="edit-company-address" name="address" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-company-country">Country</label>
                                        <input type="text" class="form-control" id="edit-company-country" name="country" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-company-city">City</label>
                                        <input type="text" class="form-control" id="edit-company-city" name="city" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xl-6 col-md-6">
                                    <div class="form-group">
                                        <label for="edit-company-vat-number">VAT Number</label>
                                        <input type="text" class="form-control" id="edit-company-vat-number" name="vat_number">
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-company-fax">Fax</label>
                                        <input type="text" class="form-control" id="edit-company-fax" name="fax" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-group-id">Groups</label>
                                        <select class="edit-company-group-select2 form-control" id="edit-group-id" name="group-id">
                                            <option value="-">Please select Group</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-company-email">Email</label>
                                        <input type="text" class="form-control" id="edit-company-email" name="email" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="company-logo">Company Logo</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" data-toggle="custom-file-input"
                                                   id="company-edit-logo" name="company-logo" required>
                                            <label class="custom-file-label">Choose Photos</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="block-content block-content-full text-right border-top">
                                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-sm btn-success company-save-button" id="company-save-button"><i class="fa fa-check mr-1"></i>Save</button>
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
