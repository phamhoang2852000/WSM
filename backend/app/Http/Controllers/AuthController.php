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

    public function forgot(Request $request) {
       $request->validate([
            'email' => 'required|email'
       ]);

       $user = User::where('email', $request->email)->first();
       if(!$user) {
           return response()->json(['error' => 'Khong thay email'], 401);
       }
       else {
        return response()->json($user);
       }


    }

    public function reset() {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|confirmed|min:6',
            'confirm_password' => 'required| min:6'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create(array_merge(
                    $validator->validated(),
                    ['password' => Hash::make($request->password)]
                ));

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }
    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function register(RegisterRequest $request) {


        $user = new User;
        $user->email = $request->email;
        $user->fullname = $request->fullname;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->phonenumber = $request->phonenumber;
        // $user->division = division::where('id',$request->division)->first()->name;
        $user->division = $request->division;
        $user->position = postion::where('id',$request->position)->first()->name;
        $user->sex = (int)$request->sex;
        // $user->id_leader = (int)$request->id_leader;
        $user->date_of_birth = $request->date_of_birth;
        // $user->permission = $request->permission;
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
        return response()->json(auth()->user());

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
        $random = Str::random(5);

        // if (request()->hasFile('avatar')){
        //     $file = $request->file('avatar');
        //     var_dump($file);
        //     $exten = $file->getClientOriginalExtension();
        //     if($exten != 'jpg' && $exten != 'png' && $exten !='jpeg' && $exten != 'JPG' && $exten != 'PNG' && $exten !='JPEG' )
        //         return response()->json(['message' => 'Đây không phải file ảnh']);
        //     $Hinh = "avatar-" . Str::random(5) . "-" . $file->getClientOriginalName();
        //     while (file_exists('../../../../frontend/static/image/'.$Hinh)) {
        //          $Hinh = "avatar-" . $random . "-" . $file->getClientOriginalName();
        //     }
        //     if(file_exists($Hinh))
        //        unlink($Hinh);

        //     $file->move('../../../../frontend/static/image/',$Hinh);
        //     // $user->avatar = $Hinh;
        //     $json_img =  json_encode($Hinh, JSON_FORCE_OBJECT);
        // }
        // else {
        //     $arr_images = "no_avatar.jpg";
        //     $json_img = json_encode($arr_images, JSON_FORCE_OBJECT);
        //  }
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

}
