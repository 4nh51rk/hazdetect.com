<?php

namespace Database\Seeders;

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
    // \App\Models\User::factory(10)->create();

    // $this->call(UserSeeder::class,true); $this->command->info("User Table seeded :)");
    // $this->call(ShipSeeder::class,true); $this->command->info("Ship Table seeded :)");
    // $this->call(DeviceSeeder::class); $this->command->info("Device Table seeded :)");

    $this->call([
        UserSeeder::class,
        ShipSeeder::class,
        DeviceSeeder::class,
    ]);
  }
}
