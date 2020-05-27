@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/sweetalert2/sweetalert2.min.css') }}">
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

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/users/tables_datatables.js') }}"></script>
    <script src="{{ asset('js/pages/users/dialogs.min.js') }}"></script>
    <script src="{{ asset('js/pages/users/user.js') }}"></script>
    <!-- Page JS Code -->

@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                	Bank Accounts
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Accounting</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">Banks Account list</a>
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
                <h3 class="block-title">Banks Account list</h3>
                <button type="button" class="btn btn-sm btn-info push" data-toggle="modal" data-target="#modal-block-fadein-user">Add New Bank Account</button>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full user-table" id="user-table">
                    <thead>
                    <tr>
                        <th>Account</th>
                        <th>Bank</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>account name</td>
                            <td>bank name</td>
                            <td>type</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-primary edit-user"><i class="fa fa-fw fa-pencil-alt"></i></button>
                                    <button type="button" class="btn btn-sm btn-primary delete-user"><i class="fa fa-fw fa-times"></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>

    <!-- Fade In Block Modal -->
    <div class="modal fade" id="modal-block-fadein-user" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <i class="si si-magnifier-add pr-2"></i>
                        <h3 class="block-title">New Bank Account</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content font-size-sm">
                        <form>
                            <div class="row push">
                                <div class="col-lg-8 col-xl-12">
                                    <div class="form-group">
                                       <label for="1">Account Name</label>
                                       <input type="text" class="form-control" id="1" name="1" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="2">Bank Name</label>
                                        <select class="form-control permission-group" id="2" name="2" required >
                                           <option value="0">Select from bank table</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="3">Type</label>
                                        <select class="form-control permission-group" id="3" name="3" required >
                                           <option value="0">Select from bank account table</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                       <label for="4">Account Number</label>
                                       <input type="text" class="form-control" id="4" name="5" required>
                                    </div>
                                    <div class="form-group">
                                       <label for="5">IBAN</label>
                                       <input type="text" class="form-control" id="5" name="5" required>
                                    </div>
                                    <div class="form-group">
                                       <label for="6">Initial Balance</label>
                                       <input type="text" class="form-control" id="6" name="6" required>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="block-content block-content-full text-right border-top bg-amethyst-light">
                    <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-sm btn-primary user-save-button" id="user-save-button"><i class="fa fa-check mr-1"></i>Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END Fade In Block Modal -->

    <!-- Fade In Block User edit Modal -->
    <div class="modal fade" id="edit-user-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <i class="fa fa-user-edit pr-2"></i>
                        <h3 class="block-title">Edit User</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content font-size-sm">
                        <form>
                            <div class="row push">
                                <div class="col-lg-8 col-xl-12">
                                    <div class="form-group">
                                        <label for="edit-user-full-name">Full Name</label>
                                        <input type="text" class="form-control" id="edit-user-full-name" name="full-name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-user-name">Username</label>
                                        <input type="text" class="form-control" id="edit-user-name" name="username" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-user-email">eMail</label>
                                        <input type="text" class="form-control" id="edit-user-email" name="email">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="block-content block-content-full text-right border-top bg-amethyst-light">
                    <button type="button" class="btn btn-sm btn-secondary cancel-user-btn" id="cancel-user">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-sm btn-success save-user-btn" id="save-user">
                        <i class="fa fa-check mr-1"></i>
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- END Fade In Block Modal -->

    <!-- END Page Content -->
@endsection
