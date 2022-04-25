<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DeviceFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'ship_id' => $this->faker->numberBetween(1,27),
      'container_serial' => $this->faker->regexify('[A-Z]{4}') . $this->faker->randomNumber(7, true),
      'imei' => $this->faker->randomNumber(8, true) . $this->faker->randomNumber(7, true),
    ];
  }
}
