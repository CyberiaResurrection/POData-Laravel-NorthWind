<?php

use Illuminate\Database\Seeder;

class PurchaseOrderStatusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('purchase_order_status')->delete();
        
        \DB::table('purchase_order_status')->insert(array (
            0 => 
            array (
                'id' => 0,
                'status' => 'New',
            ),
            1 => 
            array (
                'id' => 1,
                'status' => 'Submitted',
            ),
            2 => 
            array (
                'id' => 2,
                'status' => 'Approved',
            ),
            3 => 
            array (
                'id' => 3,
                'status' => 'Closed',
            ),
        ));
        
        
    }
}
