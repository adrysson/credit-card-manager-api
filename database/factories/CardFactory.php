<?php

namespace Database\Factories;

use App\Models\Card;
use Illuminate\Database\Eloquent\Factories\Factory;

class CardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Card::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        for ($day = 1; $day <= 31; $day++) {
            $monthDays[] = $day;
        }

        $closingDate = $this->getClosingDate($monthDays);

        return [
            'identifier' => $this->faker->name,
            'due_date' => $this->getDueDate($monthDays, $closingDate),
            'closing_date' => $closingDate,
            'processing_days' => $this->getProcessingDays(),
        ];
    }

    /**
     * Returns a random close date
     *
     * @param int[] $monthDays Days of the month
     */
    private function getClosingDate(array $monthDays): int
    {
        $index = array_rand($monthDays);

        return $monthDays[$index];
    }

    /**
     * Returns a random close date
     *
     * @param int[] $monthDays Days of the month
     * @param int $closingDate Card closing date
     */
    private function getDueDate(array $monthDays, int $closingDate): int
    {
        $dueDateDays = array_merge($monthDays, $monthDays);

        $closingDateIndex = array_search($closingDate, $monthDays);

        return $dueDateDays[$closingDateIndex + 5];
    }

    /**
     * Returns a random amount of processing days
     */
    private function getProcessingDays(): int
    {
        $processingDaysList = [0, 1, 2];

        $index = array_rand($processingDaysList);

        return $processingDaysList[$index];
    }
}
