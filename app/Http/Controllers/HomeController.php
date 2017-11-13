<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $role_id = DB::select('select role_id from role_user where user_id = ?',[$user_id = Auth::id()]);
        $user_role = DB::select('select name from roles where id = ?',[$role_id[0]->role_id]);

        return view('home')
            ->with('user_role',$user_role);

    }
}
