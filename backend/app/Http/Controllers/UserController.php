<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\division;
use App\Models\postion;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
class UserController extends Controller
{
    public function listUser($id_division) {
        $divisionName = division::where('id', $id_division)->first()->name;
        $listUser = User::where([
            ['division', $id_division],
            ['status', 1]
        ])->get();
        return response()->json([
            'divisionName' => $divisionName,
            'listUser' => $listUser,
        ]);
    }

    public function profileAccount($idUser) {
        $user = User::find($idUser);
        $division = division::where('id', $user->division)->first()->name;
        return response()->json([
            'user' => $user,
            'division' => $division
        ]);
    }

    public function deleteUser($idUser) {
        $user = User::find($idUser);
        $user->status = 0;
        $user->save();
        return response()->json([
            'message' => 'Xóa tài khoản thành công'
        ]);
    }

    public function updateUser(Request $request, $idUser) {
        $user = User::find($idUser);

        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->phonenumber = $request->phonenumber;
        if($request->division != 0) {
            $user->division = $request->division;
        }
        if($request->position != 0) {
            $user->position = postion::where('id',$request->position)->first()->name;
        }
        // $user->permission = $request->permission;
        if($request->password != ''){
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return response()->json([
            'message' => 'Cập nhật thành công'
        ]);
    }
}
