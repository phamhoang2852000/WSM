<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Validator;
use App\Mail\ResetPasswordMailable;
use Dotenv\Validator as DotenvValidator;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use App\Http\Controllers\str_random;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Str;
use App\Models\RequestUser;
use App\Models\RequestType;
use App\Models\postion;
use App\Models\division;
use App\Models\checkUser;
class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function login(Request $request){
    	$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'dang nhap khong thanh cong'], 401);
        }

        return $this->createNewToken($token);
    }

    public function firstlogin(Request $request) {
        $id = auth()->user()->id;
        $user = User::find($id);


        if($request->newpassword != '') {
            $user->password = Hash::make($request->newpassword);
        }

        $user->firstlogin = 1;

        $user->save();

        return response()->json([
            'user' => $user,
            'message' => 'Đặt lại mật khẩu thành công'
        ]);
    }



    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function register(RegisterRequest  $request) {

        $json_permission = "";
        $array_permission = array();

        $permission = $request->permission;
        foreach($permission as $per) {
            $array_permission[] = $per;
        }
        $json_permission = json_encode($array_permission, JSON_FORCE_OBJECT);

        $user = new User;
        $user->email = $request->email;
        $user->fullname = $request->fullname;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->phonenumber = $request->phonenumber;
        $user->division = $request->division;
        $user->position = postion::where('id',$request->position)->first()->name;
        $user->sex = (int)$request->sex;
        // $user->id_leader = (int)$request->id_leader;
        $user->date_of_birth = $request->date_of_birth;
        $user->permission = $json_permission;
        $user->save();

        return response()->json($user);
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        // auth()->logout();

        // return response()->json(['message' => 'User successfully signed out']);
        Auth::logout();
        return response()->json(true, 200);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile() {
        // $permission = json_decode(auth()->user()->permission, true);
        return response()->json(auth()->user(), );

    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }

    public function guard()
    {
        return Auth::guard();
    }

    public function updateUser(Request $request) {
        $id = auth()->user()->id;
        $user = User::find($id);
        $avatarName = "";
        // $random = Str::random(5);

        if($request->hasFile('avatar')) {
            $avatar = request()->file('avatar');
            var_dump($avatar);
            $avatarName = $avatar->getClientOriginalName();
            $avatarName = time().'_'.$avatarName;

            $avatar->move(public_path('../../../../frontend/static/image/'), $avatarName);
        }
        $user->fullname = $request->fullname;
        $user->address = $request->address;
        $user->phonenumber = $request->phonenumber;
        $user->avatar = $avatarName;
        $user->save();
        return response()->json([
            'hinh' => $user->avatar,
            'user' => $user,
            'message' => 'Cập nhật thành công'
        ]);
    }

    public function addRequest(Request $request) {
        $requestUser = new RequestUser;

        $requestUser->id_user = User::where('id',auth()->user()->id)->first()->fullname;
        $requestUser->id_requesttype = RequestType::where('id', $request->requestType)->first()->name;
        $requestUser->tinh_trang = 0;
        $requestUser->time_under = $request->time_under;
        $requestUser->time_on = $request->time_on;
        $requestUser->description = $request->description;

        $requestUser->save();
        return response()->json([
            'mesage' => 'Thêm yêu cầu thành công.Đợi phê duyệt từ quản trị viên'
        ]);
    }

    public function acceptRequest() {
        $acceptRequest = RequestUser::where([
            ['id_user', auth()->user()->fullname],
            ['tinh_trang', 1]
        ])->get();

        return $acceptRequest;
    }

    public function awitRequest() {
        $awitRequest = RequestUser::where([
            ['id_user', auth()->user()->fullname],
            ['tinh_trang', 0]
        ])->get();

        return $awitRequest;
    }

    public function unacceptRequest() {
        $unacceptRequest = RequestUser::where([
            ['id_user', auth()->user()->fullname],
            ['tinh_trang', 2]
        ])->get();

        return $unacceptRequest;
    }

    public function checkin(Request $request) {
        $id = auth()->user()->id;
        $check = new checkUser;

        $check->user = auth()->user()->fullname;
        $check->id_user = $id;
        $check->date = $request->datecheck;
        $check->start_time = $request->start_time;

        $check->save();

        return response()->json([
            'message' => 'Checkin thành công',
            'checkin' => $check
        ]);
    }

    public function checkout(Request $request) {
        $id = auth()->user()->id;
        $date = $request->datecheck;

        $check = checkUser::where([
            ['id_user', $id],
            ['date', $date]
        ])->first();


        $check->end_time = $request->end_time;

        $check->save();

        return response()->json([
            'message' => 'Checkout thành công',
            'checkout' => $check
        ]);
    }

    public function showcheck(Request $request) {
        $check = checkUser::where('id_user', auth()->user()->id)->get();

        return response()->json([
            'check' => $check
        ]);
    }

}
