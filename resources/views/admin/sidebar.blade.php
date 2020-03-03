<!-- BEGIN: Left Aside -->
				<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
					<i class="la la-close"></i>
				</button>
				<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
					<!-- BEGIN: Aside Menu -->
	<div 
		id="m_ver_menu" 
		class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " 
		data-menu-vertical="true"
		 data-menu-scrollable="false" data-menu-dropdown-timeout="500"  
		>
						<ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
							<li class="m-menu__item " aria-haspopup="true" >
								<a  href="{{url('/')}}/admin/dashboard" class="m-menu__link ">
									<i class="m-menu__link-icon flaticon-line-graph"></i>
									<span class="m-menu__link-title">
										<span class="m-menu__link-wrap">
											<span class="m-menu__link-text">
												Dashboard
											</span>
										</span>
									</span>
								</a>
							</li>
							<li class="m-menu__section">
								<h4 class="m-menu__section-text">
									Components
								</h4>
								<i class="m-menu__section-icon flaticon-more-v3"></i>
							</li>
							<li class="m-menu__item  " aria-haspopup="true"  data-menu-submenu-toggle="hover">
								<a  href="{{url('/')}}/admin/employees" addlink="/admin/employees/add" class="m-menu__link m-menu__toggle">
									<i class="m-menu__link-icon flaticon-users"></i>
									<span class="m-menu__link-text">
										Employees
									</span>
								</a>
							</li>
                             <li class="m-menu__item" aria-haspopup="true"  data-menu-submenu-toggle="hover">
								<a  href="{{url('/')}}/admin/clinics" addlink="{{url('/')}}/admin/clinics/add" class="m-menu__link m-menu__toggle">
									<i class="m-menu__link-icon flaticon-users"></i>
									<span class="m-menu__link-text">
										Clinics
									</span>								
								</a>
							</li>
                            <li class="m-menu__item" aria-haspopup="true"  data-menu-submenu-toggle="hover">
								<a  href="{{url('/')}}/admin/services" addlink="{{url('/')}}/admin/services/add" class="m-menu__link m-menu__toggle">
									<i class="m-menu__link-icon la la-exchange"></i>
									<span class="m-menu__link-text">
										Service
									</span>								
								</a>
							</li>
                            <li class="m-menu__item m-menu__item--submenu " aria-haspopup="true" data-menu-submenu-toggle="hover">
								<a href="#" class="m-menu__link m-menu__toggle">
									<i class="m-menu__link-icon la 	la-cubes"></i>
									<span class="m-menu__link-text">
										Products
									</span>
									<i class="m-menu__ver-arrow la la-angle-right"></i>
								</a>
								<div class="m-menu__submenu">
									<span class="m-menu__arrow"></span>
									<ul class="m-menu__subnav">
										<li class="m-menu__item " aria-haspopup="true">
											<a href="{{url('/')}}/admin/products/stock_providers" addlink="{{url('/')}}/admin/products/add_provider" class="m-menu__link ">
												<i class="m-menu__link-bullet m-menu__link-bullet--dot">
													<span></span>
												</i>
												<span class="m-menu__link-text">
													Providers
												</span>
											</a>
										</li>
										<li class="m-menu__item " aria-haspopup="true">
											<a href="{{url('/')}}/admin/products/products" addlink="{{url('/')}}/admin/products/add" class="m-menu__link ">
												<i class="m-menu__link-bullet m-menu__link-bullet--dot">
													<span></span>
												</i>
												<span class="m-menu__link-text">
													Products
												</span>
											</a>
										</li>
										<li class="m-menu__item" aria-haspopup="true">
											<a href="{{url('/')}}/admin/products/stock_purchase_entries" addlink="{{url('/')}}/admin/products/add_stock" class="m-menu__link ">
												<i class="m-menu__link-bullet m-menu__link-bullet--dot">
													<span></span>
												</i>
												<span class="m-menu__link-text">
													Stock Purchase Entries
												</span>
											</a>
										</li>
										<li class="m-menu__item " aria-haspopup="true">
											<a href="{{url('/')}}/admin/products/stock_sell_entries" addlink="{{url('/')}}/admin/products/add_sell" class="m-menu__link ">
												<i class="m-menu__link-bullet m-menu__link-bullet--dot">
													<span></span>
												</i>
												<span class="m-menu__link-text">
													Stock Sell Entries
												</span>
											</a>
										</li>
									</ul>
								</div>
							</li>
                            <li class="m-menu__item" aria-haspopup="true"  data-menu-submenu-toggle="hover">
								<a  href="{{url('/')}}/admin/patients" addlink="/admin/patients/add" class="m-menu__link m-menu__toggle">
									<i class="m-menu__link-icon flaticon-users"></i>
									<span class="m-menu__link-text">
										Patients
									</span>								
								</a>
							</li>
                             <li class="m-menu__item" aria-haspopup="true"  data-menu-submenu-toggle="hover">
								<a  href="{{url('/')}}/admin/appointments" addlink="{{url('/')}}/admin/appointments/add" class="m-menu__link m-menu__toggle">
									<i class="m-menu__link-icon la la-clipboard"></i>
									<span class="m-menu__link-text">
										Appointments
									</span>								
								</a>
							</li>
                            
						
						</ul>
					</div>
					<!-- END: Aside Menu -->
				</div>
				<!-- END: Left Aside -->