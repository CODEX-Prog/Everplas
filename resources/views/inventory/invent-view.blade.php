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
    <script src="{{ asset('js/pages/inventory/asset.js') }}"></script>
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    View Asset
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Inventory</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">View Asset</a>
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
                <h3 class="block-title">Asset Details</h3>
            </div>
            <div class="block-content block-content-full">
                <form>
                    <div class="row push col-lg-12 col-x12">
                        <div class="col-lg-6 col-x6">
                            <div class="form-group">
                                <label for="name">Asset Name</label>
                                <input type="text" class="form-control" id="name"
                                       name="name" value="{{ $asset->name }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="delivery-date">Date of Delivery</label>
                                <input type="date" class="form-control" id="delivery-date"
                                       name="delivery-date" value="{{ $asset->delivery_date }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="classification">Classification</label>
                                <input type="text" class="form-control" id="classification"
                                       name="classification" value="{{ $asset->classification }}" disabled>
                            </div>
                            <div class="form-group">
                            <label for="location">Location</label>
                                <input type="text" class="form-control" id="location"
                                       name="location" value="{{ $asset->location }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="owner">Asset Owner</label>
                                <input type="text" class="form-control" id="owner"
                                       name="owner" value="{{ $employee->full_name }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="warranty-date">Warranty expire date</label>
                                <input type="date" class="form-control" id="warranty-date"
                                       name="warranty-date" value="{{ $asset->warranty_date }}" disabled>
                            </div>

                        </div>
                        <div class="col-lg-6 col-x6">
                            <div class="form-group">
                                <label for="manufacturer">Manufacturer</label>
                                <input type="text" class="form-control" id="manufacturer"
                                       name="manufacturer" value="{{ $asset->manufacturer }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="cost">Cost of Asset</label>
                                <input type="text" class="form-control" id="cost"
                                       name="cost" value="{{ $asset->cost }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="vendor">Vendor</label>
                                <input type="text" class="form-control" id="vendor" name="vendor" disabled>
                            </div>
                            <div class="form-group">
                            <label for="type">Type of Asset</label>
                                <input type="text" class="form-control" id="type"
                                       name="type" value="{{ $asset->type }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="serial">Serial Number</label>
                                <input type="text" class="form-control" id="serial"
                                       name="serial" value="{{ $asset->serial }}" disabled>
                            </div>
                        </div>
                    </div>
                </form>

                    <!-- 2 buttons to Edit and Download -->
                    <a href="{{ url('/inventory/editasset/'.$asset->id) }}" style="display:inline; margin-top: 50px; margin-left: 500px; background-color: DodgerBlue;  border: none; color: white;  padding: 12px 16px; font-size: 16px; cursor: pointer;  background-color: RoyalBlue;"><i class="fa fa-edit"></i> Edit </a>
                        <form action="{{ url('/crm/deletecontact') }}" style="display:inline;"  method="post">
                        <button style="margin-top: 50px; margin-left: 150px; background-color: DodgerBlue;  border: none; color: white;  padding: 12px 16px; font-size: 16px; cursor: pointer;  background-color: red;" ><i class="fa fa-trash-alt"></i>  Delete</button> 
                        </form>
            </div>
            <div class="block block-rounded block-bordered">
                <div class="font-size-h4">Attachment</div>
                <div class="block-content block-content-full d-flex justify-content-between align-items-center">
                    <div class="row">
                        @foreach($attaches as $attach)
                            @if(strlen($attach) > 0)
                            <div class= 'row no-gutters gallerys' >
                                <div class={{ 'col-'.(round(12/(count($attaches)-1))) }}>
                                <a href="{{ asset($attach) }}" target="_blank">
                                    <img src="{{ url($attach) }}" alt="attach" class="img-fluid" width="100%" height="100%">
                                </a>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
{{--                    <img src="https://icon-library.net/images/image-placeholder-icon/image-placeholder-icon-0.jpg" alt="" width="100" height="100">--}}
{{--                    <img src="https://icon-library.net/images/image-placeholder-icon/image-placeholder-icon-0.jpg" alt="" width="100" height="100">--}}
{{--                    <img src="https://icon-library.net/images/image-placeholder-icon/image-placeholder-icon-0.jpg" alt="" width="100" height="100">--}}
{{--                    <img src="https://icon-library.net/images/image-placeholder-icon/image-placeholder-icon-0.jpg" alt="" width="100" height="100">--}}
{{--                    <img src="https://icon-library.net/images/image-placeholder-icon/image-placeholder-icon-0.jpg" alt="" width="100" height="100">--}}
{{--                    <img src="https://icon-library.net/images/image-placeholder-icon/image-placeholder-icon-0.jpg" alt="" width="100" height="100">--}}
{{--                    <img src="https://icon-library.net/images/image-placeholder-icon/image-placeholder-icon-0.jpg" alt="" width="100" height="100">--}}
{{--                    <img src="https://icon-library.net/images/image-placeholder-icon/image-placeholder-icon-0.jpg" alt="" width="100" height="100">--}}
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
