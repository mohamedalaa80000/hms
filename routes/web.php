<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// routes for clinic #start
Route::get('/clinic/employees','clinic@employees');
Route::get('/clinic/employees/add','clinic@employees_add');
Route::post('/clinic/employees/add','clinic@employees_store');
Route::get('/clinic/employees/edit/{id}','clinic@employees_edit')->where('id','[1-9]+');
Route::post('/clinic/employees/edit/{id}','clinic@employees_edit_store')->where('id','[1-9]+');
Route::get('/clinic/patients','clinic@patients');
Route::get('/clinic/patients/add','clinic@patients_add_show');
Route::post('/clinic/patients/add','clinic@patients_add_store');
Route::get('/clinic/appointments','clinic@appointments');
Route::get('/clinic/appointments/edit/{id}','clinic@appointments_edit_show')->where('id','[1-9]+');
Route::post('/clinic/appointments/edit/{id}','clinic@appointments_edit')->where('id','[1-9]+');
Route::get('/clinic/services','clinic@services');
Route::get('/clinic/services/add','clinic@services_add_show');
Route::post('/clinic/services/add','clinic@services_add_store');
Route::get('/clinic/services_requests/show/{id}','clinic@service_request_show')->where('id','[1-9]+');
Route::get('/clinic/services_requests/edit/{id}','clinic@service_request_edit_show')->where('id','[1-9]+');
Route::post('/clinic/services_requests/edit/{id}','clinic@service_request_edit_store')->where('id','[1-9]+');
Route::get('/clinic/purchase','clinic@purchase');
Route::get('/clinic/patients/show/{id}','clinic@patients_show')->where('id','[1-90]+');
Route::get('/clinic/patients/add_medical_history/{id}','clinic@patients_add_medical_history_show')->where('id','[1-9]');
Route::post('/clinic/patients/add_medical_history/{id}','clinic@patients_add_medical_history_store')->where('id','[1-9]');
Route::get('/clinic/patients/medical_history/{id}/{id2}','clinic@patients_medical_history_show')->where(['id'=>'[1-9]+','id2'=>'[1-9]+']);
Route::get('/clinic/patients/add_tooth_record/{id}','clinic@patients_add_tooth_record_show')->where('id','[1-9]+');
Route::post('/clinic/patients/add_tooth_record/{id}','clinic@patients_add_tooth_record_store')->where('id','[1-9]+');
// routes for clinic #end


// routes fro admin #start
   // employees controll $start
Route::get('/admin/employees','admin@employees');
Route::get('/admin/dashboard','admin@dashboard');
Route::get('/admin','admin@dashboard');
Route::get('/admin/employees/add','admin@employees_add');
Route::post('/admin/employees/add/employeetype','admin@employees_type_ref');
Route::post('/admin/employees/add','admin@employees_store');
Route::get('/admin/employees/change_password/{id}','admin@employees_change_password_view')->where('id', '[1-9]+');
Route::post('/admin/employees/change_password/{id}','admin@employees_change_password')->where('id', '[1-9]+');
Route::get('/admin/employees/edit/{id}','admin@employees_edit_profile_view')->where('id', '[1-9]+');
Route::post('/admin/employees/edit/{id}','admin@employees_edit_profile')->where('id', '[1-9]+');
Route::post('/admin/employees/remove','admin@employees_remove');
Route::post('/admin/appointments/get/clinic/times','admin@employees_get_clinic_times');
   // employees controll $end
   // clinics controll $start
Route::get('/admin/clinics','admin@clinics');
Route::get('/admin/clinics/add','admin@clinics_add');
Route::post('/admin/clinics/add','admin@clinics_store');
Route::get('/admin/clinics/edit/{id}','admin@clinics_edit_view')->where('id','[1-9]+');
Route::post('/admin/clinics/edit/{id}','admin@clinics_edit')->where('id','[1-9]+');
Route::post('/admin/clinics/remove','admin@clinics_remove');
   // clinics controll $end
   // services controll $start
Route::get('/admin/services','admin@services');
Route::get('/admin/services/add','admin@services_add_show');
Route::post('/admin/services/add','admin@services_add');
Route::get('/admin/services/edit/{id}','admin@services_edit_show')->where('id','[1-9]+');
Route::post('/admin/services/edit/{id}','admin@services_edit')->where('id','[1-9]+');
   // services controll $end
   // providers controll $start
Route::get('/admin/products/stock_providers','admin@stock_providers');
Route::get('/admin/products/add_provider','admin@add_provider_show');
Route::post('/admin/products/add_provider','admin@add_provider');
Route::get('/admin/products/stock_providers/edit/{id}','admin@edit_provider_show')->where('id','[1-9]+');
Route::post('/admin/products/stock_providers/edit/{id}','admin@edit_provider')->where('id','[1-9]+');
   // providers controll $end
  // products controll $start
Route::get('/admin/products/products','admin@products');
Route::get('/admin/products/add','admin@products_add_show');
Route::post('/admin/products/add','admin@products_add');
Route::get('/admin/products/products/edit/{id}','admin@products_edit_show')->where('id','[1-9]+');
Route::post('/admin/products/products/edit/{id}','admin@products_edit')->where('id','[1-9]+');
Route::post('/admin/products/products/remove','admin@product_remove');
   // providers controll $end
   // stock_purchase controll $start
Route::get('/admin/products/stock_purchase_entries','admin@stock_purchase_entries');
Route::get('/admin/products/add_stock','admin@add_stock_show');
Route::post('/admin/products/add_stock','admin@add_stock');
Route::get('/admin/products/stock_purchase_entries/edit/{id}','admin@edit_stock_show')->where('id','[1-9]+');
Route::post('/admin/products/stock_purchase_entries/edit/{id}','admin@edit_stock')->where('id','[1-9]+');
Route::post('/admin/products/stock_purchase_entries/remove','admin@stockp_remove');
   // stock_purchase controll $end
   // stock_sell controll $start
Route::get('/admin/products/stock_sell_entries','admin@stock_sell_entries');
Route::get('/admin/products/add_sell','admin@add_sell_show');
Route::post('/admin/products/add_sell','admin@add_sell');
Route::get('/admin/products/stock_sell_entries/edit/{id}','admin@edit_sell_show')->where('id','[1-9]+');
Route::post('/admin/products/stock_sell_entries/edit/{id}','admin@edit_sell')->where('id','[1-9]+');
Route::post('/admin/products/stock_sell_entries/remove','admin@stocksell_remove');
   // stock_sell controll $end
   // stock_sell controll $end
Route::get('/admin/patients','admin@patients');
Route::get('/admin/patients/add','admin@patients_add_show');
Route::post('/admin/patients/add','admin@patients_add');
Route::get('/admin/patients/edit/{id}','admin@patients_edit_show')->where('id','[1-9]+');
Route::post('/admin/patients/edit/{id}','admin@patients_edit')->where('id','[1-9]+');
Route::get('/admin/patients/appointments/{id}','admin@patients_appointments')->where('id','[1-9]+');
Route::post('/admin/patients/remove','admin@patient_remove');
   // patients controll $end
Route::get('/admin/appointments','admin@appointments');
Route::get('/admin/appointments/add','admin@appointments_add_show');
Route::post('/admin/appointments/add','admin@appointments_add');
Route::post('/admin/appointments/add/doctor','admin@appointments_get_doctors_in_clinic');
Route::get('/admin/appointments/edit/{id}','admin@appointments_edit_show')->where('id','[1-9]+');
Route::post('/admin/appointments/edit/{id}','admin@appointments_edit')->where('id','[1-9]+');
  

// routes for admin #end

Route::get('/receptionist/employees','receptionist@employees');
Route::get('/receptionist/employees/add','receptionist@employees_add');
Route::post('/receptionist/employees/add','receptionist@employees_store');
Route::get('/receptionist/employees/edit/{id}','receptionist@employees_edit')->where('id','[1-9]+');
Route::post('/receptionist/employees/edit/{id}','receptionist@employees_edit_store')->where('id','[1-9]+');
Route::get('/receptionist/patients','receptionist@patients');
Route::get('/receptionist/patients/add','receptionist@patients_add_show');
Route::post('/receptionist/patients/add','receptionist@patients_add_store');
Route::get('/receptionist/appointments','receptionist@appointments');
Route::get('/receptionist/appointments/edit/{id}','receptionist@appointments_edit_show')->where('id','[1-9]+');
Route::post('/receptionist/appointments/edit/{id}','receptionist@appointments_edit')->where('id','[1-9]+');
Route::get('/receptionist/services','receptionist@services');
Route::get('/receptionist/services/add','receptionist@services_add_show');
Route::post('/receptionist/services/add','receptionist@services_add_store');
Route::get('/receptionist/services_requests/show/{id}','receptionist@service_request_show')->where('id','[1-9]+');
Route::get('/receptionist/services_requests/edit/{id}','receptionist@service_request_edit_show')->where('id','[1-9]+');
Route::post('/receptionist/services_requests/edit/{id}','receptionist@service_request_edit_store')->where('id','[1-9]+');
Route::post('/receptionist/services/add/doctor','receptionist@service_request_add_getdoctors');
Route::get('/receptionist/purchase','receptionist@purchase');


Route::get('/xray/employees','xray@employees');
Route::get('/xray/employees/add','xray@employees_show');
Route::post('/xray/employees/add','xray@employees_store');
Route::get('/xray/patients','xray@patients');
Route::get('/xray/patients/show/{id}','xray@patients_show')->where('id','[1-9]+');
Route::get('/xray/services','xray@services');
Route::get('/xray/services_requests/show/{id}','xray@service_request_show')->where('id','[1-9]+');




Route::get('/accountant/employees','accountant@employees');
Route::get('/accountant/employees/add','accountant@employees_add_show');
Route::post('/accountant/employees/add','accountant@employees_store');
Route::get('/accountant/services','accountant@services');
Route::get('/accountant/services/add','accountant@services_add_show');
Route::post('/accountant/services/add','accountant@services_add');
Route::get('/accountant/services/edit/{id}','accountant@services_edit_show')->where('id','[1-9]+');
Route::post('/accountant/services/edit/{id}','accountant@services_edit')->where('id','[1-9]+');
Route::get('/accountant/expenses','accountant@expenses_show');
Route::get('/accountant/expenses/edit/{id}','accountant@expenses_edit_show')->where('id','[1-9]+');
Route::post('/accountant/expenses/edit/{id}','accountant@expenses_edit')->where('id','[1-9]+');
Route::get('/accountant/expenses/add','accountant@expenses_add_show');
Route::post('/accountant/expenses/add','accountant@expenses_add');
Route::get('/accountant/service_requests','accountant@service_requests');
Route::get('/accountant/services_requests/show/{id}','accountant@service_request_show')->where('id','[1-90]+');


