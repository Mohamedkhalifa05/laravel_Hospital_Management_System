<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class single_invoice extends Model
{
    protected $guarded = [];

    public function Service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
     public function Patient()
    {
        return $this->belongsTo(Patient::class);
    }
     public function Doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
     public function Section()
    {
        return $this->belongsTo(Section::class);
    }
}
