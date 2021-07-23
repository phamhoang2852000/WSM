<?php

namespace App\Http\Controllers;
use App\Models\postion;
use App\Models\division;
use App\Models\permission;

use Illuminate\Http\Request;

class PostionController extends Controller
{
    public function postion() {
        // return "abc";
        $postion = postion::all();
        return $postion;
    }

    public function division() {
        // return "abc";
        $division = division::all();
        return $division;
    }

    public function permission() {
        $permission = permission::all();
        return $permission;
    }
}
