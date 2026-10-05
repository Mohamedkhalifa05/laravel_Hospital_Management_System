<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;


class ReceiptAccount extends Model
{
    use HasFactory, Translatable;


    protected $guarded = [];

    public $translatedAttributes = [
        'name',
    ];



    public function patients(){
      return  $this->belongsTo(Patient::class,"patient_id");
    }
}
