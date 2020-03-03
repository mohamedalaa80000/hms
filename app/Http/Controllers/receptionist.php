<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;
use Carbon\Carbon;
class receptionist extends Controller
{
    public $receptionist = 2;
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
        $allemployess = DB::table('employees')
            ->where('employees.employeetype','=',$this->receptionist)
            ->get();
        
        return view("receptionist.employees")->with("employees",$allemployess)->with("user_type",$user_type)->with('status',$status)->with('loginfacility',$loginfacility);
    }
    
    public function employees_add(){
        
       
      
                    return view('receptionist.add_employee'); 
        
        
        
    
    }
    public function employees_store(Request $request){
       
        $weeksnum = array( 0, 1, 2 , 3, 4 , 5 , 6 );
        $weeks = array("Saturday","Sunday","Monday","Tuesday","Wednesday","Thursday","Friday");
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
                
               
                
           
       ]); 
            $image = $request->file('employee_image');
            $imageext = $image->getClientOriginalExtension();
            $imageforupload = 'userimage'.time() . rand(110,2540).'.'.$imageext;
            $insertedid = DB::table('employees')
            ->insertGetId([
                'firstname' => $request->input('employee_firstname'),
                'lastname' => $request->input('employee_lastname'),
                'email' => $request->input('employee_email'),
                'password' => Hash::make($request->input('password')),
                'mobile' => $request->input('mobile'),
                'userimage' => $imageforupload,
                'employeetype' => $this->receptionist,
                'status' => $request->input('status'),
                'loginfacility' => $request->input('loginfacility'),
                'notes' => $request->input('notes'),
                
                
            ]);
             $image->move(public_path('uploads'),$imageforupload);
            
           return view("receptionist.add_employee")->with("checkinserted",1);  
       
    }
    public function employees_edit($id){
        $check = DB::table('employees')->find($id);
        if(count($check) >0){
           $user_type = array("Doctor","Nurse","Receptionist","Accountant","X-Ray Employees","Warehouse Employees");
          return view('receptionist.employees_edit_profile')->with('userinfo',$check)->with('id',$id)->with('user_type',$user_type);
        }
    }
    public function employees_edit_store(Request $request,$id){
     
         $this->validate($request,[
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:employees,email,'.$id,
            'mobile' => 'required',
            'userimage' => 'image|mimes:png,jpeg,jpg,PNG,JPEG,JPG',
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
                'employeetype' => $this->receptionist,
                'status' => $request->input('status'),
                'loginfacility' => $request->input('loginfacility'),
                'notes' => $request->input('notes'),
                
                
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
                'employeetype' => $this->receptionist,
                'status' => $request->input('status'),
                'loginfacility' => $request->input('loginfacility'),
                'notes' => $request->input('notes'),
                 
                
            ]);
                   session()->flash('updatedsuc',1);
            
        }
           return redirect("/receptionist/employees/edit/$id"); 
       
    }
    public function patients(){
        
        $patients = DB::table('patients')->get();
        $gender = array("Male","Female");
        $status = array("Inactive","Active","Block");
        return view('receptionist.patients')->with('patients',$patients)->with("gender",$gender)->with("status",$status);
        
    }
    public function patients_add_show(){
        return view('receptionist.add_patient');
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
            return view("receptionist.add_patient")->with("inserted",$insert);
        }
    }
     public function appointments(){
        $appointmentstatus = array("Unconfirmed","Confirmed","Finish","Late Finish","Cancel");
        $appointments = DB::table('appointments')
            ->join('clinics','appointments.clinicid','=','clinics.id')
            ->join('employees','appointments.doctorid','=','employees.id')
            ->join('patients','appointments.patientid','=','patients.id')
            ->select('appointments.id as Appointid','clinics.clinicname','patients.patientname','employees.firstname','employees.lastname','appointments.appointmentdateandtime','appointments.status')
            ->get();
        return view('receptionist.appointments')->with('appointments',$appointments)->with('appointmentstatus',$appointmentstatus);
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
            ->get();
        return view("receptionist.service_requests")->with('getdata',$getdata);
    }
    public function services_add_show(){
       
        $getallpatients = DB::table('patients')
            ->select('patientname as pname','id as pid')
            ->get();
        $getallclinics = DB::table('clinics')
            ->select('clinics.id','clinics.clinicname')
            ->get();
        $getallservices = DB::table('services')
            ->get();
        return view("receptionist.add_service_request")->with('getallpatients',$getallpatients)->with('getallservices',$getallservices)->with('getallclinics',$getallclinics);
    }
    public function service_request_add_getdoctors(Request $request){
        if($request->ajax()){
            $selectalldocotosinclinic = DB::table('clinic__workers')
            ->join('employees','clinic__workers.employeeid','=','employees.id')
            ->select('employees.id as empid','employees.firstname','employees.lastname')
            ->where('clinic__workers.clinicid','=',$request->input('clinic'),'and','employees.employeetype','=',0)
            ->get();
            return response(['doctors' =>$selectalldocotosinclinic ]);
        }
    }
    public function services_add_store(Request $request){
        $this->validate($request,[
            'doctor' => 'required',
            'patient' => 'required',
            'clinic' => 'required'
            
        ]);
       $insertedid = DB::table('services_requests')
           ->insertGetId([
               'clinicid' => $request->input('clinic'),
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
        return redirect('/receptionist/services/add');
    }
    public function service_request_show($id){
        
        $getdata = DB::table('services_requests')
            ->join('employees','services_requests.employeeid','=','employees.id')
            ->join('clinics','services_requests.clinicid','=','clinics.id')
            ->join('patients','services_requests.patientid','patients.id')
            ->select('services_requests.id','employees.firstname','employees.lastname','clinics.clinicname','patients.patientname','patients.uniqueid')
            ->where('services_requests.id','=',$id)
            ->limit(1)
            ->get();
        
         $get2data = DB::table('requested_services')
               ->join('services','requested_services.serviceid','=','services.id')
               ->select('requested_services.serviceid','services.servicename','services.serviceprice')
               ->where('requested_services.requestid','=',$getdata[0]->id)
               ->get();
       return view('receptionist.service_request_show')->with('getdata',$getdata)->with('get2data',$get2data);
        
            
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
            ->where('services_requests.id','=',$id)
            ->limit(1)
            ->get();
        
            $get2data = DB::table('requested_services')
               ->join('services','requested_services.serviceid','=','services.id')
               ->select('requested_services.serviceid','services.servicename','services.serviceprice')
               ->where('requested_services.requestid','=',$getdata[0]->id)
               ->get();
       return view('receptionist.edit_service_request')->with('getdata',$getdata)->with('get2data',$get2data)->with('selectalldocotosinclinic',$selectalldocotosinclinic)->with('getallpatients',$getallpatients)->with('getallservices',$getallservices)->with('id',$id);
        
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
        return redirect('/receptionist/services_requests/edit/'.$id);
    }
    public function purchase(){
        return view("clinic.purchase");
    }
    
    
    
}
