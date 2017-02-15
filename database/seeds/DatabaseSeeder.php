<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call(UserTableSeeder::class);

        Model::reguard();
        $this->call('CustomerTableSeeder');
        $this->call('PhotoTableSeeder');
        $this->call('ProductTableSeeder');
        $this->call('StaffTableSeeder');
        $this->call('PasswordResetsTableSeeder');
        $this->call('UsersTableSeeder');
        $this->call('CustomersTableSeeder');
        $this->call('EmployeePrivilegesTableSeeder');
        $this->call('EmployeesTableSeeder');
        $this->call('InventoryTransactionTypesTableSeeder');
        $this->call('InventoryTransactionsTableSeeder');
        $this->call('InvoicesTableSeeder');
        $this->call('OrderDetailsTableSeeder');
        $this->call('OrderDetailsStatusTableSeeder');
        $this->call('OrdersTableSeeder');
        $this->call('OrdersStatusTableSeeder');
        $this->call('OrdersTaxStatusTableSeeder');
        $this->call('PrivilegesTableSeeder');
        $this->call('ProductsTableSeeder');
        $this->call('PurchaseOrderDetailsTableSeeder');
        $this->call('PurchaseOrderStatusTableSeeder');
        $this->call('PurchaseOrdersTableSeeder');
        $this->call('SalesReportsTableSeeder');
        $this->call('ShippersTableSeeder');
        $this->call('StringsTableSeeder');
        $this->call('SuppliersTableSeeder');
    }
}
