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
												Employee Change Password
											</span>
										</a>
									</li>
								</ul>
							</div>
							
						</div>
                        @if(isset($updatedsuc) and $updatedsuc == 1)
                        <div class="m-alert m-alert--outline m-alert--outline-2x alert alert-success alert-dismissible fade show" role="alert">
													<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
													<strong>
														Well done!
													</strong>
													You successfully Updated Employee Password.
												</div>
                        @endif
                        @if(isset($updatedsuc) and $updatedsuc == 0)
                        <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">
											<div class="m-alert__icon">
												<i class="flaticon-exclamation-1"></i>
												<span></span>
											</div>
											<div class="m-alert__text">
												<strong>
													Sorry!
												</strong>
												This User Not Found
											</div>
											<div class="m-alert__close">
												<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
											</div>
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

    <form class="m-form m-form--fit m-form--label-align-right" action="{{url('/')}}/admin/employees/change_password/{{$id}}" method="post">
        {{csrf_field()}}
        <div class="m-portlet__body">
                    <div class="row">
                    <div class="col-lg-5">
                         <div class="form-group m-form__group">
                            <label>
                                New Password
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
