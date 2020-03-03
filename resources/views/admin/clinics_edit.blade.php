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
												Edit Clinic
											</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
                                                    @if(session()->get('updated') != null  and session()->get('updated') == 1)
				 <div class="m-alert m-alert--outline m-alert--outline-2x alert alert-success alert-dismissible fade show" role="alert">
													<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
													<strong>
														Well done!
													</strong>
													You successfully Updated Clinic.
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
    <form class="m-form m-form--fit m-form--label-align-right" method="post" action="{{url('/')}}/admin/clinics/edit/{{$clinicinfo->id}}" >
        {{csrf_field()}}
        <div class="m-portlet__body">
                    <div class="row">
                    <div class="col-lg-5">
                    <div class="form-group m-form__group">
                    <label>
                        Clinic Name
                    </label>
                   <input class="form-control m-input m-input--solid" type="text" name="clinic_name" value="{{$clinicinfo->clinicname}}">
                          @if($errors->has('clinic_name'))
                        <div class="has-danger">
                            <div class="form-control-feedback">
                            @foreach($errors->get('clinic_name') as $er)
                                {{$er}}
                                @endforeach
                            </div></div>
                        @endif
                </div>
                    <div class="form-group m-form__group">
                    <label>
                        Single Day
                    </label>
                  <select class="form-control m-input m-input--solid" id="singleday" name="signle_or_multi">
                       @foreach($singleormultiarray as $s=>$m)
                        @if($clinicinfo->singleormulti == $s)
                      <option value="{{$s}}" selected>{{$m}}</option>
                      @else
                      <option value="{{$s}}">{{$m}}</option>
                      @endif
                      @endforeach
                        </select>
                             @if($errors->has('signle_or_multi'))
                          <div class="has-danger">
                              <div class="form-control-feedback">
                              @foreach($errors->get('signle_or_multi') as $er)
                                  {{$er}}
                                  @endforeach
                              </div></div>
                        @endif 
                                
                </div>
                           <div class="form-group m-form__group hides_day_work">
                               @if($clinicinfo->singleormulti == 1)
                               <style>.hides_day_work{display:block;}</style>
                                                                        
                                                                        @endif
                    <label>
                        Select Day
                    </label>
                  <select class="form-control m-input m-input--solid" name="day_work" id="onlyday">
                       <option disabled>Select Day</option>
                     @foreach($weeks as $k=>$d)
                      @if($clinicinfo->onlyday == $k)
                       <option  value="{{$k}}" selected>{{$d}}</option>
                      @else
                      <option value="{{$k}}">{{$d}}</option>
                      @endif
                      
                      @endforeach
                        </select>
                                      @if($errors->has('day_work'))
                          <div class="has-danger">
                              <div class="form-control-feedback">
                              @foreach($errors->get('day_work') as $er)
                                  {{$er}}
                                  @endforeach
                              </div></div>
                        @endif 
                </div>
                           <div class="form-group m-form__group hides_work_start">
                               @if($clinicinfo->singleormulti == 1)
                               <style>.hides_work_start{display:none;}</style>
                                                                        
                                                                        @endif
                    <label>
                        Work Start
                    </label>
                  <select class="form-control m-input m-input--solid" name="work_start" id="workstart">
                       <option selected disabled>Select Work Start</option>
                     @foreach($weeks as $k=>$d)
                      @if($clinicinfo->workstart == $k)
                       <option  value="{{$k}}" selected>{{$d}}</option>
                      @else
                      <option value="{{$k}}">{{$d}}</option>
                      @endif
                      
                      @endforeach
                        </select>
                                      @if($errors->has('work_start'))
                          <div class="has-danger">
                              <div class="form-control-feedback">
                              @foreach($errors->get('work_start') as $er)
                                  {{$er}}
                                  @endforeach
                              </div></div>
                        @endif 
                </div>
                           <div class="form-group m-form__group hides_work_end">
                                @if($clinicinfo->singleormulti == 1)
                               <style>.hides_work_end{display:none;}</style>
                                                                        
                                                                        @endif
                    <label>
                        Work End
                    </label>
                  <select class="form-control m-input m-input--solid" name="work_end" id="workend">
                        <option selected disabled>Select Work End</option>
                     @foreach($weeks as $k=>$d)
                      @if($clinicinfo->workend == $k)
                       <option  value="{{$k}}" selected>{{$d}}</option>
                      @else
                      <option value="{{$k}}">{{$d}}</option>
                      @endif
                      
                      @endforeach
                        </select>
                                      @if($errors->has('work_end'))
                          <div class="has-danger">
                              <div class="form-control-feedback">
                              @foreach($errors->get('work_end') as $er)
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
