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
<script src="{{ asset('js/pages/crm/tables_datatables.js') }}"></script>
<script src="{{ asset('js/pages/crm/group.js') }}"></script>
<script src="{{ asset('js/pages/crm/dialogs.min.js') }}"></script>

<!-- Page JS Helpers (BS Notify Plugin) -->

@endsection

@section('content')

    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Groups
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Client</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">Groups</a>
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
                <h3 class="block-title"> Groups List </h3>
                <button type="button" class="btn btn-sm btn-info push" data-toggle="modal" data-target="#create-group-modal">Add New Group</button>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full group-table" id="group-table">
                    <thead>
                        <tr>
                            <th> Group ID </th>
                            <th> Group Name </th>
                            <th class="text-center" style="width: 100px;"> Actions </th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < count($groups); $i++)
                            <tr>
                                <td class="font-w600">
                                    {{ $groups[$i]->id }}
                                </td>
                                <td class="font-w600">
                                    {{ $groups[$i]->name }}
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-primary edit-group-btn"
                                                id="edit-group-{{ $groups[$i]->id }}-{{$i}}">
                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-primary delete-group-btn"
                                                id="delete-group-{{ $groups[$i]->id }}-{{$i}}">
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

        <!-- Fade In Block Modal -->
        <div class="modal fade" id="create-group-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein-group" aria-hidden="true">
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
                                            <label for="create-group-name">Group Name</label>
                                            <input type="text" class="form-control" id="create-group-name" name="create-group-name" required>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-sm btn-success create-group-save-btn"
                                id="create-group-save-btn"><i class="fa fa-check mr-1"></i>Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Fade In Block Modal -->

        <!-- Fade In Block Modal -->
        <div class="modal fade" id="edit-group-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein-group" aria-hidden="true">
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
                                            <label for="edit-group-name">Group Name</label>
                                            <input type="text" class="form-control" id="edit-group-name" name="edit-group-name" required>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-sm btn-success edit-group-save-btn" id="edit-group-save-btn">
                            <i class="fa fa-check mr-1"></i>Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Fade In Block Modal -->
    </div>
    <!-- END Page Content -->
@endsection
