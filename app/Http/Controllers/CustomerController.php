<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\Services\CloudinaryStorage;
use App\Library\Services\Woocommerce;
use Illuminate\Support\Facades\Http;

/**
 * [Description CustomerController]
 */
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $session_user = $request->session()->get('user');
        $woocommerce = new Woocommerce();
        $user = $woocommerce->get('customers/' . $session_user->id);

        return view('pages.customer.main', compact('user'));
    }

    public function updateProfilePicture(Request $request) {
        $image = $request->file('profileImage');
        $upload = CloudinaryStorage::upload($image->getRealPath(), $image->getClientOriginalName()); 
        $session_user = $request->session()->get('user');
        
        try {
            $update_image = Http::put(config('app.wp_api_inoy') . 'profile-picture/'.$session_user->id, array('image_url' => $upload));

            if ($update_image->status() == 200) {
                return response()->json([
                    'message' => 'success',
                    'data' => $update_image->json()
                ], 201);
            } else {
                return response()->json([
                    'message' => $update_image->json()
                ], $update_image->status());
            }

        } catch (Throwable $e) {
            return response()->json([
                'message' => $e->message
            ],500);
        }
    }
    
    /**
     * changePassword
     *
     * @param  mixed $request
     * @return json
     */
    public function changePassword(Request $request) {
        $session_user = $request->session()->get('user');
        $validator = \Validator::make($request->all(), [
            'password' => 'required|min:6'
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
            'password' => $request->password
        ];

        $auth_key = base64_encode(config('app.basic_auth_username') . ':' . config('app.basic_auth_password'));

        try {
            $response = Http::withHeaders(
                [
                    'Authorization' => 'Basic ' . $auth_key,
                ])
                ->post(config('app.wp_api_url') . 'users/' . $session_user->id , $params);

            if ($response->status() == 200) {
                return response()->json([
                    'message' => 'success'
                ], 200);
            } else {
                return response()->json([
                    'message' => $response->json()
                ], $register->status());
            }

        } catch (Throwable $e) {
            return response()->json([
                'message' => $e->message
            ],500);
        }
    }

    public function updateProfile(Request $request) {
        $session_user = $request->session()->get('user');
        $validator = \Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'birth_date' => 'required',
            'gender' => 'required'
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
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender
        ];

        $auth_key = base64_encode(config('app.basic_auth_username') . ':' . config('app.basic_auth_password'));

        try {
            $response = Http::withHeaders(
                [
                    'Authorization' => 'Basic ' . $auth_key,
                ])
                ->post(config('app.wp_api_url') . 'users/' . $session_user->id , $params);

            if ($response->status() == 200) {
                return response()->json([
                    'message' => 'success'
                ], 200);
            } else {
                return response()->json([
                    'message' => $response->json()
                ], $register->status());
            }

        } catch (Throwable $e) {
            return response()->json([
                'message' => $e->message
            ],500);
        }
    }

    public function updateContact(Request $request) {
        $session_user = $request->session()->get('user');
        $validator = \Validator::make($request->all(), [
            'phone_number' => 'required'
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
            'phone_number' => $request->phone_number,
        ];

        $auth_key = base64_encode(config('app.basic_auth_username') . ':' . config('app.basic_auth_password'));

        try {
            $response = Http::withHeaders(
                [
                    'Authorization' => 'Basic ' . $auth_key,
                ])
                ->post(config('app.wp_api_url') . 'users/' . $session_user->id , $params);

            if ($response->status() == 200) {
                return response()->json([
                    'message' => 'success'
                ], 200);
            } else {
                return response()->json([
                    'message' => $response->json()
                ], $register->status());
            }

        } catch (Throwable $e) {
            return response()->json([
                'message' => $e->message
            ],500);
        }
    }
}
