<?php

use Illuminate\Database\Seeder;
use App\Employees;
class employees_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         for($i = 0 ; $i < 20 ; $i ++){
            
            $add = new Employees;
            $add->firstname = "Mohamed" . $i;
            $add->lastname = "Mohamed" . $i;
            $add->email = "Mohamed" . $i;
            $add->password = "Mohamed" . $i;
            $add->mobile = "Mohamed" . $i;
            $add->userimage = "Mohamed" . $i;
            $add->employeetype = "Mohamed" . $i;
            $add->status =  $i;
            $add->loginfacility =  $i;
            $add->notes = "Mohamed" . $i;
            $add->save();
        }
    }
}
