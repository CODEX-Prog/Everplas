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
    <script src="{{ asset('js/pages/users/tables_datatables.js') }}"></script>
    <script src="{{ asset('js/pages/users/dialogs.min.js') }}"></script>
    <script src="{{ asset('js/pages/users/user.js') }}"></script>


    <!-- Page JS Code -->


    <!-- Page JS Helpers (BS Notify Plugin) -->
    <script>jQuery(function(){ One.helpers('notify'); });</script>
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Users & Group
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Users & Group</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">Users</a>
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
                <h3 class="block-title"> User Table </h3>
                <button type="button" class="btn btn-sm btn-info push" data-toggle="modal" data-target="#modal-block-fadein-user">Add New User</button>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full user-table" id="user-table">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;"> Id </th>
                        <th> Full Name </th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;"> Group </th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;"> Status </th>
                        <th class="text-center" style="width: 100px;"> Actions </th>
                    </tr>
                    </thead>
                    <tbody>
                    @for ($i = 0; $i < count($users); $i++)
                        <tr>
                            <td class="font-w600">
                                {{ $users[$i]->id }}
                            </td>
                            <td class="font-w600">
                                {{ $users[$i]->full_name }}
                            </td>
                            <td class="d-none d-sm-table-cell text-muted">
                                {{ $users[$i]->email }}
                            </td>
                            <td class="text-muted">
                           {{ floor((time() - (strtotime($users[$i]->created_at))) / 86400) }} Days ago
                         
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-primary edit-user"
                                            id="edit-user-{{ $users[$i]->id }}-{{ $i }}">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-primary delete-user"
                                            id="delete-user-{{ $users[$i]->id }}-{{ $i }}">
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
                        <form>
                            <div class="row push">
                                <div class="col-lg-8 col-xl-12">
                                    <div class="form-group">
                                        <label for="employee_id">Employee</label>
                                        <select class="employee-select2 form-control ml-3" name="employee_id" id="employee_id">
                                            <option value="">Select Employee Optional</option>
                                        </select>
                                    </div>
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
