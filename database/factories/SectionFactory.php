<?php

namespace Database\Factories;

use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Section>
 */
class SectionFactory extends Factory
{


protected $model = Section::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
 public function definition(): array
{
    return [
        'name' => fake()->randomElement([
            'قسم الأطفال',
            'قسم الأشعة',
            'قسم المخ والأعصاب',
            'قسم النساء والتوليد',
            'قسم العظام',
        ]),
        'description'=>fake()->paragraph()
    ];
}
}
