<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model implements TranslatableContract
{
    use HasFactory, Translatable;
     protected $guarded = [];

    public $translatedAttributes = [
        'name',
    ];
    public function doctors()
{
    return $this->belongsToMany(Doctor::class);
}

}
