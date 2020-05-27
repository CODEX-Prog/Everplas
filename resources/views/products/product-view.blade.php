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
                Products
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Products</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">View Product</a>
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
                                    <!-- 2 buttons to Edit and Download -->
                                    <a href="{{ url('/inventory/editasset/'.$product->id) }}" style="display:inline; margin-top: 50px; margin-left: 500px; background-color: DodgerBlue;  border: none; color: white;  padding: 12px 16px; font-size: 16px; cursor: pointer;  background-color: RoyalBlue;"><i class="fa fa-edit"></i> Edit </a>
                        <form action="{{ url('/crm/deletecontact') }}" style="display:inline;"  method="post">
                        <button style="margin-top: 50px; margin-left: 150px; background-color: DodgerBlue;  border: none; color: white;  padding: 12px 16px; font-size: 16px; cursor: pointer;  background-color: red;" ><i class="fa fa-trash-alt"></i>  Delete</button> 
                        </form>
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
                                       value="{{ $product->name }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="color">Product Color</label>
                                <select class="form-control" id="color" name="color" disabled>
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
                                       value="{{ $product->weight }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="thickness">Thickness</label>
                                <input type="text" class="form-control" id="thickness" name="thickness"
                                       value="{{ $product->thickness }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="ending">Ending</label>
                                <select class="form-control" id="ending" name="ending" disabled>
                                    <option value="SP" {{ $product->ending === 'SP' ? 'selected' : '' }}>SP</option>
                                    <option value="PP" {{ $product->ending === 'PP' ? 'selected' : '' }}>PP</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Product Display</label>
                                <select class="form-control" id="status" name="status" disabled>
                                    <option value="1" {{ $product->status === 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $product->status === 0 ? 'selected' : '' }}>Not Active</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-x4">
                            <div class="form-group">
                                <label for="wt-size">WT Size</label>
                                <input type="text" class="form-control" id="wt-size" name="wt-size"
                                       value="{{ $product->wt_size }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="category-id">Category</label>
                                <select class="form-control category-select2" id="category-id" name="category-id" disabled>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Bellow Quantity</label>
                                <input type="text" class="form-control" id="quantity" name="quantity"
                                       value="{{ $product->quantity }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="prod-price">Price Per PCS</label>
                                <input type="text" class="form-control" id="prod-price" name="price" value="{{ $product->price }}" disabled>
                            </div>
                            <div class="form-group">
                               <label for="price">Cost Price</label>
                                <input type="text" class="form-control" id="price" name="price" value="{{ $product->price }}" disabled>
                        </div>
                            <div class="form-group">
             
                            </div>
                        </div>
                        <div class="col-lg-4 col-x4">
                            <div class="form-group">
                                <label for="code">Product Code</label>
                                <input type="text" class="form-control" id="code" name="code" value="{{ $product->code }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="material-select2">Content</label>
                               
                                <select class="js-select2 form-control" id="material-select2" name="vendor-id" style="width: 100%;" data-placeholder="Choose many.." multiple disabled>
                                @foreach($materials as $material)
                                    <option>{{ $material->name }}</option>
                                @endforeach
                                </select>
                               
                            </div>
                            <div class="form-group">
                                <label for="length">Length</label>
                                <input type="text" class="form-control" id="length" name="length" value="{{ $product->length }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="issue">Product issue</label>
                                <input type="text" disabled class="form-control" id="issue" name="issue" value="{{ $product->issue }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="size">Product Size</label>
                                <input type="text" class="form-control" id="size" name="size" value="{{ $product->size }}" disabled>
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
