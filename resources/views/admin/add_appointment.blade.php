@include('admin.header')
@include('admin.topmenu')	
		<!-- begin::Body -->
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
				@include('admin.sidebar')
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
												Add Appointment
											</span>
										</a>
									</li>
								</ul>
							</div>
							
						</div>
                         @if(isset($inserted) and $inserted == 1)
                        <div class="m-alert m-alert--outline m-alert--outline-2x alert alert-success alert-dismissible fade show" role="alert">
													<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
													<strong>
														Well done!
													</strong>
													You successfully Added New Appointment.
												</div>
                        @endif
					</div>
					<!-- END: Subheader -->
					<div class="m-content">
						<div class="m-portlet m-portlet--mobile">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<h3 class="m-portlet__head-text">
											<i class="la la-gift"></i> General Information
										</h3>
									</div>
								</div>
							
							</div>
    <form class="m-form m-form--fit m-form--label-align-right" id="mainform" action="{{url('/')}}/admin/appointments/add" method="post">
              
        {{csrf_field()}}
        <div class="m-portlet__body">
                    <div class="row">
                    <div class="col-lg-5">
                    <div class="form-group m-form__group">
                    <label>
                        Clinic
                    </label>
                  <select class="form-control m-input m-input--solid" id="clinics" name="clinic">
                        <option selected disabled>Select Clinic</option>
                      @foreach($allclinics as $c)  
                      <option value="{{$c->id}}" >{{$c->clinicname}}</option>
                      @endforeach
                        </select>
                        @if($errors->has('clinic'))
                        <div class="has-danger">
                            <div class="form-control-feedback">
                            @foreach($errors->get('clinic') as $er)
                                {{$er}}
                                @endforeach
                            </div></div>
                        @endif
                </div>
                    <div class="form-group m-form__group">
                    <label>
                        Doctor
                    </label>
                  <select class="form-control m-input m-input--solid" id="doctors" name="doctor">
                        <option value="0" selected disabled>Select Clinic</option>
                        </select>
                         @if($errors->has('doctor'))
                        <div class="has-danger">
                            <div class="form-control-feedback">
                            @foreach($errors->get('doctor') as $er)
                                {{$er}}
                                @endforeach
                            </div></div>
                        @endif
                </div>
                     
                          <div class="form-group m-form__group">
                    <label>
                        Patient
                    </label>
                  <select class="form-control m-input m-input--solid" name="patient">
                        <option value="0" selected disabled>Select Patient</option>
                      @foreach($patients as $p)
                       <option value="{{$p->id}}">{{$p->patientname .' ; '. $p->uniqueid}}</option>
                      @endforeach
                        </select>
                               @if($errors->has('patient'))
                        <div class="has-danger">
                            <div class="form-control-feedback">
                            @foreach($errors->get('patient') as $er)
                                {{$er}}
                                @endforeach
                            </div></div>
                        @endif
                </div>  
                    </div>
                        <div class="col-lg-5 col-lg-offset-2">
                       
                          <div class="form-group m-form__group">
                    <label>
                        Appointment Date/Time
                    </label>
                  <div class="input-group date" id="m_datetimepicker_2">
												<input type="text" class="form-control m-input" readonly="" name="dateandtime" placeholder="Select date &amp; time">
                           @if($errors->has('dateandtime'))
                        <div class="has-danger">
                            <div class="form-control-feedback">
                            @foreach($errors->get('dateandtime') as $er)
                                {{$er}}
                                @endforeach
                            </div></div>
                        @endif
												<span class="input-group-addon">
													<i class="la la-calendar-check-o glyphicon-th"></i>
												</span>
											</div>
                </div>
                       <div class="form-group m-form__group">
                    <label>
                        Status
                    </label>
                  <select class="form-control m-input m-input--solid" name="status">
                        <option   selected disabled>Select Status</option>
                     <option value="0">Unconfirmed</option>
                      <option value="1">Confirmed</option>
                      <option value="2">Finish</option>
                      <option value="3">Late Finish</option>
                      <option value="4">Cancel</option>
                        </select>
                             @if($errors->has('status'))
                        <div class="has-danger">
                            <div class="form-control-feedback">
                            @foreach($errors->get('status') as $er)
                                {{$er}}
                                @endforeach
                            </div></div>
                        @endif
                </div>
                        </div>
                    </div>
                </div>



                <div class="m-portlet__foot m-portlet__foot--fit">
                    <div class="m-form__actions">
                        <button type="submit" class="btn btn-primary">
                            Add
                        </button>
                        <button type="reset" class="btn btn-secondary">
                            Cancel
                        </button>
                    </div>
                </div>
            </form>
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
@include('admin.footer')
