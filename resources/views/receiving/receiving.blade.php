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
    <script src="{{ asset('js/pages/receiving/receiving.js') }}"></script>

    <!-- Page JS Helpers (Flatpickr + BS Datepicker + BS Colorpicker + BS Maxlength + Select2 + Masked Inputs + Ion Range Slider plugins) -->
    <script>jQuery(function(){ One.helpers(['notify', 'flatpickr', 'datepicker', 'colorpicker', 'maxlength', 'select2', 'masked-inputs', 'rangeslider']); });</script>
@endsection

@section('content')
	<!-- Hero -->
	<div class="bg-body-light">
		<div class="content content-full">
			<div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
				<h1 class="flex-sm-fill h3 my-2">
				Receiving
				</h1>
			</div>
		</div>
	</div>
	<!-- END Hero -->

	<!-- Page Content -->
	<div class="content">
		<div class="row mb-2">
			<div class="col-2 ml-auto">
				<a href="{{ route('receiving.jo-create') }}">
					<button type="button" class="btn btn-info btn-lg btn-block new-lead" id="new-lead">New Job Order</button>
				</a>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="block">
					<ul class="nav nav-tabs nav-tabs-block custom-tab-header" data-toggle="tabs" role="tablist">
						<li class="nav-item lead-tab">
							<a class="nav-link active" href="#btabs-animated-slideleft-job">Job Order</a>
						</li>
						<li class="nav-item lead-tab">
							<a class="nav-link" href="#btabs-animated-slideleft-process">In process</a>
						</li>
						<li class="nav-item lead-tab">
							<a class="nav-link" href="#btabs-animated-slideleft-receiving">Receiving</a>
						</li>
					</ul>
					<div class="block-content tab-content">
						<div class="tab-pane fade fade-left show active" id="btabs-animated-slideleft-job" role="tabpanel">
						<!-- Dynamic Table Full -->
							<div class="block">
								<div class="block-content block-content-full lead-table">
									<!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
									<table class="table table-bordered table-striped table-vcenter js-dataTable-full jo-table" id="jo-table">
										<thead>
											<tr>
												<th>JO ID</th>
												<th>Requested by</th>
												<th>From</th>
												<th>Desctiption</th>
												<th>Date</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											@for ($i = 0; $i < count($preJobs); $i++)
												<tr>
													<td>{{ $preJobs[$i]->id }}</td>
													<td>{{ $preJobs[$i]->employee->full_name }}</td>
													<td>
                                                        @if (isset($preJobs[$i]->company_id))
                                                            {{ $preJobs[$i]->company->company_name }}
                                                        @elseif (isset($preJobs[$i]->contact_id))
                                                            {{ $preJobs[$i]->contact->contact_name }}
                                                        @endif
                                                    </td>
													<td>{{ $preJobs[$i]->description }}</td>
													<td>{{ $preJobs[$i]->due_date }}</td>
													<td>{{ $preJobs[$i]->status }}</td>
													<td class="text-center">
														<div class="btn-group">
                                                            <button type="button" class="btn btn-sm btn-primary approve-jo-btn"
                                                                    id="approve-jo-{{ $preJobs[$i]->id }}-{{ $i }}" data-toggle="tooltip" title="Approve">
                                                                <i class="fa fa-check"></i>
                                                            </button>
                                                            <a href="{{ url('/receiving/job-order/detail/'.$preJobs[$i]->id) }}">
                                                                <button type="button" class="btn btn-sm btn-primary view-jo-btn" data-toggle="tooltip" title="View">
                                                                    <i class="fa fa-book-open"></i>
                                                                </button>
                                                            </a>
                                                            <a href="{{ url('/receiving/job-order/edit/'.$preJobs[$i]->id) }}">
                                                                <button type="button" class="btn btn-sm btn-primary edit-jo-btn" data-toggle="tooltip" title="Edit">
                                                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                                                </button>
                                                            </a>
															<button type="button" class="btn btn-sm btn-primary delete-jo-btn"
                                                                    id="delete-jo-{{ $preJobs[$i]->id }}-{{ $i }}" data-toggle="tooltip" title="Delete">
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
						<div class="tab-pane fade fade-left" id="btabs-animated-slideleft-process" role="tabpanel">
						   <!-- Dynamic Table Full -->
						   <div class="block">
								<div class="block-content block-content-full lead-table">
									<!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
									<table class="table table-bordered table-striped table-vcenter js-dataTable-full jo-process-table" id="jo-process-table">
										<thead>
											<tr>
												<th>JO ID</th>
												<th>Requested by</th>
												<th>From</th>
												<th>Desctiption</th>
												<th>Date</th>
												<th>Day Ago</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
                                            @for ($i = 0; $i < count($processJobs); $i++)
                                                <tr>
                                                    <td>{{ $processJobs[$i]->id }}</td>
                                                    <td>{{ $processJobs[$i]->employee->full_name }}</td>
                                                    <td>
                                                        @if (isset($processJobs[$i]->company_id))
                                                            {{ $processJobs[$i]->company->company_name }}
                                                        @elseif (isset($processJobs[$i]->contact_id))
                                                            {{ $processJobs[$i]->contact->contact_name }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $processJobs[$i]->description }}</td>
                                                    <td>{{ $processJobs[$i]->start_date }}</td>
                                                    <td>{{ ceil((time() - strtotime($processJobs[$i]->start_date))/60/60/24) }}</td>
                                                    <td>{{ $processJobs[$i]->status }}</td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-sm btn-primary complete-jo-btn"
                                                                    id="approve-jo-{{ $processJobs[$i]->id }}-{{ $i }}" data-toggle="tooltip" title="Complete">
                                                                <i class="fa fa-check"></i>
                                                            </button>
                                                            <a href="{{ url('/receiving/job-order/detail/'.$processJobs[$i]->id) }}">
                                                                <button type="button" class="btn btn-sm btn-primary view-jo-btn" data-toggle="tooltip" title="View">
                                                                    <i class="fa fa-book-open"></i>
                                                                </button>
                                                            </a>
                                                            <a href="{{ url('/receiving/job-order/edit/'.$processJobs[$i]->id) }}">
                                                                <button type="button" class="btn btn-sm btn-primary edit-jo-btn" data-toggle="tooltip" title="Edit">
                                                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                                                </button>
                                                            </a>
                                                            <button type="button" class="btn btn-sm btn-primary delete-jo-btn"
                                                                    id="delete-jo-{{ $processJobs[$i]->id }}-{{ $i }}" data-toggle="tooltip" title="Delete">
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
						<div class="tab-pane fade fade-left" id="btabs-animated-slideleft-receiving" role="tabpanel">
							<!-- Dynamic Table Full -->
							<div class="block">
								<div class="block-content block-content-full lead-table">
									<!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
									<table class="table table-bordered table-striped table-vcenter js-dataTable-full jo-receiving-table" id="jo-receiving-table">
										<thead>
										<tr>
                                            <th>JO ID</th>
                                            <th>Requested by</th>
                                            <th>From</th>
                                            <th>Desctiption</th>
                                            <th>receiving Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
										</tr>
										</thead>
										<tbody>
                                            @for ($i = 0; $i < count($doneJobs); $i++)
                                                <tr>
                                                    <td>{{ $doneJobs[$i]->id }}</td>
                                                    <td>{{ $doneJobs[$i]->employee->full_name }}</td>
                                                    <td>
                                                        @if (isset($doneJobs[$i]->company_id))
                                                            {{ $doneJobs[$i]->company->company_name }}
                                                        @elseif (isset($doneJobs[$i]->contact_id))
                                                            {{ $doneJobs[$i]->contact->contact_name }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $doneJobs[$i]->description }}</td>
                                                    <td>{{ date("d-m-Y", strtotime($doneJobs[$i]->updated_at)) }}</td>
                                                    <td>{{ $doneJobs[$i]->status }}</td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <a href="{{ url('/receiving/job-order/detail/'.$doneJobs[$i]->id) }}">
                                                                <button type="button" class="btn btn-sm btn-primary view-jo-btn" data-toggle="tooltip" title="View">
                                                                    <i class="fa fa-book-open"></i>
                                                                </button>
                                                            </a>
                                                            <a href="{{ url('/receiving/job-order/edit/'.$doneJobs[$i]->id) }}">
                                                                <button type="button" class="btn btn-sm btn-primary edit-jo-btn" data-toggle="tooltip" title="Edit">
                                                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                                                </button>
                                                            </a>
                                                            <button type="button" class="btn btn-sm btn-primary delete-jo-btn"
                                                                    id="delete-jo-{{ $doneJobs[$i]->id }}-{{ $i }}" data-toggle="tooltip" title="Delete">
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
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END Page Content -->
@endsection
