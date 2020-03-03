@include('accountant.header')
@include('accountant.topmenu')
		<!-- begin::Body -->
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
				@include('accountant.sidebar')
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
												Add Employee
											</span>
										</a>
									</li>
								</ul>
							</div>
							
						</div>
                         @if(isset($checkinserted) and $checkinserted == 1)
                        <div class="m-alert m-alert--outline m-alert--outline-2x alert alert-success alert-dismissible fade show" role="alert">
													<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
													<strong>
														Well done!
													</strong>
													You successfully Add New Employee.
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
    <form class="m-form m-form--fit m-form--label-align-right" action="{{url('/')}}/accountant/employees/add" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="m-portlet__body">
                    <div class="row">
                    <div class="col-lg-5">
                 
                
                    <div class="form-group m-form__group">
                        <label>
                            First Name
                        </label>
                        <input type="text" class="form-control  m-input m-input--solid" placeholder="First Name Of User" name="employee_firstname" value="{{old('employee_firstname')}}">
                         @if($errors->has('employee_firstname'))
                        <div class="has-danger">
                            <div class="form-control-feedback">
                            @foreach($errors->get('employee_firstname') as $er)
                                {{$er}}
                                @endforeach
                            </div></div>
                        @endif 
                    </div>
                    <div class="form-group m-form__group">
                        <label>
                            Last Name
                        </label>
                        <input type="text" class="form-control m-input m-input--solid" placeholder="Last Name Of User" name="employee_lastname" value="{{old('employee_lastname')}}">
                         @if($errors->has('employee_lastname'))
                        <div class="has-danger">
                            <div class="form-control-feedback">
                            @foreach($errors->get('employee_lastname') as $er)
                                {{$er}}
                                @endforeach
                            </div></div>
                        @endif 
                        </div>
                            <div class="form-group m-form__group">
                            <label>
                                E-mail
                            </label>
                            <input type="email" class="form-control m-input m-input--solid" placeholder="E-mail Address Of User" name="employee_email" value="{{old('employee_email')}}">
                                 @if($errors->has('employee_email'))
                        <div class="has-danger">
                            <div class="form-control-feedback">
                            @foreach($errors->get('employee_email') as $er)
                                {{$er}}
                                @endforeach
                            </div></div>
                        @endif 
                        </div>
                         <div class="form-group m-form__group">
                            <label>
                                Password
                            </label>
                            <input type="password" class="form-control m-input m-input--solid" placeholder="Password For User" name="password">
                               @if($errors->has('password'))
                        <div class="has-danger">
                            <div class="form-control-feedback">
                            @foreach($errors->get('password') as $er)
                                {{$er}}
                                @endforeach
                            </div></div>
                        @endif 
                        </div>
                         <div class="form-group m-form__group">
                            <label>
                                Confirm Password
                            </label>
                            <input type="password" class="form-control m-input m-input--solid" placeholder="Confirm Password for User" name="repassword">
                                @if($errors->has('repassword'))
                        <div class="has-danger">
                            <div class="form-control-feedback">
                            @foreach($errors->get('repassword') as $er)
                                {{$er}}
                                @endforeach
                            </div></div>
                        @endif
                        </div>
                    </div>
                    <div class="col-lg-5 col-lg-offset-1">
                    <div class="form-group m-form__group">
                            <label>
                                Mobile
                            </label>
                            <input type="tel" class="form-control m-input m-input--solid" placeholder="Mobile Number Of User" name="mobile" value="{{old('mobile')}}">
                           @if($errors->has('mobile'))
                        <div class="has-danger">
                            <div class="form-control-feedback">
                            @foreach($errors->get('mobile') as $er)
                                {{$er}}
                                @endforeach
                            </div></div>
                        @endif
                        </div>
                    <div class="form-group m-form__group">
                            <label>
                                User Image
                            </label>
                            <input type="file" class="form-control m-input m-input--solid" name="employee_image">
                         @if($errors->has('employee_image'))
                        <div class="has-danger">
                            <div class="form-control-feedback">
                            @foreach($errors->get('employee_image') as $er)
                                {{$er}}
                                @endforeach
                            </div></div>
                        @endif
                        </div>
                         <div class="form-group m-form__group">
                    <label>
                        Status
                    </label>
                    <select class="form-control m-input m-input--solid" name="status">
                        <option selected value="1">
                            Approved
                        </option>
                        <option value="0">
                            Not Approved
                        </option>

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
                          <div class="form-group m-form__group">
                    <label>
                        Login Facility
                    </label>
                    <select class="form-control m-input m-input--solid" name="loginfacility">
                        
                        <option selected value="0">
                            No
                        </option>
                        <option value="1">
                            Yes
                        </option>

                    </select>
                                @if($errors->has('loginfacility'))
                        <div class="has-danger">
                            <div class="form-control-feedback">
                            @foreach($errors->get('loginfacility') as $er)
                                {{$er}}
                                @endforeach
                            </div></div>
                        @endif
                </div>
                        <div class="form-group m-form__group">
                            <label for="exampleTextarea">
                                Notes
                            </label>
    <textarea class="form-control m-input m-input--solid" rows="3" placeholder="Notes To User" name="notes">{{old('notes')}}</textarea>
                             @if($errors->has('notes'))
                        <div class="has-danger">
                            <div class="form-control-feedback">
                            @foreach($errors->get('notes') as $er)
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
    	@include('accountant.footer')
