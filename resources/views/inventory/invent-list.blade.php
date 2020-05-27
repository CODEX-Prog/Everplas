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
                Inventory  - Asset
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Inventory</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">Asset List</a>
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
                <h3 class="block-title"> Asset List </h3>
                <a href="{{ route('inventory.asset.create') }}"><button type="button" class="btn btn-sm btn-info push">Add New Asset</button></a>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full asset-table" id="asset-table">
                    <thead>
                    <tr>
                        <th> Prefix ID   </th>
                        <th class="d-none d-sm-table-cell" > Asset Name  </th>
                        <th class="d-none d-sm-table-cell" > Manufacturer </th>
                        <th class="d-none d-sm-table-cell" > Vendor </th>
                        <th class="text-center" > Type of Asset  </th>
                        <th class="text-center" > Asset Owner   </th>
                        <th class="text-center" > Action  </th>
                    </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < count($assets); $i++)
                            <tr>
                                <td class="font-w600">
                                    @switch (strlen($assets[$i]->id))
                                        @case (1)
                                            {{ $assets[$i]->prefix.'000'.$assets[$i]->id }}
                                            @break
                                        @case (2)
                                            {{ $assets[$i]->prefix.'00'.$assets[$i]->id }}
                                            @break
                                        @case (3)
                                            {{ $assets[$i]->prefix.'0'.$assets[$i]->id }}
                                            @break
                                        @default
                                            {{ $assets[$i]->id }}
                                    @endswitch
                                </td>
                                <td class="font-w600">
                                    {{ $assets[$i]->name }}
                                </td>
                                <td class="font-w600">
                                    {{ $assets[$i]->manufacturer }}
                                </td>
                                <td class="font-w600">
                                    @if (isset($assets[$i]->company_id))
                                        {{ $assets[$i]->company->company_name }}
                                    @else
                                        {{ $assets[$i]->contact }}  
                                    @endif
                                </td>  
                                <td class="font-w600">
                                    {{ $assets[$i]->type }}
                                </td>
                                <td class="font-w600">
                                    {{ $assets[$i]->employee->full_name }}
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{ url('inventory/viewasset/'.$assets[$i]->id) }}">
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="View">
                                                <i class="fa fa-book-open"></i>
                                            </button>
                                        </a>
                                        <a href="{{ url('inventory/editasset/'.$assets[$i]->id) }}">
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
                                                <i class="fa fa-fw fa-pencil-alt"></i>
                                            </button>
                                        </a>
                                        <a>
                                            <button type="button" class="btn btn-sm btn-primary delete-asset-btn" id="delete-asset-{{ $assets[$i]->id }}-{{ $i }}"
                                                    data-toggle="tooltip" title="Delete">
                                                <i class="fa fa-fw fa-times"></i>
                                            </button>
                                        </a>
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
    <!-- END Page Content -->
@endsection
