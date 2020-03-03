<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;
use App\services_requests;
use App\requested_services;
use Carbon\Carbon;
class clinic extends Controller
{
    public $clinicid = 2;
    public function index(){
        return view("clinic.dashboard");
    }
    public function dashboard(){
        return view("clinic.dashboard");
    }
    public function employees(){
        $user_type = array("Doctor","Nurse","Receptionist","Accountant","X-Ray Employees","Warehouse Employees");
        $status = array("Not Approved","Approved");
        $loginfacility = array("No","Yes");
        $allemployess = DB::table('clinic__workers')
            ->join('employees','clinic__workers.employeeid','=','employees.id')
            ->select('employees.id as empid','employees.employeetype as emptype','employees.email','employees.mobile','employees.firstname','employees.lastname','employees.status','employees.loginfacility')
            ->where('clinic__workers.clinicid','=',$this->clinicid)
            ->get();
        
        return view("clinic.employees")->with("employees",$allemployess)->with("user_type",$user_type)->with('status',$status)->with('loginfacility',$loginfacility);
    }
    
    public function employees_add(){
        $singleormulti = DB::table('clinics')->find($this->clinicid);
        $weeks = array("Saturday","Sunday","Monday","Tuesday","Wednesday","Thursday","Friday");
        $weeksnum = array( 0, 1, 2 , 3, 4 , 5 , 6 );
        if($singleormulti->singleormulti == 1){
            $startdays = array_slice($weeksnum,$singleormulti->workstart,$singleormulti->workend);
        $enddays = array_slice($weeksnum,$singleormulti->workstart,$singleormulti->workend);
         return view('clinic.add_employee')->with('singleormulti',$singleormulti)->with('weeks',$weeks)->with('weeksnum',$weeksnum)->with('startdays',$startdays)->with('enddays',$enddays);
        
        }
        else{
                    return view('clinic.add_employee')->with('singleormulti',$singleormulti)->with('weeks',$weeks); 
        }
        
        
    
    }
    public function employees_store(Request $request){
        $singleormulti = DB::table('clinics')->find($this->clinicid);
        $weeksnum = array( 0, 1, 2 , 3, 4 , 5 , 6 );
        $weeks = array("Saturday","Sunday","Monday","Tuesday","Wednesday","Thursday","Friday");
        if($request->has('salary')){
             if($singleormulti->singleormulti == 0){
            $startdays = array_slice($weeksnum,$singleormulti->workstart,$singleormulti->workend);
            $enddays = array_slice($weeksnum,$singleormulti->workstart,$singleormulti->workend);
            $startdaystr = implode($startdays,',');
            $enddaysstr = implode($enddays,',');
            $this->validate($request,[
                
                'employee_firstname' => 'required',
                'employee_lastname' => 'required',
                'employee_email' => 'required|email|unique:employees,email',
                'password' => 'required',
                'repassword' => 'required|same:password',
                'mobile' => 'required|numeric',
                'employee_image' =>'required|mimes:png,jpeg,jpg,PNG,JPEG,JPG',
                'status' => 'required|in:0,1|numeric',
                'loginfacility' => 'required|in:0,1|numeric',
                'notes' => 'required',
                'employee_type' => 'required|numeric|in:0,1',
                'work_start' => 'required|numeric|in:'.$startdaystr,  
                'work_end' => 'required|numeric|in:'.$enddaysstr,
                'salary' => 'required|numeric',
           
       ]); 
            $image = $request->file('employee_image');
            $imageext = $image->getClientOriginalExtension();
            $imageforupload = 'userimage'.time() . rand(10,2540).'.'.$imageext;
            $insertedid = DB::table('employees')
            ->insertGetId([
                'firstname' => $request->input('employee_firstname'),
                'lastname' => $request->input('employee_lastname'),
                'email' => $request->input('employee_email'),
                'password' => Hash::make($request->input('password')),
                'mobile' => $request->input('mobile'),
                'userimage' => $imageforupload,
                'employeetype' => $request->input('employee_type'),
                'status' => $request->input('status'),
                'loginfacility' => $request->input('loginfacility'),
                'notes' => $request->input('notes'),
                 'salary' => $request->input('salary'),
                
                
            ]);
            $image->move(public_path('uploads'),$imageforupload);
            $in = DB::table('clinic__workers')->insert([
                'employeeid' => $insertedid,
                'clinicid' => $this->clinicid ,
                'workstart' =>  $request->input('work_start'),
                'workend' =>  $request->input('work_end'),
                'singleormulti' => 0 ,
                
            ]);
            return view("clinic.add_employee")->with("checkinserted",1)->with('singleormulti',$singleormulti)->with('weeks',$weeks)->with('weeksnum',$weeksnum)->with('startdays',$startdays)->with('enddays',$enddays);
        }
        else{
            
               $this->validate($request,[
                
                'employee_firstname' => 'required',
                'employee_lastname' => 'required',
                'employee_email' => 'required|email|unique:employees,email',
                'password' => 'required',
                'repassword' => 'required|same:password',
                'mobile' => 'required|numeric',
                'employee_image' =>'required|mimes:png,jpeg,jpg,PNG,JPEG,JPG',
                'status' => 'required|in:0,1|numeric',
                'loginfacility' => 'required|in:0,1|numeric',
                'notes' => 'required',
                'employee_type' => 'required|numeric|in:0,1',
                'work_day' => 'required|numeric|in:'.$singleormulti->onlyday,  
                'salary' => 'required|numeric',
                
           
       ]); 
            $image = $request->file('employee_image');
            $imageext = $image->getClientOriginalExtension();
            $imageforupload = 'userimage'.time() . rand(10,2540).'.'.$imageext;
            $insertedid = DB::table('employees')
            ->insertGetId([
                'firstname' => $request->input('employee_firstname'),
                'lastname' => $request->input('employee_lastname'),
                'email' => $request->input('employee_email'),
                'password' => Hash::make($request->input('password')),
                'mobile' => $request->input('mobile'),
                'userimage' => $imageforupload,
                'employeetype' => $request->input('employee_type'),
                'status' => $request->input('status'),
                'loginfacility' => $request->input('loginfacility'),
                'notes' => $request->input('notes'),
                'salary' => $request->input('salary'),
                
                
            ]);
             $image->move(public_path('uploads'),$imageforupload);
            $in = DB::table('clinic__workers')->insert([
                'employeeid' => $insertedid,
                'clinicid' => $this->clinicid ,
                'onlyday' => $request->input('work_day'),
                'singleormulti' => 1 ,
                
            ]);
           return view("clinic.add_employee")->with("checkinserted",1)->with('singleormulti',$singleormulti)->with('weeks',$weeks);  
        }
        }
        else{
            if($singleormulti->singleormulti == 0){
            $startdays = array_slice($weeksnum,$singleormulti->workstart,$singleormulti->workend);
            $enddays = array_slice($weeksnum,$singleormulti->workstart,$singleormulti->workend);
            $startdaystr = implode($startdays,',');
            $enddaysstr = implode($enddays,',');
            $this->validate($request,[
                
                'employee_firstname' => 'required',
                'employee_lastname' => 'required',
                'employee_email' => 'required|email|unique:employees,email',
                'password' => 'required',
                'repassword' => 'required|same:password',
                'mobile' => 'required|numeric',
                'employee_image' =>'required|mimes:png,jpeg,jpg,PNG,JPEG,JPG',
                'status' => 'required|in:0,1|numeric',
                'loginfacility' => 'required|in:0,1|numeric',
                'notes' => 'required',
                'employee_type' => 'required|numeric|in:0,1',
                'work_start' => 'required|numeric|in:'.$startdaystr,  
                'work_end' => 'required|numeric|in:'.$enddaysstr,
           
       ]); 
            $image = $request->file('employee_image');
            $imageext = $image->getClientOriginalExtension();
            $imageforupload = 'userimage'.time() . rand(10,2540).'.'.$imageext;
            $insertedid = DB::table('employees')
            ->insertGetId([
                'firstname' => $request->input('employee_firstname'),
                'lastname' => $request->input('employee_lastname'),
                'email' => $request->input('employee_email'),
                'password' => Hash::make($request->input('password')),
                'mobile' => $request->input('mobile'),
                'userimage' => $imageforupload,
                'employeetype' => $request->input('employee_type'),
                'status' => $request->input('status'),
                'loginfacility' => $request->input('loginfacility'),
                'notes' => $request->input('notes'),
                
                
            ]);
            $image->move(public_path('uploads'),$imageforupload);
            $in = DB::table('clinic__workers')->insert([
                'employeeid' => $insertedid,
                'clinicid' => $this->clinicid ,
                'workstart' =>  $request->input('work_start'),
                'workend' =>  $request->input('work_end'),
                'singleormulti' => 0 ,
                
            ]);
            return view("clinic.add_employee")->with("checkinserted",1)->with('singleormulti',$singleormulti)->with('weeks',$weeks)->with('weeksnum',$weeksnum)->with('startdays',$startdays)->with('enddays',$enddays);
        }
        else{
            
               $this->validate($request,[
                
                'employee_firstname' => 'required',
                'employee_lastname' => 'required',
                'employee_email' => 'required|email|unique:employees,email',
                'password' => 'required',
                'repassword' => 'required|same:password',
                'mobile' => 'required|numeric',
                'employee_image' =>'required|mimes:png,jpeg,jpg,PNG,JPEG,JPG',
                'status' => 'required|in:0,1|numeric',
                'loginfacility' => 'required|in:0,1|numeric',
                'notes' => 'required',
                'employee_type' => 'required|numeric|in:0,1',
                'work_day' => 'required|numeric|in:'.$singleormulti->onlyday,  
                
           
       ]); 
            $image = $request->file('employee_image');
            $imageext = $image->getClientOriginalExtension();
            $imageforupload = 'userimage'.time() . rand(10,2540).'.'.$imageext;
            $insertedid = DB::table('employees')
            ->insertGetId([
                'firstname' => $request->input('employee_firstname'),
                'lastname' => $request->input('employee_lastname'),
                'email' => $request->input('employee_email'),
                'password' => Hash::make($request->input('password')),
                'mobile' => $request->input('mobile'),
                'userimage' => $imageforupload,
                'employeetype' => $request->input('employee_type'),
                'status' => $request->input('status'),
                'loginfacility' => $request->input('loginfacility'),
                'notes' => $request->input('notes'),
                
                
            ]);
             $image->move(public_path('uploads'),$imageforupload);
            $in = DB::table('clinic__workers')->insert([
                'employeeid' => $insertedid,
                'clinicid' => $this->clinicid ,
                'onlyday' => $request->input('work_day'),
                'singleormulti' => 1 ,
                
            ]);
           return view("clinic.add_employee")->with("checkinserted",1)->with('singleormulti',$singleormulti)->with('weeks',$weeks);  
        }
        }
        
       
    }
    public function employees_edit($id){
        $check = DB::table('clinic__workers')
            ->where([
                ['employeeid','=',$id,],
                ['clinicid','=',$this->clinicid] 
            ])
            ->get();
        if(count($check) >0){
            $userinfo = DB::table('employees')->find($id);
            $user_type = array("Doctor","Nurse");
          return view('clinic.employees_edit_profile')->with('userinfo',$userinfo)->with('id',$id)->with('user_type',$user_type);
        }
    }
    public function employees_edit_store(Request $request,$id){
     
        if($request->has('salary')){
              $this->validate($request,[
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:employees,email,'.$id,
            'mobile' => 'required',
            'userimage' => 'image|mimes:png,jpeg,jpg,PNG,JPEG,JPG',
            'employee_type'=>'required|in:0,1',
            'status'=>'required|in:0,1',
            'loginfacility'=>'required|in:0,1',
            'notes'=>'required',
            'salary'=>'required|numeric'
        ]);
           if($request->hasFile('userimage')){
            $image = $request->file('userimage');
            $imagename = $image->getClientOriginalName();
            $imageext = $image->getClientOriginalExtension();
            $imagepathtoupload = "userimage_" . time() . rand(1,1000) . "." . $imageext;
            $updatedsuc = DB::table('employees')
            ->where('id',$id)
            ->update([
                'firstname' => $request->input('firstname'),
                'lastname' => $request->input('lastname'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'mobile' => $request->input('mobile'),
                'userimage' => $imagepathtoupload,
                'employeetype' => $request->input('employee_type'),
                'status' => $request->input('status'),
                'loginfacility' => $request->input('loginfacility'),
                'notes' => $request->input('notes'),
                'salary' => $request->input('salary')
                
            ]);
                    $image->move(public_path('uploads'),$imagepathtoupload);
                    session()->flash('updatedsuc',1);
        }
           else{
              $updatedsuc = DB::table('employees')
            ->where('id',$id)
            ->update([
                'firstname' => $request->input('firstname'),
                'lastname' => $request->input('lastname'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'mobile' => $request->input('mobile'),
                'employeetype' => $request->input('employee_type'),
                'status' => $request->input('status'),
                'loginfacility' => $request->input('loginfacility'),
                'notes' => $request->input('notes'),
                 'salary' => $request->input('salary')
                
            ]);
                   session()->flash('updatedsuc',1);
            
        }
           return redirect("/clinic/employees/edit/$id"); 
        }
        else{
           $this->validate($request,[
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:employees,email,'.$id,
            'mobile' => 'required',
            'userimage' => 'image|mimes:png,jpeg,jpg,PNG,JPEG,JPG',
            'employee_type'=>'required|in:0,1',
            'status'=>'required|in:0,1',
            'loginfacility'=>'required|in:0,1',
            'notes'=>'required',
        ]);
           if($request->hasFile('userimage')){
            $image = $request->file('userimage');
            $imagename = $image->getClientOriginalName();
            $imageext = $image->getClientOriginalExtension();
            $imagepathtoupload = "userimage_" . time() . rand(1,1000) . "." . $imageext;
            $updatedsuc = DB::table('employees')
            ->where('id',$id)
            ->update([
                'firstname' => $request->input('firstname'),
                'lastname' => $request->input('lastname'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'mobile' => $request->input('mobile'),
                'userimage' => $imagepathtoupload,
                'employeetype' => $request->input('employee_type'),
                'status' => $request->input('status'),
                'loginfacility' => $request->input('loginfacility'),
                'notes' => $request->input('notes'),
                 'salary' => 0
                
            ]);
                    $image->move(public_path('uploads'),$imagepathtoupload);
                    session()->flash('updatedsuc',1);
        }
           else{
              $updatedsuc = DB::table('employees')
            ->where('id',$id)
            ->update([
                'firstname' => $request->input('firstname'),
                'lastname' => $request->input('lastname'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'mobile' => $request->input('mobile'),
                'employeetype' => $request->input('employee_type'),
                'status' => $request->input('status'),
                'loginfacility' => $request->input('loginfacility'),
                'notes' => $request->input('notes'),
                 'salary' => 0
                
            ]);
                   session()->flash('updatedsuc',1);
            
        }
           return redirect("/clinic/employees/edit/$id"); 
        }
       
    }
    public function patients(){
        
        $patients = DB::table('patients')->get();
        $gender = array("Male","Female");
        $status = array("Inactive","Active","Block");
        return view('clinic.patients')->with('patients',$patients)->with("gender",$gender)->with("status",$status);
        
    }
    public function patients_add_show(){
        return view('clinic.add_patient');
    }
    public function patients_add_store(Request $request){
          $this->validate($request,[
            
            'patient_name' => 'required',
            'marital_status' => 'required|in:0,1',
            'gender' => 'required|in:0,1',
            'occupation' => 'required',
            'religion' => 'required',
            'address' => 'required',
            'nationality' => 'required',
            'phone' => 'required',
            'age' => 'required|numeric',
            'blood_group' => 'required',
            'chief_complaint' => 'required',
            'relevant_medical_history' => 'required',
            'temperature' => 'required',
            'blood_pressure' => 'required',
            'extra_oral_examination' => 'required',
            'oral_hygiene' => 'required',
            'occlusion' => 'required',
        ]);
        $insert = DB::table('patients')
            ->insert([
            'patientname' => $request->input('patient_name'),
            'uniqueid' => 'PA' . time(),
            'marital_status' => $request->input('marital_status'),
            'gender' => $request->input('gender'),
            'occupation' => $request->input('occupation'),
            'religion' => $request->input('religion'),
            'address' => $request->input('address'),
            'nationality' => $request->input('nationality'),
            'phone' => $request->input('phone'),
            'age' => $request->input('age'),
            'bloodgroup' => $request->input('blood_group'),
            'chiefcomplaint' => $request->input('chief_complaint'),
            'relevantmedicalhistory' => $request->input('relevant_medical_history'),
            'temperature' => $request->input('temperature'),
            'bloodpressure' => $request->input('blood_pressure'),
            'extraoralexamination' => $request->input('extra_oral_examination'),
            'oralhygiene' => $request->input('oral_hygiene'),
            'occlusion' => $request->input('occlusion'),
            ]);
        
        if($insert != null){
            return view("clinic.add_patient")->with("inserted",$insert);
        }
    }
     public function appointments(){
        $appointmentstatus = array("Unconfirmed","Confirmed","Finish","Late Finish","Cancel");
        $appointments = DB::table('appointments')
            ->join('clinics','appointments.clinicid','=','clinics.id')
            ->join('employees','appointments.doctorid','=','employees.id')
            ->join('patients','appointments.patientid','=','patients.id')
            ->select('appointments.id as Appointid','clinics.clinicname','patients.patientname','employees.firstname','employees.lastname','appointments.appointmentdateandtime','appointments.status')
            ->where('clinicid','=',$this->clinicid)
            ->get();
        return view('clinic.appointments')->with('appointments',$appointments)->with('appointmentstatus',$appointmentstatus);
    }
    public function appointments_edit_show($id){
      $check = DB::table('appointments')->find($id);
        if($check != null){
             $clinics = DB::table('clinics')->get();
             $patients = DB::table('patients')->get();
             $appointmentstatus = array(0 =>"Unconfirmed",1 => "Confirmed", 2 => "Finish",3 => "Late Finish", 4 => "Cancel");
             $appointments = DB::table('appointments')
            ->join('clinics','appointments.clinicid','=','clinics.id')
            ->join('employees','appointments.doctorid','=','employees.id')
            ->join('patients','appointments.patientid','=','patients.id')
            ->select('appointments.id as Appointid','clinics.clinicname','clinics.id as clinicid','patients.patientname','patients.id as patientid','employees.id as empid','employees.firstname','employees.lastname','appointments.appointmentdateandtime','appointments.status')
            ->where('appointments.id','=',$id)
            ->limit(1) 
            ->get();
            $doctorsinclinic  = DB::table('clinic__workers')
                ->join('employees','clinic__workers.employeeid','=','employees.id')
                ->select('employees.id as empid','employees.firstname','employees.lastname')
                ->where('clinicid','=',$appointments[0]->clinicid)
                ->get();
            return view("clinic.appointments_edit")->with('info',$id)->with('allclinics',$clinics)->with('patients',$patients)->with('appointments',$appointments)->with('appointmentstatus',$appointmentstatus)->with('doctorsinclinic',$doctorsinclinic);
        }
    }
    public function appointments_edit(Request $request,$id){
         $clinics = DB::table('clinics')->get();
        $clinicsids = array();
        foreach($clinics as $c){
            $clinicsids [] = $c->id;
        }
        $idsclinics = implode(',',$clinicsids);
        $doctorsinclinic = DB::table('clinic__workers')
            ->where('clinicid','=',$request->input('clinic'),'and','employeeid','=',$request->input('doctor'))
            ->get();
        $doctorsids =array();
        foreach($doctorsinclinic as $d){
            $doctorsids [] = $d->employeeid;
        }
        $idsdoctors = implode(',',$doctorsids);
        $patients = DB::table('patients')->get();
        $patientsids = array();
        foreach($patients as $p){
            $patientsids [] = $p->id;
        }
        $idspatients = implode(',',$patientsids);
        $this->validate($request,[
            'clinic' => 'required|in:'.$idsclinics,
            'doctor' => 'required|in:'.$idsdoctors,
            'patient' => 'required|in:'.$idspatients,
            'dateandtime' =>'required' ,
            'status' => 'required|in:0,1,2,3,4',
            
        ]);
        $updated = DB::table('appointments')
            ->where('id',$id)
            ->update([
                
                'clinicid' => $request->input('clinic'),
                'doctorid' => $request->input('doctor'),
                'patientid' => $request->input('patient'),
                'appointmentdateandtime' => $request->input('dateandtime'),
                'status' => $request->input('status'),
            ])
            
            ;
        
            session()->flash('updated',1);
            return redirect("/clinic/appointments/edit/$id");
        
        
    }
    public function services(){
        $getdata = DB::table('services_requests')
            ->join('clinics','services_requests.clinicid','=','clinics.id')
            ->join('employees','services_requests.employeeid','=','employees.id')
            ->join('patients','services_requests.patientid','=','patients.id')
            ->select('services_requests.id as serid','clinics.clinicname as cname','employees.firstname as fir','employees.lastname as las','patients.phone','patients.patientname','services_requests.created_at as created')
            ->where('services_requests.clinicid','=',$this->clinicid)
            ->get();
        return view("clinic.service_requests")->with('getdata',$getdata);
    }
    public function services_add_show(){
        $selectalldocotosinclinic = DB::table('clinic__workers')
            ->join('employees','clinic__workers.employeeid','=','employees.id')
            ->select('employees.id as empid','employees.firstname','employees.lastname')
            ->where('employees.employeetype','=',0)
            ->get();
        $getallpatients = DB::table('patients')
            ->select('patientname as pname','id as pid')
            ->get();
        $getallservices = DB::table('services')
            ->get();
        return view("clinic.add_service_request")->with('selectalldocotosinclinic',$selectalldocotosinclinic)->with('getallpatients',$getallpatients)->with('getallservices',$getallservices);
    }
    public function services_add_store(Request $request){
        $this->validate($request,[
            'doctor' => 'required',
            'patient' => 'required',
            
        ]);
       $insertedid = DB::table('services_requests')
           ->insertGetId([
               'clinicid' => $this->clinicid,
               'employeeid' => $request->input('doctor'),
               'patientid' => $request->input('patient'),
               'created_at' => Carbon::now(),
               
               
           ]);
        $requested_servicesarr = $request->input('service');
       foreach($requested_servicesarr as $x){
           $insertservice = DB::table('requested_services')
               ->insert([
                   'requestid' => $insertedid,
                   'serviceid' => $x,
                   
               ]);
       }
        session()->flash('success',1);
        return redirect('/clinic/services/add');
    }
    public function service_request_show($id){
        
        $getdata = DB::table('services_requests')
            ->join('employees','services_requests.employeeid','=','employees.id')
            ->join('clinics','services_requests.clinicid','=','clinics.id')
            ->join('patients','services_requests.patientid','patients.id')
            ->select('services_requests.id','employees.firstname','employees.lastname','clinics.clinicname','patients.patientname','patients.uniqueid')
            ->where('services_requests.id','=',$id,'and','services_requests.clinicid','=',$this->clinicid)
            ->limit(1)
            ->get();
        
         $get2data = DB::table('requested_services')
               ->join('services','requested_services.serviceid','=','services.id')
               ->select('requested_services.serviceid','services.servicename','services.serviceprice')
               ->where('requested_services.requestid','=',$getdata[0]->id)
               ->get();
       return view('clinic.service_request_show')->with('getdata',$getdata)->with('get2data',$get2data);
        
            
    }
    public function service_request_edit_show($id){
           $selectalldocotosinclinic = DB::table('clinic__workers')
            ->join('employees','clinic__workers.employeeid','=','employees.id')
            ->select('employees.id as empid','employees.firstname','employees.lastname')
            ->where('employees.employeetype','=',0)
            ->get();
           $getallpatients = DB::table('patients')
            ->select('patientname as pname','id as pid','uniqueid')
            ->get();
           $getallservices = DB::table('services')
            ->get();
           $getdata = DB::table('services_requests')
            ->join('employees','services_requests.employeeid','=','employees.id')
            ->join('clinics','services_requests.clinicid','=','clinics.id')
            ->join('patients','services_requests.patientid','patients.id')
            ->select('services_requests.id','employees.id as emid','employees.firstname','employees.lastname','clinics.clinicname','patients.id as patientid','patients.patientname','patients.uniqueid')
            ->where('services_requests.id','=',$id,'and','services_requests.clinicid','=',$this->clinicid)
            ->limit(1)
            ->get();
        
            $get2data = DB::table('requested_services')
               ->join('services','requested_services.serviceid','=','services.id')
               ->select('requested_services.serviceid','services.servicename','services.serviceprice')
               ->where('requested_services.requestid','=',$getdata[0]->id)
               ->get();
       return view('clinic.edit_service_request')->with('getdata',$getdata)->with('get2data',$get2data)->with('selectalldocotosinclinic',$selectalldocotosinclinic)->with('getallpatients',$getallpatients)->with('getallservices',$getallservices)->with('id',$id);
        
    }
    public function service_request_edit_store(Request $request,$id){
         $this->validate($request,[
            'doctor' => 'required',
            'patient' => 'required',
            
        ]);
       $updated = DB::table('services_requests')
           ->where('id','=',$id)
           ->update([
               'clinicid' => $this->clinicid,
               'employeeid' => $request->input('doctor'),
               'patientid' => $request->input('patient'),
               'created_at' => Carbon::now(),
               
           ]);
         $deletes = DB::table('requested_services')
               ->where('requestid','=',$id)
              ->delete();
        $requested_servicesarr = $request->input('service');
       foreach($requested_servicesarr as $x){
          
           $insertservice = DB::table('requested_services')
               ->insert([
                   'requestid' => $id,
                   'serviceid' => $x,
                   
               ]);
       }
        session()->flash('success',1);
        return redirect('/clinic/services_requests/edit/'.$id);
    }
    public function purchase(){
        return view("clinic.purchase");
    }
     public function patients_show($id){
        $gender = array("Male","Female");
        $Marital = array("Single","Married");
        $patient = DB::table('patients')->find($id);
         $medical_histories = DB::table('medical_histories')
             ->where('patientid','=',$id)
             ->get();
        if($patient != null){
            return view('clinic.patients_show')->with('patient',$patient)->with('gender',$gender)->with('Marital',$Marital)
                ->with('medical_histories',$medical_histories);
        }
    }
    public function patients_add_medical_history_show($id){
        return view("clinic.add_medical_history")->with('id',$id);
    }
    public function patients_add_medical_history_store(Request $request,$id){
        $this->validate($request,[
            
            'field_1' => 'required|numeric|in:0,1',
            'field_2' => 'required|numeric|in:0,1',
            'field_3' => 'required|numeric|in:0,1',
            'field_4' => 'required|numeric|in:0,1',
            'field_5' => 'required|numeric|in:0,1',
            'field_6' => 'required|numeric|in:0,1',
            'field_7' => 'required|numeric|in:0,1',
            'field_8' => 'required|numeric|in:0,1',
            'field_9' => 'required|numeric|in:0,1',
            'field_10' => 'required|numeric|in:0,1',
            'field_11' => 'required|numeric|in:0,1',
            'field_12' => 'required|numeric|in:0,1',
            'field_13' => 'required|numeric|in:0,1',
            'field_14' => 'required|numeric|in:0,1',
            
        ]);
        $medical_history_id = DB::table('medical_histories')
            ->insertGetId([
             'patientid' => $id,    
             'field1' =>   $request->input('field_1'),
             'field2' =>   $request->input('field_2'),
             'field3' =>   $request->input('field_3'),
             'field4' =>   $request->input('field_4'),
             'field5' =>   $request->input('field_5'),
             'field6' =>   $request->input('field_6'),
             'field7' =>   $request->input('field_7'),
             'field8' =>   $request->input('field_8'),
             'field9' =>   $request->input('field_9'),
             'field10' =>  $request->input('field_10'),
             'field11' =>  $request->input('field_11'),
             'field12' =>  $request->input('field_12'),
             'field13' =>  $request->input('field_13'),
             'field14' =>  $request->input('field_14'),
                'created_at' => Carbon::now(),
        ]);
              
       if(count($request->input('appropriate_boxs')) > 0){
           foreach($request->input('appropriate_boxs') as $x){
            $inserts = DB::table('appropriate_boxs_medhistories')
                ->insert([
                    
                    'medhistid' =>$medical_history_id,
                    'appropriate_box_id' => $x,
                ]);
        } 
       }
       
        return view('clinic.add_medical_history')->with('inserted',1)->with('id',$id);
            
        
        
    }
    public function patients_medical_history_show($id,$id2){
        $medical_history = DB::table('medical_histories')
            ->where('id','=',$id2,'and','patientid','=',$id)
            ->get();
        
       $appropriate_boxs = DB::table('appropriate_boxs_medhistories')
           ->where('medhistid','=',$id2)
           ->get();
       $appropriate_boxs_txts = array('Rheumatic Fever','Heart Diseases','Blood Pressure','Epilepsy','Tubereculosis','Kidney Trouble','Diabetes','Jaundice','Hepatites','Cancer','Arthrites','Veneral Disease','Other');
        return view('clinic.medical_history_show')->with('medical_history',$medical_history)->with('appropriate_boxs',$appropriate_boxs)->with('appropriate_boxs_txts',$appropriate_boxs_txts);
    }
    public function patients_add_tooth_record_show($id){
        return view('clinic.add_tooth_record')->with('id',$id);
    }
    public function  patients_add_tooth_record_store(Request $request,$id){
        $this->validate($request,[
            
            'date' =>'required',
            'tooth_or_area' =>'required',
            'diagnosis' =>'required',
            'treatment_plant' =>'required',
            'fee' =>'required',
        ]);
       
        
       $toothtreetmentsid = DB::table('toothtreetments')
           ->insertGetId([
               'patid' =>$id,
               'created_at' =>Carbon::now()
           ]);
       for($i = 0;$i < count($request->input('date'));$i++){
           
           $insert = DB::table('recordstoothtreats')
               ->insert([
                   'treatid' => $toothtreetmentsid,
                   'tooth_treatment_date' => Carbon::parse($request->input('date')[$i])->format('Y-m-d'),
                   'areaortooth' => $request->input('tooth_or_area')[$i],
                   'diagnosis' => $request->input('diagnosis')[$i],
                   'treatmentplant' =>$request->input('treatment_plant')[$i],
                   'fee' => $request->input('fee')[$i],
               ]);
               
       }
        
    }
}
