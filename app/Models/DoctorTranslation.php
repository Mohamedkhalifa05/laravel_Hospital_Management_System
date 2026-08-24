<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorTranslation extends Model
{
    protected $table = 'doctor_translations';

    protected $fillable = [
        'doctor_id',
        'locale',
        'name',
    ];

    public $timestamps = false;


 }
