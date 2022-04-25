<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ShipFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'name' => $this->faker->domainWord(),
      'imo' => $this->faker->randomNumber(7, true),
      'ssid' => $this->faker->userName(),
      'ssid_password' => $this->faker->text($this->faker->numberBetween(6,12)),
      'wifi_ping' => $this->faker->numberBetween(15,120),
      'gsm_ping' => $this->faker->numberBetween(15,120),
    ];
  }
}
