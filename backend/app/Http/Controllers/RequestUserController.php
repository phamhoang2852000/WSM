<?php

namespace App\Http\Controllers;
use App\Models\RequestType;
use App\Models\RequestUser;
use Illuminate\Http\Request;
use App\Models\User;
class RequestUserController extends Controller
{
    public function requestType() {
        $requestType = RequestType::all();
        return $requestType;
    }

    public function listRequest() {
        $listRequest = RequestUser::where('tinh_trang', 0)->get();
        return $listRequest;

    }

    public function approveRequest(Request $request) {
        $id = $request->id_request;
        $approve = RequestUser::find($id);

        $approve->id_approve = User::where('id', $request->id_approve)->first()->fullname;
        $approve->tinh_trang = 1;

        $approve->save();

        return response()->json([
            'mesage' => 'Phê duyệt thành công. Bạn reload lại trang',
        ]);
    }

    public function unapproveRequest(Request $request) {
        $id = $request->id_request;
        $approve = RequestUser::find($id);

        $approve->id_approve = User::where('id', $request->id_approve)->first()->fullname;
        $approve->tinh_trang = 2;

        $approve->save();

        return response()->json([
            'mesage' => 'Từ chối thành công. Bạn reload lại trang',
        ]);
    }

}
