<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        for ($i = 1; $i < 11; $i++) {
            User::factory()->create([
                'email' => "test$i@test.com",
                'name' => "test$i"
            ])->each(function ($user) {
                $user->questions()->saveMany(
                    Question::factory(rand(1, 3))->create()->each(function ($question) {
                        $question->answers()->saveMany(Answer::factory(rand(1, 5))->make());
                    }),
                );
            });
        }
    }
}
