<?php

use Illuminate\Database\Seeder;

class PrivilegesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('privileges')->delete();
        
        \DB::table('privileges')->insert(array (
            0 => 
            array (
                'id' => 2,
                'privilege_name' => 'Purchase Approvals',
            ),
        ));
        
        
    }
}
