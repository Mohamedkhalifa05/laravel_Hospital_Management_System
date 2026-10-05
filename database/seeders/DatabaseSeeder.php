<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;



use App\Models\Doctor;
use App\Models\User;
use Database\Seeders\AppointmentSeeder;
use Database\Seeders\SectionSeeder;
use Database\Seeders\PatientSeeder;

use Database\Seeders\DoctorSeeder;
use Database\Seeders\ImageSeeder;
use Database\Seeders\ServiceSeeder;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class DatabaseSeeder extends Seeder
{
    // use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {




        $this->call([
         AdminSeeder::class,
         UserSeeder::class,
         PatientSeeder::class,
         AppointmentSeeder::class,
         SectionSeeder::class,
         DoctorSeeder::class,
         ImageSeeder::class,
         ServiceSeeder::class
        ]);


        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
