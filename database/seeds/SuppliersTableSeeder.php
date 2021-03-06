<?php

use Illuminate\Database\Seeder;

class SuppliersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('suppliers')->delete();
        
        \DB::table('suppliers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'company' => 'Supplier A',
                'last_name' => 'Andersen',
                'first_name' => 'Elizabeth A.',
                'email_address' => NULL,
                'job_title' => 'Sales Manager',
                'business_phone' => NULL,
                'home_phone' => NULL,
                'mobile_phone' => NULL,
                'fax_number' => NULL,
                'address' => NULL,
                'city' => NULL,
                'state_province' => NULL,
                'zip_postal_code' => NULL,
                'country_region' => NULL,
                'web_page' => NULL,
                'notes' => NULL,
                'attachments' => '',
            ),
            1 => 
            array (
                'id' => 2,
                'company' => 'Supplier B',
                'last_name' => 'Weiler',
                'first_name' => 'Cornelia',
                'email_address' => NULL,
                'job_title' => 'Sales Manager',
                'business_phone' => NULL,
                'home_phone' => NULL,
                'mobile_phone' => NULL,
                'fax_number' => NULL,
                'address' => NULL,
                'city' => NULL,
                'state_province' => NULL,
                'zip_postal_code' => NULL,
                'country_region' => NULL,
                'web_page' => NULL,
                'notes' => NULL,
                'attachments' => '',
            ),
            2 => 
            array (
                'id' => 3,
                'company' => 'Supplier C',
                'last_name' => 'Kelley',
                'first_name' => 'Madeleine',
                'email_address' => NULL,
                'job_title' => 'Sales Representative',
                'business_phone' => NULL,
                'home_phone' => NULL,
                'mobile_phone' => NULL,
                'fax_number' => NULL,
                'address' => NULL,
                'city' => NULL,
                'state_province' => NULL,
                'zip_postal_code' => NULL,
                'country_region' => NULL,
                'web_page' => NULL,
                'notes' => NULL,
                'attachments' => '',
            ),
            3 => 
            array (
                'id' => 4,
                'company' => 'Supplier D',
                'last_name' => 'Sato',
                'first_name' => 'Naoki',
                'email_address' => NULL,
                'job_title' => 'Marketing Manager',
                'business_phone' => NULL,
                'home_phone' => NULL,
                'mobile_phone' => NULL,
                'fax_number' => NULL,
                'address' => NULL,
                'city' => NULL,
                'state_province' => NULL,
                'zip_postal_code' => NULL,
                'country_region' => NULL,
                'web_page' => NULL,
                'notes' => NULL,
                'attachments' => '',
            ),
            4 => 
            array (
                'id' => 5,
                'company' => 'Supplier E',
                'last_name' => 'Hernandez-Echevarria',
                'first_name' => 'Amaya',
                'email_address' => NULL,
                'job_title' => 'Sales Manager',
                'business_phone' => NULL,
                'home_phone' => NULL,
                'mobile_phone' => NULL,
                'fax_number' => NULL,
                'address' => NULL,
                'city' => NULL,
                'state_province' => NULL,
                'zip_postal_code' => NULL,
                'country_region' => NULL,
                'web_page' => NULL,
                'notes' => NULL,
                'attachments' => '',
            ),
            5 => 
            array (
                'id' => 6,
                'company' => 'Supplier F',
                'last_name' => 'Hayakawa',
                'first_name' => 'Satomi',
                'email_address' => NULL,
                'job_title' => 'Marketing Assistant',
                'business_phone' => NULL,
                'home_phone' => NULL,
                'mobile_phone' => NULL,
                'fax_number' => NULL,
                'address' => NULL,
                'city' => NULL,
                'state_province' => NULL,
                'zip_postal_code' => NULL,
                'country_region' => NULL,
                'web_page' => NULL,
                'notes' => NULL,
                'attachments' => '',
            ),
            6 => 
            array (
                'id' => 7,
                'company' => 'Supplier G',
                'last_name' => 'Glasson',
                'first_name' => 'Stuart',
                'email_address' => NULL,
                'job_title' => 'Marketing Manager',
                'business_phone' => NULL,
                'home_phone' => NULL,
                'mobile_phone' => NULL,
                'fax_number' => NULL,
                'address' => NULL,
                'city' => NULL,
                'state_province' => NULL,
                'zip_postal_code' => NULL,
                'country_region' => NULL,
                'web_page' => NULL,
                'notes' => NULL,
                'attachments' => '',
            ),
            7 => 
            array (
                'id' => 8,
                'company' => 'Supplier H',
                'last_name' => 'Dunton',
                'first_name' => 'Bryn Paul',
                'email_address' => NULL,
                'job_title' => 'Sales Representative',
                'business_phone' => NULL,
                'home_phone' => NULL,
                'mobile_phone' => NULL,
                'fax_number' => NULL,
                'address' => NULL,
                'city' => NULL,
                'state_province' => NULL,
                'zip_postal_code' => NULL,
                'country_region' => NULL,
                'web_page' => NULL,
                'notes' => NULL,
                'attachments' => '',
            ),
            8 => 
            array (
                'id' => 9,
                'company' => 'Supplier I',
                'last_name' => 'Sandberg',
                'first_name' => 'Mikael',
                'email_address' => NULL,
                'job_title' => 'Sales Manager',
                'business_phone' => NULL,
                'home_phone' => NULL,
                'mobile_phone' => NULL,
                'fax_number' => NULL,
                'address' => NULL,
                'city' => NULL,
                'state_province' => NULL,
                'zip_postal_code' => NULL,
                'country_region' => NULL,
                'web_page' => NULL,
                'notes' => NULL,
                'attachments' => '',
            ),
            9 => 
            array (
                'id' => 10,
                'company' => 'Supplier J',
                'last_name' => 'Sousa',
                'first_name' => 'Luis',
                'email_address' => NULL,
                'job_title' => 'Sales Manager',
                'business_phone' => NULL,
                'home_phone' => NULL,
                'mobile_phone' => NULL,
                'fax_number' => NULL,
                'address' => NULL,
                'city' => NULL,
                'state_province' => NULL,
                'zip_postal_code' => NULL,
                'country_region' => NULL,
                'web_page' => NULL,
                'notes' => NULL,
                'attachments' => '',
            ),
        ));
        
        
    }
}
