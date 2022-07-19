<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => trim($this->faker->sentence(), '.'),
            'body' => $this->faker->paragraphs(rand(3, 5), true),
            'user_id' => User::pluck('id')->random(),
        ];
    }
}
