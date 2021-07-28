<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\division;
use App\Models\postion;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Models\checkUser;
use App\Models\permission;
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
        $permission = json_decode($user->permission, true);
        return response()->json([
            'user' => $user,
            'division' => $division,
            'permission' => $permission
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

        $json_permission = "";
        $array_permission = array();

        if($request->permission != '') {
            $permission = $request->permission;
            foreach($permission as $per) {
                $array_permission[] = $per;
            }
            $json_permission = json_encode($array_permission, JSON_FORCE_OBJECT);

        }


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
        $user->permission = $json_permission;
        if($request->password != ''){
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return response()->json([
            'message' => 'Cập nhật thành công'
        ]);
    }

    public function timeworkUser($id_division) {
        $divisionName = division::where('id', $id_division)->first()->name;

        // $user = User::where('division', $id_division)->get();

        $listtimedivision = checkUser::where('division', $id_division)->orderBy('datecheck', 'desc')->get();

        return response()->json([
            'divisionName' => $divisionName,
            'listtimedivision' => $listtimedivision
        ]);
    }

    public function addDivision(Request $request) {
        $division = new division;

        $division->name = $request->divisionName;

        $division->save();

        return response()->json([
            'message' => 'Thêm phòng ban thành công'
        ]);
    }

    public function addPermission(Request $request) {
        $permission = new permission;

        $permission->name = $request->permissionName;
        $permission->path = $request->path;
        $permission->save();

        return response()->json([
            'message' => 'Thêm quyền thành công'
        ]);
    }

    public function addPosition(Request $request) {
        $position = new postion;

        $position->name = $request->positionName;
        $position->id_role = 1;
        $position->save();

        return response()->json([
            'message' => 'Thêm mới chức vụ thành công'
        ]);
    }
}
