<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     */
    private $model = Section::class;
    public function run(): void
    {
        //

        
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

    $model = Section::create([
        'name' => $section['ar'],
    ]);

   $model->translateOrNew('ar')->name = $section['ar'];
    $model->translateOrNew('en')->name = $section['en'];

    $model->save();
}

    }
}
