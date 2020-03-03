<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;    

class xray extends Controller
{
    
     public $xray = 4;
     public function employees(){  
        // Show Employees
         $users = DB::table('employees')
             ->where('employeetype','=',$this->xray)
             ->get();
         $user_type = array("Doctor","Nurse","Receptionist","Accountant","X-Ray Employees","Warehouse Employees");
         $status = array("Not Approved","Approved");
         $loginfacility = array("No","Yes");
        return view('xray.employees')->with("employees",$users)->with('user_type',$user_type)->with("status",$status)->with("loginfacility",$loginfacility);
    }
    public function employees_show(){
        return view('xray.add_employee');
    }
    public function employees_store(Request $request){
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
                'employeetype' => $this->xray,
                'status' => $request->input('status'),
                'loginfacility' => $request->input('loginfacility'),
                'notes' => $request->input('notes'),
                
                
            ]);
             $image->move(public_path('uploads'),$imageforupload);
            
           return view("xray.add_employee")->with("checkinserted",1);  
    }
    public function patients(){
        
        $patients = DB::table('patients')->get();
        $gender = array("Male","Female");
        $status = array("Inactive","Active","Block");
        return view('xray.patients')->with('patients',$patients)->with("gender",$gender)->with("status",$status);
        
    }
    public function patients_show($id){
        $gender = array("Male","Female");
        $Marital = array("Single","Married");
        $patient = DB::table('patients')->find($id);
        if($patient != null){
            return view('xray.patients_show')->with('patient',$patient)->with('gender',$gender)->with('Marital',$Marital);
        }
    }
      public function services(){
        $getdata = DB::table('services_requests')
            ->join('clinics','services_requests.clinicid','=','clinics.id')
            ->join('employees','services_requests.employeeid','=','employees.id')
            ->join('patients','services_requests.patientid','=','patients.id')
            ->select('services_requests.id as serid','clinics.clinicname as cname','employees.firstname as fir','employees.lastname as las','patients.phone','patients.patientname','services_requests.created_at as created')
            ->get();
        return view("xray.service_requests")->with('getdata',$getdata);
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
       return view('xray.service_request_show')->with('getdata',$getdata)->with('get2data',$get2data);
        
            
    }
}
