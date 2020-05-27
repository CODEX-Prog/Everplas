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
    <script src="{{ asset('js/pages/products/materials.js') }}"></script>
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                	Material
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Products</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">Material List</a>
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
                <h3 class="block-title">Material List</h3>
                <!-- <a href="{{ route('products.material.create') }}"><button type="button" class="btn btn-sm btn-info push">Add New Asset</button></a> -->
                <button type="button" class="btn btn-sm btn-info push" data-toggle="modal" data-target="#material-create-modal">Add New Material</button>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full material-table" id="material-table">
                    <thead>
                        <tr>
                            <th style="width: 30%;">Material Name</th>
                            <th style="width: 30%;">Material code</th>
                            <th style="width: 30%;">Supplier</th>
                            <th style="width: 10%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < count($materials); $i++)
                            <tr>
                                <td>{{ $materials[$i]->name }}</td>
                                <td>{{ $materials[$i]->code }}</td>
                                <td>
                                    @if (isset($materials[$i]->company_id))
                                        {{ $materials[$i]->company->company_name }}
                                    @else
                                        {{ $materials[$i]->contact->contact_name }}
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-primary edit-btn"
                                                id="edit-btn-{{ $materials[$i]->id }}-{{ $i }}">
                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-primary delete-btn"
                                                id="edit-btn-{{ $materials[$i]->id }}-{{ $i }}">
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
    <div class="modal fade" id="material-create-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <i class="si si-magnifier-add pr-2"></i>
                        <h3 class="block-title">New Material</h3>
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
                                       <label for="mat-create-name">Material Name</label>
                                       <input type="text" class="form-control" id="mat-create-name" name="mat-create-name" required>
                                    </div>
                                    <div class="form-group">
                                       <label for="mat-create-code">Material Code</label>
                                       <input type="text" class="form-control" id="mat-create-code" name="mat-create-code" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="mat-create-supplier">Supplier</label>
                                        <select class="material-supplier-select2 form-control ml-3" id="mat-create-supplier">
                                            <option value="-">Please select Group</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="block-content block-content-full text-right border-top bg-amethyst-light">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-sm btn-success mat-create-save-btn" id="mat-create-save-btn"><i class="fa fa-check mr-1"></i>Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END Fade In Block Modal -->

    <!-- Fade In Block User edit Modal -->
    <div class="modal fade" id="material-edit-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <i class="fa fa-pencil-alt pr-2"></i>
                        <h3 class="block-title">Edit Material</h3>
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
                                        <label for="mat-edit-name">Material Name</label>
                                        <input type="text" class="form-control" id="mat-edit-name" name="mat-edit-name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="mat-edit-code">Material Code</label>
                                        <input type="text" class="form-control" id="mat-edit-code" name="mat-edit-code" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="mat-edit-supplier">Supplier</label>
                                        <select class="material-supplier-select2 form-control ml-3" id="mat-edit-supplier">
                                            <option value="-">Please select Group</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="block-content block-content-full text-right border-top bg-amethyst-light">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-sm btn-success mat-edit-save-btn" id="mat-edit-save-btn"><i class="fa fa-check mr-1"></i>Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END Fade In Block Modal -->

    <!-- END Page Content -->
@endsection
