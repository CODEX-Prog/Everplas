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
                            <a class="link-fx" href="">New Job Order</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <form name="job-create-form" id="job-create-form" action="{{ url('/purchasing/job-order') }}" method="post" enctype="multipart/form-data">
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
        <div class="block">
            <div class="block-header">
                <h3 class="block-title">Job Order details</h3>
            </div>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                    <div class="row">
                                <div class="col-md-6 border-right">
                                    <div class="form-group">
                                        <label for="job-subject">JO Subject</label>
                                        <input type="text" class="form-control" id="job-subject" name="job-subject" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="client-id">Select Company or Contact</label>
                                        <select class="form-control client-select2" id="client-id" name="client-id" required>
                                            <option></option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="Not yet">Not yet</option>
                                            <option value="id">In Progress</option>
                                            <option value="id">Completed</option>
                                            <option value="id">Cancel</option>
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="date" class="control-label">Date</label>
                                                <input type="text" class="js-datepicker form-control" id="date" name="date" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="due-date" class="control-label">Due Date</label>
                                                <input type="text" class="js-datepicker form-control" id="due-date" name="due-date" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="amount">Amount</label>
                                                <input type="number" class="form-control" id="amount" name="amount" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="job-order-id">JO ID</label>
                                                <input type="text" class="form-control" id="job-order-id" name="job-order-id"
                                                       placeholder="next >> Prefix + short date + ID" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="attachments" class="control-label">Attachment <small>(Invoice/Qutation)</small></label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" data-toggle="custom-file-input"
                                                   id="attachments" name="attachments[]" multiple required>
                                            <label class="custom-file-label" for="photos">Choose Attachments</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label" for="employee-id">Assign to</label>
                                                <select class="form-control employee-select2" id="employee-id" name="employee-id" required>
                                                    <option></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label" for="importance">Importance</label>
                                                <select class="form-control" id="importance" name="importance" required>
                                                    <option value="Urgent">Urgent</option>
                                                    <option value="Important">Important</option>
                                                    <option value="Normal">Normal</option>
                                                    <option value="For Review">For Review</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="description">Description / Comments</label>
                                                <textarea type="text" class="form-control" id="description" name="description" rows="2"></textarea>
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
        <div class="col-md-12">
                    <div class="pt-2 mb-2">
                        <strong class="text-black">
                            Select Material
                        </strong>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <div class="row">
                                <div class="col-6 pr-1">
                                    <select class="form-control material-select2" id="material-id" name="material-id" required>
                                        <option></option>
                                    </select>
                                </div>
                                <div class="col-6 pl-0">
                                    <button type="button" class="btn pull-right btn-success material-add-btn">
                                        <i class="si si-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="table-responsive s_table">
                <table class="table estimate-items-table items table-main-estimate-edit has-calculations no-mtop" id="material-table">
                    <thead>
                        <tr>
                            <th width="20%" align="left">
                                <i class="fa fa-exclamation-circle" aria-hidden="true" data-toggle="tooltip" data-title="New lines are not supported for item description. Use the item long description instead."></i>Item
                            </th>
                            <th width="35%" align="left">Description</th>
                            <th width="8%" class="qty" align="right">Qty</th>
                            <th width="9%" align="right">KG</th>
                            <th width="15%" align="right">Amount</th>
                            <th width="5%" align="center"><i class="fa fa-cog"></i></th>
                        </tr>
                    </thead>
                    <tbody class="ui-sortable">

                    </tbody>
                </table>
                <div class="form-group text-right mr-3">
  
                            <button type="submit"  class="btn btn-sm btn-success create-btn-pur" style="padding: 5px 30px;">
                                Move to Purchasing
                                <i class="fa fa-arrow-right mr-1"></i>
                            </button>
                        
                    </div>
                </div>

        </div>
    </form>
    </div>
    <!-- END Page Content -->
@endsection
