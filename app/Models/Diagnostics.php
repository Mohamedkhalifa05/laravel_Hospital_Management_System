<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diagnostics extends Model
{
    protected $guarded = [];

    public function Doctor() {
        return $this->belongsTo(Doctor::class);
    }
}
