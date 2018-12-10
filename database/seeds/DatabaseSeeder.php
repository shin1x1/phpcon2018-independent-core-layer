<?php

use Acme\Point\Application\Eloquents\EloquentCustomer;
use Acme\Point\Application\Eloquents\EloquentCustomerPoint;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->customers();
    }

    private function customers()
    {
        /** @var EloquentCustomer $customer */
        $customer = (new EloquentCustomer)->newQuery()->create([
            'name' => 'name1',
        ]);
        (new EloquentCustomerPoint)->newQuery()->insert([
            'customer_id' => $customer->id,
            'point'       => 100,
        ]);
    }
}
