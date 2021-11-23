<?php

namespace Database\Factories;

use App\Models\Accounts;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class IncidentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Incident::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'incident_type' => $this->faker->incident_type,
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'sex' => Arr::random(['male', 'female']),
            'age' => $this->faker->age,
            'description' => $this->faker->description,
            'location' => $this->faker->location,
            'date_time_reported' => now(),
            'location_id' => $this->faker->location_id,
            'account_id' => $this->faker->account_id,
           
            'remember_token' => Str::random(10),
            
       
            
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    // public function unverified()
    // {
    //     return $this->state(function (array $attributes) {
    //         return [
    //             'email_verified_at' => null,
    //         ];
    //     });
    // }
}
