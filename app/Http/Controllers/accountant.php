<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;
class accountant extends Controller
{
    
    public $accountant = 3;
    public function employees(){
        $allemployees = DB::table('employees')
            ->where('employeetype','=',$this->accountant)
            ->get();
        $user_type = array("Doctor","Nurse","Receptionist","Accountant","X-Ray Employees","Warehouse Employees");
        $loginfacility = array("No","Yes");
        $status = array("Inactive","Active","Block");
        return view('accountant.employees')->with('employees',$allemployees)->with('user_type',$user_type)->with('status',$status)->with('loginfacility',$loginfacility);
    }
    public function employees_add_show(){
        
        
         return view('accountant.add_employee'); 
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
                'employeetype' => $this->accountant,
                'status' => $request->input('status'),
                'loginfacility' => $request->input('loginfacility'),
                'notes' => $request->input('notes'),
                
                
            ]);
             $image->move(public_path('uploads'),$imageforupload);
            
           return view("accountant.add_employee")->with("checkinserted",1);  
       
    }
    
     public function services(){  
         $servicesinfo = DB::table('services')->get();
         return view('accountant.service')->with('servicesinfo',$servicesinfo);
    }
    public function services_add_show(){
        
         return view('accountant.add_service');
    }
    public function services_add(Request $request){
         $this->validate($request,[
            
            'service_name' =>'required',
            'service_price' =>'required',
        ]);
         $insert = DB::table('services')
             ->insert([
                 
                 'servicename' => $request->input('service_name'),
                 'serviceprice' => $request->input('service_price'),
             ]);
         
         return view('accountant.add_service')->with('inserted',$insert);
    }
    public function services_edit_show($id){
         $serviceinfo = DB::table('services')->find($id);
        if($serviceinfo != null){
           return view("accountant.service_edit")->with('serviceinfo',$serviceinfo); 
        }
    }
    public function services_edit(Request $request,$id){
         $this->validate($request,[
            
            'service_name' =>'required',
            'service_price' =>'required',
        ]);
        $checkfound = DB::table('services')->find($id);
        if($checkfound != null){
            
             $updated = DB::table('services')
             ->where('id',$id)
             ->update([
                 
                 'servicename' => $request->input('service_name'),
                 'serviceprice' => $request->input('service_price'),
             ]);
       
            session()->flash("updated",1);
        
        }
       
        return redirect("/accountant/services/edit/$id");
    }
    public function expenses_show(){
         $servicesinfo = DB::table('expenses')->get();
         return view('accountant.expenses')->with('servicesinfo',$servicesinfo);
    }
    public function expenses_edit_show($id){
         $serviceinfo = DB::table('expenses')->find($id);
        if($serviceinfo != null){
           return view("accountant.expense_edit")->with('serviceinfo',$serviceinfo); 
        }
    }
    public function expenses_edit(Request $request,$id){
        $this->validate($request,[
            
            'expense_name' =>'required',
            'expense_price' =>'required',
        ]);
        $checkfound = DB::table('services')->find($id);
        if($checkfound != null){
            
             $updated = DB::table('expenses')
             ->where('id',$id)
             ->update([
                 
                 'expensename' => $request->input('expense_name'),
                 'expenseprice' => $request->input('expense_price'),
             ]);
       
            session()->flash("updated",1);
        
        }
       
        return redirect("/accountant/expenses/edit/$id");
    }
    public function expenses_add_show(){
        return view('accountant.add_expense');
    }
    public function expenses_add(Request $request){
         $this->validate($request,[
            
            'expense_name' =>'required',
            'expense_price' =>'required',
        ]);
         $insert = DB::table('expenses')
             ->insert([
                 
                 'expensename' => $request->input('expense_name'),
                 'expenseprice' => $request->input('expense_price'),
             ]);
         
         return view('accountant.add_expense')->with('inserted',$insert);
    }
    public function service_requests(){
         $getdata = DB::table('services_requests')
            ->join('clinics','services_requests.clinicid','=','clinics.id')
            ->join('employees','services_requests.employeeid','=','employees.id')
            ->join('patients','services_requests.patientid','=','patients.id')
            ->select('services_requests.id as serid','clinics.clinicname as cname','employees.firstname as fir','employees.lastname as las','patients.phone','patients.patientname','services_requests.created_at as created')
            ->get();
        return view("accountant.service_requests")->with('getdata',$getdata);
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
       return view('accountant.service_request_show')->with('getdata',$getdata)->with('get2data',$get2data);
        
    }
     
}

