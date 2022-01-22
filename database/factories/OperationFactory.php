<?php

namespace Database\Factories;

use App\Models\Accounts;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OperationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Operation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'incident_id' => $this->faker->incident_id,
            'unit_name' => $this->faker->unit_name,
            'dispatcher_id' => $this->faker->dispatcher_id,
            'external_agency_id' => $this->faker->external_agency_id,
            'etd_base' => $this->faker->etd_base,
            'eta_scene' => $this->faker->eta_scene,
            'etd_scene' => $this->faker->etd_scene,
            'eta_hospital' => $this->faker->eta_hospital,
            'etd_hospital' => $this->faker->etd_hospital,
            'eta_base' => $this->faker->eta_base,
            'receiving_facility' => $this->faker->receiving_facility,
            
       
            
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
