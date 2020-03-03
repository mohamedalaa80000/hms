
@include('xray.header')	
@include('xray.topmenu')	
	
		<!-- begin::Body -->
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
			@include('xray.sidebar')
				<div class="m-grid__item m-grid__item--fluid m-wrapper">
					<!-- BEGIN: Subheader -->
					<div class="m-subheader ">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
									<li class="m-nav__item m-nav__item--home">
										<a href="#" class="m-nav__link m-nav__link--icon">
											<i class="m-nav__link-icon la la-home"></i>
										</a>
									</li>
									
									<li class="m-nav__separator">
										-
									</li>
									<li class="m-nav__item">
										<a href="" class="m-nav__link">
											<span class="m-nav__link-text">
												Patients
											</span>
										</a>
									</li>
								</ul>
							</div>
							
						</div>
					</div>
					<!-- END: Subheader -->
					<div class="m-content">
						<div class="m-portlet m-portlet--mobile">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<h3 class="m-portlet__head-text">
											List of Patients
										</h3>
									</div>
								</div>
							
							</div>
							<div class="m-portlet__body">
								<!--begin: Search Form -->
								<div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
									<div class="row align-items-center">
										<div class="col-xl-6 order-2 order-xl-1">
											<div class="form-group m-form__group row align-items-center">
												
												
												<div class="col-md-6">
													<div class="m-input-icon m-input-icon--left">
														<input type="text" class="form-control m-input m-input--solid" placeholder="Search..." id="generalSearch">
														<span class="m-input-icon__icon m-input-icon__icon--left">
															<span>
																<i class="la la-search"></i>
															</span>
														</span>
													</div>
												</div>
											</div>
										</div>
										
									</div>
								</div>
								<!--end: Search Form -->
		                       <!--begin: Datatable -->
								<table class="m-datatable" id="html_table" width="100%">
									<thead>
										<tr>
											<th title="Field #1">
												Sr No.
											</th>
											<th title="Field #2">
												Unique Id
											</th>
											<th title="Field #3">
												Name
											</th>
											<th title="Field #4">
												Phone
											</th>
											<th title="Field #5">
												Gender
											</th>
											<th title="Field #6">
												Age
											</th>
                                            <th title="Field #6">
												Status
											</th>
											<th title="Field #8">
												Actions
											</th>
										</tr>
									</thead>
									<tbody>
                                        @foreach($patients as $p)
										<tr>
											<td>
												{{$p->id}}
											</td>
											<td>
                                                {{$p->uniqueid}}
                                            </td>
											<td>
												{{$p->patientname}}
											</td>
											<td>
												{{$p->phone}}
											</td>
											<td>
												{{$gender[$p->gender]}}
											</td>
											<td>
												{{$p->age}}
											</td>
                                            <td>
                                                <span><span class="m-badge  m-badge--primary m-badge--wide">{{$status[$p->status]}}</span></span>
											</td>
											
											<td>
												
                                                <a href="{{url('/')}}/xray/patients/show/{{$p->id}}" class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill" title="View"><i class="la la-eye"></i></a>
                                                
                                              
											</td>
										</tr>
                                        @endforeach						
									</tbody>
								</table>
								<!--end: Datatable -->
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- end:: Body -->
<!-- begin::Footer -->
			<footer class="m-grid__item		m-footer ">
				<div class="m-container m-container--fluid m-container--full-height m-page__container">
					<div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
						<div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
							<span class="m-footer__copyright">
								2018 &copy; Hospital Managment System
							</span>
						</div>
						<div class="m-stack__item m-stack__item--right m-stack__item--middle m-stack__item--first">
							<ul class="m-footer__nav m-nav m-nav--inline m--pull-right">
								<li class="m-nav__item">
									<a href="#" class="m-nav__link">
										<span class="m-nav__link-text">
											About
										</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
			<!-- end::Footer -->
		</div>
		<!-- end:: Page -->	   
<div class="modal fade" id="m_modal_5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-sm" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" style="justify-content: center;">
											New Alert !!
										</h5>
									
									</div>
									<div class="modal-body" style="text-align: center;">
										Are You Sure To Remove ?
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">
											Close
										</button>
										<button type="button" class="btn btn-primary" id="sureremovepatient" token="{{csrf_token()}}">
											Sure
										</button>
									</div>
								</div>
							</div>
						</div>
    	@include('xray.footer')