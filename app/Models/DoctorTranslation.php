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
        'appointments',
    ];

    public $timestamps = false;

//     public function doctor()
//     {
//         return $this->belongsTo(Doctor::class);
//     }
 }
