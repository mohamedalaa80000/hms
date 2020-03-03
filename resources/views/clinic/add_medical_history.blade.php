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
													You successfully Added New Medical History.
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
    <form class="m-form m-form--fit m-form--label-align-right" action="{{url('/')}}/clinic/patients/add_medical_history/{{$id}}" method="post">
                
        {{csrf_field()}}
        <div class="m-portlet__body">
                    <div class="row">
                  <div class="col-lg-12">
                       <div class="m-form__group form-group margins_top">
                           <label class="floats_left col-lg-6 aligin-left">Date of last Dental Examination ?</label>
                           <div class="m-radio-inline floats_left margins-left">
                                <label class="m-radio">
                                    <input type="radio" name="field_1" value="0" checked="checked">
                                    No
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" name="field_1" value="1">
                                    Yes
                                    <span></span>
                                </label>

                            </div>

					</div>
        
                      <div class="m-form__group form-group margins_top">
                           <label class="floats_left col-lg-6 aligin-left">Have you often had toothaches ?</label>
                           <div class="m-radio-inline floats_left margins-left">
                                <label class="m-radio">
                                    <input type="radio" name="field_2" value="0" checked="checked">
                                    No
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" name="field_2" value="1">
                                    Yes
                                    <span></span>
                                </label>

                            </div>

					</div>
                      <div class="m-form__group form-group margins_top">
                           <label class="floats_left col-lg-6 aligin-left">Do you have dentures ?</label>
                           <div class="m-radio-inline floats_left margins-left">
                                <label class="m-radio">
                                    <input type="radio" name="field_3" value="0" checked="checked">
                                    No
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" name="field_3" value="1">
                                    Yes
                                    <span></span>
                                </label>

                            </div>

					</div>
                      <div class="m-form__group form-group margins_top">
                           <label class="floats_left col-lg-6 aligin-left">Are you presently under medical care?</label>
                           <div class="m-radio-inline floats_left margins-left">
                                <label class="m-radio">
                                    <input type="radio" name="field_4" value="0" checked="checked">
                                    No
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" name="field_4" value="1">
                                    Yes
                                    <span></span>
                                </label>

                            </div>

					</div>
                      <div class="m-form__group form-group margins_top">
                           <label class="floats_left col-lg-6 aligin-left">Are you taking any medicines or drugs?</label>
                           <div class="m-radio-inline floats_left margins-left">
                                <label class="m-radio">
                                    <input type="radio" name="field_5" value="0" checked="checked">
                                    No
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" name="field_5" value="1">
                                    Yes
                                    <span></span>
                                </label>

                            </div>

					</div>
                      <div class="m-form__group form-group margins_top">
                           <label class="floats_left col-lg-6 aligin-left">Have you ever had a prolonged illness or hospitalisation ?</label>
                           <div class="m-radio-inline floats_left margins-left">
                                <label class="m-radio">
                                    <input type="radio" name="field_6" value="0" checked="checked">
                                    No
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" name="field_6" value="1">
                                    Yes
                                    <span></span>
                                </label>

                            </div>

					</div>
                      <div class="m-form__group form-group margins_top">
                           <label class="floats_left col-lg-6 aligin-left">Have you or any relatives had problems with bleeding ?</label>
                           <div class="m-radio-inline floats_left margins-left">
                                <label class="m-radio">
                                    <input type="radio" name="field_7" value="0" checked="checked">
                                    No
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" name="field_7" value="1">
                                    Yes
                                    <span></span>
                                </label>

                            </div>

					</div>
                      <div class="m-form__group form-group margins_top">
                           <label class="floats_left col-lg-6 aligin-left">Do you have any blood disorders such as anaemia ?</label>
                           <div class="m-radio-inline floats_left margins-left">
                                <label class="m-radio">
                                    <input type="radio" name="field_8" value="0" checked="checked">
                                    No
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" name="field_8" value="1">
                                    Yes
                                    <span></span>
                                </label>

                            </div>

					</div>
                      <div class="m-form__group form-group margins_top">
                           <label class="floats_left col-lg-6 aligin-left">Are you short of breath on light exertion ?</label>
                           <div class="m-radio-inline floats_left margins-left">
                                <label class="m-radio">
                                    <input type="radio" name="field_9" value="0" checked="checked">
                                    No
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" name="field_9" value="1">
                                    Yes
                                    <span></span>
                                </label>

                            </div>

					</div>
                      <div class="m-form__group form-group margins_top">
                           <label class="floats_left col-lg-6 aligin-left">Do you have chest pains on light exertion ?</label>
                           <div class="m-radio-inline floats_left margins-left">
                                <label class="m-radio">
                                    <input type="radio" name="field_10" value="0" checked="checked">
                                    No
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" name="field_10" value="1">
                                    Yes
                                    <span></span>
                                </label>

                            </div>

					</div>
                      <div class="m-form__group form-group margins_top">
                           <label class="floats_left col-lg-6 aligin-left">Do you suffer from any hay fever, Asthma or other allergies ?</label>
                           <div class="m-radio-inline floats_left margins-left">
                                <label class="m-radio">
                                    <input type="radio" name="field_11" value="0" checked="checked">
                                    No
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" name="field_11" value="1">
                                    Yes
                                    <span></span>
                                </label>

                            </div>

					</div>
                      <div class="m-form__group form-group margins_top">
                           <label class="floats_left col-lg-6 aligin-left">Are you allergic to penicillin or to any drug ?</label>
                           <div class="m-radio-inline floats_left margins-left">
                                <label class="m-radio">
                                    <input type="radio" name="field_12" value="0" checked="checked">
                                    No
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" name="field_12" value="1">
                                    Yes
                                    <span></span>
                                </label>

                            </div>

					</div>
                      <div class="m-form__group form-group margins_top">
                           <label class="floats_left col-lg-6 aligin-left">Do your ankles swell ?</label>
                           <div class="m-radio-inline floats_left margins-left">
                                <label class="m-radio">
                                    <input type="radio" name="field_13" value="0" checked="checked">
                                    No
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" name="field_13" value="1">
                                    Yes
                                    <span></span>
                                </label>

                            </div>

					</div>
                       <div class="m-form__group form-group margins_top">
                           <label class="floats_left col-lg-6 aligin-left">Have you had any of the following ?</label>
                           <div class="m-radio-inline floats_left margins-left">
                                <label class="m-radio">
                                    <input type="radio" name="field_14" value="0" checked="checked">
                                    No
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" name="field_14" value="1">
                                    Yes
                                    <span></span>
                                </label>

                            </div>

					</div>
                      
                     <div class="m-form__group form-group margins_top">
                           <label class=" col-lg-6 aligin-left" style="    font-size: 17px;">Check the appropriate box : </label>
                         

					</div>
                        </div>
                 
                         <div class="col-lg-6">
                           <div class="col-lg-12">
                               <div class="m-checkbox-list" style="padding-left: 45px;">
															<label class="m-checkbox m-checkbox--bold m-checkbox--state-success">
																		<input type="checkbox" name="appropriate_boxs[]" value="0">
																		 Rheumatic Fever
																		<span></span>
																	</label>		
																	
                                   <label class="m-checkbox m-checkbox--bold m-checkbox--state-success">
																		<input type="checkbox" name="appropriate_boxs[]" value="1">
																		Heart Diseases
																		<span></span>
																	</label>
                                   <label class="m-checkbox m-checkbox--bold m-checkbox--state-success">
																		<input type="checkbox" name="appropriate_boxs[]" value="2">
																		Blood Pressure
																		<span></span>
																	</label>
                                   <label class="m-checkbox m-checkbox--bold m-checkbox--state-success">
																		<input type="checkbox" name="appropriate_boxs[]" value="3">
																		Epilepsy
																		<span></span>
																	</label>
                                   <label class="m-checkbox m-checkbox--bold m-checkbox--state-success">
																		<input type="checkbox" name="appropriate_boxs[]" value="4">
																		Tubereculosis
																		<span></span>
																	</label>
                                   <label class="m-checkbox m-checkbox--bold m-checkbox--state-success">
																		<input type="checkbox" name="appropriate_boxs[]" value="5">
																		Kidney Trouble
																		<span></span>
																	</label>
																	
																</div>
                             </div>
                        </div>
                        <div class="col-lg-6">
                         <div class="m-checkbox-list" style="padding-left: 45px;">
																	<label class="m-checkbox m-checkbox--bold m-checkbox--state-success">
																		<input type="checkbox" name="appropriate_boxs[]" value="6">
																		Diabetes
																		<span></span>
																	</label>
                             <label class="m-checkbox m-checkbox--bold m-checkbox--state-success">
																		<input type="checkbox" name="appropriate_boxs[]" value="7">
																		Jaundice
																		<span></span>
																	</label>
                             <label class="m-checkbox m-checkbox--bold m-checkbox--state-success">
																		<input type="checkbox" name="appropriate_boxs[]" value="8">
																		Hepatites
																		<span></span>
																	</label>
                             <label class="m-checkbox m-checkbox--bold m-checkbox--state-success">
																		<input type="checkbox" name="appropriate_boxs[]" value="9">
																		Cancer
																		<span></span>
																	</label>
                             <label class="m-checkbox m-checkbox--bold m-checkbox--state-success">
																		<input type="checkbox" name="appropriate_boxs[]" value="10">
																		Arthrites
																		<span></span>
																	</label>
                             <label class="m-checkbox m-checkbox--bold m-checkbox--state-success">
																		<input type="checkbox" name="appropriate_boxs[]" value="11">
																		Veneral Disease
																		<span></span>
																	</label>
                             <label class="m-checkbox m-checkbox--bold m-checkbox--state-success">
																		<input type="checkbox" name="appropriate_boxs[]" value="12">
																		Other
																		<span></span>
																	</label>
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
