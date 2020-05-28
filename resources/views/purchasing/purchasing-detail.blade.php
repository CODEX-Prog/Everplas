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
    <script src="{{ asset('js/plugins/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
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
    <script src="{{ asset('js/pages/purchasing/purchasing.js') }}"></script>

    <!-- Page JS Helpers (Flatpickr + BS Datepicker + BS Colorpicker + BS Maxlength + Select2 + Masked Inputs + Ion Range Slider plugins) -->
    <script>jQuery(function(){ One.helpers(['notify', 'flatpickr', 'datepicker', 'colorpicker', 'maxlength', 'select2', 'masked-inputs', 'rangeslider']); });</script>

@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                Purchasing Job Order
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Purchasing</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">Job Order detail</a>
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
    
            <h3 class="block-title"> #{{ $prefix->purchase. $idFormat }} </h3>
  
            <div class="block-options">
                <button type="button" class="btn-block-option" onclick="One.helpers('print');">
                    <i class="si si-printer mr-1"></i> Print 
                </button>
             </div>
        </div>


        <!-- start -->

        <div class="block-content">
            <div class="p-sm-4 p-xl-7">
                <div class="row mb-4">
                    <div class="col-6 font-size-sm">
                        <img src="{{ asset($cominfo->logo) }}" height="150px" width="150px" alt="">
                        <p class="h3"> {{ $cominfo->name }}</p>
                        <address>
                        <!-- {{ Auth::user()->id }} <br> -->
                        {{ $cominfo->address }} <br>
                        {{ $cominfo->email }} <br>
                        {{ $cominfo->telephone }} <br>
                            <!-- Street Address<br>
                            State, City<br>
                            Region, Postal Code<br>
                            ctr@example.com -->
                        </address>
                    </div>
                    <div class="col-6 text-right font-size-sm" style="margin-top:155px;">
                        <p class="h3">PURCHASING</p>

                        <address>
                        ISSUE DATE : &nbsp;  {{ $purdetail->start_date  }}<br>
                        PURCHASING : &nbsp; {{ $prefix->purchase. $idFormat }} <br>
                        IMPORTANCE : &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; {{ $purdetail->importance }} <br>
                        DUE DATE : &nbsp;  {{ $purdetail->due_date }} <br>

                        </address>
                        
                    </div>


                    <div class="col-6 text-left font-size-sm" style="margin-top:5px;">
                        <span style="float:left;" class="h5">Subject:</span> &nbsp;  {{ $purdetail->subject }}   
                    
                    </div>

                    <div class="col-6 text-right font-size-sm" >
                        <label class="h5">Assigned To:</label> &nbsp; {{ $purdetail->employee->full_name}}
                    </div>
                </div>
                
                <div class="table-responsive push">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 60px;"></th>
                                <th>Product</th>
                                <th class="text-center" style="width: 90px;">Qnt</th>
                                <th class="text-center" style="width: 120px;">KG</th>
                                <th class="text-center" style="width: 120px;">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
     
                           <!-- {{ $i=0 }} -->
                        @foreach ($purdetail->materials as $material)
                            <tr>
                                <td class="text-center">{{ $i = $i+1 }}</td>
                                <td>
                                    <p class="font-w600 mb-1">{{ $material->name }} </p>
                                    <div class="text-muted">{{ $material->pivot->description ? $material->pivot->description : 'No description' }}</div>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-pill badge-primary" style=" font-size: 100%;">{{ $material->pivot->quantity }}</span>
                                </td>
                                <td class="text-center"> {{ number_format($material->pivot->weight, 3) }}</td>
                                <td class="text-center"> {{ number_format($material->pivot->amount, 3) }}</td>
                                
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="4" class="font-w700 text-uppercase text-right bg-body-light">Total </td> 
                            <td class="font-w700 text-right bg-body-light">BD  {{ number_format($purdetail->amount, 3) }}</td>
                        </tr>

           
                   
                        </tbody>
                    </table>
                </div>
                <p class="font-size-sm text-muted text-center py-3 my-3 border-top">
                    Thank you very much for doing business with us. We look forward to working with you again!
                </p>
            </div>
        </div>

        <!-- end -->

            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6 border-right">
                                <div class="form-group">
                                    <label for="job-subject">JO Subject</label>
                                    <input type="text" class="form-control" id="job-subject" name="job-subject"
                                           value="{{ $purdetail->subject }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="client-id">Select Company or Contact</label>
                                    <input type="text" class="form-control" id="client-id" name="client-id"
                                           value="{{ isset($purdetail->company_id) ? $purdetail->company->company_name : $purdetail->contact->contact_name }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <input type="text" class="form-control" id="status" name="status"
                                           value="{{ $purdetail->status }}" disabled>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="date" class="control-label">Date</label>
                                            <input type="text" class="js-datepicker form-control" id="date" name="date"
                                                   value="{{ $purdetail->start_date }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="due-date" class="control-label">Due Date</label>
                                            <input type="text" class="js-datepicker form-control" id="due-date" name="due-date"
                                                   value="{{ $purdetail->due_date }}" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="amount">Amount</label>
                                            <input type="text" class="form-control" id="amount" name="amount" value="{{ $purdetail->amount }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="job-order-id">JO ID</label>
                                            <input type="text" class="form-control" id="job-order-id" name="job-order-id"
                                                   value="{{ $prefix->joborder."". time(). "-" .$idFormat }}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="employee-id">Assign to</label>
                                            <input type="text" class="form-control" id="employee-id" name="employee-id"
                                                   value="{{ $purdetail->employee->full_name }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="importance">Importance</label>
                                            <input type="text" class="form-control" id="importance" name="importance"
                                                   value="{{ $purdetail->importance }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">Description / Comments</label>
                                            <textarea type="text" id="description" name="description" class="form-control" rows="2" disabled>{{ $purdetail->description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="block">
            <div class="block-header">
                <h3 class="block-title">Material List</h3>
            </div>
            <div class="table-responsive s_table">
                <table class="table estimate-items-table items table-main-estimate-edit has-calculations" id="material-table">
                    <thead>
                        <tr>
                            <th style="width: 20%; text-align: left">
                                <i class="fa fa-exclamation-circle" aria-hidden="true" data-toggle="tooltip" data-title="New lines are not supported for item description. Use the item long description instead."></i>Item
                            </th>
                            <th style="width: 35%; text-align: left">Description</th>
                            <th style="width: 10%; text-align: right" class="qty">Qty</th>
                            <th style="width: 10%; text-align: right">KG</th>
                            <th style="width: 15%; text-align: right">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="ui-sortable">
                        @foreach ($purdetail->materials as $material)
                            <tr>
                                <td>{{ $material->name }}</td>
                                <td>{{ $material->pivot->description ? $material->pivot->description : 'No description' }}</td>
                                <td>{{ $material->pivot->quantity }}</td>
                                <td>{{ $material->pivot->weight }}</td>
                                <td>{{ $material->pivot->amount }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="block block-rounded block-bordered">
            <div class="block-header">
                <h3 class="block-title">Documents</h3>
            </div>
            <div class="block-content block-content-full d-flex justify-content-between">
                <div class="row">
                    @foreach($attaches as $attach)
                        @if(strlen($attach) > 0)
                            <div class={{ 'col-'.(round(12/(count($attaches)-1))) }}>
                                <a href="{{ url($attach) }}" target="_blank">
                                    <img src="{{ url($attach) }}" alt="attach" width="200px">
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
