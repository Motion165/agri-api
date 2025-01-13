<?php

namespace Database\Factories;

use App\Models\Farmer;
  use App\Models\Transactions;


use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transactions>
 */
class TransactionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'farmer_id'=>Farmer::factory(),
            'amount'=>$this->faker->numberBetween(100,200000),
            'date'=>$this->faker->dateTimeThisDecade(),
        ];
    }
}
