<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

       $doctors = Doctor::factory()->count(30)->create();

     $appointments = Appointment::pluck('id');

foreach ($doctors as $doctor) {
    $doctor->doctorappointments()->attach(
        $appointments->random(rand(1, 3))
    );
}

// $Appointments = Appointment::all();
//
////        foreach ($doctors as $doctor){
////            $Appointments = Appointment::all()->random()->id;
////            $doctor->doctorappointments()->attach($Appointments);
////        }
//        Doctor::all()->each(function ($doctor) use ($Appointments) {
//           $doctor->doctorappointments()->attach(
//              $Appointments->random(rand(1,7))->pluck('id')->toArray()
//           );
//       });

           }
}
