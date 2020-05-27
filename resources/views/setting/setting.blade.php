@extends('layouts.backend')

@section('css_before')
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection

@section('css_after')
@endsection

@section('js_after')
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

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/sales/tables_datatables.js') }}"></script>
    <script src="{{ asset('js/pages/users/dialogs.min.js') }}"></script>
    <script src="{{ asset('js/pages/setting/setting.js') }}"></script>

    <!-- Page JS Helpers (BS Notify Plugin) -->
    <script>jQuery(function(){ One.helpers('notify'); });</script>
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Setting
                </h1>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="block">
                    <ul class="nav nav-tabs nav-tabs-block custom-tab-header" data-toggle="tabs" role="tablist">
                        <li class="nav-item lead-tab">
                            <a class="nav-link active" href="#btabs-static-general">General</a>
                        </li>
                        <li class="nav-item lead-tab">
                            <a class="nav-link" href="#btabs-static-smtp">SMTP</a>
                        </li>
                        <li class="nav-item lead-tab">
                            <a class="nav-link" href="#btabs-static-prefix">Prefix</a>
                        </li>
                        <li class="nav-item lead-tab">
                            <a class="nav-link" href="#btabs-static-payment">Payment</a>
                        </li>
                        <li class="nav-item lead-tab">
                            <a class="nav-link" href="#btabs-static-pcategory">Product Category</a>
                        </li>
                        <li class="nav-item lead-tab">
                            <a class="nav-link" href="#btabs-static-tcategory">Task Category</a>
                        </li>
                        <li class="nav-item lead-tab">
                            <a class="nav-link" href="#btabs-static-item">Item Category</a>
                        </li>
                        <li class="nav-item lead-tab">
                            <a class="nav-link" href="#btabs-static-department">Department</a>
                        </li>
                        <li class="nav-item lead-tab">
                            <a class="nav-link" href="#btabs-static-bank">Bank</a>
                        </li>
                        <li class="nav-item lead-tab">
                            <a class="nav-link" href="#btabs-static-sms">SMS</a>
                        </li>
                    </ul>
                    <div class="block-content tab-content">
                        <div class="tab-pane fade fade-left active show" id="btabs-static-general" role="tabpanel">
 
                            @if (!empty($companyinfo)  )
                           
                            <form name="company-form" id="company-form" action="/setting/companyinformation-update/{{$companyinfo->id}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
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
                                <div class="row">
                                    <div class="col-lg-6 col-xl-6 col-md-6">
                                        <div class="form-group">
                                            <label for="company-name">Company Name</label>
                                            <input type="text" class="form-control" id="company-name" name="company-name" value="{{ $companyinfo->name }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="company-telephone">Company Telephone</label>
                                            <input type="text" class="form-control" id="company-telephone" name="company-telephone" value="{{ $companyinfo->telephone }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="company-email">Company email</label>
                                            <input type="email" class="form-control" id="company-email" name="company-email" value="{{ $companyinfo->email }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="vat-number">VAT Number</label>
                                            <input type="text" class="form-control" id="vat-number" name="vat-number" value="{{ $companyinfo->vat_number }}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xl-6 col-md-6">
                                        <div class="form-group">
                                            <label for="company-addr">Company Address</label>
                                            <input type="text" class="form-control" id="company-addr" name="company-addr" value="{{ $companyinfo->address }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="company-fax">Company FAX</label>
                                            <input type="text" class="form-control" id="company-fax" name="company-fax" value="{{ $companyinfo->fax }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="company-website">Company website</label>
                                            <input type="text" class="form-control" id="company-website" name="company-website" value="{{ $companyinfo->website }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="company-logo">Company Logo</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" data-toggle="custom-file-input"
                                                       id="company-logo" name="company-logo" value="{{ $companyinfo->logo }}">
                                                <label class="custom-file-label">Choose Photos</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-12 text-right">
                                        <button type="button" class="btn btn-sm btn-light mr-2" style="padding: 5px 12px">Cancel</button>
                                        <button type="submit" class="btn btn-sm btn-primary ml-2" style="padding: 5px 10px">
                                            <i class="fa fa-check mr-1"></i>
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </form>
                          

                            @else
                          
                            <form name="company-form" id="company-form" action="{{ route('setting.companyinformation-create') }}" method="post" enctype="multipart/form-data">
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
                                <div class="row">
                                    <div class="col-lg-6 col-xl-6 col-md-6">
                                        <div class="form-group">
                                            <label for="company-name">Company Name</label>
                                            <input type="text" class="form-control" id="company-name" name="company-name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="company-telephone">Company Telephone</label>
                                            <input type="text" class="form-control" id="company-telephone" name="company-telephone" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="company-email">Company email</label>
                                            <input type="email" class="form-control" id="company-email" name="company-email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="vat-number">VAT Number</label>
                                            <input type="text" class="form-control" id="vat-number" name="vat-number" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xl-6 col-md-6">
                                        <div class="form-group">
                                            <label for="company-addr">Company Address</label>
                                            <input type="text" class="form-control" id="company-addr" name="company-addr" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="company-fax">Company FAX</label>
                                            <input type="text" class="form-control" id="company-fax" name="company-fax" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="company-website">Company website</label>
                                            <input type="text" class="form-control" id="company-website" name="company-website" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="company-logo">Company Logo</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" data-toggle="custom-file-input"
                                                       id="company-logo" name="company-logo">
                                                <label class="custom-file-label">Choose Photos</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-12 text-right">
                                        <button type="button" class="btn btn-sm btn-light mr-2" style="padding: 5px 12px">Cancel</button>
                                        <button type="submit" class="btn btn-sm btn-primary ml-2" style="padding: 5px 10px">
                                            <i class="fa fa-check mr-1"></i>
                                            Create
                                        </button>
                                    </div>
                                </div>
                            </form>
                         
                            @endif
                   
                            
                        </div>
                        <div class="tab-pane fade fade-left" id="btabs-static-smtp" role="tabpanel">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="smtp-server">Server Name</label>
                                        <input type="text" class="form-control" id="smtp-server" name="smtp-server" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="smtp-security">Connection security</label>
                                        <input type="text" class="form-control" id="smtp-security" name="smtp-security" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="smtp-username">Username</label>
                                        <input type="text" class="form-control" id="smtp-username" name="smtp-username" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="smtp-port">Port</label>
                                        <input type="text" class="form-control" id="smtp-port" name="smtp-port" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="smtp-auth">Authentication</label>
                                        <input type="text" class="form-control" id="smtp-auth" name="smtp-auth" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="smtp-pass">Password</label>
                                        <input type="password" class="form-control" id="smtp-pass" name="smtp-pass" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12 text-right">
                                    <button type="button" class="btn btn-sm btn-light mr-2" style="padding: 5px 12px">Cancel</button>
                                    <button type="button" class="btn btn-sm btn-primary ml-2" style="padding: 5px 10px">
                                        <i class="fa fa-check mr-1"></i>
                                        Save
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade fade-left" id="btabs-static-prefix" role="tabpanel">

                        @if ( !empty($prefix) )

                            <form name="prefix-form" id="prefix-form" action="setting/prefix-update/{{ $prefix->id }}" method="post">
                                @csrf
                                @method('PATCH')
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
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label for="invoice-pre">Invoice Prefix</label>
                                            <input type="text" class="form-control" id="invoice-pre" name="invoice-pre" value="{{ $prefix->invoice }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="estimation-pre">Estimation Prefix</label>
                                            <input type="text" class="form-control" id="estimation-pre" name="estimation-pre" value="{{ $prefix->estimation }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="joborder-pre">Job Order Prefix</label>
                                            <input type="text" class="form-control" id="joborder-pre" name="joborder-pre" value="{{ $prefix->joborder }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="credit-pre">Credit note Prefix</label>
                                            <input type="text" class="form-control" id="credit-pre" name="credit-pre" value="{{ $prefix->credit_note }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="employee-pre">Employee Prefix</label>
                                            <input type="text" class="form-control" id="employee-pre" name="employee-pre" value="{{ $prefix->employee }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="bank-pre">Bank Prefix</label>
                                            <input type="text" class="form-control" id="bank-pre" name="bank-pre" value="{{ $prefix->bank }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="purchase-pre">Purchase Prefix</label>
                                            <input type="text" class="form-control" id="purchase-pre" name="purchase-pre" value="{{ $prefix->purchase }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label for="quotation-pre">Quotation Prefix</label>
                                            <input type="text" class="form-control" id="quotation-pre" name="quotation-pre" value="{{ $prefix->quotation }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="po-pre">PO Prefix</label>
                                            <input type="text" class="form-control" id="po-pre" name="po-pre" value="{{ $prefix->po }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="receipt-pre">Receipt Prefix</label>
                                            <input type="text" class="form-control" id="receipt-pre" name="receipt-pre" value="{{ $prefix->receipt }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="receiving-pre">Receiving Prefix</label>
                                            <input type="text" class="form-control" id="receiving-pre" name="receiving-pre" value="{{ $prefix->receiving }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="accent-pre">Accenting Prefix</label>
                                            <input type="text" class="form-control" id="accent-pre" name="accent-pre" value="{{ $prefix->accenting }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="transaction-pre">Transaction Prefix</label>
                                            <input type="text" class="form-control" id="transaction-pre" name="transaction-pre" value="{{ $prefix->transaction }}" required>
                                        </div>
                                        <div class="form-group text-right" style="padding-top: 35px;">
                                            <button type="button" class="btn btn-sm btn-light mr-2" style="padding: 5px 12px">Cancel</button>
                                            <button type="submit" class="btn btn-sm btn-primary ml-2" style="padding: 5px 10px">
                                                <i class="fa fa-check mr-1"></i>
                                                Save
                                            </button>
                                        </div>
                                </div>
                            </div>
                            </form>
                        @else

                        <form name="prefix-form" id="prefix-form" action="{{ route('setting.prefix-create') }}" method="post">
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
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label for="invoice-pre">Invoice Prefix</label>
                                            <input type="text" class="form-control" id="invoice-pre" name="invoice-pre" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="estimation-pre">Estimation Prefix</label>
                                            <input type="text" class="form-control" id="estimation-pre" name="estimation-pre" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="joborder-pre">Job Order Prefix</label>
                                            <input type="text" class="form-control" id="joborder-pre" name="joborder-pre" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="credit-pre">Credit note Prefix</label>
                                            <input type="text" class="form-control" id="credit-pre" name="credit-pre" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="employee-pre">Employee Prefix</label>
                                            <input type="text" class="form-control" id="employee-pre" name="employee-pre" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="bank-pre">Bank Prefix</label>
                                            <input type="text" class="form-control" id="bank-pre" name="bank-pre" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="purchase-pre">Purchase Prefix</label>
                                            <input type="text" class="form-control" id="purchase-pre" name="purchase-pre" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label for="quotation-pre">Quotation Prefix</label>
                                            <input type="text" class="form-control" id="quotation-pre" name="quotation-pre" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="po-pre">PO Prefix</label>
                                            <input type="text" class="form-control" id="po-pre" name="po-pre" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="receipt-pre">Receipt Prefix</label>
                                            <input type="text" class="form-control" id="receipt-pre" name="receipt-pre" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="receiving-pre">Receiving Prefix</label>
                                            <input type="text" class="form-control" id="receiving-pre" name="receiving-pre" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="accent-pre">Accenting Prefix</label>
                                            <input type="text" class="form-control" id="accent-pre" name="accent-pre" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="transaction-pre">Transaction Prefix</label>
                                            <input type="text" class="form-control" id="transaction-pre" name="transaction-pre" required>
                                        </div>
                                        <div class="form-group text-right" style="padding-top: 35px;">
                                            <button type="button" class="btn btn-sm btn-light mr-2" style="padding: 5px 12px">Cancel</button>
                                            <button type="submit" class="btn btn-sm btn-primary ml-2" style="padding: 5px 10px">
                                                <i class="fa fa-check mr-1"></i>
                                                Create
                                            </button>
                                        </div>
                                </div>
                            </div>
                            </form>

                        @endif
                            
                        </div>
                        <div class="tab-pane fade fade-left" id="btabs-static-payment" role="tabpanel">
                            <div class="row">
                                <button type="button" class="btn btn-info btn-block ml-auto col-2 create-payment-method-btn" id="create-payment-method-btn">
                                    Add Payment Method
                                </button>
                            </div>
                            <!-- Dynamic Table Full -->
                            <div class="block">
                                <div class="block-content block-content-full lead-table">
                                    <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full payment-method-table" id="payment-method-table">
                                        <thead>
                                            <tr>
                                                <th>Payemnt ID</th>
                                                <th>Payemnt name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for ($i = 0; $i < count($payments); $i++)
                                                <tr>
                                                    <td>{{ $payments[$i]->id }}</td>
                                                    <td>{{ $payments[$i]->name }}</td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-sm btn-primary edit-pay-btn"
                                                                    id="edit-pay-{{ $payments[$i]->id }}-{{$i}}">
                                                                <i class="fa fa-fw fa-pencil-alt"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-primary delete-pay-btn"
                                                                    id="delete-pay-{{ $payments[$i]->id }}-{{$i}}">
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
                        <div class="tab-pane fade fade-left" id="btabs-static-pcategory" role="tabpanel">
                            <div class="row">
                                <button type="button" class="btn btn-info btn-block col-2 ml-auto create-product-cat-btn" id="create-product-cat-btn">
                                    Add Product Category
                                </button>
                            </div>
                            <!-- Dynamic Table Full -->
                            <div class="block">
                                <div class="block-content block-content-full lead-table">
                                    <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full product-cat-table" id="product-cat-table">
                                        <thead>
                                            <tr>
                                                <th>Product Category ID</th>
                                                <th>Product Category name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for ($i = 0; $i < count($prodCategories); $i++)
                                                <tr>
                                                    <td>{{ $prodCategories[$i]->id }}</td>
                                                    <td>{{ $prodCategories[$i]->name }}</td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-sm btn-primary edit-prod-cat-btn"
                                                                    id="edit-prod-{{ $prodCategories[$i]->id }}-{{$i}}">
                                                                <i class="fa fa-fw fa-pencil-alt"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-primary delete-prod-cat-btn"
                                                                    id="delete-prod-{{ $prodCategories[$i]->id }}-{{$i}}">
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
                        <div class="tab-pane fade fade-left" id="btabs-static-tcategory" role="tabpanel">
                            <div class="row">
                                <button type="button" class="btn btn-info btn-block col-2 ml-auto create-task-cat-btn" id="create-task-cat-btn">
                                    Add Task Category
                                </button>
                            </div>
                            <!-- Dynamic Table Full -->
                            <div class="block">
                                <div class="block-content block-content-full lead-table">
                                    <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full task-cat-table" id="task-cat-table">
                                        <thead>
                                        <tr>
                                            <th>Task Category ID</th>
                                            <th>Task Category name</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @for ($i = 0; $i < count($taskCategories); $i++)
                                                <tr>
                                                    <td>{{ $taskCategories[$i]->id }}</td>
                                                    <td>{{ $taskCategories[$i]->name }}</td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-sm btn-primary edit-task-cat-btn"
                                                                    id="edit-task-{{ $taskCategories[$i]->id }}-{{$i}}">
                                                                <i class="fa fa-fw fa-pencil-alt"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-primary delete-task-cat-btn"
                                                                    id="delete-task-{{ $taskCategories[$i]->id }}-{{$i}}">
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
                        <div class="tab-pane fade fade-left" id="btabs-static-item" role="tabpanel">
                            <div class="row">
                                <button type="button" class="btn btn-info btn-block ml-auto col-2 create-item-cat-btn" id="create-item-cat-btn">
                                    Add Item Category
                                </button>
                            </div>
                            <!-- Dynamic Table Full -->
                            <div class="block">
                                <div class="block-content block-content-full lead-table">
                                    <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full item-cat-table" id="item-cat-table">
                                        <thead>
                                            <tr>
                                                <th>Item Category ID</th>
                                                <th>Item Category name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for ($i = 0; $i < count($itemCategories); $i++)
                                                <tr>
                                                    <td>{{ $itemCategories[$i]->id }}</td>
                                                    <td>{{ $itemCategories[$i]->name }}</td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-sm btn-primary edit-item-cat-btn"
                                                                    id="edit-item-{{ $itemCategories[$i]->id }}-{{$i}}">
                                                                <i class="fa fa-fw fa-pencil-alt"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-primary delete-item-cat-btn"
                                                                    id="delete-item-{{ $itemCategories[$i]->id }}-{{$i}}">
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
                        <div class="tab-pane fade fade-left" id="btabs-static-department" role="tabpanel">
                            <div class="row">
                                <button type="button" class="btn btn-info btn-block ml-auto col-2 create-department-btn" id="create-department-btn">
                                    Add Department
                                </button>
                            </div>
                            <!-- Dynamic Table Full -->
                            <div class="block">
                                <div class="block-content block-content-full lead-table">
                                    <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full department-table" id="department-table">
                                        <thead>
                                        <tr>
                                            <th>Department ID</th>
                                            <th>Department name</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @for ($i = 0; $i < count($departments); $i++)
                                            <tr>
                                                <td>{{ $departments[$i]->id }}</td>
                                                <td>{{ $departments[$i]->name }}</td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-sm btn-primary edit-department-btn"
                                                                id="edit-item-{{ $departments[$i]->id }}-{{$i}}">
                                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-primary delete-department-btn"
                                                                id="delete-item-{{ $departments[$i]->id }}-{{$i}}">
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
                        <div class="tab-pane fade fade-left" id="btabs-static-bank" role="tabpanel">
                            <div class="row">
                                <button type="button" class="btn btn-info btn-block ml-auto col-2 create-bank-btn" id="create-bank-btn">
                                    Add Bank
                                </button>
                            </div>
                            <!-- Dynamic Table Full -->
                            <div class="block">
                                <div class="block-content block-content-full lead-table">
                                    <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full bank-table" id="bank-table">
                                        <thead>
                                        <tr>
                                            <th>Bank ID</th>
                                            <th>Bank name</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @for ($i = 0; $i < count($banks); $i++)
                                            <tr>
                                                <td>{{ $banks[$i]->id }}</td>
                                                <td>{{ $banks[$i]->name }}</td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-sm btn-primary edit-bank-btn"
                                                                id="edit-item-{{ $banks[$i]->id }}-{{$i}}">
                                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-primary delete-bank-btn"
                                                                id="delete-item-{{ $banks[$i]->id }}-{{$i}}">
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
                        <div class="tab-pane fade fade-left" id="btabs-static-sms" role="tabpanel">
                            <form name="sms-form" id="sms-form" action="{{ route('setting.sms-create') }}" method="post">
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
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="sms-api-url">SMS API URL</label>
                                            <input type="text" class="form-control" id="sms-api-url" name="sms-api-url" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="sms-pass">Password</label>
                                            <input type="password" class="form-control" id="sms-pass" name="sms-pass" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                    <div class="form-group">
                                        <label for="sms-username">Username</label>
                                        <input type="text" class="form-control" id="sms-username" name="sms-username" required>
                                    </div>
                                    <div class="form-group text-right" style="padding-top: 35px;">
                                        <button type="button" class="btn btn-sm btn-light mr-2" style="padding: 5px 12px">Cancel</button>
                                        <button type="submit" class="btn btn-sm btn-primary ml-2" style="padding: 5px 10px">
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
            </div>
        </div>
    </div>

    <!-- Create Payment Method modal -->
    <div class="modal fade create-pay-modal" id="create-pay-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein-group" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <i class="si si-magnifier-add pr-2"></i>
                        <h3 class="block-title">Add</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content font-size-sm">
                        <form>
                            <div class="row push">
                                <div class="col-lg-8 col-xl-12">
                                    <div class="form-group">
                                        <label for="create-pay-name">Payment Name</label>
                                        <input type="text" autofocus class="form-control create-pay-name" id="create-pay-name" name="create-pay-name" required>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="block-content block-content-full text-right border-top bg-amethyst-light">
                    <button type="button" class="btn btn-sm btn-secondary cancel-pay-create-btn" data-dismiss="modal" id="cancel-pay-create-btn">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-sm btn-success save-pay-create-btn"  id="save-pay-create-btn">
                        <i class="fa fa-check mr-1"></i>
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Payment Method modal -->

    <!-- Create Product Category modal -->
    <div class="modal fade create-prod-modal" id="create-prod-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein-group" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <i class="si si-magnifier-add pr-2"></i>
                        <h3 class="block-title">Add</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content font-size-sm">
                        <form>
                            <div class="row push">
                                <div class="col-lg-8 col-xl-12">
                                    <div class="form-group">
                                        <label for="create-prod-cat-name">Product Category Name</label>
                                        <input type="text" autofocus class="form-control create-prod-cat-name" id="create-prod-cat-name" name="create-prod-cat-name" required>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="block-content block-content-full text-right border-top bg-amethyst-light">
                    <button type="button" class="btn btn-sm btn-secondary cancel-prod-cat-create-btn" data-dismiss="modal" id="cancel-prod-cat-create-btn">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-sm btn-success save-prod-cat-create-btn"  id="save-prod-cat-create-btn">
                        <i class="fa fa-check mr-1"></i>
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Product Category modal -->

    <!-- Create Task Category modal -->
    <div class="modal fade create-task-modal" id="create-task-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein-group" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <i class="si si-magnifier-add pr-2"></i>
                        <h3 class="block-title">Add</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content font-size-sm">
                        <form>
                            <div class="row push">
                                <div class="col-lg-8 col-xl-12">
                                    <div class="form-group">
                                        <label for="create-task-cat-name">Task Category Name</label>
                                        <input type="text" class="form-control create-task-cat-name" autofocus id="create-task-cat-name" name="create-task-cat-name" required>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="block-content block-content-full text-right border-top bg-amethyst-light">
                    <button type="button" class="btn btn-sm btn-secondary cancel-create-task-cat-btn" data-dismiss="modal" id="cancel-create-task-cat-btn">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-sm btn-success save-create-task-cat-btn"  id="save-create-task-cat-btn">
                        <i class="fa fa-check mr-1"></i>
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Task Category modal -->

    <!-- Create Item Category modal -->
    <div class="modal fade create-item-modal" id="create-item-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein-group" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <i class="si si-magnifier-add pr-2"></i>
                        <h3 class="block-title">Add</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content font-size-sm">
                        <form>
                            <div class="row push">
                                <div class="col-lg-8 col-xl-12">
                                    <div class="form-group">
                                        <label for="create-item-cat-name">Item Category Name</label>
                                        <input type="text" class="form-control create-item-cat-name" autofocus id="create-item-cat-name" name="create-item-cat-name" required>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="block-content block-content-full text-right border-top bg-amethyst-light">
                    <button type="button" class="btn btn-sm btn-secondary cancel-item-cat-create-btn" data-dismiss="modal" id="cancel-item-cat-create-btn">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-sm btn-success save-item-cat-create-btn"  id="save-item-cat-create-btn">
                        <i class="fa fa-check mr-1"></i>
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Item Category modal -->

    <!-- Create Department modal -->
    <div class="modal fade create-department-modal" id="create-department-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein-group" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <i class="si si-magnifier-add pr-2"></i>
                        <h3 class="block-title">Add</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content font-size-sm">
                        <form>
                            <div class="row push">
                                <div class="col-lg-8 col-xl-12">
                                    <div class="form-group">
                                        <label for="create-department-name">Department Name</label>
                                        <input type="text" class="form-control create-department-name" autofocus id="create-department-name" name="create-department-name" required>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="block-content block-content-full text-right border-top bg-amethyst-light">
                    <button type="button" class="btn btn-sm btn-secondary cancel-item-cat-create-btn" data-dismiss="modal" id="cancel-item-cat-create-btn">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-sm btn-success save-item-cat-create-btn"  id="save-department-create-btn">
                        <i class="fa fa-check mr-1"></i>
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Department modal -->

    <!-- Create Bank modal -->
    <div class="modal fade create-bank-modal" id="create-bank-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein-group" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <i class="si si-magnifier-add pr-2"></i>
                        <h3 class="block-title">Add</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content font-size-sm">
                        <form>
                            <div class="row push">
                                <div class="col-lg-8 col-xl-12">
                                    <div class="form-group">
                                        <label for="create-bank-name">Bank Name</label>
                                        <input type="text" class="form-control create-bank-name" autofocus id="create-bank-name" name="create-bank-name" required>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="block-content block-content-full text-right border-top bg-amethyst-light">
                    <button type="button" class="btn btn-sm btn-secondary cancel-bank-create-btn" data-dismiss="modal" id="cancel-bank-create-btn">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-sm btn-success save-bank-create-btn"  id="save-bank-create-btn">
                        <i class="fa fa-check mr-1"></i>
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bank modal -->

    <!-- Edit Payment Method modal -->
    <div class="modal fade edit-pay-modal" id="edit-pay-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein-group" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <i class="fa fa-pen-alt pr-2"></i>
                        <h3 class="block-title">Edit</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content font-size-sm">
                        <form>
                            <div class="row push">
                                <div class="col-lg-8 col-xl-12">
                                    <div class="form-group">
                                        <label for="edit-pay-name">Payment Name</label>
                                        <input type="text" class="form-control edit-pay-name" autofocus id="edit-pay-name" name="edit-pay-name" required>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="block-content block-content-full text-right border-top bg-amethyst-light">
                    <button type="button" class="btn btn-sm btn-secondary cancel-pay-create-btn" data-dismiss="modal" id="cancel-pay-edit-btn">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-sm btn-success save-pay-create-btn"  id="save-pay-edit-btn">
                        <i class="fa fa-check mr-1"></i>
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Payment Method modal -->

    <!-- Edit Product Category modal -->
    <div class="modal fade edit-prod-modal" id="edit-prod-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein-group" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <i class="fa fa-pen-alt pr-2"></i>
                        <h3 class="block-title">Edit</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content font-size-sm">
                        <form>
                            <div class="row push">
                                <div class="col-lg-8 col-xl-12">
                                    <div class="form-group">
                                        <label for="edit-prod-cat-name">Product Category Name</label>
                                        <input type="text" class="form-control create-prod-cat-name" autofocus id="edit-prod-cat-name" name="edit-prod-cat-name" required>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="block-content block-content-full text-right border-top bg-amethyst-light">
                    <button type="button" class="btn btn-sm btn-secondary cancel-prod-cat-create-btn" data-dismiss="modal" id="cancel-prod-cat-edit-btn">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-sm btn-success save-prod-cat-create-btn"  id="save-prod-cat-edit-btn">
                        <i class="fa fa-check mr-1"></i>
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Product Category modal -->

    <!-- Edit Task Category modal -->
    <div class="modal fade edit-task-modal" id="edit-task-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein-group" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <i class="fa fa-pen-alt pr-2"></i>
                        <h3 class="block-title">Edit</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content font-size-sm">
                        <form>
                            <div class="row push">
                                <div class="col-lg-8 col-xl-12">
                                    <div class="form-group">
                                        <label for="edit-task-cat-name">Task Category Name</label>
                                        <input type="text" class="form-control edit-task-cat-name" autofocus id="edit-task-cat-name" name="edit-task-cat-name" required>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="block-content block-content-full text-right border-top bg-amethyst-light">
                    <button type="button" class="btn btn-sm btn-secondary cancel-task-cat-edit-btn" data-dismiss="modal" id="cancel-task-cat-edit-btn">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-sm btn-success save-task-cat-edit-btn"  id="save-task-cat-edit-btn">
                        <i class="fa fa-check mr-1"></i>
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Task Category modal -->

    <!-- Edit Item Category modal -->
    <div class="modal fade edit-item-modal" id="edit-item-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein-group" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <i class="fa fa-pen-alt pr-2"></i>
                        <h3 class="block-title">Edit</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content font-size-sm">
                        <form>
                            <div class="row push">
                                <div class="col-lg-8 col-xl-12">
                                    <div class="form-group">
                                        <label for="edit-item-cat-name">Item Category Name</label>
                                        <input type="text" class="form-control create-item-cat-name" autofocus id="edit-item-cat-name" name="edit-item-cat-name" required>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="block-content block-content-full text-right border-top bg-amethyst-light">
                    <button type="button" class="btn btn-sm btn-secondary cancel-item-cat-edit-btn" data-dismiss="modal" id="cancel-item-cat-edit-btn">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-sm btn-success save-item-cat-edit-btn"  id="save-item-cat-edit-btn">
                        <i class="fa fa-check mr-1"></i>
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Item Category modal -->

    <!-- Edit Department modal -->
    <div class="modal fade edit-department-modal" id="edit-department-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein-group" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <i class="fa fa-pen-alt pr-2"></i>
                        <h3 class="block-title">Edit</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content font-size-sm">
                        <form>
                            <div class="row push">
                                <div class="col-lg-8 col-xl-12">
                                    <div class="form-group">
                                        <label for="edit-department-name">Department Name</label>
                                        <input type="text" class="form-control edit-department-name" autofocus id="edit-department-name" name="edit-department-name" required>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="block-content block-content-full text-right border-top bg-amethyst-light">
                    <button type="button" class="btn btn-sm btn-secondary cancel-item-cat-edit-btn" data-dismiss="modal" id="cancel-item-cat-edit-btn">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-sm btn-success save-item-cat-edit-btn"  id="save-department-edit-btn">
                        <i class="fa fa-check mr-1"></i>
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Department modal -->

    <!-- Edit Bank modal -->
    <div class="modal fade edit-bank-modal" id="edit-bank-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein-group" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <i class="fa fa-pen-alt pr-2"></i>
                        <h3 class="block-title">Edit</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content font-size-sm">
                        <form>
                            <div class="row push">
                                <div class="col-lg-8 col-xl-12">
                                    <div class="form-group">
                                        <label for="edit-bank-name">Bank Name</label>
                                        <input type="text" class="form-control edit-bank-name" autofocus id="edit-bank-name" name="edit-bank-name" required>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="block-content block-content-full text-right border-top bg-amethyst-light">
                    <button type="button" class="btn btn-sm btn-secondary cancel-item-cat-edit-btn" data-dismiss="modal" id="cancel-bank-edit-btn">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-sm btn-success save-bank-edit-btn"  id="save-bank-edit-btn">
                        <i class="fa fa-check mr-1"></i>
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bank modal -->

    <!-- END Page Content -->
@endsection
