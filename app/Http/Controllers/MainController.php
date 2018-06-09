<?php namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Tag;
use App\Models\User;
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

    public function orm()
    {
        /*$customer = new Customer();
        $customer->name = 'Сидор';
        $customer->surname = 'Сидоров';
        $customer->patronymic = 'Сидорович';
        $customer->age = 40;
        $customer->birthdate = '1984-06-23';
        $customer->notes = 'sdfsdfsdf';
        $customer->save();

        $customer2 = new Customer();
        $customer2->name = 'Сидор1';
        $customer2->surname = 'Сидоров2';
        $customer2->patronymic = 'Сидорович3';
        $customer2->age = 44;
        $customer2->birthdate = '1984-06-23';
        $customer2->notes = 'sdfsdfsdf';
        $customer2->save();*/


        /*$customer = Customer::find(6);
        dump($customer->birthdate);*/

        /*$customers = Customer::all();


        foreach ($customers as $customer) {
            dump($customer);
            echo $customer->name . ' ' . $customer->surname, '<br>';
        }*/

        /*$customer = Customer::find(6);
        dump($customer);
        $customer->name = 'Петр';
        $customer->surname = 'Петров';
        $customer->patronymic = 'Петрович';
        $customer->save();
        dump($customer);*/

        /*$customers1 = DB::table('customers')
            ->where('name', '=', 'Ivan')
            ->first();

        $customers2 = Customer::where('name', '=', 'Ivan')
            ->first();

        dump($customers1->name, $customers2->name);

        $customers2->name = 'dsfsdf';
        $customers2->save();*/



        $newModel = Customer::create([
            'name' => 'Alfred',
            'surname' => 'Ivanov',
            'age' => 22,
            'birthdate' => '1990-01-30',
            'notes' => 'NTSchool student'
        ]);

        dump($newModel);



        return 'OK';
    }

    public function relations()
    {
        $content = '';

        /*$userModel = User::find(1);
        $userProfile = $userModel->profile;*/

        //dump($userModel, $userProfile);
        //dump($userProfile->name, $userProfile->birthdate);


        /*$user = Profile::where('name', 'Дмитрий Юрьев')
            ->first()
            ->user;

        echo $user->password;
        $user->password = '555555';
        $user->save();*/


        $postsByUser1 = User::find(1)
           ->posts;

        /*$postsByUser2 = Post::where('user_id', 1)
            ->get();

        $postsByUser3 = DB::table('posts')
            ->where('user_id', 1)
            ->get();*/

        //dump($postsByUser1, $postsByUser2, $postsByUser3);

        //dump($postsCollection);

        $author = Post::where('title', 'Post 3')
            ->first()
            ->user
            ->profile
            ->name;


        $tags = Post::where('slug', 'post_3')
            ->first()
            ->tags;

        //dump($tags);
        /*$tagsString = '';

        foreach ($tags as $tag) {
            $tagsString .= $tag->name . ', ';
        }

        dump(rtrim(trim($tagsString), ','));



        $posts1 = Post::has('tags')->get();
        $posts2 = Post::has('tags', '>=', 2)->get();
        dump($posts1, $posts2);


        dump(Post::doesntHave('tags')->get());*/



        /*$post = new Post([
            'title' => 'Post4.',
            'slug' => '444',
            'tagline' => '444444'
        ]);

        $user = User::find(1);
        $user->posts()->save($post);*/

        /*try {
            $postModel = Post::find(4);
            $postModel->tags()->attach([1,2]);
        } catch (\Exception $e) {
            echo 'Whoooops...';
        }*/

        User::where('popularity', '>', 100)
            ->where('is_active', 1)
            ->orderBy('popularity', 'DESC')
            ->get();



        User::popular()
            ->active()
            ->latest('popularity')
            ->get();






        Post::find(1)
            ->tags()
            ->sync([
                Tag::where('name', 'Новость')->first()->id,
                Tag::where('name', 'Статья')->first()->id
            ]);

/*return view('layouts.primary', [
    'page' => 'pages.main',
    'posts' => $postsByUser1,
    'author' => $author
]);*/


        return view('layouts.primary', [
            'page' => 'pages.test',
            'title' => 'Relations',
            'content' => $content,
            'activeMenu' => '',
        ]);
    }
}
