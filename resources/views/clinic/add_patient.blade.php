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
												Add Patient
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
													You successfully Added New Patient.
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
    <form class="m-form m-form--fit m-form--label-align-right" action="{{url('/')}}/clinic/patients/add" method="post">
                
        {{csrf_field()}}
        <div class="m-portlet__body">
                    <div class="row">
                    <div class="col-lg-5">
                         <div class="form-group m-form__group">
                    <label>
                        Patient Name
                    </label>
            <input class="form-control m-input m-input--solid" type="text" name="patient_name" value="{{old('patient_name')}}">
                                 @if($errors->has('patient_name'))
                          <div class="has-danger">
                              <div class="form-control-feedback">
                              @foreach($errors->get('patient_name') as $er)
                                  {{$er}}
                                  @endforeach
                              </div></div>
                        @endif 
                </div>
                         <div class="form-group m-form__group">
                    <label>
                        Marital Status
                    </label>
                  <select class="form-control m-input m-input--solid" name="marital_status">
                        <option selected disabled>Select Marital Status</option>
                        <option value="0">Single</option>
                        <option value="1">Married</option>
                        </select>
                                      @if($errors->has('marital_status'))
                          <div class="has-danger">
                              <div class="form-control-feedback">
                              @foreach($errors->get('marital_status') as $er)
                                  {{$er}}
                                  @endforeach
                              </div></div>
                        @endif 
                </div>
                         <div class="form-group m-form__group">
                    <label>
                        Gender
                    </label>
                  <select class="form-control m-input m-input--solid" name="gender">
                        <option  selected disabled>Select Gender</option>
                        <option value="0">Male</option>
                        <option value="1">Female</option>
                        </select>
                                     @if($errors->has('gender'))
                          <div class="has-danger">
                              <div class="form-control-feedback">
                              @foreach($errors->get('gender') as $er)
                                  {{$er}}
                                  @endforeach
                              </div></div>
                        @endif 
                </div>      
                         <div class="form-group m-form__group">
                    <label>
                        Occupation
                    </label>
            <input class="form-control m-input m-input--solid" type="text" name="occupation" value="{{old('occupation')}}">
                                     @if($errors->has('occupation'))
                          <div class="has-danger">
                              <div class="form-control-feedback">
                              @foreach($errors->get('occupation') as $er)
                                  {{$er}}
                                  @endforeach
                              </div></div>
                        @endif 
                </div>
                         <div class="form-group m-form__group">
                    <label>
                        Religion
                    </label>
            <input class="form-control m-input m-input--solid" type="text" name="religion" value="{{old('religion')}}">
                                      @if($errors->has('religion'))
                          <div class="has-danger">
                              <div class="form-control-feedback">
                              @foreach($errors->get('religion') as $er)
                                  {{$er}}
                                  @endforeach
                              </div></div>
                        @endif 
                </div>
                         <div class="form-group m-form__group">
                    <label>
                        Address
                    </label>
            <input class="form-control m-input m-input--solid" type="text" name="address" value="{{old('address')}}">
                                          @if($errors->has('address'))
                          <div class="has-danger">
                              <div class="form-control-feedback">
                              @foreach($errors->get('address') as $er)
                                  {{$er}}
                                  @endforeach
                              </div></div>
                        @endif 
                </div>
                         <div class="form-group m-form__group">
                    <label>
                        Nationality
                    </label>
            <input class="form-control m-input m-input--solid" type="text" name="nationality" value="{{old('nationality')}}">
                                         @if($errors->has('nationality'))
                          <div class="has-danger">
                              <div class="form-control-feedback">
                              @foreach($errors->get('nationality') as $er)
                                  {{$er}}
                                  @endforeach
                              </div></div>
                        @endif 
                </div>                       
                         <div class="form-group m-form__group">
                    <label>
                        Phone
                    </label>
            <input class="form-control m-input m-input--solid" type="text" name="phone" value="{{old('phone')}}">
                                           @if($errors->has('phone'))
                          <div class="has-danger">
                              <div class="form-control-feedback">
                              @foreach($errors->get('phone') as $er)
                                  {{$er}}
                                  @endforeach
                              </div></div>
                        @endif 
                </div> 
                         <div class="form-group m-form__group">
                    <label>
                        Age
                    </label>
            <input class="form-control m-input m-input--solid" type="number" name="age" value="{{old('age')}}">
                                           @if($errors->has('age'))
                          <div class="has-danger">
                              <div class="form-control-feedback">
                              @foreach($errors->get('age') as $er)
                                  {{$er}}
                                  @endforeach
                              </div></div>
                        @endif 
                </div> 
                    </div>
                    <div class="col-lg-5 col-lg-offset-2">
                         <div class="form-group m-form__group">
                    <label>
                        Blood Group
                    </label>
            <input class="form-control m-input m-input--solid" type="text" name="blood_group" value="{{old('blood_group')}}"> 
                                                 @if($errors->has('blood_group'))
                          <div class="has-danger">
                              <div class="form-control-feedback">
                              @foreach($errors->get('blood_group') as $er)
                                  {{$er}}
                                  @endforeach
                              </div></div>
                        @endif 
                </div> 
                         <div class="form-group m-form__group">
                            <label >
                                Chief Complaint
                            </label>
    <textarea class="form-control m-input m-input--solid" rows="4" name="chief_complaint">{{old('chief_complaint')}}</textarea>
                                          @if($errors->has('chief_complaint'))
                          <div class="has-danger">
                              <div class="form-control-feedback">
                              @foreach($errors->get('chief_complaint') as $er)
                                  {{$er}}
                                  @endforeach
                              </div></div>
                        @endif 
                    </div>
                         <div class="form-group m-form__group">
                            <label >
                                Relevant Medical History
                            </label>
    <textarea class="form-control m-input m-input--solid" rows="4" name="relevant_medical_history">{{old('relevant_medical_history')}}</textarea>
                                             @if($errors->has('relevant_medical_history'))
                          <div class="has-danger">
                              <div class="form-control-feedback">
                              @foreach($errors->get('relevant_medical_history') as $er)
                                  {{$er}}
                                  @endforeach
                              </div></div>
                        @endif 
                    </div>
                         <div class="form-group m-form__group">
                    <label>
                        Temperature
                    </label>
            <input class="form-control m-input m-input--solid" type="text" name="temperature" value="{{old('temperature')}}">
                                             @if($errors->has('temperature'))
                          <div class="has-danger">
                              <div class="form-control-feedback">
                              @foreach($errors->get('temperature') as $er)
                                  {{$er}}
                                  @endforeach
                              </div></div>
                        @endif 
                </div> 
                         <div class="form-group m-form__group">
                    <label>
                        Blood Pressure
                    </label>
            <input class="form-control m-input m-input--solid" type="text" name="blood_pressure" value="{{old('blood_pressure')}}">
                                               @if($errors->has('blood_pressure'))
                          <div class="has-danger">
                              <div class="form-control-feedback">
                              @foreach($errors->get('blood_pressure') as $er)
                                  {{$er}}
                                  @endforeach
                              </div></div>
                        @endif 
                </div> 
                         <div class="form-group m-form__group">
                    <label>
                        Extra Oral Examination
                    </label>
            <input class="form-control m-input m-input--solid" type="text" name="extra_oral_examination" value="{{old('extra_oral_examination')}}">
                                               @if($errors->has('extra_oral_examination'))
                          <div class="has-danger">
                              <div class="form-control-feedback">
                              @foreach($errors->get('extra_oral_examination') as $er)
                                  {{$er}}
                                  @endforeach
                              </div></div>
                        @endif 
                </div> 
                         <div class="form-group m-form__group">
                    <label>
                        Oral Hygiene
                    </label>
            <input class="form-control m-input m-input--solid" type="text" name="oral_hygiene" value="{{old('oral_hygiene')}}">
                                               @if($errors->has('oral_hygiene'))
                          <div class="has-danger">
                              <div class="form-control-feedback">
                              @foreach($errors->get('oral_hygiene') as $er)
                                  {{$er}}
                                  @endforeach
                              </div></div>
                        @endif 
                </div> 
                         <div class="form-group m-form__group">
                    <label>
                        Occlusion
                    </label>
            <input class="form-control m-input m-input--solid" type="text" name="occlusion" value="{{old('occlusion')}}">
                                         @if($errors->has('occlusion'))
                          <div class="has-danger">
                              <div class="form-control-feedback">
                              @foreach($errors->get('occlusion') as $er)
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
@include('clinic.footer')
