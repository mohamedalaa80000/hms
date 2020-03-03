<!--
<div class="modal fade" id="m_modal_5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-sm" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" style="justify-content: center;">
											New Alert !!
										</h5>
									
									</div>
									<div class="modal-body" style="text-align: center;">
										Are You Sure To Remove ?
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">
											Close
										</button>
										<button type="button" class="btn btn-primary" id="sure" token="{{csrf_token()}}">
											Sure
										</button>
									</div>
								</div>
							</div>
						</div>
-->
<!--begin::Base Scripts -->
		<script src="{{asset('assets/vendors/base/vendors.bundle.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/demo/default/base/scripts.bundle.js')}}" type="text/javascript"></script>
		<!--end::Base Scripts -->   
        <!--begin::Page Resources -->
		<script src="{{asset('assets/demo/default/custom/components/datatables/base/html-table.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/demo/default/custom/components/forms/widgets/bootstrap-datetimepicker.js')}}" type="text/javascript"></script>
        <script type="text/javascript" src="{{asset('assets/customjs/script.js')}}"></script>
        <script src="{{asset('assets/app/js/dashboard.js')}}" type="text/javascript"></script>
	   <script src="{{asset('assets/vendors/custom/fullcalendar/fullcalendar.bundle.js')}}" type="text/javascript"></script>
		<!--end::Page Resources -->
	</body>
	<!-- end::Body -->
</html>