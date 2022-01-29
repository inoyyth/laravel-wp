<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Automattic\WooCommerce\Client;

class HomepageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts =  json_decode(Http::get('http://wordpress/index.php/wp-json/wp/v2/posts/')->body());
        $woocommerce = new Client(
            'http://localhost:8000',
            'ck_c7ee1e7ed5a00cf190b13dddfd65fb418f7d9405',
            'cs_256d1fbd6ef4fb8a9460fb8a4b405e4a6a3248b7',
            [
                'wp_api' => true,
                'version' => 'wc/v3',
                'query_string_auth' => true, // Force Basic Authentication as query string true and using under HTTPS
                'verify_ssl' => false
            ]
        );

        $dt = $woocommerce->get('products/categories');
        $request_slider =  json_decode(Http::get('http://wordpress/index.php/wp-json/wp/v2/announcements/?slug=home-page-slider')->body());
        $slider = $request_slider[0]->acf->announcement_slider;

        return view('pages.homepage.main', compact('dt', 'slider'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
