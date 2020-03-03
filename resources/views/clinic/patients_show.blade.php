
@include('clinic.header')	
@include('clinic.topmenu')	
	
		<!-- begin::Body -->
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
			@include('clinic.sidebar')
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
											Patient Details
										</h3>
									</div>
								</div>
							
							</div>
							<div class="m-portlet__body">
								<!--begin: Search Form -->
								<div class="m-form m-form--label-align-right ">
									<div class="row ">
										<div class="col-xl-6 order-1 order-xl-1">
											<div class="form-group m-form__group row align-items-center">
                                                
                                                    <div class="col-lg-12">
                                                        <h2 class="general">General Info</h2>
                                                        <table class="table customcsstable">
                <tbody>
                    <tr>
                    <td>Patient Name</td>
                    <td>{{$patient->patientname}}</td>
                </tr>
                <tr>
                    <td>Marital Status</td>
                    <td>{{$Marital[$patient->marital_status]}}</td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td>{{$gender[$patient->gender]}}</td>
                </tr>
                <tr>
                    <td>Occupation</td>
                    <td>{{$patient->occupation}}</td>
                </tr>
                <tr>
                    <td>Religion</td>
                    <td>{{$patient->religion}}</td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>{{$patient->address}}</td>
                </tr>
                <tr>
                    <td>Nationality</td>
                    <td>{{$patient->nationality}}</td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td>{{$patient->phone}}</td>
                </tr>
                <tr>
                    <td>Age</td>
                    <td>{{$patient->age}}</td>
                </tr>
                <tr>
                    <td>Blood Group</td>
                    <td>{{$patient->bloodgroup}}</td>
                </tr>
                <tr>
                    <td>Chief Complaint</td>
                    <td>{{$patient->chiefcomplaint}}</td>
                </tr>
                <tr>
                    <td>Relevant Medical History</td>
                    <td>{{$patient->relevantmedicalhistory}}</td>
                </tr>
                <tr>
                    <td>Temperature</td>
                    <td>{{$patient->temperature}}</td>
                </tr>
                <tr>
                    <td>Blood Pressure</td>
                    <td>{{$patient->bloodpressure}}</td>
                </tr>
                <tr>
                    <td>Extra Oral Examination</td>
                    <td>{{$patient->extraoralexamination}}</td>
                </tr>
                <tr>
                    <td>Oral Hygiene</td>
                    <td>{{$patient->oralhygiene}}</td>
                </tr>
                <tr>
                    <td>Occlusion</td>
                    <td>{{$patient->occlusion}}</td>
                </tr>
            </tbody></table>
                                                    
                                                    </div>
                                                
                                                </div>
											</div>
                                        <div class="col-xl-6 order-2 order-xl-2">
											<div class="form-group m-form__group row align-items-center">
                                                
                                                    <div class="col-lg-12">
                                                       
                                                        <table class="table customcsstable">
                                                            <thead>
                                                             <tr>
                    <td style="border-top:0px"> <h2 class="general">Medical History</h2></td>
                    <td style="border-top:0px"><a href="{{url('/')}}/clinic/patients/add_medical_history/{{$patient->id}}" class="btn btn-primary" style="margin-left:5px;">Add</a>  <a href="/HMS/clinic/patients/view/1" class="btn btn-danger">Cancel</a></td>
                </tr>
                                                                <tr>
                    <td>Date</td>
                    <td>Action</td>
                </tr>
                                                            </thead>
                <tbody>
                    @foreach($medical_histories as $m)
                    <tr>
                      <td>{{$m->created_at}}</td>
                    <td><a href="{{url('/')}}/clinic/patients/medical_history/{{$m->patientid}}/{{$m->id}}">View</a></td>
                    </tr>
                    @endforeach
                
            </tbody></table>
                                                        <table class="table customcsstable">
                                                            <thead>
                                                             <tr>
                    <td style="border-top:0px"> <h2 class="general">Tooth Treatment</h2></td>
                    <td style="border-top:0px"><a href="{{url('/')}}/clinic/patients/add_tooth_record/{{$patient->id}}" class="btn btn-primary" style="margin-left:5px;">Add</a>  <a href="/HMS/clinic/patients/view/1" class="btn btn-danger">Cancel</a></td>
                </tr>
                                                                <tr>
                    <td>Date</td>
                    <td>Action</td>
                </tr>
                                                            </thead>
                <tbody>
                   
                
            </tbody></table>
                                                    
                                                    </div>
                                                
                                                </div>
											</div>
										
										
									</div>
								</div>
								<!--end: Search Form -->
		                       <!--begin: Datatable -->
								
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

    	@include('clinic.footer')