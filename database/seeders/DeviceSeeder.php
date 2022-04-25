<?php

namespace Database\Seeders;

use App\Models\Device;
use Illuminate\Database\Seeder;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = \Faker\Factory::create();
        Device::create([
            'ship_id' => 25,
            'container_serial' => $faker->regexify('[A-Z]{4}') . $faker->randomNumber(7,true),
            'imei' => "868822041117571",
        ]);
        // Device::factory(500)->create();
    }
}
