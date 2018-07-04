<?php namespace App\Http\Controllers;

use App\Events\FeedbackWasCreated;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function feedback(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50|min:2',
            'email' => 'required|max:255|email',
            'message' => 'required|max:10240|min:10',
        ]);

        event(
            new FeedbackWasCreated($request->all())
        );

        return response()
            ->json(['status' => 'OK']);
    }
}
