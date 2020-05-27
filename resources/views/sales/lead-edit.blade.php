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
    <script src="{{ asset('js/pages/sales/EditSales.js') }}"></script>
    <!-- <script src=" js/pages/sales/calc.js "></script> -->
    


    <!-- Page JS Helpers (Flatpickr + BS Datepicker + BS Colorpicker + BS Maxlength + Select2 + Masked Inputs + Ion Range Slider plugins) -->
    <script>jQuery(function(){ One.helpers(['notify', 'flatpickr', 'datepicker', 'colorpicker', 'maxlength', 'select2', 'masked-inputs', 'rangeslider']); });</script>
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Edit Lead
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Lead & Sales</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">New Lead</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <form name="lead-form" id="lead-form" action="/leads/{{ $LE->id}} " method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Lead details</h3>
                </div>
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6 border-right">
                                    <div class="form-group">
                                        <label for="subject">Subject</label>
                                        <input type="text" class="form-control" id="subject" name="subject" value="{{ $LE->subject }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="related">Related</label>
                                        <select class="form-control" id="related"  name="related"  required>
                                            <option value="Lead" {{ $LE->related === "Lead" ? "selected" : "" }}> Lead </option>
                                            <option value="Sales" {{ $LE->related === "Sales" ? "selected" : "" }}> Sales </option>
                                        </select>
                                    </div>

                                    <label for="client">Client</label>
                                    <div class="input-group">
                                        <select class="form-control client-select2 " id="client" name="client"  required>
                                             @if(isset($LE->company_id))<option value="com{{ $LE->company->id }}" > {{ $LE->company->company_name }} </option> @else <option value="con{{ $LE->contact->id }}" > {{ $LE->contact->contact_name }} </option>  @endif 
                                        </select>
{{--                                        <div class="input-group-append">--}}
{{--                                            <button type="button" class="btn btn-dark">Quick Add</button>--}}
{{--                                        </div>--}}
                                    </div>

                                    <div class="row pt-3">
                                        <div class="col-md-6">
                                            <div class="form-group" >
                                                <label for="date" class="control-label">Date</label>
                                                <div class="input-group date">
                                                    <input type="date" id="date" name="date"
                                                           class="form-control" value="{{ $LE->date }}"  autocomplete="off" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" >
                                                <label for="open-till" class="control-label">Open Till</label>
                                                <div class="input-group date">
                                                    <input type="date" id="open-till" name="open-till"
                                                           class="form-control" value="{{ $LE->till_date }}" autocomplete="off" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select class="form-control" id="status" name="status" required>
                                                    <option value="Draft" {{ $LE->status === "Draft" ? "selected" : "" }}> Draft </option>
                                                    <option value="Sent" {{ $LE->status === "Sent" ? "selected" : "" }}> Sent </option>
                                                    <option value="Open" {{ $LE->status === "Open" ? "selected" : "" }}> Open </option>
                                                    <option value="Revised" {{ $LE->status === "Revised" ? "selected" : "" }}> Revised </option>
                                                    <option value="Declined" {{ $LE->status === "Declined" ? "selected" : "" }}> Declined </option>
                                                    <option value="Accepted" {{ $LE->status === "Accepted" ? "selected" : "" }}> Accepted </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="employee">Assigned</label>
                                                <select class="form-control employee-select2" id="employee" name="employee" required>
                                                    <option>{{ $LE->employee->full_name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    @if(isset($LE->company_id))
                                    <div class="form-group">
                                        <label for="address" class="control-label">Address</label>
                                        <input type="text" name="address" value="{{ $LE->company->address }}" id="address" class="form-control" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label" for="country">Country</label>
                                                <input type="text" name="country" value="{{ $LE->company->country }}" id="country" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label" for="city">City</label>
                                                <input type="text" name="city" value="{{ $LE->company->city }}" id="city" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label" for="email">Email</label>
                                                <input type="text" name="email" value="{{ $LE->company->Email }}" id="email" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label" for="phone">Phone</label>
                                                <input type="text" name="phone" value="{{ $LE->company->telephone }}" id="phone" class="form-control" required>
                                            </div>
                                        </div>

                                        @else

                                        <div class="form-group">
                                        <label for="address" class="control-label">Address</label>
                                        <input type="text" name="address" value="{{ $LE->contact->contact_address }}" id="address" class="form-control" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label" for="country">Country</label>
                                                <input type="text" name="country" value="{{ $LE->contact->contact_country }}" id="country" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label" for="city">City</label>
                                                <input type="text" name="city" value="{{ $LE->contact->contact_city }}" id="city" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label" for="email">Email</label>
                                                <input type="text" name="email" value="{{ $LE->contact->contact_email }}" id="email" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label" for="phone">Phone</label>
                                                <input type="text" name="phone" value="{{ $LE->contact->contact_telephone }}" id="phone" class="form-control" required>
                                            </div>
                                        </div>

                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block">
                <div class="col-md-12">
                <div class="pt-2 mb-2">
                        <strong class="text-black">
                            Select Product
                        </strong>
                    </div>
                    
       <!-- <div id="txtHint">Customer info will be listed here...</div> -->
       <div class="row">
                        <div class="form-group col-6">
                            <div class="row">
                                <div class="col-6 pr-1">
                                    <select class="form-control product-select2"  id="product" name="product" >
                                        <option></option>
                                    </select>
                                </div>
                                <div class="col-6 pl-0">
                                    <button type="button" class="btn pull-right btn-success pro-item-button"  id="prod-add-btn">
                                        <i class="si si-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive s_table">
                    <table  class="table estimate-items-table items table-main-estimate-edit has-calculations no-mtop prod-select-table" id="prod-select-table">
                        <thead>
                            <tr>
                                <th style="width: 20%; text-align: left">
                                    <i class="fa fa-exclamation-circle" aria-hidden="true" data-toggle="tooltip" data-title="New lines are not supported for item description. Use the item long description instead."></i>
                                    Item
                                </th>
                                <th style="width: 30%; text-align: left">Description</th>
                                <th style="width: 10%; text-align: right" class="qty">Qty</th>
                                <th style="width: 10%; text-align: right">Rate</th>
                                <th style="width: 10%; text-align: right">VAT %5</th>
                                <th style="width: 15%; text-align: right">Amount</th>
                                <th style="width: 5%; text-align: center"><i class="fa fa-cog"></i></th>
                            </tr>
                            </thead>  
                        <tbody class="ui-sortable prod-select-tbody">
                   
                            <tr class="main">
{{--                                <td>--}}
{{--                                    <textarea name="description" rows="2" class="form-control" placeholder="Description"></textarea>--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <textarea name="long-description" rows="2" class="form-control" placeholder="Long description"></textarea>--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <input type="number" name="quantity" min="0" value="1" class="form-control qty" placeholder="Quantity">--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <input type="number" name="rate" class="form-control unit" placeholder="Rate">--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <input type="number" name="vat" class="form-control vat" placeholder="%5">--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                      <input type="number" name="amount" class="form-control amount" placeholder="Total Amount">--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <button type="button" class="btn pull-right btn-danger">--}}
{{--                                        <i class="fa fa-times"></i>--}}
{{--                                    </button>--}}
{{--                                </td>--}}
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12 col-md-offset-6">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                                <td colspan="4" class="font-w600">Subtotal</td>
                                <td class="text-right">
                                    <!-- BD  &nbsp;<b><span id="td-subtotal"> {{ number_format($LE->subtotal, 3) }}</span></b> -->
                                    BD  &nbsp;<b><span id="td-subtotal"> </span></b>
                                </td>
                            </tr>
                            <!-- <tr>
                                <td colspan="4" class="font-w600">Subtotal</td>
                                <td class="text-right">
                                    BD  &nbsp;<b><span id="td-subtotal-without"> 0.000</span></b>
                                </td>
                            </tr> -->
                            <tr>
                                <td colspan="4" class="font-w600">Total VAT</td>
                                <td class="text-right">
                                BD  &nbsp;<b><span id="td-totalVat"> </span></b>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" class="font-w600 align-middle">Discount</td>
                                <td class="text-right">
                                    <div class="row">
                                        <div class="col-1" style="margin-left: auto; padding-top: 5px;">
                                            <span class="align-middle"></span>
                                        </div>
                                        <div class="col-2">
                                            <input type="number" class="form-control align-middle" min="0.000" name="td-discount" id="td-discount"   step="0.001"  >
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" class="font-w600">Total</td>
                                <td class="text-right">
                                BD  &nbsp;<b><span id="td-total"> </span></b>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <div class="form-group text-center mr-3">
                        <a href="{{ route('sales.list') }}" class="mr-3">
                            <button type="button" class="btn btn-sm btn-light cancel-btn">
                                Cancel
                            </button>
                        </a>
                        <button type="submit" class="btn btn-sm btn-primary save-lead-btn">
                            <i class="fa fa-check mr-1"></i>
                            Save
                        </button>
                    </div>


                    <div class="form-group pb-4" style="text-align: right; padding-top: 36px;">
                        {{--                    <a href="{{ route('human.list') }}" class="mr-3">--}}
                        {{--                        <button type="button" class="btn btn-sm btn-light cancel-btn" style="padding: 5px 30px;">--}}
                        {{--                            Cancel--}}
                        {{--                        </button>--}}
                        {{--                    </a>--}}

                    </div>
                </div>
            </div>
        </form>
    </div>


    <!-- END Page Content -->
@endsection
