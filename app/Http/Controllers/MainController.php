<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $user = [
            'data' => [
                'name' => 'Dmitrii',
                'surname' => 'Iurev',
            ]
        ];

        return $user;
    }

    public function about(Request $request, $id = null)
    {
        $a = $request->input('a');
        return view('about', ['id' => $id, 'a' => $a]);
    }
}
