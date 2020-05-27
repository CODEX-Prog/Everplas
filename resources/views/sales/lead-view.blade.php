@extends('layouts.backend')

@section('css_before')
<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
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
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Lead (Prefix+di+date)
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Lead & Sales</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">View Lead</a>
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
                <h3 class="block-title">Lead details</h3>
            </div>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6 border-right">
                                <div class="form-group">
                                    <label for="29">Subject</label>
                                    <input type="text" class="form-control" id="29" name="29" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="32">Related</label>
                                    <select class="form-control" id="32" name="32" disabled>
                                        <option value="Lead">Lead</option>
                                        <option value="Sales">Sales</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="32">Client</label>
                                    <select class="form-control" id="32" name="32" disabled>
                                        <option value="id">Client name</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" app-field-wrapper="date">
                                            <label for="date" class="control-label">Date</label>
                                            <div class="input-group date">
                                                <input type="text" id="date" name="date"
                                                    class="form-control datepicker" value="2019-10-16" autocomplete="off"
                                                    data-com.onepassword.iv disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" app-field-wrapper="open_till">
                                            <label for="open_till" class="control-label">Open Till</label>
                                            <div class="input-group date">
                                                <input type="text" id="open_till" name="open_till"
                                                    class="form-control datepicker" value="2019-10-23" autocomplete="off"
                                                    data-com.onepassword.iv>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="32">Status</label>
                                            <select class="form-control" id="32" name="32" required>
                                                <option value="6">Draft</option>
                                                <option value="4">Sent</option>
                                                <option value="1">Open</option>
                                                <option value="5">Revised</option>
                                                <option value="2">Declined</option>
                                                <option value="3">Accepted</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="32">Assigned</label>
                                            <select class="form-control" id="32" name="32" required>
                                                <option value="id">Emp. Name</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" app-field-wrapper="address">
                                    <label for="address" class="control-label">Address</label>
                                    <input type="text" name="address" id="address" class="form-control">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="country">Country</label>
                                            <input type="text" name="country" id="country" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="city">City</label>
                                            <input type="text" name="city" id="city" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="email">Email</label>
                                            <input type="text" name="email" id="email" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="phone">Phone</label>
                                            <input type="text" name="phone" id="phone" class="form-control">
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
        <h3 class="block-title">Lead information</h3>
    </div>
    <div class="col-md-12">
        <div class="panel_s">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6 border-right">
                        <div class="form-group">
                            <label for="29">Created by</label>
                            <input type="text" class="form-control" id="29" name="29" disabled>
                        </div>
                        <div class="form-group">
                            <label for="29">Created at</label>
                            <input type="text" class="form-control" id="29" name="29" disabled>
                        </div>
                    </div>
                    <div class="col-md-6 border-right">
                        <div class="form-group">
                            <label for="29">Update by</label>
                            <input type="text" class="form-control" id="29" name="29" disabled>
                        </div>
                        <div class="form-group">
                            <label for="29">Update at</label>
                            <input type="text" class="form-control" id="29" name="29" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="block">

    <div class="col-md-12">
        <div class="panel_s">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 border-right">
                        <div class="form-group">
                            <label for="29">Note</label>
                            <textarea name="" id="" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        <div class="block">

            <div class="table-responsive s_table">
                <table class="table estimate-items-table items table-main-estimate-edit has-calculations no-mtop">
                    <thead>
                        <tr>
                            <th width="20%" align="left">
                                <i class="fa fa-exclamation-circle" aria-hidden="true" data-toggle="tooltip" data-title="New lines are not supported for item description. Use the item long description instead."></i>Item
                            </th>
                            <th width="35%" align="left">Description</th>
                            <th width="8%" class="qty" align="right">Qty</th>
                            <th width="9%" align="right">Rate</th>
                            <th width="8%" align="right">Tax</th>
                            <th width="15%" align="right">Amount</th>

                        </tr>
                    </thead>
                    <tbody class="ui-sortable">
                        <tr class="main">
                            <td>
                                <input class="form-control" name="32" width="35%" align="left" disabled>
                            </td>
                            <td>
                                <input class="form-control" name="32" width="35%" align="left" disabled>
                            </td>
                            <td>
                                <input class="form-control" name="32" width="35%" align="left" disabled>
                            </td>
                            <td>
                                <input class="form-control" name="32" width="35%" align="left" disabled>
                            </td>
                            <td>
                                <input class="form-control" name="32" width="35%" align="left" disabled>
                            </td>
                            <td>
                                <input class="form-control" name="32" width="35%" align="left" disabled>
                            </td>

                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12 col-md-offset-6">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td colspan="4" class="font-w600">Subtotal</td>
                            <td class="text-right">BD 0.000</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="font-w600">Total VAT</td>
                            <td class="text-right">BD 0.000</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="font-w600">Discount</td>
                            <td class="text-right">BD 0.000</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="font-w600">Total</td>
                            <td class="text-right">BD 0.000</td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group" style="text-align: right; padding-top: 36px;">
                    <a href="{{ route('human.list') }}" class="mr-3">
                        <button type="button" class="btn btn-sm btn-light cancel-btn" style="padding: 5px 30px;">
                            Cancel
                        </button>
                    </a>
                    <button type="submit" class="btn btn-sm btn-primary create-btn" style="padding: 5px 30px;">
                    <i class="fa fa-check mr-1"></i>
                        Save Lead
                    </button>
                    <button type="submit" class="btn btn-sm btn-success create-btn" style="padding: 5px 30px;">
                        Move to Sales
                        <i class="fa fa-arrow-right mr-1"></i>
                    </button>
                </div>
            </div>

            <div id="removed-items"></div>
            <br>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
