<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestUser extends Model
{
    protected $table = "request";

    public function requestType() {
        return $this->belongsTo('App\Models\RequestType');
    }
}
