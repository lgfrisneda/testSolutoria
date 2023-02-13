<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FinancialIndicatorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'UNIDAD DE FOMENTO (UF)',
            'code' => 'UF',
            'unit' => 'Pesos',
            'value' => $this->faker->randomFloat(2, 0),
            'date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'time' => null,
            'origin' => 'mindicador.cl'
        ];
    }
}
