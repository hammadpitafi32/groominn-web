<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $Listnotifications;
    public function __construct()
    {
        $this->middleware('auth');
        $this->Listnotifications = Notification::latest()->take(8)->get();

        View::share('Listnotifications', $this->Listnotifications);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
}
