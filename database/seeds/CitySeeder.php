<?php

use App\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = factory(App\City::class, 5)
            ->create()
            ->each(function ($city) {
                for ($i = 0; $i < 10; $i++) {
                    $client = factory(App\Client::class)->create();
                    $city->clients()->save($client);
                }

            });;
    }
}
