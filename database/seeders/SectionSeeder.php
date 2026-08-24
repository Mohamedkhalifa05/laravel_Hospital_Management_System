<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    public function run(): void
    {
        $sections = [
            [
                'ar' => 'قسم الأطفال',
                'en' => 'Pediatrics Department',
            ],
            [
                'ar' => 'قسم الأشعة',
                'en' => 'Radiology Department',
            ],
            [
                'ar' => 'قسم المخ والأعصاب',
                'en' => 'Neurology Department',
            ],
            [
                'ar' => 'قسم النساء والتوليد',
                'en' => 'Obstetrics and Gynecology Department',
            ],
            [
                'ar' => 'قسم العظام',
                'en' => 'Orthopedics Department',
            ],
        ];

        foreach ($sections as $section) {

            $model = new Section();

            $ar = $model->translateOrNew('ar');
            $ar->name = $section['ar'];
            $ar->description = fake()->paragraph();

            $en = $model->translateOrNew('en');
            $en->name = $section['en'];
            $en->description = fake()->paragraph();

            $model->save();
        }
    }
}
