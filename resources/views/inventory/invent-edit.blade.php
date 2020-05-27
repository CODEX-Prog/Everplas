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
    <script src="{{ asset('js/pages/inventory/asset.js') }}"></script>
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Edit Asset
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Inventory</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">Edit Asset</a>
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
                <h3 class="block-title">Asset Details</h3>
            </div>
            <div class="block-content block-content-full">
                <form name="asset-form" id="asset-form" action="{{ url('/inventory/updateasset') }}" method="post" enctype="multipart/form-data">
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
                    <input type="hidden" value="{{ $asset->id }}" name="id">
                    <div class="row push col-lg-12 col-x12">
                        <div class="col-lg-6 col-x6">
                            <div class="form-group">
                                <label for="name">Asset Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $asset->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="delivery-date">Date of Delivery</label>
                                <input type="date" class="form-control" id="delivery-date" name="delivery-date" value="{{ $asset->delivery_date }}" required>
                            </div>
                            <div class="form-group">
                                <label for="classification">Classification</label>
                                <select class="form-control" id="classification" name="classification" required>
                                    <option value="Unclassified" {{ $asset->classification === 'Unclassified' ? 'selected' : ''}}>Unclassified</option>
                                    <option value="Public" {{ $asset->classification === 'Public' ? 'selected' : ''}}>Public</option>
                                    <option value="Internal" {{ $asset->classification === 'Internal' ? 'selected' : ''}}>Internal</option>
                                    <option value="Confidential" {{ $asset->classification === 'Confidential' ? 'selected' : ''}}>Confidential</option>
                                    <option value="Highly Confidential" {{ $asset->classification === 'Highly Confidential' ? 'selected' : ''}}>Highly Confidential</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text" class="form-control" id="location" name="location" value="{{ $asset->location }}" required>
                            </div>
                            <div class="form-group">
                                <label for="owner">Asset Owner</label>
                                <select class="form-control asset-owner-select2" id="owner" name="owner" required>
                                    <option value="-">Select Asset Owner</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="warranty-date">Warranty expire date</label>
                                <input type="date" class="form-control" id="warranty-date" name="warranty-date" value="{{ $asset->warranty_date }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-x6">
                            <div class="form-group">
                                <label for="manufacturer">Manufacturer</label>
                                <input type="text" class="form-control" id="manufacturer" name="manufacturer" value="{{ $asset->manufacturer }}" required>
                            </div>
                            <div class="form-group">
                                <label for="cost">Cost of Asset</label>
                                <input type="text" class="form-control" id="cost" name="cost" value="{{ $asset->cost }}" required>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12 col-lg-12 col-sm-12">
                                        <label for="vendor-id">Vendor Company</label>
                                        <select class="form-control asset-company-select2" id="vendor-id" name="vendor-id">
                                            <option value="-">Select Company Or Contact</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="type">Type of Asset</label>
                                <select class="form-control" id="type" name="type" required>
                                    <option value="Furniture" {{ $asset->type === 'Furniture' ? 'selected' : ''}}>Furniture</option>
                                    <option value="Hardware" {{ $asset->type === 'Hardware' ? 'selected' : ''}}>Hardware</option>
                                    <option value="Software" {{ $asset->type === 'Software' ? 'selected' : ''}}>Software</option>
                                    <option value="Machine" {{ $asset->type === 'Machine' ? 'selected' : ''}}>Machine</option>
                                    <option value="Document" {{ $asset->type === 'Document' ? 'selected' : ''}}>Document</option>
                                    <option value="Part" {{ $asset->type === 'Part' ? 'selected' : ''}}>Part</option>
                                    <option value="Folder" {{ $asset->type === 'Folder' ? 'selected' : ''}}>Folder</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="serial">Serial Number</label>
                                <input type="text" class="form-control" id="serial" name="serial" value="{{ $asset->serial }}" required>
                            </div>
                            <div class="form-group">
                                <label for="attachments">Attachment</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" data-toggle="custom-file-input"
                                           id="attachments" name="attachments[]"
                                           multiple>
                                    <label class="custom-file-label" for="14">Choose files</label>
                                </div>
                            </div>
                        </div>
                        <div class="block-content block-content-full text-right">
                            <a href="{{ route('inventory.assets') }}">
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
