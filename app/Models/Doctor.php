<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Doctor extends Model implements TranslatableContract
{
    use HasFactory, Translatable;


    protected $guarded = [];

    public $translatedAttributes = [
        'name',
    ];


    public function image(){
        return $this->morphOne(Image::class,"imageable");
    }
    public function section(){
      return  $this->belongsTo(Section::class);
    }
      public function doctorappointments()
    {
        return $this->belongsToMany(Appointment::class,'appointment_doctor');
    }


}
