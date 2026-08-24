<?php

namespace Database\Seeders;

use App\Models\Appointment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $appointments = [
    [
        'ar' => 'السبت',
        'en' => 'Saturday',
    ],
    [
        'ar' => 'الأحد',
        'en' => 'Sunday',
    ],
    [
        'ar' => 'الإثنين',
        'en' => 'Monday',
    ],
    [
        'ar' => 'الثلاثاء',
        'en' => 'Tuesday',
    ],
    [
        'ar' => 'الأربعاء',
        'en' => 'Wednesday',
    ],
    [
        'ar' => 'الخميس',
        'en' => 'Thursday',
    ],
    [
        'ar' => 'الجمعة',
        'en' => 'Friday',
    ],
];
foreach ($appointments as $appointment) {

    $model = new Appointment();

    $model->translateOrNew('ar')->name = $appointment['ar'];
    $model->translateOrNew('en')->name = $appointment['en'];

    $model->save();
}


    }
}
