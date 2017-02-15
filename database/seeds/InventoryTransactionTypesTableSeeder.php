<?php

use Illuminate\Database\Seeder;

class InventoryTransactionTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('inventory_transaction_types')->delete();
        
        \DB::table('inventory_transaction_types')->insert(array (
            0 => 
            array (
                'id' => 1,
                'type_name' => 'Purchased',
            ),
            1 => 
            array (
                'id' => 2,
                'type_name' => 'Sold',
            ),
            2 => 
            array (
                'id' => 3,
                'type_name' => 'On Hold',
            ),
            3 => 
            array (
                'id' => 4,
                'type_name' => 'Waste',
            ),
        ));
        
        
    }
}
