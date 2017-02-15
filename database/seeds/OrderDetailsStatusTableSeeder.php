<?php

use Illuminate\Database\Seeder;

class OrderDetailsStatusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('order_details_status')->delete();
        
        \DB::table('order_details_status')->insert(array (
            0 => 
            array (
                'id' => 0,
                'status_name' => 'None',
            ),
            1 => 
            array (
                'id' => 1,
                'status_name' => 'Allocated',
            ),
            2 => 
            array (
                'id' => 2,
                'status_name' => 'Invoiced',
            ),
            3 => 
            array (
                'id' => 3,
                'status_name' => 'Shipped',
            ),
            4 => 
            array (
                'id' => 4,
                'status_name' => 'On Order',
            ),
            5 => 
            array (
                'id' => 5,
                'status_name' => 'No Stock',
            ),
        ));
        
        
    }
}
