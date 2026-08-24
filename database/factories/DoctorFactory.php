<?php

namespace Database\Factories;

use App\Models\Doctor;
use App\Models\Section;
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

            'section_id' => Section::inRandomOrder()->first()->id,
        ];

    }

    public function configure()
    {
        return $this->afterCreating(function (Doctor $doctor) {


          $arFaker = \Faker\Factory::create('ar_EG');


            $doctor->translateOrNew('ar')->name = 'د. ' . $arFaker->name();


            $doctor->translateOrNew('en')->name = 'Dr. ' . fake()->name;


            $doctor->save();
        });
    }
}
