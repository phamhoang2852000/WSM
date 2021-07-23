<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestType extends Model
{
    protected $table = "requestType";

    public function requestType() {
        return $this->hasMany('App\Models\RequestUser');
    }
}
