<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return inertia('Dashboard', [
            'games' => [
                [
                    'name' => 'Tic Tac Toe',
                    'route' => route('games.tic-tac-toe.index'),
                    'image' => asset('images/tic-tac-toe.jpg')
                ],
                [
                    'name' => 'Comming Soon',
                    'route' => '#',
                    'image' => asset('images/hangman.jpg')
                ],
            ]
        ]);
    }

}
