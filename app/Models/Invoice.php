<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Invoice extends Model
{
     protected $guarded = [];



   public function Service(){

   return $this->belongsTo(Service::class,"Service_id");

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
    public function Group()
{
    return $this->belongsTo(Group::class,"Group_id");
}


}
