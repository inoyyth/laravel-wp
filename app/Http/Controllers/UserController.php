<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.user.login');
    }

    public function userValidate(Request $request) 
    {
        $email = $request->email;
        $password = $request->password;

        try {
            $login = Http::post(config('app.wp_api_auth') . 'token',
                [
                    'username' => $email,
                    'password' => $password
                ]
            );
  
            if ($login->status() == 200) {
                $key = config('app.jwt_key');
                $response = $login->json();
                $decoded = JWT::decode($response['token'], new Key($key, 'HS256'));

                $request->session()->put('token', $response['token']);
                $request->session()->put('user', $decoded->data->user);
                return response()->json([
                    'message' => 'success'
                ], 200);
            } else {
                return response()->json([
                    'message' => 'success'
                ], $login->status());
            }

        } catch (Throwable $e) {
            return response()->json([
                'message' => $e->message
            ],500);
        }
    }

    public function userRegister(Request $request)
    {
        return view('pages.user.register');
    }

    public function userRegisterValidate(Request $request) {
        $validator = \Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required:email',
            'password' => 'required|min:6',
            'first_name' => 'required',
            'last_name' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'errors'=>$validator->errors()->all()
                ], 
                422
            );
        }

        $params = [
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name
        ];

        $auth_key = base64_encode(config('app.basic_auth_username') . ':' . config('app.basic_auth_password'));

        try {
            $register = Http::withHeaders(
                [
                    'Authorization' => 'Basic ' . $auth_key,
                ])
                ->post(config('app.wp_api_url') . 'users', $params);

            if ($register->status() == 200) {
                return response()->json([
                    'message' => 'success'
                ], 200);
            } else {
                return response()->json([
                    'message' => $register->json()
                ], $register->status());
            }

        } catch (Throwable $e) {
            return response()->json([
                'message' => $e->message
            ],500);
        }
    }

    public function userLogout(Request $request)
    {
        $request->session()->forget(['user', 'token']);

        return redirect()->route('homepage.main');
    }
}
