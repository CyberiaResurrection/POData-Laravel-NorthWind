<?php

use Illuminate\Database\Seeder;

class ShippersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('shippers')->delete();
        
        \DB::table('shippers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'company' => 'Shipping Company A',
                'last_name' => NULL,
                'first_name' => NULL,
                'email_address' => NULL,
                'job_title' => NULL,
                'business_phone' => NULL,
                'home_phone' => NULL,
                'mobile_phone' => NULL,
                'fax_number' => NULL,
                'address' => '123 Any Street',
                'city' => 'Memphis',
                'state_province' => 'TN',
                'zip_postal_code' => '99999',
                'country_region' => 'USA',
                'web_page' => NULL,
                'notes' => NULL,
                'attachments' => '',
            ),
            1 => 
            array (
                'id' => 2,
                'company' => 'Shipping Company B',
                'last_name' => NULL,
                'first_name' => NULL,
                'email_address' => NULL,
                'job_title' => NULL,
                'business_phone' => NULL,
                'home_phone' => NULL,
                'mobile_phone' => NULL,
                'fax_number' => NULL,
                'address' => '123 Any Street',
                'city' => 'Memphis',
                'state_province' => 'TN',
                'zip_postal_code' => '99999',
                'country_region' => 'USA',
                'web_page' => NULL,
                'notes' => NULL,
                'attachments' => '',
            ),
            2 => 
            array (
                'id' => 3,
                'company' => 'Shipping Company C',
                'last_name' => NULL,
                'first_name' => NULL,
                'email_address' => NULL,
                'job_title' => NULL,
                'business_phone' => NULL,
                'home_phone' => NULL,
                'mobile_phone' => NULL,
                'fax_number' => NULL,
                'address' => '123 Any Street',
                'city' => 'Memphis',
                'state_province' => 'TN',
                'zip_postal_code' => '99999',
                'country_region' => 'USA',
                'web_page' => NULL,
                'notes' => NULL,
                'attachments' => '',
            ),
        ));
        
        
    }
}
