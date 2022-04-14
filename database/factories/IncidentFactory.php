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
            'name' => $this->faker->name(),
            'sex' => Arr::random(['male', 'female']),
            'age' => $this->faker->age,
            'description' => $this->faker->description,
            'location' => $this->faker->location,
            'location_id' => $this->faker->location_id,
            'account_id' => $this->faker->account_id,
            'temperature' => $this->faker->temperature,
            'pulse_rate' => $this->faker->pulse_rate,
            'incident_status' => Arr::random(['Pending', 'Proceeding', 'Completed', 'Pseudo']),
            'victim_status' => $this->faker->victim_status,
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
