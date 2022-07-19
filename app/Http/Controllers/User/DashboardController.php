<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $questions = Question::without('answers')->where('user_id', Auth::id())->latest()->paginate();

        return view('user.dashboard', compact('questions'));
    }
}
