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
    <script src="{{ asset('js/pages/inventory/mainten.js') }}"></script>
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    New Maintenance
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Maintenance</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">New Maintenance</a>
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
                <h3 class="block-title">Maintenance Details</h3>
            </div>
            <div class="block-content block-content-full">
                <form name="mainten-form" id="mainten-form" action="{{ url('/inventory/createmainten') }}" method="post" enctype="multipart/form-data">
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
                    <div class="row push col-lg-12 col-x12">
                        <div class="col-lg-6 col-x6">
                            <div class="form-group">
                                <label for="asset-id">Select Asset</label>
                                <select class="form-control mainten-asset-select2" id="asset-id" name="asset-id" required>
                                    <option value="">Select Asset</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="company-id">Company</label>
                                <select class="form-control mainten-company-select2" id="company-id" name="company-id" required>
                                    <option value="">Select Company</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="start-date">Start date</label>
                                <input type="date" class="form-control" id="start-date" name="start-date" required>
                            </div>
                            <div class="form-group">
                                <label for="end-date">End date</label>
                                <input type="date" class="form-control" id="end-date" name="end-date" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" id="description" name="description" required>
                            </div>
                            <div class="form-group">
                                <label for="mainten-employee-id">Maintenance By</label>
                                <select class="form-control mainten-employee-select2" id="mainten-employee-id" name="mainten-employee-id" required>
                                    <option value="">Select Employee</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-x6">
                            <div class="form-group">
                                <label for="super-employee-id">Supervise by</label>
                                <select class="form-control super-employee-select2" id="super-employee-id" name="super-employee-id" required>
                                    <option value="">Select Employee</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="review-employee-id">Review by</label>
                                <select class="form-control review-employee-select2" id="review-employee-id" name="review-employee-id" required>
                                    <option value="">Select Employee</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="review-date">Review date</label>
                                <input type="date" class="form-control" id="review-date" name="review-date" required>
                            </div>
                            <div class="form-group">
                                <label for="close-date">Close date</label>
                                <input type="date" class="form-control" id="close-date" name="close-date" required>
                            </div>
                            <div class="form-group">
                                <label for="reports">Report</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" data-toggle="custom-file-input"
                                        id="reports" name="reports[]" multiple>
                                    <label class="custom-file-label" for="14">Choose files</label>
                                </div>
                            </div>
                            <div class="block-content block-content-full text-right  mt-4">
                                <a href="{{ route('inventory.maintens') }}" class="mr-4">
                                    <button type="button" class="btn btn-sm btn-light pl-3 pr-3">Close</button>
                                </a>
                                <button type="submit" class="btn btn-sm btn-primary pl-3 pr-3 ml-4">
                                    <i class="fa fa-check mr-1"></i>
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
