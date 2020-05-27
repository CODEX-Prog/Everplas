@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" integrity="sha256-PZLhE6wwMbg4AB3d35ZdBF9HD/dI/y4RazA3iRDurss=" crossorigin="anonymous" />
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


    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js" integrity="sha256-P93G0oq6PBPWTP1IR8Mz/0jHHUpaWL0aBJTKauisG7Q=" crossorigin="anonymous"></script>
    <script>
    $(document).ready(function() {
        $('.gallerys').magnificPopup({type:'image', delegate:'a',     gallery: {
      enabled: true
    } });
    });
    </script>

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
                    View Maintenance
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Maintenance</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">View Maintenance</a>
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
                <form>
                    <div class="row push col-lg-12 col-x12">
                        <div class="col-lg-6 col-x6">
                            <div class="form-group">
                                <label for="asset-name">Asset Name</label>
                                <input type="text" class="form-control" id="asset-name" name="asset-name" value="{{ $maintenance->asset->name }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="company-name">Company</label>
                                <input type="text" class="form-control" id="company-name" name="company-name" value="{{ $maintenance->company->company_name }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="start-date">Start date</label>
                                <input type="date" class="form-control" id="start-date" name="start-date" value="{{ $maintenance->start_date }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="end-date">End date</label>
                                <input type="text" class="form-control" id="end-date" name="end-date" value="{{ $maintenance->end_date }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" id="description" name="description" value="{{ $maintenance->description }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="mainten-employee">Maintenance By</label>
                                <input type="text" class="form-control" id="mainten-employee" name="mainten-employee" value="{{ $maintenance->maintenEmployee->full_name }}" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6 col-x6">
                            <div class="form-group">
                                <label for="super-employee">Supervise by</label>
                                <input type="text" class="form-control" id="super-employee" name="super-employee" value="{{ $maintenance->superEmployee->full_name }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="review-employee">Review by</label>
                                <input type="text" class="form-control" id="review-employee" name="review-employee" value="{{ $maintenance->reviewEmployee->full_name }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="review-date">Review date</label>
                                <input type="date" class="form-control" id="review-date" name="review-date" value="{{ $maintenance->review_date }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="close-date">Close date</label>
                                <input type="date" class="form-control" id="close-date" name="close-date" value="{{ $maintenance->close_date }}" disabled>
                            </div>

                                                <!-- 2 buttons to Edit and Download -->
                    <a href="{{ url('/inventory/editmainten/'.$maintenance->id) }}" style="display:inline; margin-top: 50px; margin-left: 100px; background-color: DodgerBlue;  border: none; color: white;  padding: 12px 16px; font-size: 16px; cursor: pointer;  background-color: RoyalBlue;"><i class="fa fa-edit"></i> Edit </a>
                        <form action="{{ url('/crm/deletecontact') }}" style="display:inline;"  method="post">
                        <button style="margin-top: 50px; margin-left: 150px; background-color: DodgerBlue;  border: none; color: white;  padding: 12px 16px; font-size: 16px; cursor: pointer;  background-color: red;" ><i class="fa fa-trash-alt"></i>  Delete</button> 
                        </form>

                        </div>
                    </div>
                    <div class="block block-rounded block-bordered">
                        <div class="font-size-h4">Reports/Documents</div>
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="row">
                                @foreach($reports as $report)
                                    @if(strlen($report) > 0)
                                    <div class= 'row no-gutters gallerys' >
                                        <div class={{ 'col-'.(round(12/(count($reports)-1))) }}>
                                        <a href="{{ asset($report) }}" target="_blank">
                                            <img src="{{ url($report) }}" class="img-fluid" alt="report" >
                                        </a>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
