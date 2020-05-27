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
               Job Order
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Job Order</li>
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



        <!-- start -->
@if (isset($Findpurdetail))
<div class="block-header">
    
    <h3 class="block-title"> #{{ $FindAllOrder->Job_id }} </h3>

    <div class="block-options">
        <button type="button" class="btn-block-option" onclick="One.helpers('print');">
            <i class="si si-printer mr-1"></i> Print Invoice
        </button>
     </div>
</div>
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
                        DATE : &nbsp;  {{ $Findpurdetail->start_date  }}<br>
                        PURCHASING# : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  {{ $prefix->purchase. $idFormat }} <br>
                        DUE DATE# : &nbsp;  {{ $Findpurdetail->due_date }} <br>

                        </address>
                    </div>
                    <!-- <div class="col-6 text-left font-size-sm" style="margin-top:5px;">
                        <p class="h3">Bill To</p>

                        <address>
     
                        </address>
                    </div> -->
                </div>
                <div class="table-responsive push">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 60px;"></th>
                                <th>Material</th>
                                <th class="text-center" style="width: 90px;">Qnt</th>
                            
                           
                            </tr>
                        </thead>
                        <tbody>
     
                           <!-- {{ $i=0 }} -->
                        @foreach ($Findpurdetail->materials as $material)
                            <tr>
                                <td class="text-center">{{ $i = $i+1 }}</td>
                                <td>
                                    <p class="font-w600 mb-1">{{ $material->name }} </p>
                                    <div class="text-muted">{{ $material->pivot->description ? $material->pivot->description : 'No description' }}</div>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-pill badge-primary" style=" font-size: 100%;">{{ $material->pivot->quantity }}</span>
                                </td>
                           
                              
                                
                            </tr>
                        @endforeach


           
                   
                        </tbody>
                    </table>
                </div>
                <p class="font-size-sm text-muted text-center py-3 my-3 border-top">
                    Thank you very much for doing business with us. We look forward to working with you again!
                </p>
            </div>
        </div>
@elseif ( isset($Findrecdetail) )
<div class="block-header">
    
<h3 class="block-title"> #{{ $FindAllOrder->Job_id }} </h3>

    <div class="block-options">
        <button type="button" class="btn-block-option" onclick="One.helpers('print');">
            <i class="si si-printer mr-1"></i> Print Invoice
        </button>
     </div>
</div>
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
                        <p class="h3">Receiving</p>

                        <address>
                        DATE : &nbsp;  {{ $Findrecdetail->start_date  }}<br>
                        Receiving :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  {{ $prefix->receiving. $idFormat }} <br>
                        DUE DATE : &nbsp;  {{ $Findrecdetail->due_date }} <br>

                        </address>
                    </div>
                    <!-- <div class="col-6 text-left font-size-sm" style="margin-top:5px;">
                        <p class="h3">Bill To</p>

                        <address>
     
                        </address>
                    </div> -->
                </div>
                <div class="table-responsive push">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 60px;"></th>
                                <th>Material</th>
                                <th class="text-center" style="width: 90px;">Qnt</th>
                            
                           
                            </tr>
                        </thead>
                        <tbody>
     
                           <!-- {{ $i=0 }} -->
                        @foreach ($Findrecdetail->materials as $material)
                            <tr>
                                <td class="text-center">{{ $i = $i+1 }}</td>
                                <td>
                                    <p class="font-w600 mb-1">{{ $material->name }} </p>
                                    <div class="text-muted">{{ $material->pivot->description ? $material->pivot->description : 'No description' }}</div>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-pill badge-primary" style=" font-size: 100%;">{{ $material->pivot->quantity }}</span>
                                </td>
                           
                              
                                
                            </tr>
                        @endforeach


           
                   
                        </tbody>
                    </table>
                </div>
                <p class="font-size-sm text-muted text-center py-3 my-3 border-top">
                    Thank you very much for doing business with us. We look forward to working with you again!
                </p>
            </div>
        </div>


@else
<div class="block-header">
    
<h3 class="block-title"> #{{ $FindAllOrder->Job_id }} </h3>

    <div class="block-options">
        <button type="button" class="btn-block-option" onclick="One.helpers('print');">
            <i class="si si-printer mr-1"></i> Print Invoice
        </button>
     </div>
</div>
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
                        <p class="h3">Sales</p>

                        <address>
                        DATE : &nbsp;  {{ $Findleaddetail->date  }}<br>
                        Sales : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  {{ $prefix->invoice. $idFormat }} <br>
                        DUE DATE : &nbsp;  {{ $Findleaddetail->till_date }} <br>

                        </address>
                    </div>
                    <!-- <div class="col-6 text-left font-size-sm" style="margin-top:5px;">
                        <p class="h3">Bill To</p>

                        <address>
     
                        </address>
                    </div> -->
                </div>
                <div class="table-responsive push">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 60px;"></th>
                                <th>Product</th>
                                <th class="text-center" style="width: 90px;">Qnt</th>
                            
                           
                            </tr>
                        </thead>
                        <tbody>
     
                           <!-- {{ $i=0 }} -->

                        @foreach ($Findleaddetail->products as $product)
                            <tr>
                                <td class="text-center">{{ $i = $i+1 }}</td>
                                <td>
                                    <p class="font-w600 mb-1">{{ $product->name }} </p>
                                    <div class="text-muted">{{ $product->pivot->description ? $product->pivot->description : 'No description' }}</div>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-pill badge-primary" style=" font-size: 100%;">{{ $product->pivot->qty }}</span>
                                </td>
            
                            </tr>
                        @endforeach


           
                   
                        </tbody>
                    </table>
                </div>
                <p class="font-size-sm text-muted text-center py-3 my-3 border-top">
                    Thank you very much for doing business with us. We look forward to working with you again!
                </p>
            </div>
        </div>

@endif
        <!-- end -->

            <div class="col-md-12">
     
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
