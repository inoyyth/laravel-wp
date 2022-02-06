<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\Services\CloudinaryStorage;
use App\Library\Services\Woocommerce;
use Illuminate\Support\Facades\Http;

/**
 * [Description CustomerController]
 * Author Inoy <supri170845@gmailcom>
 * since 2022.02.01
 */
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request
     * @return void
     */
    public function index(Request $request)
    {
        $session_user = $request->session()->get('user');
        $woocommerce = new Woocommerce();
        $user = $woocommerce->get('customers/' . $session_user->id);

        return view('pages.customer.main', compact('user'));
    }
    
    /**
     * updateProfilePicture: Update user profile picture
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
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
     * changePassword: change user password
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
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
    
    /**
     * updateProfile: update user profile
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
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
    
    /**
     * updateContact
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * [Description for getAddress]
     *
     * @param  \Illuminate\Http\Request
     * 
     * @return void
     * 
     */
    public function getAddress(Request $request)
    {
        $session_user = $request->session()->get('user');
        $auth_key = base64_encode(config('app.basic_auth_username') . ':' . config('app.basic_auth_password'));

        $response = Http::withHeaders(
            [
                'Authorization' => 'Basic ' . $auth_key,
            ])
            ->get(config('app.wp_api_url') . 'users/' . $session_user->id);

        $user = json_decode($response->body());

        return view('pages.customer.main', compact('user'));
    }

    /**
     * [Description for setDefaultAddress]
     *
     * @param  \Illuminate\Http\Request
     * @return void
     * 
     */
    public function setDefaultAddress(Request $request) {
        $session_user = $request->session()->get('user');
        $id = $request->id;
        $length = $request->data_length;
        $auth_key = base64_encode(config('app.basic_auth_username') . ':' . config('app.basic_auth_password'));
        $data = [];
        for ($i=0; $i < $length; $i++) {
            $data['customer_shipping_address_'.$i.'_customer_shipping_address_is_main_address'] = ($id == $i ? 1 : 0);
        }
        try {
            $response = Http::put(config('app.wp_api_inoy') . 'set-default-address/' . $session_user->id, $data);
            
            return response()->json([
                'message' => 'success'
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'message' => $e->message
            ],500);
        }
    }
}
