<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Doctor extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    protected $fillable = [
        'email',
        'email_verified_at',
        'password',
        'phone',
        'price',
        'name','appointments'
    ];

    public $translatedAttributes = [
        'name',
        'appointments',
    ];


    public function image(){
        return $this->morphOne(Image::class,"imageable");
    }

}
