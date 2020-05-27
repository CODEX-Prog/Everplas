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

@section('css-after')
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

<!-- Page JS Helpers (Flatpickr + BS Datepicker + BS Colorpicker + BS Maxlength + Select2 + Masked Inputs + Ion Range Slider plugins) -->
<script>jQuery(function(){ One.helpers(['flatpickr', 'datepicker', 'colorpicker', 'maxlength', 'select2', 'masked-inputs', 'rangeslider']); });</script>

<!-- Page JS Code -->
<script src="{{ asset('js/pages/hrm/tables_datatables.js') }}"></script>
<script src="{{ asset('js/pages/products/product.js') }}"></script>
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                Products
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Products</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">Add New Product</a>
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
                <h3 class="block-title">Product Details</h3>
            </div>
            <div class="block-content block-content-full">
                <form name="product-form" id="product-form" action="{{ url('/products/product/update') }}" method="post" enctype="multipart/form-data">
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
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <div class="row push">
                        <div class="col-lg-4 col-x4">
                            <div class="form-group">
                                <label for="name">Product Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{ $product->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="color">Product Color</label>
                                <select class="form-control" id="color" name="color" required>
                                    <option value="Black" {{ $product->color === 'Black' ? 'selected' : '' }}>Black</option>
                                    <option value="Orange" {{ $product->color === 'Orange' ? 'selected' : '' }}>Orange</option>
                                    <option value="Yellow" {{ $product->color === 'Yellow' ? 'selected' : '' }}>Yellow</option>
                                    <option value="Dark Grey" {{ $product->color === 'Dark Grey' ? 'selected' : '' }}>Dark Grey</option>
                                    <option value="Light Grey" {{ $product->color === 'Light Grey' ? 'selected' : '' }}>Light Grey</option>
                                    <option value="White" {{ $product->color === 'White' ? 'selected' : '' }}>White</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="weight">Weight (KG)</label>
                                <input type="text" class="form-control" id="weight" name="weight"
                                       value="{{ $product->weight }}" required>
                            </div>
                            <div class="form-group">
                                <label for="thickness">Thickness</label>
                                <input type="text" class="form-control" id="thickness" name="thickness"
                                       value="{{ $product->thickness }}" required>
                            </div>
                            <div class="form-group">
                                <label for="ending">Ending</label>
                                <select class="form-control" id="ending" name="ending" required>
                                    <option value="SP" {{ $product->ending === 'SP' ? 'selected' : '' }}>SP</option>
                                    <option value="PP" {{ $product->ending === 'PP' ? 'selected' : '' }}>PP</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Product Display</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="1" {{ $product->status === 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $product->status === 0 ? 'selected' : '' }}>Not Active</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-x4">
                            <div class="form-group">
                                <label for="wt-size">WT Size</label>
                                <input type="text" class="form-control" id="wt-size" name="wt-size"
                                       value="{{ $product->wt_size }}" required>
                            </div>
                            <div class="form-group">
                                <label for="category-id">Category</label>
                                <select class="form-control category-select2" id="category-id" name="category-id" required>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Bellow Quantity</label>
                                <input type="text" class="form-control" id="quantity" name="quantity"
                                       value="{{ $product->quantity }}" required>
                            </div>
                            <div class="form-group">
                                <label for="prod-price">Price Per PCS</label>
                                <input type="text" class="form-control" id="prod-price" name="price" value="{{ $product->price }}">
                            </div>
{{--                            <div class="form-group">--}}
{{--                                <label for="price">Cost Price</label>--}}
{{--                                <input type="text" class="form-control" id="price" name="price" value="{{ $product->price }}">--}}
{{--                            </div>--}}
                            <div class="form-group">
                                <label for="photos">Photo</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" data-toggle="custom-file-input"
                                        id="photos" name="photos[]" multiple required>
                                    <label class="custom-file-label" for="photos">Choose Photos</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-x4">
                            <div class="form-group">
                                <label for="code">Product Code</label>
                                <input type="text" class="form-control" id="code" name="code" value="{{ $product->code }}" required>
                            </div>
                            <div class="form-group">
                                <label for="material-select2">Content</label>
                                <select class="js-select2 form-control" id="material-select2" name="vendor-id" style="width: 100%;" data-placeholder="Choose many.." multiple required>
                                    <option>{{ $product->code }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="length">Length</label>
                                <input type="text" class="form-control" id="length" name="length" value="{{ $product->length }}" required>
                            </div>
                            <div class="form-group">
                                <label for="issue">Product issue</label>
                                <input type="text" disabled class="form-control" id="issue" name="issue" value="{{ $product->issue }}">
                            </div>
                            <div class="form-group">
                                <label for="size">Product Size</label>
                                <input type="text" class="form-control" id="size" name="size" value="{{ $product->size }}">
                            </div>
                            <div class="block-content block-content-full text-right pb-0" style="padding-top: 38px;">
                                <a href="{{ route('products.prod-list') }}">
                                    <button type="button" class="btn btn-sm btn-light mr-2 cancel-save-btn" style="padding: 5px 25px;">Close</button>
                                </a>
                                <button type="submit" class="btn btn-sm btn-primary ml-2 save-prod-btn" style="padding: 5px 25px;"><i class="fa fa-check mr-1"></i>Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
