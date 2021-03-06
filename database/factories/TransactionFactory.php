<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'identifier' => $this->faker->text(20),
            'value' => $this->faker->randomFloat(2, 0, 1000),
            'installments' => $this->faker->numberBetween(0, 18),
            'date' => $this->faker->date(),
        ];
    }
}
