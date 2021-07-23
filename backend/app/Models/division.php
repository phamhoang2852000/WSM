<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class division extends Model
{
    protected $table = 'division';

    public function users(){
    	return $this->hasMany('App\Models\User','id_division','id');
    }
}
