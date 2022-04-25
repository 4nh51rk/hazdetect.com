<?php

namespace Database\Seeders;

use App\Models\Ship;
use Illuminate\Database\Seeder;

class ShipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Melanesian Pride (ex Kiribati Chief)', 'imo' => '8809189'],
            ['name' => 'Melanesian Chief', 'imo' => '8809191'],
            ['name' => 'Forum Samoa4 (ex Micronesian Chief)', 'imo' => '8901705'],
            ['name' => 'Kokopo Chief', 'imo' => '8907412'],
            ['name' => 'Kwangtung', 'imo' => '9070709'],
            ['name' => 'Kweilin', 'imo' => '9103104'],
            ['name' => 'Kwangsi', 'imo' => '9103116'],
            ['name' => 'Moana Chief', 'imo' => '9516741'],
            ['name' => 'Shansi', 'imo' => '9614476'],
            ['name' => 'Carpenters Sirius (ex Shantung)', 'imo' => '9614488'],
            ['name' => 'Shaoshing', 'imo' => '9614490'],
            ['name' => 'Shengking', 'imo' => '9614505'],
            ['name' => 'Shuntien', 'imo' => '9614517'],
            ['name' => 'Siangtan', 'imo' => '9614529'],
            ['name' => 'Soochow', 'imo' => '9614531'],
            ['name' => 'Szechuen', 'imo' => '9614543'],
            ['name' => 'Coral Chief', 'imo' => '9689938'],
            ['name' => 'Highland Chief', 'imo' => '9689940'],
            ['name' => 'New Guinea Chief', 'imo' => '9689952'],
            ['name' => 'Papuan Chief', 'imo' => '9689964'],
            ['name' => 'Antung (ex MCP Troodos)', 'imo' => '9356907'],
            ['name' => 'Polynesia (ex Hansa Salzburg)', 'imo' => '9516753'],
            ['name' => 'Morobe Chief (ex G. Box)', 'imo' => '9766047'],
            ['name' => 'Coronado Bay', 'imo' => '9367815'],
            ['name' => 'Bardu', 'imo' => '9504592'],
            ['name' => 'Mount Cameron', 'imo' => '9760598'],
            ['name' => 'Nickie B', 'imo' => '9431343'],
        ];
        //
        // Ship::create([
        //     'name' => 'Serenity',
        //     'ssid' => 'Wi5',
        //     'ssid_password' => '147'
        // ]);
        // Ship::factory(25)->create();

        $faker = \Faker\Factory::create();
        foreach ($data as $item) {
            Ship::create([
                'name' => $item['name'],
                'imo' => $item['imo'],
                'ssid' => $faker->userName(),
                'ssid_password' => $faker->text($faker->numberBetween(6,12)),
                'ipv4' => $faker->ipv4(),
                'wifi_ping' => $faker->numberBetween(15,120),
                'gsm_ping' => $faker->numberBetween(15,120),
            ]);
        }
    }
}
