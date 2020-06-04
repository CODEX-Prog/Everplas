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
    <script src="{{ asset('js/pages/users/dialogs.min.js') }}"></script>
    <script src="{{ asset('js/pages/sales/tables_datatables.js') }}"></script>
    <script src="{{ asset('js/pages/sales/sales.js') }}"></script>
    <!-- <script src=" js/pages/sales/calc.js "></script> -->
    


    <!-- Page JS Helpers (Flatpickr + BS Datepicker + BS Colorpicker + BS Maxlength + Select2 + Masked Inputs + Ion Range Slider plugins) -->
    <script>jQuery(function(){ One.helpers(['notify', 'flatpickr', 'datepicker', 'colorpicker', 'maxlength', 'select2', 'masked-inputs', 'rangeslider']); });</script>
@endsection

@section('content')
    <!-- Hero -->
    <!-- <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    View Lead
                </h1>
                
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Lead & Sales</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href=""> Lead details</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div> -->
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <form name="lead-form" id="lead-form" action="{{ url('/sales/leads') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="block">
                <!-- <div class="block-header">
                    <h3 class="block-title">Lead details</h3>
                </div> -->

                <div class="block-header">
    
            <h3 class="block-title"> #{{ $prefix->invoice. $InvidFormats }} </h3>
  
            <div class="block-options">
                <button type="button" class="btn-block-option" onclick="One.helpers('print');">
                    <i class="si si-printer mr-1"></i> Print Invoice
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
                        <p class="h3">INVOICE</p>

                        <address>
                        ISSUE DATE : &nbsp;  {{ $LD->date  }}<br>
                        INVOICE# : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  {{ $prefix->invoice. $InvidFormats }} <br>
                        DUE DATE# : &nbsp;  {{ $LD->till_date }} <br>

                        </address>
                    </div>
                    <div class="col-6 text-left font-size-sm" style="margin-top:5px;">
                        <p class="h3">Bill To</p>
                        @if(isset($LD->company_id))
                        <address>
                            {{ $LD->company->company_name }}<br>
                            {{ $LD->company->address }}<br>
                            {{ $LD->company->country }}<br>
                            {{ $LD->company->city }}<br>
                            {{ $LD->company->Email }}
                        </address>
                        @else
                        <address>
                            {{ $LD->contact->contact_name }}<br>
                            {{ $LD->contact->contact_address }}<br>
                            {{ $LD->contact->contact_country }}<br>
                            {{ $LD->contact->contact_city }}<br>
                            {{ $LD->contact->contact_email }}
                        </address>
                        @endif
                    </div>
                    
                </div>
                <div class="table-responsive push">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 60px;"></th>
                                <th>Product</th>
                                <th class="text-center" style="width: 90px;">Qnt</th>
                                <th class="text-right" style="width: 120px;">Unit</th>
                                <th class="text-right" style="width: 120px;">Vat %5</th>
                                <th class="text-right" style="width: 120px;">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                        <!-- @for($i = 0; $i < count($LD->products); $i++)
                      
                            <tr>
                                <td class="text-center">{{ $i+1 }}</td>
                                <td>
                                    <p class="font-w600 mb-1">{{ $LD->products[$i]->name }} </p>
                                    <div class="text-muted">{{ $LD->products[$i]->pivot->description ? $LD->products[$i]->pivot->description : 'No description' }}</div>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-pill badge-primary">{{ $LD->products[$i]->pivot->qty }}</span>
                                </td>
                                <td class="text-right">BD {{ number_format($LD->products[$i]->pivot->rate, 3) }}</td>
                                <td class="text-right">BD {{ number_format($LD->products[$i]->pivot->vat, 3) }}</td>
                                <td class="text-right">BD {{ number_format($LD->products[$i]->pivot->amount, 3) }}</td>
                            </tr>
                            @endfor -->
                           <!-- {{ $i=0 }} -->
                        @foreach ($LD->products as $product)
                            <tr>
                                <td class="text-center">{{ $i = $i+1 }}</td>
                                <td>
                                    <p class="font-w600 mb-1">{{ $product->name }} </p>
                                    <div class="text-muted">{{ $product->pivot->description ? $product->pivot->description : 'No description' }}</div>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-pill badge-primary" style=" font-size: 100%;">{{ $product->pivot->qty }}</span>
                                </td>
                                <td class="text-right">BD {{ number_format($product->pivot->rate, 3) }}</td>
                                <td class="text-right">BD {{ number_format($product->pivot->vat, 3) }}</td>
                                <td class="text-right">BD {{ number_format($product->pivot->amount, 3) }}</td>
                            </tr>
                        @endforeach
                            <!-- <tr>
                                <td class="text-center">2</td>
                                <td>
                                    <p class="font-w600 mb-1">Icon Pack Design</p>
                                    <div class="text-muted">50 uniquely crafted icons for promotion</div>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-pill badge-primary">1</span>
                                </td>
                                <td class="text-right">$900,00</td>
                                <td class="text-right">$900,00</td>
                            </tr> -->
                            <!-- <tr>
                                <td class="text-center">3</td>
                                <td>
                                    <p class="font-w600 mb-1">Website Design</p>
                                    <div class="text-muted">Promotional website for the mobile application</div>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-pill badge-primary">1</span>
                                </td>
                                <td class="text-right">$1.600,00</td>
                                <td class="text-right">$1.600,00</td>
                            </tr> -->
                            <tr>
                                <td></td>
                                <td colspan="4" class="font-w600 text-right">Subtotal</td>
                                <td class="text-right">BD  {{ number_format($LD->subtotal, 3) }}</td>
                            </tr>
                            <tr>
                            <td></td>
                                <td colspan="4" class="font-w600 text-right">Vat Rate</td>
                                <td class="text-right">5%</td>
                            </tr>
                            <tr>
                            <td></td>
                                <td colspan="4" class="font-w600 text-right">Vat Due</td>
                                <td class="text-right">BD  {{ number_format($LD->total_vat, 3) }}</td>
                            </tr>
                            <tr>
                            <td></td>
                                <td colspan="4" class="font-w600 text-right">Discount</td>
                                <td class="text-right">BD  {{ number_format($LD->discount, 3) }}</td>
                            </tr>
                            <tr>
                            <td></td>
                                <td colspan="4" class="font-w700 text-uppercase text-right bg-body-light">Total Due</td>
                                <td class="font-w700 text-right bg-body-light">BD  {{ number_format($LD->total, 3) }}</td>
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



    <!-- END Page Content -->
@endsection
