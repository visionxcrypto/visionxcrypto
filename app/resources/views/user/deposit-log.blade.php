@extends('include.userdashboard')
@section('content')
  <!-- Main Content-->
			<div class="main-content side-content pt-0">

				<div class="container-fluid">
					<div class="inner-body">

						<!-- Page Header -->
						<div class="page-header">
							<div>
								<h2 class="main-content-title tx-24 mg-b-5">Deposit History</h2>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">Deposit History</li>
								</ol>
							</div>
							 
						</div>
						<!-- End Page Header -->

						<!-- row -->
						<div class="row row-sm">
							<div class="col-md-12 col-lg-12 col-xl-12">
								<div class="card custom-card transcation-crypto">
									<div class="card-header border-bottom-0">
										<div class="main-content-label">Deposit History</div> 
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table" id="example1">
												<thead>
													<tr>
														<th class="wd-1"></th>
														<th>Deposit ID</th>
														<th>Date</th>
														<th>Gateway</th>
														<th>Charge</th>
														<th>Amount</th>
														<th>Total</th>
														<th>Status</th>
													</tr>
												</thead>
												<tbody>
												@foreach($deposit as $k=>$data)
													<tr class="border-bottom">
														<td>
															<span class="crypto-icon bg-primary-transparent mr-3 my-auto">
																<i class="fa fa-bank text-primary"></i>
															</span>
														</td>
														<td class="font-weight-bold">{{isset($data->trx ) ? $data->trx  : 'N/A'}}</td>
														<td>{!! date(' d/M/Y', strtotime($data->created_at)) !!}</td>
														<td>Bank Deposit</td> 
														<td class="text-warning font-weight-bold">{{$basic->currency_sym}}{{number_format($data->charge, $basic->decimal)}}</td>
														<td class="text-success font-weight-bold">{{$basic->currency_sym}}{{number_format($data->amount, $basic->decimal)}}</td>
														<td class="text-success font-weight-bold">{{$basic->currency_sym}}{{number_format($data->amount + $data->charge, $basic->decimal)}}</td>
														<td>
														@if($data->status == 1)
														<span class="text-success font-weight-semibold">COMPLETED</span>
														@elseif($data->status == 2)
														<span class="text-warning font-weight-semibold">PENDING</span>
														@elseif($data->status == 0)
														<span class="text-info font-weight-semibold">UNFINISHED</span>
														@elseif($data->status == -2)
														<span class="text-danger font-weight-semibold">DECLINED</span>
														@endif

														
														</td>
													</tr>
													 @endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<!-- Row End -->
							</div>
						</div>
						<!-- Row End -->
					</div>
				</div>
			</div>
			<!-- End Main Content-->
@stop
