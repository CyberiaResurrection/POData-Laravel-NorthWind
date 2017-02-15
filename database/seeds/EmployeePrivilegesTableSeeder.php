<?php

use Illuminate\Database\Seeder;

class EmployeePrivilegesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('employee_privileges')->delete();
        
        \DB::table('employee_privileges')->insert(array (
            0 => 
            array (
                'employee_id' => 2,
                'privilege_id' => 2,
            ),
        ));
        
        
    }
}
