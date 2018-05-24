<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index()
    {
        $posts = [];

        return view('layouts.primary', [
            'page' => 'pages.main',
            'title' => 'Blogplace :: Блог Дмитрий Юрьев - PHP & JS разработчик, ментор, преподаватель',
            'content' => '',
            'activeMenu' => 'main',
            'posts' => $posts
        ]);
    }

    public function about()
    {
        return view('layouts.primary', [
            'page' => 'pages.about',
            'title' => 'Обо мне',
            'content' => '<p>Привет, меня зовут Дмитрий Юрьев и я веб разработчик!</p>',
            'image' => [
                'path' => 'assets/images/Me.jpg',
                'alt' => 'Image'
            ],
            'activeMenu' => 'about',
        ]);
    }

    public function feedback()
    {
        return view('layouts.primary', [
            'page' => 'pages.feedback',
            'title' => 'Написать мне',
            'content' => '',
            'activeMenu' => 'feedback',
        ]);
    }

    public function db()
    {
        $users = DB::table('users')
            ->where('id', '2')
            ->Where('name', 'Vasya')
            ->select('name', 'email as user_email')
            ->get(/*['name', 'email']*/);
            //->count();
            //->exists();

        /*foreach ($users as $user) {
            echo $user->name . ' - ' .  $user->email, '<br>';
        }*/

        DB::table('users')
            ->where('id', 5)
            ->update([
                'name' => 'Ivan Ivanov',
                'password' => 999999
            ]);

        debug($users);
        //dump($users);

        /*$id = DB::table('users')->insertGetId([
            'email' => 'dima@asdaaa.ru',
            'name' => 'Dmitriy Yuriev',
            'password' => '123',
            'created_at' => '2018-05-24 23:18:00'
        ]);*/

        //dump($id);
        DB::table('users')
            ->delete();

        return 'DB';
    }
}
