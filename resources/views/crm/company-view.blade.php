@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
    
    <!-- Add icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
        $('.gallerys').magnificPopup({type:'image', delegate:'a'});
    });
    </script>


    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/hrm/tables_datatables.js') }}"></script>
    <script src="{{ asset('js/pages/inventory/asset.js') }}"></script>
    <script src="{{ asset('js/pages/crm/tables_datatables.js') }}"></script>
    <script src="{{ asset('js/pages/crm/contact.js') }}"></script>
    <script src="{{ asset('js/pages/crm/dialogs.min.js') }}"></script>
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    View Company
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Companies</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">View Company</a>
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
                <h3 class="block-title">Company Details</h3>
            </div>
            <div class="block-content block-content-full">
                <form>
                    <div class="row push col-lg-12 col-x12">
                        <div class="col-lg-6 col-x6">
                            <div class="form-group">
                                <label for="name">Company Name</label>
                                <input type="text" class="form-control" id="name"
                                       name="name" value="{{ $company->company_name }}" disabled>
                            </div>

                            <div class="form-group">
                            <label for="telephone"> Telephone</label>
                                <input type="text" class="form-control" id="name"
                                         name="contact_telephone" value="{{ $company->telephone }}" disabled>
                            </div>
                            <div class="form-group">
                            <label for="moble"> Website</label>
                                <input type="text" class="form-control" id="name"
                                       name="contact_mobile" value="{{ $company->website }}" disabled>
                            </div>

                            <div class="form-group">
                            <label for="Country">Address</label>
                            <input type="text" class="form-control" id="name"
                                       name="contact_country" value="{{ $company->address}}" disabled>
                            </div>
                            <div class="form-group">
                            <label for="Email">Country</label>
                            <input type="text" class="form-control" id="name"
                                       name="contact_email" value="{{ $company->country }}" disabled>
                            </div>
                            <div class="form-group">
                            <label for="moblie2">Vat Number</label>
                                <input type="text" class="form-control" id="name"
                                       name="contact_mobile2" value="{{ $company->vat_number }}" disabled>
                            </div>
                            <div class="form-group">
                            <label for="moblie2">Fax</label>
                                <input type="text" class="form-control" id="name"
                                       name="name" value="{{ $company->fax }}" disabled>
                            </div>

                            <div class="form-group">
                            <label for="moblie2">Group </label>
                                <input type="text" class="form-control" id="name"
                                       name="name" value="{{ $Group->name }}" disabled>
                            </div>

                            <div class="form-group">
                            <label for="moblie2">City</label>
                                <input type="text" class="form-control" id="name"
                                       name="name" value="{{ $company->city }}" disabled>
                            </div>
         

                        </div>
                        <div class="col-lg-6 col-x6">
                        
                         <!-- 2 buttons to Edit and Download -->
                         <a href="{{ url('crm/editCompany/'.$company->id) }}" style="display:inline; margin-top: 50px; margin-left: 140px; background-color: DodgerBlue;  border: none; color: white;  padding: 12px 16px; font-size: 16px; cursor: pointer;  background-color: RoyalBlue;"><i class="fa fa-edit"></i> Edit </a>
                        <form action="{{ url('/crm/deletecontact') }}" style="display:inline;"  method="post">
                        <button style="margin-top: 50px; margin-left: 150px; background-color: DodgerBlue;  border: none; color: white;  padding: 12px 16px; font-size: 16px; cursor: pointer;  background-color: red;" ><i class="fa fa-trash-alt"></i>  Delete</button> 
                        </form>
                      @if(strlen($attaches) > 0)
                          <div class= 'row no-gutters gallerys' >
                            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                            <a href="{{ asset($attaches) }}" target="_blank">
                              <img src="{{ asset($attaches) }}" class="img-fluid" alt="attach" style="border-style:solid; margin-top: 80px; margin-left :110%;" >
                              </a>
                              </div>
                          </div>
                          <!-- <a href="/download{{ $attaches }}" style="margin-top: 50px; margin-left: 220px; background-color: DodgerBlue;  border: none; color: white;  padding: 12px 16px; font-size: 16px; cursor: pointer;  background-color: RoyalBlue;" class="btn"><i class="fa fa-download"></i> Download </a> -->
                      @endif

                 
                       

                        </div>
                    </div>
                </form>
            </div>
            <div class="block block-rounded block-bordered" >
                <div  class="font-size-h4">Attachment</div>
                <div class="block-content block-content-full d-flex justify-content-between align-items-center">
                    <div class="row">
                      
    
                       
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
