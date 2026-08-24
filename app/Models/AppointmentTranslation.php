<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppointmentTranslation extends Model
{
     protected $table = 'appointment_translations';

    protected $fillable = ['name'];

    public $timestamps = false;
}
