<?php namespace App\Http\Controllers;

use App\Events\FeedbackWasCreated;
use App\Mail\FeedbackMail;
use App\Models\Page;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class MainController extends Controller
{
    public function index()
    {
        $posts = Cache::remember('mainPostLists', 30, function () {
            return Post::with(['comments', 'sections'])
                ->active()
                ->intime()
                ->orderBy('id', 'DESC')
                ->get();
        });

        return view('layouts.primary', [
            'page' => 'pages.main',
            'title' => 'Blogplace :: Блог Дмитрий Юрьев - PHP & JS разработчик, ментор, преподаватель',
            'content' => '<p>Привет, меня зовут Дмитрий Юрьев и я веб разработчик!</p>',
            'image' => [
                'path' => 'assets/images/Me.jpg',
                'alt' => 'Image'
            ],
            'activeMenu' => 'main',
            'posts' => $posts,
        ]);
    }

    public function about()
    {
        return view('layouts.primary', [
            'page' => 'pages.about',
            'title' => 'Обо мне',
            'content' => Page::find(1)->content,
            /*'image' => [
                'path' => 'assets/images/Me.jpg',
                'alt' => 'Image'
            ],*/
            'activeMenu' => 'about',
        ]);
    }

    public function feedback()
    {
        return view('layouts.primary', [
            'page' => 'pages.feedback',
            'title' => 'Написать мне',
            'activeMenu' => 'feedback',
        ]);
    }

    public function feedback2()
    {
        return view('layouts.primary', [
            'page' => 'pages.feedback2',
            'title' => 'Написать мне',
            'activeMenu' => 'feedback',
        ]);
    }

    public function feedbackPost(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50|min:2',
            'email' => 'required|max:255|email',
            'message' => 'required|max:10240|min:1',
        ]);

        event(
            new FeedbackWasCreated($request->all())
        );

        /*Mail::to(env('MAIL_TO'))
            ->send(new FeedbackMail($request->all())
        );*/

       /* Mail::raw('<h1>sdfsdf</h1>', function($message) {
            $message->from('no-reply@iurev.ru');
            $message->to('yurev@ntschool.ru');
            $message->setContentType('text/html');
            $message->subject('Письмо с блога');
        });*/

        return view('layouts.primary', [
            'page' => 'parts.blank',
            'title' => 'Сообщение отправлено!',
            'content' => 'Спасибо за ваше сообщение!',
            'link' => '<a href="javascript:history.back()">Вернуться назад</a>',
            'activeMenu' => 'feedback',
        ]);
    }

    public function ajaxSimple()
    {
        return view('layouts.primary', [
            'page' => 'pages.ajax',
            'title' => 'Ajax test',
        ]);
    }

    public function postAjaxSimple(Request $request)
    {
        $name = $request->input('name');
        $surname = $request->input('surname');
        $age = $request->input('age');

        //abort(500);

        return view('api.simple', [
            'name' => $name,
            'surname' => $surname,
            'age' => $age,
        ]);
    }
}
