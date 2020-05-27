@extends('layouts.backend')

@section('css_before')
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
	<script src="{{ asset('js/pages/sales/sales.js') }}"></script>
@endsection

@section('content')
	<!-- Hero -->
	<div class="bg-body-light">
		<div class="content content-full">
			<div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
				<h1 class="flex-sm-fill h3 my-2">
				Job Orders
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
							<a class="nav-link active" href="#btabs-animated-slideleft-all">All</a>
						</li>
						<li class="nav-item lead-tab">
							<a class="nav-link" href="#btabs-animated-slideleft-purchasing">Purchasing</a>
						</li>
						<li class="nav-item lead-tab">
							<a class="nav-link" href="#btabs-animated-slideleft-sales">Sales</a>
                        </li>
                        <li class="nav-item lead-tab">
							<a class="nav-link" href="#btabs-animated-slideleft-receiving">Receiving</a>
						</li>
					</ul>
					<div class="block-content tab-content">
						<div class="tab-pane fade fade-left show active" id="btabs-animated-slideleft-all" role="tabpanel">
						<!-- Dynamic Table Full -->
							<div class="block">
								<div class="block-content block-content-full lead-table">
									<!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
									<table class="table table-bordered table-striped table-vcenter js-dataTable-full user-table" id="user-table">
										<thead>
											<tr>
												<th>JO ID</th>
												<th>Requested by</th>
												<th>From</th>
												<!-- <th>Desctiption</th> -->
												<th>Date</th>
												<th>Day Ago</th>
												<th>Related</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											@for ($i = 0; $i < count($AllOrders); $i++)
												<tr>
													<td>{{ $AllOrders[$i]->id }}</td>
													<td>{{ $AllOrders[$i]->requested_by }}</td>
													<td>{{ $AllOrders[$i]->from }}</td>
													<!-- <td>{{ $AllOrders[$i]->description }}</td> -->
													<td>{{ $AllOrders[$i]->date }}</td>
													<td>{{ $AllOrders[$i]->day_ago }}</td>
													<td>{{ $AllOrders[$i]->related }}</td>
													<td>{{ $AllOrders[$i]->status }}</td>
													<td class="text-center">
														<div class="btn-group">
															<button type="button" class="btn btn-sm btn-primary complete-jo-btn"
                                                                    id="approve-jo-{{ $AllOrders[$i]->id }}-{{ $i }}" data-toggle="tooltip" title="Complete">
                                                                <i class="fa fa-check"></i>
                                                            </button>
                                                            <a href="{{ url('/joborder/detail/'.$AllOrders[$i]->id) }}">
                                                                <button type="button" class="btn btn-sm btn-primary view-jo-btn" data-toggle="tooltip" title="View">
                                                                    <i class="fa fa-book-open"></i>
                                                                </button>
                                                            </a>
                                                            <!-- <a href="{{ url('/purchasing/edit/'.$AllOrders[$i]->id) }}"> -->
                                                                <button type="button" class="btn btn-sm btn-primary edit-jo-btn" data-toggle="tooltip" title="Edit">
                                                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                                                </button>
                                                            <!-- </a> -->
															<button type="button" class="btn btn-sm btn-primary delete-jo-btn"
                                                                    id="delete-jo-{{ $AllOrders[$i]->id }}-{{ $i }}" data-toggle="tooltip" title="Delete">
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
						<div class="tab-pane fade fade-left" id="btabs-animated-slideleft-purchasing" role="tabpanel">
						   <!-- Dynamic Table Full -->
						   <div class="block">
								<div class="block-content block-content-full lead-table">
									<!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
									<table class="table table-bordered table-striped table-vcenter js-dataTable-full user-table" id="user-table">
										<thead>
											<tr>
												<th>JO ID</th>
												<th>Requested by</th>
												<th>From</th>
												<th>Desctiption</th>
												<th>Date</th>
												<th>Day Ago</th>
												<th>Related</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											@for ($i = 0; $i < count($AllPurchasingOrders); $i++)
												<tr>
													<td>{{ $AllPurchasingOrders[$i]->id }}</td>
													<td>{{ $AllPurchasingOrders[$i]->requested_by }}</td>
													<td>{{ $AllPurchasingOrders[$i]->from }}</td>
													<td>{{ $AllPurchasingOrders[$i]->description }}</td>
													<td>{{ $AllPurchasingOrders[$i]->date }}</td>
													<td>{{ $AllPurchasingOrders[$i]->day_ago }}</td>
													<td>{{ $AllPurchasingOrders[$i]->related }}</td>
													<td>{{ $AllPurchasingOrders[$i]->status }}</td>
													<td class="text-center">
														<div class="btn-group">
															<button type="button" class="btn btn-sm btn-primary complete-jo-btn"
                                                                    id="approve-jo-{{ $AllPurchasingOrders[$i]->id }}-{{ $i }}" data-toggle="tooltip" title="Complete">
                                                                <i class="fa fa-check"></i>
                                                            </button>
                                                            <a href="{{ url('/joborder/purchasing/detail/'.$AllPurchasingOrders[$i]->P_id) }}">
                                                                <button type="button" class="btn btn-sm btn-primary view-jo-btn" data-toggle="tooltip" title="View">
                                                                    <i class="fa fa-book-open"></i>
                                                                </button>
                                                            </a>
                                                            <!-- <a href="{{ url('/purchasing/edit/'.$AllPurchasingOrders[$i]->id) }}"> -->
                                                                <button type="button" class="btn btn-sm btn-primary edit-jo-btn" data-toggle="tooltip" title="Edit">
                                                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                                                </button>
                                                            <!-- </a> -->
															<button type="button" class="btn btn-sm btn-primary delete-jo-btn"
                                                                    id="delete-jo-{{ $AllPurchasingOrders[$i]->id }}-{{ $i }}" data-toggle="tooltip" title="Delete">
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
						<div class="tab-pane fade fade-left" id="btabs-animated-slideleft-sales" role="tabpanel">
							<!-- Dynamic Table Full -->
							<div class="block">
								<div class="block-content block-content-full lead-table">
									<!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
									<table class="table table-bordered table-striped table-vcenter js-dataTable-full user-table" id="user-table">
										<thead>
										<tr>
												<th>JO ID</th>
												<th>Requested by</th>
												<th>From</th>
								
												<th>Date</th>
												<th>Day Ago</th>
												<th>Related</th>
												<th>Status</th>
												<th>Action</th>
										</tr>
										</thead>
										<tbody>
											@for ($i = 0; $i < count($AllSalesOrders); $i++)
												<tr>
													<td>{{ $AllSalesOrders[$i]->id }}</td>
													<td>{{ $AllSalesOrders[$i]->requested_by }}</td>
													<td>{{ $AllSalesOrders[$i]->from }}</td>
										
													<td>{{ $AllSalesOrders[$i]->date }}</td>
													<td>{{ $AllSalesOrders[$i]->day_ago }}</td>
													<td>{{ $AllSalesOrders[$i]->related }}</td>
													<td>{{ $AllSalesOrders[$i]->status }}</td>
													<td class="text-center">
														<div class="btn-group">
															<button type="button" class="btn btn-sm btn-primary complete-jo-btn"
                                                                    id="approve-jo-{{ $AllSalesOrders[$i]->id }}-{{ $i }}" data-toggle="tooltip" title="Complete">
                                                                <i class="fa fa-check"></i>
                                                            </button>
                                                            <a href="{{ url('joborder/sales/detail/'.$AllSalesOrders[$i]->L_id) }}">
                                                                <button type="button" class="btn btn-sm btn-primary view-jo-btn" data-toggle="tooltip" title="View">
                                                                    <i class="fa fa-book-open"></i>
                                                                </button>
                                                            </a>
                                                            <!-- <a href="{{ url('/purchasing/edit/'.$AllSalesOrders[$i]->id) }}"> -->
                                                                <button type="button" class="btn btn-sm btn-primary edit-jo-btn" data-toggle="tooltip" title="Edit">
                                                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                                                </button>
                                                            <!-- </a> -->
															<button type="button" class="btn btn-sm btn-primary delete-jo-btn"
                                                                    id="delete-jo-{{ $AllSalesOrders[$i]->id }}-{{ $i }}" data-toggle="tooltip" title="Delete">
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
									<table class="table table-bordered table-striped table-vcenter js-dataTable-full user-table" id="user-table">
										<thead>
										<tr>
												<th>JO ID</th>
												<th>Requested by</th>
												<th>From</th>
												<th>Desctiption</th>
												<th>Date</th>
												<th>Day Ago</th>
												<th>Related</th>
												<th>Status</th>
												<th>Action</th>
										</tr>
										</thead>
										<tbody>
											@for ($i = 0; $i < count($AllReceivingOrders); $i++)
												<tr>
													<td>{{ $AllReceivingOrders[$i]->id }}</td>
													<td>{{ $AllReceivingOrders[$i]->requested_by }}</td>
													<td>{{ $AllReceivingOrders[$i]->from }}</td>
													<td>{{ $AllReceivingOrders[$i]->description }}</td>
													<td>{{ $AllReceivingOrders[$i]->date }}</td>
													<td>{{ $AllReceivingOrders[$i]->day_ago }}</td>
													<td>{{ $AllReceivingOrders[$i]->related }}</td>
													<td>{{ $AllReceivingOrders[$i]->status }}</td>
													<td class="text-center">
														<div class="btn-group">
															<button type="button" class="btn btn-sm btn-primary complete-jo-btn"
                                                                    id="approve-jo-{{ $AllReceivingOrders[$i]->id }}-{{ $i }}" data-toggle="tooltip" title="Complete">
                                                                <i class="fa fa-check"></i>
                                                            </button>
                                                            <a href="{{ url('joborder/receiving/detail/'.$AllReceivingOrders[$i]->R_id) }}">
                                                                <button type="button" class="btn btn-sm btn-primary view-jo-btn" data-toggle="tooltip" title="View">
                                                                    <i class="fa fa-book-open"></i>
                                                                </button>
                                                            </a>
                                                            <!-- <a href="{{ url('/purchasing/edit/'.$AllReceivingOrders[$i]->id) }}"> -->
                                                                <button type="button" class="btn btn-sm btn-primary edit-jo-btn" data-toggle="tooltip" title="Edit">
                                                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                                                </button>
                                                            <!-- </a> -->
															<button type="button" class="btn btn-sm btn-primary delete-jo-btn"
                                                                    id="delete-jo-{{ $AllReceivingOrders[$i]->id }}-{{ $i }}" data-toggle="tooltip" title="Delete">
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
