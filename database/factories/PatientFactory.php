<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as FakerFactory;

class PatientFactory extends Factory
{
    protected $model = Patient::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [

            'email' => fake()->unique()->safeEmail(),

            'password' => Hash::make('12345678'),

            'Date_Birth' => fake()->date(),

            'Phone' => fake()->unique()->phoneNumber(),

            'Gender' => fake()->randomElement([
                'Male',
                'Female',
            ]),

            'Blood_Group' => fake()->randomElement([
                'A+',
                'A-',
                'B+',
                'B-',
                'AB+',
                'AB-',
                'O+',
                'O-',
            ]),

        ];
    }

    /**
     * Configure the model factory.
     */
    public function configure()
    {
        return $this->afterCreating(function (Patient $patient) {

            // Faker باللغة العربية
            $arFaker = FakerFactory::create('ar_EG');

            // الترجمة العربية
            $patient->translateOrNew('ar')->name = $arFaker->name();
            $patient->translateOrNew('ar')->Address = $arFaker->address();

            // الترجمة الإنجليزية
            $patient->translateOrNew('en')->name = fake()->name();
            $patient->translateOrNew('en')->Address = fake()->address();

            // حفظ الترجمات
            $patient->save();
        });
    }
}