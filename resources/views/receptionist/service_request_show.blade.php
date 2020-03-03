@include('receptionist.header')
@include('receptionist.topmenu')	
		<!-- begin::Body -->
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
				@include('receptionist.sidebar')
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
												Show Request Services
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
    
      
        <div class="m-portlet__body">
                    <div class="row">
                    <div class="col-lg-5">
                    <div class="form-group m-form__group">
                    <label>
                       Doctor
                    </label>
                    <input class="form-control m-input m-input--solid" type="text" disabled value="{{$getdata[0]->firstname . ' ' . $getdata[0]->lastname}}">
                               
                  
                    </div>
                        <div class="form-group m-form__group">
                    <label>
                        Patient
                    </label>
                   <input class="form-control m-input m-input--solid" type="text" disabled value="{{$getdata[0]->patientname . ' ; ' . $getdata[0]->uniqueid}}">
                            
                                                    
                </div>
                    <div class="form-group m-form__group">
                    <label>
                        Total Price
                    </label>
                        <?php $i =0;?>
                         @foreach($get2data as $s)
                           <?php $i+= $s->serviceprice;?>
                        @endforeach
                   <input class="form-control m-input m-input--solid" type="text" disabled value="{{$i}} $">
                            
                                                    
                </div>
                        
                    </div>
                       
                        
                       
                        <div class="col-lg-5 col-lg-offset-2">
                         @foreach($get2data as $s)
                        <div class="form-group m-form__group serviceplus">
                    <label>
                        Service
                    </label>
                    <input class="form-control m-input m-input--solid" type="text" disabled value="{{$s->servicename . ' ; ' . $s->serviceprice}} $">
                           
                            
                </div>
                        @endforeach    
                    
                        </div>
                        
                    </div>
                        
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
@include('receptionist.footer')
