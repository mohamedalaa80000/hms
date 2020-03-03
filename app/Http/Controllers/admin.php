<?php

namespace App\Http\Controllers;
use App\Employees;
use Illuminate\Http\Request;
use Illuminate\HttpResponse;
use Hash;
use DB;
use Carbon\Carbon;
class admin extends Controller
{
    public function dashboard(){
        
        
        $countservices = DB::table('services')->count();
        $countproducts = DB::table('products')->count();
        $countemployees = DB::table('employees')->count();
        
        return view('admin.dashboard')->with('countservices',$countservices)->with('countproducts',$countproducts)->with('countemployees',$countemployees);
    }
    public function employees(){  
        // Show Employees
         $users = DB::table('employees')->get();
         $user_type = array("Doctor","Nurse","Receptionist","Accountant","X-Ray Employees","Warehouse Employees");
         $status = array("Not Approved","Approved");
         $loginfacility = array("No","Yes");
        return view('admin.employees')->with("employees",$users)->with('user_type',$user_type)->with("status",$status)->with("loginfacility",$loginfacility);
    }
    public function employees_add(){   
        return view('admin.add_employee');
    }
    public function employees_type_ref(Request $request){
        if($request->ajax()){
            $this->validate($request,[
                'emptype' =>'required'
                
            ]);
            if($request->input('emptype') == 0){
                //then will return all clinics
                $clinics = DB::table('clinics')->get();
                return response(['clinics' => $clinics,"doctor" => 'true']);
            }
            if($request->input('emptype') == 1){
                 //then will return all clinics
                $clinics = DB::table('clinics')->get();
                return response(['clinics' => $clinics]);
            }
            
            
        }
    }
    public function employees_store(Request $request){   
        if($request->has('clinic') && !$request->has('salary')){
                  $interval = DB::table('clinics')->get();
            $clinicallowedids = array();
            foreach($interval as $id){
                $clinicallowedids [] = $id->id;
            }
            $stringidsclinics = implode(',',$clinicallowedids);
            $findsingleormulti = DB::table('clinics')->find($request->input('clinic'));
            if($findsingleormulti != null){
            if($findsingleormulti->singleormulti == 1){
                $allowedday = $findsingleormulti->onlyday;
               $this->validate($request,[
           
           'firstname'=>'required',
           'lastname'=>'required',
           'email'=>'required|email|unique:employees',
           'password'=>'required',
           'mobile'=>'required',
           'userimage'=>'required|image|mimes:png,jpeg,jpg,PNG,JPEG,JPG',
           'employeetype'=>'required|in:0,1,2,3,4,5',
           'status'=>'required|in:0,1',
           'loginfacility'=>'required|in:0,1',
           'notes'=>'required',
           'repassword'=>'required|same:password',
           'clinic'=>'required|in:'.$stringidsclinics,
           'day_work'=>'required|numeric|in:'.$allowedday,
       ]); 
                 $image = $request->file('userimage');
        $imagename = $image->getClientOriginalName();
        $imageext = $image->getClientOriginalExtension();
        $imagepathtoupload = "userimage_" . time() . rand(1,1000) . "." . $imageext;
        $insertedid = DB::table('employees')->insertGetId([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'mobile' => $request->input('mobile'),
            'userimage' => $imagepathtoupload,
            'employeetype' => $request->input('employeetype'),
            'status' => $request->input('status'),
            'loginfacility' => $request->input('loginfacility'),
            'notes' => $request->input('notes'),
            
    
    ]);
            
        $image->move(public_path('uploads'),$imagepathtoupload);
            $in = DB::table('clinic__workers')->insert([
                'employeeid' => $insertedid,
                'clinicid' => $request->input('clinic') ,
                'onlyday' => $request->input('day_work') ,
                'singleormulti' => 1 ,
                
            ]);
        return view("admin.add_employee")->with("checkinserted",1);
            }
            if($findsingleormulti->singleormulti == 0){
               $workstartintervalall =  $findsingleormulti->workstart;
               $workendintervalall =  $findsingleormulti->workend;
               $weeks = array( 0, 1, 2 , 3, 4 , 5 , 6 );
               $startidsarray = array();
               $endidsarray = array();
                for($in = $workstartintervalall ; $in < count($weeks) ;$in++){
                    $startidsarray [] = $weeks[$in];
                }
                for($in = $workendintervalall ; $in < count($weeks) ;$in++){
                    $endidsarray [] = $weeks[$in];
                }
               $stringstartids = implode(',',$startidsarray); 
               $stringendids = implode(',',$endidsarray); 
               $this->validate($request,[
           
           'firstname'=>'required',
           'lastname'=>'required',
           'email'=>'required|email|unique:employees',
           'password'=>'required',
           'mobile'=>'required',
           'userimage'=>'required|image|mimes:png,jpeg,jpg,PNG,JPEG,JPG',
           'employeetype'=>'required|in:0,1,2,3,4,5',
           'status'=>'required|in:0,1',
           'loginfacility'=>'required|in:0,1',
           'notes'=>'required',
           'repassword'=>'required|same:password',
           'clinic'=>'required|in:'.$stringidsclinics,
           'work_start'=>'required|numeric|in:'.$stringstartids,
            'work_end'=>'required|numeric|in:'.$stringendids,
                   
       ]); 
                 $image = $request->file('userimage');
        $imagename = $image->getClientOriginalName();
        $imageext = $image->getClientOriginalExtension();
        $imagepathtoupload = "userimage_" . time() . rand(1,1000) . "." . $imageext;
        $insertedid = DB::table('employees')->insertGetId([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'mobile' => $request->input('mobile'),
            'userimage' => $imagepathtoupload,
            'employeetype' => $request->input('employeetype'),
            'status' => $request->input('status'),
            'loginfacility' => $request->input('loginfacility'),
            'notes' => $request->input('notes'),
            
    
    ]);
            
        $image->move(public_path('uploads'),$imagepathtoupload);
            $in = DB::table('clinic__workers')->insert([
                'employeeid' => $insertedid,
                'clinicid' => $request->input('clinic') ,
                'workstart' => $request->input('work_start') ,
                'workend' => $request->input('work_end') ,
                'singleormulti' => 0 ,
                
            ]);
        return view("admin.add_employee")->with("checkinserted",1); 
            }
            }
        }
        if($request->has('clinic') && $request->has('salary')){
            $interval = DB::table('clinics')->get();
            $clinicallowedids = array();
            foreach($interval as $id){
                $clinicallowedids [] = $id->id;
            }
            $stringidsclinics = implode(',',$clinicallowedids);
            $findsingleormulti = DB::table('clinics')->find($request->input('clinic'));
          if($findsingleormulti != null){
                if($findsingleormulti->singleormulti == 1){
                $allowedday = $findsingleormulti->onlyday;
               $this->validate($request,[
           
           'firstname'=>'required',
           'lastname'=>'required',
           'email'=>'required|email|unique:employees',
           'password'=>'required',
           'mobile'=>'required',
           'userimage'=>'required|image|mimes:png,jpeg,jpg,PNG,JPEG,JPG',
           'employeetype'=>'required|in:0,1,2,3,4,5',
           'status'=>'required|in:0,1',
           'loginfacility'=>'required|in:0,1',
           'notes'=>'required',
           'repassword'=>'required|same:password',
           'clinic'=>'required|in:'.$stringidsclinics,
           'day_work'=>'required|numeric|in:'.$allowedday,
       ]); 
                 $image = $request->file('userimage');
        $imagename = $image->getClientOriginalName();
        $imageext = $image->getClientOriginalExtension();
        $imagepathtoupload = "userimage_" . time() . rand(1,1000) . "." . $imageext;
        $insertedid = DB::table('employees')->insertGetId([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'mobile' => $request->input('mobile'),
            'userimage' => $imagepathtoupload,
            'employeetype' => $request->input('employeetype'),
            'status' => $request->input('status'),
            'loginfacility' => $request->input('loginfacility'),
            'notes' => $request->input('notes'),
            
    
    ]);
            
        $image->move(public_path('uploads'),$imagepathtoupload);
            $in = DB::table('clinic__workers')->insert([
                'employeeid' => $insertedid,
                'clinicid' => $request->input('clinic') ,
                'onlyday' => $request->input('day_work') ,
                'singleormulti' => 1 ,
                
            ]);
        return view("admin.add_employee")->with("checkinserted",1);
            }
            if($findsingleormulti->singleormulti == 0){
               $workstartintervalall =  $findsingleormulti->workstart;
               $workendintervalall =  $findsingleormulti->workend;
               $weeks = array( 0, 1, 2 , 3, 4 , 5 , 6 );
               $startidsarray = array();
               $endidsarray = array();
                for($in = $workstartintervalall ; $in < count($weeks) ;$in++){
                    $startidsarray [] = $weeks[$in];
                }
                for($in = $workendintervalall ; $in < count($weeks) ;$in++){
                    $endidsarray [] = $weeks[$in];
                }
               $stringstartids = implode(',',$startidsarray); 
               $stringendids = implode(',',$endidsarray); 
               $this->validate($request,[
           
           'firstname'=>'required',
           'lastname'=>'required',
           'email'=>'required|email|unique:employees',
           'password'=>'required',
           'mobile'=>'required',
           'userimage'=>'required|image|mimes:png,jpeg,jpg,PNG,JPEG,JPG',
           'employeetype'=>'required|in:0,1,2,3,4,5',
           'status'=>'required|in:0,1',
           'loginfacility'=>'required|in:0,1',
           'notes'=>'required',
           'repassword'=>'required|same:password',
           'clinic'=>'required|in:'.$stringidsclinics,
           'work_start'=>'required|numeric|in:'.$stringstartids,
            'work_end'=>'required|numeric|in:'.$stringendids,
                   
       ]); 
                 $image = $request->file('userimage');
        $imagename = $image->getClientOriginalName();
        $imageext = $image->getClientOriginalExtension();
        $imagepathtoupload = "userimage_" . time() . rand(1,1000) . "." . $imageext;
        $insertedid = DB::table('employees')->insertGetId([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'mobile' => $request->input('mobile'),
            'userimage' => $imagepathtoupload,
            'employeetype' => $request->input('employeetype'),
            'status' => $request->input('status'),
            'loginfacility' => $request->input('loginfacility'),
            'notes' => $request->input('notes'),
            
    
    ]);
            
        $image->move(public_path('uploads'),$imagepathtoupload);
            $in = DB::table('clinic__workers')->insert([
                'employeeid' => $insertedid,
                'clinicid' => $request->input('clinic') ,
                'workstart' => $request->input('work_start') ,
                'workend' => $request->input('work_end') ,
                'singleormulti' => 0 ,
                
            ]);
        return view("admin.add_employee")->with("checkinserted",1); 
            }
          }
            
            
        }
        if(!$request->has('clinic') && !$request->has('salary')){
             $this->validate($request,[
           
           'firstname'=>'required',
           'lastname'=>'required',
           'email'=>'required|email|unique:employees',
           'password'=>'required',
           'mobile'=>'required',
           'userimage'=>'required|image|mimes:png,jpeg,jpg,PNG,JPEG,JPG',
           'employeetype'=>'required|in:0,1,2,3,4,5',
           'status'=>'required|in:0,1',
           'loginfacility'=>'required|in:0,1',
           'notes'=>'required',
           'repassword'=>'required|same:password',
       ]);
             $image = $request->file('userimage');
        $imagename = $image->getClientOriginalName();
        $imageext = $image->getClientOriginalExtension();
        $imagepathtoupload = "userimage_" . time() . rand(1,1000) . "." . $imageext;
        $insertedid = DB::table('employees')->insertGetId([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'mobile' => $request->input('mobile'),
            'userimage' => $imagepathtoupload,
            'employeetype' => $request->input('employeetype'),
            'status' => $request->input('status'),
            'loginfacility' => $request->input('loginfacility'),
            'notes' => $request->input('notes'),
            
    
    ]);
            
        $image->move(public_path('uploads'),$imagepathtoupload);
            
        return view("admin.add_employee")->with("checkinserted",1);
        }
      
       
    }
    public function employees_change_password_view($id){
        return view("admin.employees_change_password")->with("id",$id);
    }
    public function employees_change_password($id,Request $request){
       $this->validate($request,[
           'password'=>'required',
           'repassword'=>'required|same:password',
           
       ]);
        $info =  DB::table('employees')->find($id);
        if($info != null){
            $updatedsuc = DB::table('employees')
                ->where("id",$info->id)
                ->update([
                    'password'=>Hash::make($request->input('password'))
                ]);
        }
        else{
            $updatedsuc = 0;
        }
        return view("admin.employees_change_password")->with("updatedsuc",$updatedsuc)->with("id",$id);
    }
    public function employees_edit_profile_view($id){
        $userinfo = DB::table('employees')->find($id);
        if($userinfo != null){
             return view("admin.employees_edit_profile")->with("userinfo",$userinfo)->with("id",$id);
        }
       
    }
    public function employees_edit_profile($id,Request $request){
        $this->validate($request,[
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:employees,email,'.$id,
            'mobile' => 'required',
            'userimage' => 'image|mimes:png,jpeg,jpg,PNG,JPEG,JPG',
            'employeetype'=>'required|in:0,1,2,3,4,5',
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
                'employeetype' => $request->input('employeetype'),
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
                'employeetype' => $request->input('employeetype'),
                'status' => $request->input('status'),
                'loginfacility' => $request->input('loginfacility'),
                'notes' => $request->input('notes'),
                
            ]);
                   session()->flash('updatedsuc',1);
            
        }
     return redirect("/admin/employees/edit/$id");
    }
    public function employees_remove(Request $request){
        if($request->ajax()){
            $check = DB::table('employees')->find($request->input('empid'));
            if($check != null){
                $remove = DB::table('employees')
                    ->where('id','=',$request->input('empid'))
                    ->delete();
              return response(['removed' => 'true']);  
            }
            
        }
    }
    
    public function clinics(){   
        
        $clinics = DB::table('clinics')->get();
        return view('admin.clinics')->with('clinics',$clinics);
    }
    public function clinics_add(){   
        return view('admin.add_clinic');
    }
    public function clinics_store(Request $request){   
       if($request->has('signle_or_multi')){
           $this->validate($request,[
            'signle_or_multi' => 'required|in:0,1',
            'clinic_name' => 'required'  
            
        ]);
           if($request->input('signle_or_multi') == 0){
               $this->validate($request,[
                   'work_start' => 'required|in:0,1,2,3,4,5,6',
                   'work_end' => 'required|in:0,1,2,3,4,5,6'
                   
               ]);
                $insert = DB::table('clinics')->insert([
                   
                   'clinicname' => $request->input('clinic_name'),
                   'workstart' => $request->input('work_start'),
                    'workend' => $request->input('work_end'),
                   'singleormulti' => $request->input('signle_or_multi')
               ]);
               if($insert != null){
                   return view('admin.add_clinic')->with('inserted',$insert);
               }
           }
           if($request->input('signle_or_multi') == 1){
               $this->validate($request,[
                   'day_work' => 'required|in:0,1,2,3,4,5,6'
                   
               ]);
               $insert = DB::table('clinics')->insert([
                   
                   'clinicname' => $request->input('clinic_name'),
                   'onlyday' => $request->input('day_work'),
                   'singleormulti' => $request->input('signle_or_multi')
               ]);
               if($insert != null){
                   return view('admin.add_clinic')->with('inserted',$insert);
               }
           }
       }
        
        
        
      
        //return view('admin.add_clinic')->with('inserted',$insert);
    }
    public function clinics_edit_view($id){
        $singleormultiarray = array(0 =>"No" , 1 => "Yes");
        $weeks = array(0 => "Saturday",1 => "Sunday",2 => "Monday",3 => "Tuesday",4 => "Wednesday",5 => "Thursday",6 =>"Friday");
        $clinicinfo = DB::table('clinics')->find($id);
        if($clinicinfo != null){
            return view('admin.clinics_edit')->with('clinicinfo',$clinicinfo)->with("singleormultiarray",$singleormultiarray)->with("weeks",$weeks);
        }
        
    }
    public function employees_get_clinic_times(Request $request){
        if($request->ajax()){
            $weeks = array(0 => "Saturday",1 => "Sunday",2 => "Monday",3 => "Tuesday",4 => "Wednesday",5 => "Thursday",6 =>"Friday");
            $times = DB::table('clinics')->find($request->input('clinic'));
            return response(['times' => $times,"weeks" => $weeks]);
        }
    }
    public function clinics_edit($id,Request $request){
 if($request->has('signle_or_multi')){
           $this->validate($request,[
            'signle_or_multi' => 'required|in:0,1',
            'clinic_name' => 'required'  
            
        ]);
           if($request->input('signle_or_multi') == 0){
               $this->validate($request,[
                   'work_start' => 'required|in:0,1,2,3,4,5,6',
                   'work_end' => 'required|in:0,1,2,3,4,5,6'
                   
               ]);
                $updated = DB::table('clinics')
                    ->where('id',$id)
                    ->update([
                   
                   'clinicname' => $request->input('clinic_name'),
                   'workstart' => $request->input('work_start'),
                    'workend' => $request->input('work_end'),
                   'singleormulti' => $request->input('signle_or_multi')
               ]);
              
           }
           if($request->input('signle_or_multi') == 1){
               $this->validate($request,[
                   'day_work' => 'required|in:0,1,2,3,4,5,6'
                   
               ]);
               $updated = DB::table('clinics')
                   ->where('id',$id)
                   ->update([
                   
                   'clinicname' => $request->input('clinic_name'),
                   'onlyday' => $request->input('day_work'),
                   'singleormulti' => $request->input('signle_or_multi')
               ]);
               
           }
       session()->flash("updated",1);
        return redirect("/admin/clinics/edit/$id");
       }
       
    }
    public function clinics_remove(Request $request){
        if($request->ajax()){
            $check = DB::table('clinics')->find($request->input('clinicid'));
            if($check != null){
                $remove = DB::table('clinics')
                    ->where('id',$request->input('clinicid'))
                    ->delete();
                return response([ 'removed' => "true"]);
            }
        }
    }
    public function services(){  
         $servicesinfo = DB::table('services')->get();
         return view('admin.service')->with('servicesinfo',$servicesinfo);
    }
    public function services_add_show(){   
        return view('admin.add_service');
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
         
         return view('admin.add_service')->with('inserted',$insert);
    }
    public function services_edit_show($id){
        $serviceinfo = DB::table('services')->find($id);
        if($serviceinfo != null){
           return view("admin.service_edit")->with('serviceinfo',$serviceinfo); 
        }
    }
    public function services_edit($id,Request $request){
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
       
        return redirect("/admin/services/edit/$id");
        
    }
    public function stock_providers(){  
        $providersinfo = DB::table('providers')->get();
        return view('admin.products.stock_providers')->with('providersinfo',$providersinfo);
    }
    public function add_provider_show(){   
        return view('admin.products.add_provider');
    }
    public function add_provider(Request $request){
         
         $this->validate($request,[
             
             'provider_name' => 'required',
         ]);
         $insert = DB::table('providers')->insert([
             'providername' => $request->input('provider_name'),
             
         ]);
        return view('admin.products.add_provider')->with('inserted',$insert);
    }
    public function edit_provider_show($id){
        $check = DB::table('providers')->find($id);
        if($check != null){
            return view("admin.products.edit_provider")->with('providerinfo',$check);
        }
    }
    public function edit_provider($id,Request $request){
        $this->validate($request,[
             
             'provider_name' => 'required',
         ]);
        $check = DB::table('providers')->find($id);
        if($check != null){
             $updated = DB::table('providers')
                 ->where('id',$id)
                 ->update([
             'providername' => $request->input('provider_name'),
             
         ]);
            session()->flash("updated",1);
            return redirect("/admin/products/stock_providers/edit/$id");
        }
        
    }
    public function products(){  
        $productsinfo = DB::table('products')->get();
        return view('admin.products.products')->with('productsinfo',$productsinfo);
    }
    public function products_add_show(){   
        return view('admin.products.add_product');
    }
    public function products_add(Request $request){
        
        $this->validate($request,[
            
            'product_name' => 'required',
            'product_barcode' => 'required|unique:products,productbarcode',
        ]);
        
        $insert = DB::table('products')->insert([
            'productname' => $request->input('product_name'),
            'productbarcode' => $request->input('product_barcode'),
            
        ]);
        if($insert != null){
            return view("admin.products.add_product")->with("inserted",$insert);
        }
        
    }
    public function products_edit_show($id){
        $check = DB::table('products')->find($id);
        if($check != null){
            return view("admin.products.edit_product")->with("check",$check);
        }
    }
    public function products_edit($id,Request $request){
       
        $this->validate($request,[
            'product_name' => 'required',
            'product_barcode' => 'required|unique:products,productbarcode,'.$id,
            
        ]);
        $check = DB::table('products')->find($id);
        if($check != null){
           $update  = DB::table('products')->where('id',$id)
               ->update([
                   'productname' => $request->input('product_name'),
                   'productbarcode' => $request->input('product_barcode'),
               ]);
           
                session()->flash("updated",1);
                return redirect("/admin/products/products/edit/$id");
            
        }
        
    }
    public function product_remove(Request $request){
         if($request->ajax()){
            $check = DB::table('products')->find($request->input('productid'));
            if($check != null){
                $remove = DB::table('products')
                    ->where('id',$request->input('productid'))
                    ->delete();
                return response([ 'removed' => "true"]);
            }
        }
    }
    public function stock_purchase_entries(){   
        $stockinfos = DB::table('stock__purchases')
            ->join('products','stock__purchases.productid','=','products.id')
            ->join('providers','stock__purchases.providerid','=','providers.id')
            ->select('stock__purchases.id as stockid','stock__purchases.price','stock__purchases.qty','stock__purchases.total','stock__purchases.created_at as created','products.*','providers.*')
            ->get();
        return view('admin.products.stock_purchase_entries')->with('stockinfos',$stockinfos);
    }
    public function add_stock_show(){ 
        $productsinfo = DB::table('products')->get();
        $providers = DB::table('providers')->get();
        return view('admin.products.add_stock')->with('products',$productsinfo)->with('providers',$providers);
    }
    public function add_stock(Request $request){
        $productsinfo = DB::table('products')->get();
        $productsids = array();
        foreach($productsinfo as $p){
            $productsids []= $p->id;
        }
        $productsids2 = implode(",",$productsids);
        $providers = DB::table('providers')->get();
        $providersids = array();
        foreach($providers as $p){
            $providersids []= $p->id;
        }
        $providersids2 = implode(",",$providersids);
        $this->validate($request,[
            
            'product' =>'required|in:'.$productsids2,
            'price' =>'required|numeric',
            'Qty' =>'required|numeric',
            'provider' =>'required|in:'.$providersids2,
        ]);
        
        $insert = DB::table('stock__purchases')->insert([
            
            'productid' => $request->input('product'),
            'providerid' => $request->input('provider'),
            'qty' => $request->input('Qty'),
            'price' => $request->input('price') ,
            'total' => $request->input('Qty') * $request->input('price'),
            'created_at' => Carbon::now(),
        ]);
        if($insert != null){
            return view('admin.products.add_stock')->with("inserted",$insert)->with('products',$productsinfo)->with('providers',$providers);
        }
        
        
    }
    
    public function edit_stock_show($id){
        $check = DB::table('stock__purchases')->find($id);
        $productsinfo =DB::table('products')->get(); 
        $providersinfo =DB::table('providers')->get(); 
        if($check != null){
            return view("admin.products.edit_stock")->with("stockinfo",$check)->with('products',$productsinfo)->with('providers',$providersinfo);
        }
    }
    public function edit_stock($id,Request $request){
        $check = DB::table('stock__purchases')->find($id);
        if($check != null){
               $productsinfo = DB::table('products')->get();
        $productsids = array();
        foreach($productsinfo as $p){
            $productsids []= $p->id;
        }
        $productsids2 = implode(",",$productsids);
        $providers = DB::table('providers')->get();
        $providersids = array();
        foreach($providers as $p){
            $providersids []= $p->id;
        }
        $providersids2 = implode(",",$providersids);
        $this->validate($request,[
            
            'product' =>'required|in:'.$productsids2,
            'price' =>'required|numeric',
            'Qty' =>'required|numeric',
            'provider' =>'required|in:'.$providersids2,
        ]);
        
        $update = DB::table('stock__purchases')
            ->where('id',$id)
            ->update([
            
            'productid' => $request->input('product'),
            'providerid' => $request->input('provider'),
            'qty' => $request->input('Qty'),
            'price' => $request->input('price') ,
            'total' => $request->input('Qty') * $request->input('price'),
            'updated_at' => Carbon::now(),
        ]);
            if($update != null){
                session()->flash('updated',$update);
                return redirect("/admin/products/stock_purchase_entries/edit/$id");
            }
            
        }
    }
    public function stockp_remove(Request $request){
          if($request->ajax()){
            $check = DB::table('stock__purchases')->find($request->input('stockid'));
            if($check != null){
                $remove = DB::table('stock__purchases')
                    ->where('id',$request->input('stockid'))
                    ->delete();
                return response([ 'removed' => "true"]);
            }
        }
    }
    public function stock_sell_entries(){  
        $stocksell = DB::table('stock__sells')
            ->join('products','stock__sells.productid','=','products.id')
            ->join('clinics','stock__sells.clinicid','=','clinics.id')
            ->select('stock__sells.id as stockid','stock__sells.created_at as created','stock__sells.price','stock__sells.qty','stock__sells.total','products.*','clinics.*')
            ->get();
        
        return view('admin.products.stock_sell_entries')->with('stocksell',$stocksell);
    }
    public function add_sell_show(){
         $products = DB::table('products')->get();
         $clinics = DB::table('clinics')->get();
        return view('admin.products.add_sell')->with('products',$products)->with('clinics',$clinics);
    }
    public function add_sell(Request $request){
         $products = DB::table('products')->get();
         $clinics = DB::table('clinics')->get();
         $productsids = array();
         foreach($products as $proid){
             $productsids [] = $proid->id;
         }
         $productsids2 = implode(",",$productsids);
         $clinicsids = array();
         foreach($clinics as $clinic){
             $clinicsids [] = $clinic->id;
         }
         $clinicsids2 = implode(",",$clinicsids);
         $this->validate($request,[
             'product' => 'required|in:'.$productsids2,
             'price' => 'required|numeric',
             'Qty' => 'required|numeric',
             'clinic' => 'required|in:'.$clinicsids2,
             
         ]);
        $insert = DB::table('stock__sells')
            ->insert([
                
                'productid' => $request->input('product'),
                'clinicid' => $request->input('clinic'),
                'price' => $request->input('price'),
                'qty' => $request->input('Qty'),
                'total' => $request->input('Qty') * $request->input('price'),
                'created_at' => Carbon::now(),
            ]);
        if($insert != null){
            return view("admin.products.add_sell")->with('products',$products)->with('clinics',$clinics)->with('inserted',$insert);
        }
        
    
    }
    public function edit_sell_show($id){
        $products = DB::table('products')->get();
        $clinics = DB::table('clinics')->get();
        $check = DB::table('stock__sells')->find($id);
        if($check != null){
            return view("admin.products.edit_stock_sell")->with('stockinfo',$check)->with('products',$products)->with('clinics',$clinics);
        }
        
    }
    public function edit_sell($id,Request $request){
     $check = DB::table('stock__sells')->find($id); 
        if($check != null){
             $products = DB::table('products')->get();
         $clinics = DB::table('clinics')->get();
         $productsids = array();
         foreach($products as $proid){
             $productsids [] = $proid->id;
         }
         $productsids2 = implode(",",$productsids);
         $clinicsids = array();
         foreach($clinics as $clinic){
             $clinicsids [] = $clinic->id;
         }
         $clinicsids2 = implode(",",$clinicsids);
         $this->validate($request,[
             'product' => 'required|in:'.$productsids2,
             'price' => 'required|numeric',
             'Qty' => 'required|numeric',
             'clinic' => 'required|in:'.$clinicsids2,
             
         ]);
        $update = DB::table('stock__sells')
            ->where('id',$id)
            ->update([
                
                'productid' => $request->input('product'),
                'clinicid' => $request->input('clinic'),
                'price' => $request->input('price'),
                'qty' => $request->input('Qty'),
                'total' => $request->input('Qty') * $request->input('price'),
                'updated_at' => Carbon::now(),
            ]);
            if($update != null){
                session()->flash("updated",$update);
                return redirect("/admin/products/stock_sell_entries/edit/$id");
            }
        }
    }
    public function stocksell_remove(Request $request){
                  if($request->ajax()){
            $check = DB::table('stock__sells')->find($request->input('stockid'));
            if($check != null){
                $remove = DB::table('stock__sells')
                    ->where('id',$request->input('stockid'))
                    ->delete();
                return response([ 'removed' => "true"]);
            }
        }
    }
    public function patients(){   
        $patients = DB::table('patients')->get();
        $gender = array("Male","Female");
        $status = array("Inactive","Active","Block");
        return view('admin.patients')->with('patients',$patients)->with("gender",$gender)->with("status",$status);
    }
    public function patients_add_show(){  
        
        return view('admin.add_patient');
    }
    public function patients_add(Request $request){
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
            return view("admin.add_patient")->with("inserted",$insert);
        }
    }
    public function patients_edit_show($id){
        $check = DB::table('patients')->find($id);
        $gender = array("Male","Female");
        $status = array("Inactive","Active","Block");
        if($check != null){
            return view("admin.edit_patient")->with('patientinfo',$check)->with("gender",$gender)->with("status",$status);
        }
    }
    public function patients_edit($id,Request $request){
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
            'status' => 'required|in:0,1,2',
        ]);
        $check = DB::table('patients')->find($id);
        if($check != null){
            $update = DB::table('patients')
             ->where('id',$id)
             ->update([
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
            'status' => $request->input('status'),
            ]);
            if($update != null){
                session()->flash("updated",$update);
                return redirect("/admin/patients/edit/$id");
            }
        }
    }
    public function patient_remove(Request $request){
                 if($request->ajax()){
            $check = DB::table('patients')->find($request->input('patientid'));
            if($check != null){
                $remove = DB::table('patients')
                    ->where('id',$request->input('patientid'))
                    ->delete();
                return response([ 'removed' => "true"]);
            }
        }
    }
    public function patients_appointments($id){
        $check = DB::table('patients')->find($id);
        if($check != null){
            $appointmentstatus = array("Unconfirmed","Confirmed","Finish","Late Finish","Cancel");
            $appointments = DB::table('appointments')
                ->join('clinics','appointments.clinicid','=','clinics.id')
                ->join('patients','appointments.patientid','=','patients.id')
                ->join('employees','appointments.doctorid','=','employees.id')
                ->select('appointments.id as appointid','clinics.clinicname','employees.firstname','employees.lastname','patients.patientname','appointments.appointmentdateandtime','appointments.status')
                ->where('appointments.patientid','=',$id)
                ->get();
            return view("admin.appointment_related_patient")->with('appointments',$appointments)->with('appointmentstatus',$appointmentstatus);
            
        }
    }
    public function appointments_get_doctors_in_clinic(Request $request){
        if($request->ajax()){
          $this->validate($request,[
              'clinic' => 'required'
          ]);
            $doctors = DB::table('clinic__workers')
                ->join('employees','employees.id','=','clinic__workers.id')
                ->select('employees.id','employees.firstname','employees.lastname')
                ->where('clinicid','=',$request->input('clinic'))
                ->get();
           return response(["doctors" => $doctors]);
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
        return view('admin.appointments')->with('appointments',$appointments)->with('appointmentstatus',$appointmentstatus);
    }
    public function appointments_add_show(){ 
        $allclinics = DB::table('clinics')->get();
        $patients = DB::table('patients')->get();
        return view('admin.add_appointment')->with('allclinics',$allclinics)->with('patients',$patients);
    }
    public function appointments_add(Request $request){
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
        $insert = DB::table('appointments')
            ->insert([
                
                'clinicid' => $request->input('clinic'),
                'doctorid' => $request->input('doctor'),
                'patientid' => $request->input('patient'),
                'appointmentdateandtime' => $request->input('dateandtime'),
                'status' => $request->input('status'),
            ]);
        if($insert != null){
            return view("admin.add_appointment")->with('inserted',$insert)->with('allclinics',$clinics)->with('patients',$patients);
        }
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
            return view("admin.appointments_edit")->with('info',$id)->with('allclinics',$clinics)->with('patients',$patients)->with('appointments',$appointments)->with('appointmentstatus',$appointmentstatus)->with('doctorsinclinic',$doctorsinclinic);
        }
    }
    public function appointments_edit($id,Request $request){
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
            return redirect("/admin/appointments/edit/$id");
        
        
        
    }
   
}
