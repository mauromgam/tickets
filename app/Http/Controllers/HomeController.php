<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;

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
     * Render the list of relationships
     *
     * @return Renderable
     */
    public function index()
    {
        /** @var User $user */
        $user    = auth()->user();
        $tickets = $user->tickets;

        return view('home', compact('tickets'));
    }
}
