<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        static $counter = 0;
        $counter++;
        $startDate = $this->faker->dateTimeThisDecade($max = 'now', $timezone = null);

        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => Hash::make('password'.$counter),
            'remember_token' => Str::random(10),
            'contract_start_date' => $startDate,
            'contract_end_date' => $this->faker->dateTimeBetween($startDate, $endDate = 'now', $timezone = null),
            'type' => $this->faker->randomElement(['normal', 'premium'])
        ];
    }

    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
