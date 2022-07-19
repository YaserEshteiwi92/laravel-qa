<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index($id)
    {
        $questions = Question::without('answers')->where('user_id', $id)->get();
        $user = User::find($id);

        return view('profile.index', compact('questions', 'user'));
    }
}
