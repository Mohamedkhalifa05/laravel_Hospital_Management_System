<?php

namespace Database\Seeders;

use App\Models\Section;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('services')->delete();
        
        $single_services = [
            [
                'ar' => 'حشو عصب',
                'en' => 'root canal filling',
                "price" => "500"
            ],
            [
                'ar' => 'تبيض الاسنان',
                'en' => 'Teeth whitening',
                "price" => "1000"

            ],
            [
                'ar' => 'خلع السن',
                'en' => 'Tooth Extraction',
                "price" => "200"

            ],
            [
                'ar' => 'تقويم الأسنان',
                'en' => 'Braces / Orthodontics',
                "price" => "1500"

            ],
            [
                'ar' => 'زراعة الأسنان',
                'en' => 'Dental Implant',
                "price" => "5000"

            ],
            [
                'ar' => 'جسر الأسنان',
                'en' => 'Dental Bridge',
                "price" => "2000"

            ],
               [
                'ar' =>"عملية جراحية",
                'en' => 'Surgery',
                "price" => "4000"

            ],


        ];

        foreach ($single_services as $service) {

            $model = new Service();

            $ar = $model->translateOrNew('ar');
            $ar->name = $service['ar'];


            $en = $model->translateOrNew('en');
            $en->name = $service['en'];
       $model->price = $service['price'];

            $model->save();
        }
    }
}
