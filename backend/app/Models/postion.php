<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class postion extends Model
{
    protected $table = "position";

    public function role() {
        return $this->belongsTo('App\Models\role');
    }
}
