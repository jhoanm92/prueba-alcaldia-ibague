<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employe>
 */
class EmployeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $departments = Department::pluck('id')->toArray();
        return [
            'name' => fake()->name(),
            'lastname' => fake()->lastName(),
            'email' =>fake()->unique()->email(),
            'identification' => fake()->unique()->randomNumber(9),
            'sex' => fake()->randomElement(['M', 'F']),
            'birthday' => fake()->date(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'department_id' => fake()->randomElement($departments),
        ];
    }
}
