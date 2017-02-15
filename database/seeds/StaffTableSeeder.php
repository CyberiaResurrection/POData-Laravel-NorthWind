<?php

use Illuminate\Database\Seeder;

class StaffTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('staff')->delete();
        
        \DB::table('staff')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'J. R. R. Tolkien',
                'partner_id' => 2,
                'photo_id' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'George R. R. Martin',
                'partner_id' => 1,
                'photo_id' => 2,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Sydney Newman',
                'partner_id' => NULL,
                'photo_id' => 3,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Terry Pratchet',
                'partner_id' => NULL,
                'photo_id' => 4,
            ),
        ));
        
        
    }
}
