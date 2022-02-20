<?php

namespace Database\Factories;

use App\Models\Accounts;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AccountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Account::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'sex' => Arr::random(['male', 'female']),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'account_type' => Arr::random(['administrator', 'responder', 'reporter', 'dispatcher']),
            'birthday' => $this->faker->date('2021-01-01'),
            'address' => $this->faker->address,
            'mobile_no' => $this->faker->phoneNumber,
            'unit_name' => $this->faker->unit_name,
            'city_municipality' => $this->faker->city_municipality,
            'province' => $this->faker->province,
            'zip_code' => $this->faker->randomNumber(6),
            'status' => Arr::random(['Off Duty', 'Available', 'Unavailable']),
            'remember_token' => Str::random(10),
            
       
            
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
