<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Ambulance extends Model implements TranslatableContract
{
      use HasFactory, Translatable;


    protected $guarded = [];

    public $translatedAttributes = [
        'driver_name',
        "notes"
    ];
}
