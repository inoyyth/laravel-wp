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

    public function userLogout(Request $request)
    {
        $request->session()->forget(['user', 'token']);

        return redirect()->route('homepage.main');
    }
}
