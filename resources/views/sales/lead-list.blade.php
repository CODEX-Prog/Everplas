@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/ion-rangeslider/css/ion.rangeSlider.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/dropzone/dist/min/dropzone.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/flatpickr/flatpickr.min.css') }}">
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
    <script src="{{ asset('js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('js/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
    <script src="{{ asset('js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ asset('js/plugins/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('js/plugins/flatpickr/flatpickr.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/sales/tables_datatables.js') }}"></script>
    <script src="{{ asset('js/pages/users/dialogs.min.js') }}"></script>
    <script src="{{ asset('js/pages/sales/sales.js') }}"></script>
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Lead & Sales
                </h1>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <div class="row">
            <div class="col-6 col-md-3 col-lg-6 col-xl-3">
                <a class="block block-rounded block-link-pop border-left border-primary border-4x"
                    href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Lead Open</div>
                        <div class="font-size-h2 font-w400 text-dark">{{ count($leadOpen) }} </div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3 col-lg-6 col-xl-3">
                <a class="block block-rounded block-link-pop border-left border-primary border-4x"
                    href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Lead In Process</div>
                        <div class="font-size-h2 font-w400 text-dark">{{ count($leadinProcess) }}</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3 col-lg-6 col-xl-3">
                <a class="block block-rounded block-link-pop border-left border-primary border-4x"
                    href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Lead Close</div>
                        <div class="font-size-h2 font-w400 text-dark">{{ count($leadDeclined) }}</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3 col-lg-6 col-xl-3">
                <a class="block block-rounded block-link-pop border-left border-primary border-4x"
                    href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Sales Complete</div>
                        <div class="font-size-h2 font-w400 text-dark">{{ count($SalesPaid) }}</div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-2 ml-auto">
                <a href="{{ route('sales.create') }}">
                    <button type="button" class="btn btn-info btn-lg btn-block new-lead" id="new-lead">New Lead</button>
                </a>
            </div>
        </div>
        <div class="row">
        <div class="col-lg-12">
            <div class="block">
                <ul class="nav nav-tabs nav-tabs-block custom-tab-header" data-toggle="tabs" role="tablist">
                    <li class="nav-item lead-tab">
                        <a class="nav-link active" href="#btabs-animated-slideleft-lead">Lead</a>
                    </li>
                    <li class="nav-item lead-tab">
                        <a class="nav-link" href="#btabs-animated-slideleft-sales">Sales</a>
                    </li>
                    <li class="nav-item lead-tab">
                        <a class="nav-link" href="#btabs-animated-slideleft-archive">Sale Archives</a>
                    </li>
                </ul>
                <div class="block-content tab-content">
                    <div class="tab-pane fade fade-left show active" id="btabs-animated-slideleft-lead" role="tabpanel">
                    <!-- Dynamic Table Full -->
                        <div class="block">
                            <div class="block-content block-content-full lead-table">
                                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                                <table class="table table-bordered table-striped table-vcenter js-dataTable-full lead-table" id="lead-table">
                                    <thead>
                                        <tr>
                                        <th>Lead ID</th>
                                        <th>Client</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Open Till</th>
                                        <th>Time Ago</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if( count($leads) > 0 )
                                        @for($i = 0; $i < count($leads); $i++)
                                        <tr>
                                            <td>{{ $leads[$i]->id }}</td>
                                            @if(isset($leads[$i]->company_id))
                                                <td>{{ $leads[$i]->company->company_name }}</td>
                                            @else
                                                <td>{{ $leads[$i]->contact->contact_name }}</td>
                                            @endif
                                            <td>{{ $leads[$i]->total }}</td>
                                            <td>{{ $leads[$i]->date }}</td>
                                            <td>{{ $leads[$i]->till_date }}</td>
                                            <td>{{ floor((time() - (strtotime($leads[$i]->date))) / 86400) }} Days ago</td>
                                            <td>{{ $leads[$i]->status }}</td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <button type="button" style="background-color:#8bc34a; border:white;" class="btn btn-sm btn-primary approve-leads-btn"
                                                                    id="approve-jo-{{ $leads[$i]->id }}-{{ $i }}" data-toggle="tooltip" title="Approve">
                                                                <i class="fa fa-check"></i>
                                                    </button>
                                                    <a href="{{ url('/viewing/leads/detail/'.$leads[$i]->id) }}">
                                                    <button type="button" class="btn btn-sm btn-primary view-jo-btn" style="background-color:#FF8C00; margin-left:5px; border:white;" data-toggle="tooltip" title="View">
                                                                <i class="fa fa-book-open"></i>
                                                    </button> 
                                                    </a>
                                                    <a href="{{ url('/leads/'.$leads[$i]->id.'/edit') }}">
                                                    <button type="button" style=" margin-left:5px; " class="btn btn-sm btn-primary lead-edit-btn" data-toggle="tooltip" title="Edit" id="lead-edit-btn-{{$leads[$i]->id}}-{{$i}}">
                                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                                    </button>
                                                    </a>
                                                    <button type="button" style="background-color:#d26a5c; margin-left:5px; border:white;" class="btn btn-sm btn-primary lead-delete-btn" data-toggle="tooltip" title="Delete" id="lead-delete-btn-{{$leads[$i]->id}}-{{$i}}">
                                                        <i class="fa fa-fw fa-times"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @endfor

                                    @else
                                            {{-- No leads to display message --}}
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <!-- END Dynamic Table Full -->
                    </div>
                    <div class="tab-pane fade fade-left" id="btabs-animated-slideleft-sales" role="tabpanel">
                        <!-- Dynamic Table Full -->
                        <div class="block">
                            <div class="block-content block-content-full lead-table">
                            <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                                <table class="table table-bordered table-striped table-vcenter js-dataTable-full sales-table" id="sales-table">
                                    <thead>
                                    <tr>
                                        <th>Sales ID</th>
                                        <th>Amount</th>
                                        <th>Client</th>
                                        <th>Date</th>
                                        <th>Due Date</th>
                                        <th>Time Ago</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @for($i = 0; $i < count($leadAccepted); $i++)
                                        <tr>
                                            <td>{{ $leadAccepted[$i]->id }}</td>
                                            @if(isset($leadAccepted[$i]->company_id))
                                                <td>{{ $leadAccepted[$i]->company->company_name }}</td>
                                            @else
                                                <td>{{ $leadAccepted[$i]->contact->contact_name }}</td>
                                            @endif
                                            <td>{{ $leadAccepted[$i]->total }}</td>
                                            <td>{{ $leadAccepted[$i]->date }}</td>
                                            <td>{{ $leadAccepted[$i]->till_date }}</td>
                                            <td>{{ floor((time() - (strtotime($leadAccepted[$i]->date))) / 86400) }} Days ago</td>
                                            <td>{{ $leadAccepted[$i]->status }}</td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <button type="button" style="background-color:#8bc34a; border:white;" class="btn btn-sm btn-primary approve-jo-btn"
                                                                    id="approve-jo-{{ $leadAccepted[$i]->id }}-{{ $i }}" data-toggle="tooltip" title="Approve">
                                                                <i class="fa fa-check"></i>
                                                    </button> 
                                                    <a href="{{ url('/viewing/leads/detail/'.$leadAccepted[$i]->id) }}">
                                                    <button type="button" class="btn btn-sm btn-primary view-jo-btn" style="background-color:#FF8C00; margin-left:5px; border:white;" data-toggle="tooltip" title="View">
                                                                    <i class="fa fa-book-open"></i>
                                                    </button>
                                                    </a>
                                                    <a href="{{ url('/leads/'.$leadAccepted[$i]->id.'/edit') }}">
                                                    <button type="button" style=" margin-left:5px; " class="btn btn-sm btn-primary lead-edit-btn" data-toggle="tooltip" title="Edit" id="lead-edit-btn-{{$leadAccepted[$i]->id}}-{{$i}}">
                                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                                    </button>
                                                    </a>
                                                    <button type="button" style="background-color:#d26a5c; margin-left:5px; border:white;" class="btn btn-sm btn-primary sale-delete-btn" data-toggle="tooltip" title="Delete" id="sale-delete-btn-{{$leadAccepted[$i]->id}}-{{$i}}">
                                                        <i class="fa fa-fw fa-times" ></i>
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
                    <div class="tab-pane fade fade-left" id="btabs-animated-slideleft-archive" role="tabpanel">
                        <!-- Dynamic Table Full -->
                        <div class="block">
                            <div class="block-content block-content-full lead-table">
                                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                                <table class="table table-bordered table-striped table-vcenter js-dataTable-full user-table" id="user-table">
                                    <thead>
                                    <tr>
                                        <th>Sales ID</th>
                                        <th>Amount</th>
                                        <th>Client</th>
                                        <th>Date</th>
                                        <th>Due Date</th>
                                        <th>Time Ago</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @for($i = 0; $i < count($Archives); $i++)
                                        <tr>
                                            <td>{{ $Archives[$i]->id }}</td>
                                            @if(isset($Archives[$i]->company_id))
                                                <td>{{ $Archives[$i]->company->company_name }}</td>
                                            @else
                                                <td>{{ $Archives[$i]->contact->contact_name }}</td>
                                            @endif
                                            <td>{{ $Archives[$i]->total }}</td>
                                            <td>{{ $Archives[$i]->date }}</td>
                                            <td>{{ $Archives[$i]->till_date }}</td>
                                            <td>{{ floor((time() - (strtotime($Archives[$i]->date))) / 86400) }} Days ago</td>
                                            <td>{{ $Archives[$i]->status }}</td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                <a href="{{ url('/viewing/leads/detail/'.$Archives[$i]->id) }}">
                                                <button type="button" class="btn btn-sm btn-primary view-jo-btn" style="background-color:#FF8C00; margin-left:5px; border:white;" data-toggle="tooltip" title="View">
                                                                    <i class="fa fa-book-open"></i>
                                                    </button>
                                                </a>   
                                                <a href="{{ url('/leads/'.$Archives[$i]->id.'/edit') }}"> 
                                                    <button type="button" class="btn btn-sm btn-primary lead-edit-btn" style=" margin-left:5px; " data-toggle="tooltip" title="Edit" id="lead-edit-btn-{{$Archives[$i]->id}}-{{$i}}">
                                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                                    </button>
                                                    </a>   
                                                    <button type="button" style="background-color:#d26a5c; margin-left:5px; border:white;" class="btn btn-sm btn-primary lead-delete-btn" data-toggle="tooltip" title="Delete" id="lead-delete-btn-{{$Archives[$i]->id}}-{{$i}}">
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
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- END Page Content -->
@endsection
