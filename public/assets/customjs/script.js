$(window).ready(function () {
    var urls = $('#link').attr('href');
   var path = document.location.pathname.split("/");
    var wantedpath1 = "/"+path[path.length-2]+"/"+path[path.length-1];
    var wantedpath2 = "/"+path[path.length-3]+"/"+path[path.length-2]+"/"+path[path.length-1];
    $(".m-menu__item a[href='"+wantedpath1+"']").parent().addClass("m-menu__item--active");
    $(".m-menu__item a[addlink='"+wantedpath1+"']").parent().addClass("m-menu__item--active");
    $(".m-menu__item a[href='"+wantedpath2+"']").parent().addClass("m-menu__item--active");
    $(".m-menu__item a[addlink='"+wantedpath2+"']").parent().addClass("m-menu__item--active");
    $(".m-menu__item a[href='"+wantedpath1+"']").parent().addClass("m-menu__item--active").parent().parent().css("display","block").parent().addClass("m-menu__item--open");
    $(".m-menu__item a[addlink='"+wantedpath1+"']").parent().addClass("m-menu__item--active").parent().parent().css("display","block").parent().addClass("m-menu__item--open");
    $(".m-menu__item a[href='"+wantedpath2+"']").parent().addClass("m-menu__item--active").parent().parent().css("display","block").parent().addClass("m-menu__item--open");
    $(".m-menu__item a[addlink='"+wantedpath2+"']").parent().addClass("m-menu__item--active").parent().parent().css("display","block").parent().addClass("m-menu__item--open");
    
    
   
    $('select[name="employeetype"]').change(function (){
        $("#clinic,#salary").remove();
        var token = $("input[name='_token']").val();
        var emptype = $(this).val();
        var serialized = "_token="+token+"&emptype="+emptype;
        console.log(serialized);
        $.ajax({
            url:urls +'/admin/employees/add/employeetype',
            method:'POST',
            data:serialized,
            dataType:'json',
            success:function (data){
                if(data.clinics){
                    
                        
                        var options ='<option value="0" selected disabled>Select Clinic</option>';
                       for(var x = 0; x <data.clinics.length ; x++) {
                           options +="<option value='"+data.clinics[x].id+"'>"+data.clinics[x].clinicname+"</option>";
                       }
                    $('select[name="employeetype"]').parent().after('<div class="form-group m-form__group" id="clinic"><label>Clinic</label> <select class="form-control m-input m-input--solid" name="clinic" id="clinicgetdate">'+options+'</select></div>');
                   
                    
                    if(data.doctor){
                         $('textarea[name="notes"]').parent().after('<div class="form-group m-form__group" id="salary"><label>Salary</label> <input type="number" class="form-control m-input m-input--solid" name="salary"></div>');
                    }
                }
            }
            
        });
    });
    $('select[name="employee_type"]').change(function (){
        $("#salary").remove();
        var va = $(this).val();
        if(va == 0){
            $('textarea[name="notes"]').parent().after('<div class="form-group m-form__group" id="salary"><label>Salary</label> <input type="number" class="form-control m-input m-input--solid" name="salary"></div>'); 
        }
    });
    
    $("#clinics").change(function (){
        var clinic = $(this).val();
        var token = $("input[name='_token']").val();
        var serialized = "_token="+token+"&clinic="+clinic;
        var options = '<option value="0" selected disabled>Select Doctor</option>';
        $.ajax({
            url:urls +'/admin/appointments/add/doctor',
            method:'POST',
            data:serialized,
            dataType:'json',
            success:function(data){
                if(data.doctors){
                    $("#doctors").children().remove();
                    for(var m = 0;m<data.doctors.length;m++){
                        options+="<option value='"+data.doctors[m].id+"'>"+data.doctors[m].firstname+"</option>";
                    }
                    $("#doctors").append(options);
                }
               
            },
            
    error: function (request, status, error) {
        console.log(request);
        console.log(status);
        console.log(error);
    }
        });
    });
    
    $(document).on('change','#clinicgetdate',function (){
        $('select[name="day_work"]').children().remove();
        $('select[name="work_start"]').children().remove();
        $('select[name="work_end"]').children().remove();
        var clinic = $(this).val();
        var token = $("input[name='_token']").val();
        var serialized = "_token="+token+"&clinic="+clinic;
         $.ajax({
            url:urls +'/admin/appointments/get/clinic/times',
            method:'POST',
            data:serialized,
            dataType:'json',
            success:function(data){
            if(data.times){
             
                
                  if(data.times.singleormulti == 1){
                       $('select[name="day_work"]').append('<option value="'+data.times.onlyday+'">'+data.weeks[data.times.onlyday]+'</option>');
                       $(".hides_day_work").css("display","block");
                       $(".hides_work_start").css("display","none");
                       $(".hides_work_end").css("display","none");
                  }
                    if(data.times.singleormulti == 0){
                           $(".hides_day_work").css("display","none");
                         var firstoptions = '<option selected disabled>Select Start Date</option>';
                         var secondoptions = '<option selected disabled>Select End Date</option>';
                        for(var x = data.times.workstart;x <data.weeks.length;x++){
                             firstoptions +='<option value="'+x+'">'+data.weeks[x]+'</option>';
                         } 
                        for(var y = data.times.workend;y <data.weeks.length;y++){
                             secondoptions +='<option value="'+y+'">'+data.weeks[y]+'</option>';
                         }
                         $('select[name="work_start"]').append(firstoptions);
                         $('select[name="work_end"]').append(secondoptions);
                         $(".hides_day_work").css("display","none");
                         $(".hides_work_start_emp").css("display","block");
                         $(".hides_work_end_emp").css("display","block");
                    }
                
                
            }
               
            },
            
    error: function (request, status, error) {
        console.log(request);
        console.log(status);
        console.log(error);
    }
        });
    });
    
    $(document).on('click','.removeemployee',function(e){
        e.preventDefault();
         var row = $(this).parent().parent().parent().attr('data-row');
        var empid = $(this).attr('empid');
        $("#sure").attr('empid',empid);
        $("#sure").attr('row',row);
        $('#m_modal_5').modal('show');
    });
    $(document).on('click','#sure',function (){
        var row = $(this).attr('row');
        var empid = $(this).attr('empid');
        var token = $(this).attr('token');
        var serialized = '_token='+token+'&empid='+empid;
        $.ajax({
            
            url:urls +'/admin/employees/remove',
            method:"POST",
            data:serialized,
            dataType:"json",
            success:function (data){
                if(data.removed){
                    $('#m_modal_5').modal('hide');
                   
                    $('tr[data-row="'+row+'"]').on('custom',function (){
                        $(this).remove();
                    });
                    $('tr[data-row="'+row+'"]').trigger('custom');
                    
                    
                   
                }
            }
        });
    });
    $(document).on('change','#singleday',function (){
       var selected = $(this).val();
        if(selected == 0){
           $("#onlyday").parent().css("display","none");
            $("#workstart").parent().css("display","block");
            $("#workend").parent().css("display","block");
        }
        else{
            $("#onlyday").parent().css("display","block");
            $("#workstart").parent().css("display","none");
            $("#workend").parent().css("display","none");
        }
    });
    
    $('.getdates').click(function (){
        alert("dd");
    });
    
    
  $(document).on('click','.removeclinic',function (e){
      e.preventDefault();
      var row = $(this).parent().parent().parent().attr('data-row');
       var clinicid = $(this).attr('clinicid');
        $("#sureclinicremove").attr('clinicid',clinicid);
        $("#sureclinicremove").attr('row',row);
        $('#m_modal_5').modal('show');
    
  });
    
    $(document).on('click','#sureclinicremove',function (){
        var row = $(this).attr('row');
        var clinicid = $(this).attr('clinicid');
        var token = $(this).attr('token');
        var serialized = '_token='+token+'&clinicid='+clinicid;
        $.ajax({
            
            url:urls +'/admin/clinics/remove',
            method:"POST",
            data:serialized,
            dataType:"json",
            success:function (data){
                if(data.removed){
                    $('#m_modal_5').modal('hide');
                   
                    $('tr[data-row="'+row+'"]').on('custom',function (){
                        $(this).remove();
                    });
                    $('tr[data-row="'+row+'"]').trigger('custom');
                    
                    
                   
                }
            }
        });
    });
    $(document).on('click','.removeproduct',function (e){
      e.preventDefault();
      var row = $(this).parent().parent().parent().attr('data-row');
       var productid = $(this).attr('productid');
        $("#sureproductremove").attr('productid',productid);
        $("#sureproductremove").attr('row',row);
        $('#m_modal_5').modal('show');
    
  });
    $(document).on('click','#sureproductremove',function (){
        var row = $(this).attr('row');
        var productid = $(this).attr('productid');
        var token = $(this).attr('token');
        var serialized = '_token='+token+'&productid='+productid;
        $.ajax({
            
            url:urls +'/admin/products/products/remove',
            method:"POST",
            data:serialized,
            dataType:"json",
            success:function (data){
                if(data.removed){
                    $('#m_modal_5').modal('hide');
                   
                    $('tr[data-row="'+row+'"]').on('custom',function (){
                        $(this).remove();
                    });
                    $('tr[data-row="'+row+'"]').trigger('custom');
                    
                    
                   
                }
            }
        });
    });
    
     $(document).on('click','.removestockp',function (e){
      e.preventDefault();
      var row = $(this).parent().parent().parent().attr('data-row');
       var stockid = $(this).attr('stockid');
        $("#sureremovestockp").attr('stockid',stockid);
        $("#sureremovestockp").attr('row',row);
        $('#m_modal_5').modal('show');
    
  });
      $(document).on('click','#sureremovestockp',function (){
        var row = $(this).attr('row');
        var stockid = $(this).attr('stockid');
        var token = $(this).attr('token');
        var serialized = '_token='+token+'&stockid='+stockid;
        $.ajax({
            
            url:urls +'/admin/products/stock_purchase_entries/remove',
            method:"POST",
            data:serialized,
            dataType:"json",
            success:function (data){
                if(data.removed){
                    $('#m_modal_5').modal('hide');
                   
                    $('tr[data-row="'+row+'"]').on('custom',function (){
                        $(this).remove();
                    });
                    $('tr[data-row="'+row+'"]').trigger('custom');
                    
                    
                   
                }
            }
        });
    });
    $(document).on('click','.removestocksell',function (e){
      e.preventDefault();
      var row = $(this).parent().parent().parent().attr('data-row');
       var stockid = $(this).attr('stockid');
        $("#sureremovestocksell").attr('stockid',stockid);
        $("#sureremovestocksell").attr('row',row);
        $('#m_modal_5').modal('show');
    
  });
       $(document).on('click','#sureremovestocksell',function (){
        var row = $(this).attr('row');
        var stockid = $(this).attr('stockid');
        var token = $(this).attr('token');
        var serialized = '_token='+token+'&stockid='+stockid;
        $.ajax({
            
            url:urls +'/admin/products/stock_sell_entries/remove',
            method:"POST",
            data:serialized,
            dataType:"json",
            success:function (data){
                if(data.removed){
                    $('#m_modal_5').modal('hide');
                   
                    $('tr[data-row="'+row+'"]').on('custom',function (){
                        $(this).remove();
                    });
                    $('tr[data-row="'+row+'"]').trigger('custom');
                    
                    
                   
                }
            }
        });
    });
     $(document).on('click','.removepatient',function (e){
      e.preventDefault();
      var row = $(this).parent().parent().parent().attr('data-row');
       var patientid = $(this).attr('patientid');
        $("#sureremovepatient").attr('patientid',patientid);
        $("#sureremovepatient").attr('row',row);
        $('#m_modal_5').modal('show');
    
  });
      $(document).on('click','#sureremovepatient',function (){
        var row = $(this).attr('row');
        var patientid = $(this).attr('patientid');
        var token = $(this).attr('token');
        var serialized = '_token='+token+'&patientid='+patientid;
        $.ajax({
            
            url:urls +'/admin/patients/remove',
            method:"POST",
            data:serialized,
            dataType:"json",
            success:function (data){
                if(data.removed){
                    $('#m_modal_5').modal('hide');
                   
                    $('tr[data-row="'+row+'"]').on('custom',function (){
                        $(this).remove();
                    });
                    $('tr[data-row="'+row+'"]').trigger('custom');
                    
                    
                   
                }
            }
        });
    });
     $(document).on('click','.serviceplusicon',function () {
         $(this).removeClass('la-plus-circle').removeClass('serviceplusicon').addClass('la-remove').addClass('serviceremoveicon');
         var appenedval = '<div class="form-group m-form__group serviceplus"><label>Service</label><select class="form-control m-input m-input--solid servicescon" name="service[]">';
             appenedval += $(this).siblings('.servicescon').html();
             appenedval       +='</select>  <i class="la la-plus-circle serviceplusicon"></i></div>';
         $(this).parent().after(appenedval);
     });
    $(document).on('click','.serviceremoveicon',function(){
        $(this).parent().remove();
    });
      $("#addserclinic").change(function (){
          
        var clinic = $(this).val();
        var token = $("input[name='_token']").val();
        var serialized = "_token="+token+"&clinic="+clinic;
        var options = '<option value="0" selected disabled>Select Doctor</option>';
        $.ajax({
            url:urls +'/receptionist/services/add/doctor',
            method:'POST',
            data:serialized,
            dataType:'json',
            success:function(data){
                if(data.doctors){
                    $("#doctors").children().remove();
                    for(var m = 0;m<data.doctors.length;m++){
                        options+="<option value='"+data.doctors[m].empid+"'>"+data.doctors[m].firstname+' '+data.doctors[m].lastname+"</option>";
                    }
                    $("#doctors").append(options);
                }
               
            },
            
    error: function (request, status, error) {
        console.log(request);
        console.log(status);
        console.log(error);
    }
        });
    });
    
    $('#addappend').click(function (){
        var conentappen = $('.addappend').html();
        $('.addappend').after('<tr>'+conentappen+'</tr>');
    });
});