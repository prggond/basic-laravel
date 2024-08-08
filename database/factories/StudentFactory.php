<?php

namespace Database\Factories;
use App\Models\Student;

use App\Models\Teacher;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    protected $model = Student::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_name' => $this->faker->name,
            'class_teacher_id' => Teacher::factory(),
            'class' => $this->faker->randomElement(['1A', '2B', '3C']),
            'admission_date' => $this->faker->date(),
            'yearly_fees' => $this->faker->randomFloat(2, 1000, 5000),
        ];
    }
}
