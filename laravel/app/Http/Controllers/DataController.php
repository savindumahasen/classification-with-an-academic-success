<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\login;


class DataController extends Controller
{
    public function showData()
    {
        // Read the JSON file from storage/app directory
        $json = Storage::get('data.json');

        // Decode the JSON data into a PHP array
        $data = json_decode($json, true);

        // You can now use $data for further processing or return it as a response
        return response()->json($data);
    }

    public function login()
    {
        return view('login');
    }


    public function showlogindetails(){
        $data =login::all();
        dd($data);

    }

    public function logincredentials(Request $request){

        dd($request);

    }
}
