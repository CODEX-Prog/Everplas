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
    <script src="{{ asset('js/pages/users/group.js') }}"></script>

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
                            <a class="link-fx" href="">Group</a>
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
                <h3 class="block-title"> Group Table </h3>
                <button type="button" class="btn btn-sm btn-info push" data-toggle="modal" data-target="#modal-block-fadein-group">Add New Group</button>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full group-table" id="group-table">
                    <thead>
                    <tr>
                        <th class="d-none d-sm-table-cell" style="width: 45%;"> Group </th>
                        <th class="d-none d-sm-table-cell" style="width: 45%;"> Total User </th>
                        <th class="text-center" style="width: 10%;"> Actions </th>
                    </tr>
                    </thead>
                    <tbody  id="group-tablebody">
                        @for ($i = 0; $i < count($groups); $i++)
                            <tr>
                                <td class="d-none d-sm-table-cell font-w600">
                                    {{ $groups[$i]->group_name }}
                                </td>
                                <td class="text-muted">
                                    {{ rand(2, 10) }} days ago
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-primary edit-group" id="edit-group-{{ $groups[$i]->id }}-{{ $i }}">
                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-primary delete-group" id="delete-group-{{ $groups[$i]->id }}-{{ $i }}">
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

        <!-- Fade In Block Create Group Modal -->
        <div class="modal fade" id="modal-block-fadein-group" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein-group" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <i class="si si-magnifier-add pr-2"></i>
                            <h3 class="block-title">New Group</h3>
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
                                            <label for="group_name">Group Name</label>
                                            <input type="text" class="form-control group_name" id="group_name" name="group_name" required>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel-save-group-btn">
                            Close
                        </button>
                        <button type="button" class="btn btn-success user-save-button"  id="save-group-btn">
                            <i class="fa fa-check mr-1"></i>
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Fade In Block Modal -->

        <!-- Fade In Block Edit Group Modal -->
        <div class="modal fade" id="modal-block-edit-group" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein-group" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <i class="fa fa-user-edit pr-2"></i>
                            <h3 class="block-title">Edit</h3>
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
                                            <label for="edit-group_name">Group Name</label>
                                            <input type="text" class="form-control group_name" id="edit-group_name" name="group_name" required>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-right border-top bg-amethyst-light">
                        <button type="button" class="btn btn-sm btn-secondary cancel-group-edit-btn" id="cancel-group-edit-btn">
                            Cancel
                        </button>
                        <button type="button" class="btn btn-sm btn-success save-group-edit-btn"  id="save-group-edit-btn">
                            <i class="fa fa-check mr-1"></i>
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Fade In Block Modal -->

    </div>
    <!-- END Page Content -->
@endsection
