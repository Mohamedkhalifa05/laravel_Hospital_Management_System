<?php

namespace Database\Factories;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class DoctorFactory extends Factory
{
    protected $model = Doctor::class;

    public function definition(): array
    {
        return [
            
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'phone' => $this->faker->unique()->phoneNumber,
            'price' => $this->faker->randomElement([
                100,
                200,
                300,
                400,
                500
            ]),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Doctor $doctor) {

            $doctor->translateOrNew('ar')->name = 'د. ' . fake()->name;
            $doctor->translateOrNew('ar')->appointments = fake()->randomElement([
                'Saturday',
                'Sunday',
                'Monday',
                'Tuesday',
                'Wednesday',
                'Thursday',
                'Friday',
            ]);

            $doctor->translateOrNew('en')->name = 'Dr. ' . fake()->name;
            $doctor->translateOrNew('en')->appointments = fake()->randomElement([
                'Saturday',
                'Sunday',
                'Monday',
                'Tuesday',
                'Wednesday',
                'Thursday',
                'Friday',
            ]);

            $doctor->save();
        });
    }
}
