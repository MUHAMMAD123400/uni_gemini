<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GeminiAPI\Laravel\Facades\Gemini;

class test extends Controller
{
    //
    public function send_request(Request $request)
    {
        $data = Gemini::generateText($request->data);
        // dd($data);
        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
        // print Gemini::generateText("i'm ill suggest me some treatment");
    }
    public function test()
    {
        print_r(Gemini::generateText("i'm ill suggest me some treatment"));
        // print Gemini::generateText("i'm ill suggest me some treatment");
    }

    public function image()
    {
        print Gemini::generateTextUsingImageFile(
            'image/jpeg',
            'elephpant.jpg',
            'Explain what is in the image',
        );
    }
}
