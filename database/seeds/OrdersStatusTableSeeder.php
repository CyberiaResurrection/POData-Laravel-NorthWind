<?php

use Illuminate\Database\Seeder;

class OrdersStatusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('orders_status')->delete();
        
        \DB::table('orders_status')->insert(array (
            0 => 
            array (
                'id' => 0,
                'status_name' => 'New',
            ),
            1 => 
            array (
                'id' => 1,
                'status_name' => 'Invoiced',
            ),
            2 => 
            array (
                'id' => 2,
                'status_name' => 'Shipped',
            ),
            3 => 
            array (
                'id' => 3,
                'status_name' => 'Closed',
            ),
        ));
        
        
    }
}
