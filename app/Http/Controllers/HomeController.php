<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $view = view('home');
        $user = Auth::user();

        if ($user == null)
        {
            $view = 'You have to be logged in!';
        }
        else if ($user->hasRole('Student'))
        {
            $view = redirect()->route('student');
        }
        else if ($user->hasRole('Professor'))
        {
            $view = 'Professor view';
        }
        else if ($user->hasRole('Admin'))
        {
            $view = redirect()->route('admin');
        }

        return $view;
    }

}
