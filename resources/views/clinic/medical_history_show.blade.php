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
    <form class="m-form m-form--fit m-form--label-align-right" >
                
        
        <div class="m-portlet__body">
                    <div class="row">
                  <div class="col-lg-12">
                       <div class="m-form__group form-group margins_top">
                           <label class="floats_left col-lg-6 aligin-left">Date of last Dental Examination ?</label>
                           <div class="m-radio-inline floats_left margins-left">
                              @if($medical_history[0]->field1 == 0)
                               <label class="m-radio">
                                    <input type="radio"  checked="checked" disabled>
                                    No
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" disabled>
                                    Yes
                                    <span></span>
                                </label>
                               @else
                                 <label class="m-radio">
                                    <input type="radio"  disabled>
                                    No
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" checked="checked" disabled>
                                    Yes
                                    <span></span>
                                </label>
                               @endif
                              
                               

                            </div>

					</div>
        
                      <div class="m-form__group form-group margins_top">
                           <label class="floats_left col-lg-6 aligin-left">Have you often had toothaches ?</label>
                           <div class="m-radio-inline floats_left margins-left">
                                
    @if($medical_history[0]->field2 == 0)
                               <label class="m-radio">
                                    <input type="radio"  checked="checked" disabled>
                                    No
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" disabled>
                                    Yes
                                    <span></span>
                                </label>
                               @else
                                 <label class="m-radio">
                                    <input type="radio"  disabled>
                                    No
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" checked="checked" disabled>
                                    Yes
                                    <span></span>
                                </label>
                               @endif

                            </div>

					</div>
                      <div class="m-form__group form-group margins_top">
                           <label class="floats_left col-lg-6 aligin-left">Do you have dentures ?</label>
                           <div class="m-radio-inline floats_left margins-left">
                               
    @if($medical_history[0]->field3 == 0)
                               <label class="m-radio">
                                    <input type="radio"  checked="checked" disabled>
                                    No
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" disabled>
                                    Yes
                                    <span></span>
                                </label>
                               @else
                                 <label class="m-radio">
                                    <input type="radio"  disabled>
                                    No
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" checked="checked" disabled>
                                    Yes
                                    <span></span>
                                </label>
                               @endif

                            </div>

					</div>
                      <div class="m-form__group form-group margins_top">
                           <label class="floats_left col-lg-6 aligin-left">Are you presently under medical care?</label>
                           <div class="m-radio-inline floats_left margins-left">
                                
    @if($medical_history[0]->field4 == 0)
                               <label class="m-radio">
                                    <input type="radio"  checked="checked" disabled>
                                    No
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" disabled>
                                    Yes
                                    <span></span>
                                </label>
                               @else
                                 <label class="m-radio">
                                    <input type="radio"  disabled>
                                    No
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" checked="checked" disabled>
                                    Yes
                                    <span></span>
                                </label>
                               @endif

                            </div>

					</div>
                      <div class="m-form__group form-group margins_top">
                           <label class="floats_left col-lg-6 aligin-left">Are you taking any medicines or drugs?</label>
                           <div class="m-radio-inline floats_left margins-left">
                               
    @if($medical_history[0]->field5 == 0)
                               <label class="m-radio">
                                    <input type="radio"  checked="checked" disabled>
                                    No
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" disabled>
                                    Yes
                                    <span></span>
                                </label>
                               @else
                                 <label class="m-radio">
                                    <input type="radio"  disabled>
                                    No
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" checked="checked" disabled>
                                    Yes
                                    <span></span>
                                </label>
                               @endif

                            </div>

					</div>
                      <div class="m-form__group form-group margins_top">
                           <label class="floats_left col-lg-6 aligin-left">Have you ever had a prolonged illness or hospitalisation ?</label>
                           <div class="m-radio-inline floats_left margins-left">
                               
    @if($medical_history[0]->field6 == 0)
                               <label class="m-radio">
                                    <input type="radio"  checked="checked" disabled>
                                    No
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" disabled>
                                    Yes
                                    <span></span>
                                </label>
                               @else
                                 <label class="m-radio">
                                    <input type="radio"  disabled>
                                    No
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" checked="checked" disabled>
                                    Yes
                                    <span></span>
                                </label>
                               @endif

                            </div>

					</div>
                      <div class="m-form__group form-group margins_top">
                           <label class="floats_left col-lg-6 aligin-left">Have you or any relatives had problems with bleeding ?</label>
                           <div class="m-radio-inline floats_left margins-left">
                               
    @if($medical_history[0]->field7 == 0)
                               <label class="m-radio">
                                    <input type="radio"  checked="checked" disabled>
                                    No
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" disabled>
                                    Yes
                                    <span></span>
                                </label>
                               @else
                                 <label class="m-radio">
                                    <input type="radio"  disabled>
                                    No
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" checked="checked" disabled >
                                    Yes
                                    <span></span>
                                </label>
                               @endif

                            </div>

					</div>
                      <div class="m-form__group form-group margins_top">
                           <label class="floats_left col-lg-6 aligin-left">Do you have any blood disorders such as anaemia ?</label>
                           <div class="m-radio-inline floats_left margins-left">
                                
    @if($medical_history[0]->field8 == 0)
                               <label class="m-radio">
                                    <input type="radio"  checked="checked" disabled>
                                    No
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" disabled>
                                    Yes
                                    <span></span>
                                </label>
                               @else
                                 <label class="m-radio">
                                    <input type="radio"  disabled>
                                    No
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" checked="checked" disabled>
                                    Yes
                                    <span></span>
                                </label>
                               @endif

                            </div>

					</div>
                      <div class="m-form__group form-group margins_top">
                           <label class="floats_left col-lg-6 aligin-left">Are you short of breath on light exertion ?</label>
                           <div class="m-radio-inline floats_left margins-left">
                               
    @if($medical_history[0]->field9 == 0)
                               <label class="m-radio">
                                    <input type="radio"  checked="checked" disabled>
                                    No
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" disabled>
                                    Yes
                                    <span></span>
                                </label>
                               @else
                                 <label class="m-radio">
                                    <input type="radio"  disabled>
                                    No
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" checked="checked" disabled>
                                    Yes
                                    <span></span>
                                </label>
                               @endif
                            </div>

					</div>
                      <div class="m-form__group form-group margins_top">
                           <label class="floats_left col-lg-6 aligin-left">Do you have chest pains on light exertion ?</label>
                           <div class="m-radio-inline floats_left margins-left">
                               
    @if($medical_history[0]->field10 == 0)
                               <label class="m-radio">
                                    <input type="radio"  checked="checked" disabled>
                                    No
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" disabled>
                                    Yes
                                    <span></span>
                                </label>
                               @else
                                 <label class="m-radio">
                                    <input type="radio"  disabled>
                                    No
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" checked="checked" disabled>
                                    Yes
                                    <span></span>
                                </label>
                               @endif

                            </div>

					</div>
                      <div class="m-form__group form-group margins_top">
                           <label class="floats_left col-lg-6 aligin-left">Do you suffer from any hay fever, Asthma or other allergies ?</label>
                           <div class="m-radio-inline floats_left margins-left">
                               
    @if($medical_history[0]->field11 == 0)
                               <label class="m-radio">
                                    <input type="radio"  checked="checked" disabled>
                                    No
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" disabled>
                                    Yes
                                    <span></span>
                                </label>
                               @else
                                 <label class="m-radio">
                                    <input type="radio"  disabled>
                                    No
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" checked="checked" disabled>
                                    Yes
                                    <span></span>
                                </label>
                               @endif

                            </div>

					</div>
                      <div class="m-form__group form-group margins_top">
                           <label class="floats_left col-lg-6 aligin-left">Are you allergic to penicillin or to any drug ?</label>
                           <div class="m-radio-inline floats_left margins-left">
                                
    @if($medical_history[0]->field12 == 0)
                               <label class="m-radio">
                                    <input type="radio"  checked="checked" disabled>
                                    No
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" disabled>
                                    Yes
                                    <span></span>
                                </label>
                               @else
                                 <label class="m-radio">
                                    <input type="radio"  disabled>
                                    No
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" checked="checked" disabled>
                                    Yes
                                    <span></span>
                                </label>
                               @endif

                            </div>

					</div>
                      <div class="m-form__group form-group margins_top">
                           <label class="floats_left col-lg-6 aligin-left">Do your ankles swell ?</label>
                           <div class="m-radio-inline floats_left margins-left">
                                
    @if($medical_history[0]->field13 == 0)
                               <label class="m-radio">
                                    <input type="radio"  checked="checked" disabled>
                                    No
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" disabled>
                                    Yes
                                    <span></span>
                                </label>
                               @else
                                 <label class="m-radio">
                                    <input type="radio"  disabled>
                                    No
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" checked="checked" disabled>
                                    Yes
                                    <span></span>
                                </label>
                               @endif

                            </div>

					</div>
                       <div class="m-form__group form-group margins_top">
                           <label class="floats_left col-lg-6 aligin-left">Have you had any of the following ?</label>
                           <div class="m-radio-inline floats_left margins-left">
                                
    @if($medical_history[0]->field14 == 0)
                               <label class="m-radio">
                                    <input type="radio"  checked="checked" disabled>
                                    No
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" disabled>
                                    Yes
                                    <span></span>
                                </label>
                               @else
                                 <label class="m-radio" disabled>
                                    <input type="radio"  >
                                    No
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" checked="checked" disabled>
                                    Yes
                                    <span></span>
                                </label>
                               @endif

                            </div>

					</div>
                      
                     <div class="m-form__group form-group margins_top">
                           <label class=" col-lg-6 aligin-left" style="    font-size: 17px;">appropriate box : </label>
                         

					</div>
                        </div>
                 
                         <div class="col-lg-6">
                           <div class="col-lg-12">
                               <div class="m-checkbox-list" style="padding-left: 45px;">
												
                                  @foreach($appropriate_boxs_txts as $k=>$v)
                                    @foreach($appropriate_boxs as $id)
                                         @if($id->appropriate_box_id == $k)
                                   <div class="m-radio-list">
																	<label class="m-radio m-radio--state-success">
																		<input type="radio" checked disabled>
																		{{$v}}
																		<span></span>
																	</label>
																</div>
                                  
                                        
                                   @endif
                                   
                                   
                                   
                                       @endforeach
                                   
																
                                   @endforeach
                                 
																</div>
                             </div>
                        </div>
                        <div class="col-lg-6">
                         <div class="m-checkbox-list" style="padding-left: 45px;">
                             
                            
																</div>
                        </div>
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
