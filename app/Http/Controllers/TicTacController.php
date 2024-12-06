<?php

namespace App\Http\Controllers;

use App\Events\GameJoined;
use App\Models\TicTacToe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TicTacController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return inertia('TicTacToe', [
            'rooms' => TicTacToe::with('playerOne')
                        ->where(function ($q) use($request) {
                            $q->whereNull('player_two_id')
                                ->orWhere('player_two_id', $request->user()->id);
                        })
                        ->orWhere('player_one_id', $request->user()->id)
                        ->oldest()
                        ->simplePaginate(100)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tic_tac_toe = TicTacToe::create([
            'player_one_id' => $request->user()->id
        ]);

        return to_route('games.tic-tac-toe.show', $tic_tac_toe);
    }

    /**
     * Display the specified resource.
     */
    public function show(TicTacToe $tic_tac_toe)
    {
        $tic_tac_toe->load(['playerOne', 'playerTwo']);
        return inertia('Games/TicTacToe/Show', compact('tic_tac_toe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TicTacToe $tic_tac_toe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TicTacToe $tic_tac_toe)
    {
        $data = $request->validate([
            'state' => ['required', 'array', 'size:9'],
            'state.*' => ['integer', 'between:-1,1']
        ]);

        $tic_tac_toe->update($data);

        return to_route('games.tic-tac-toe.show', $tic_tac_toe);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TicTacToe $tic_tac_toe)
    {
        //
    }

    public function join(Request $request, TicTacToe $tic_tac_toe)
    {
        Gate::authorize('join', $tic_tac_toe);
    
        $tic_tac_toe->update([
            'player_two_id' => $request->user()->id
        ]);

        GameJoined::dispatch($tic_tac_toe);

        return to_route('games.tic-tac-toe.show', $tic_tac_toe);
    }

    public function rejoin(Request $request, TicTacToe $tic_tac_toe)
    {
        Gate::authorize('rejoin', $tic_tac_toe);

        return to_route('games.tic-tac-toe.show', $tic_tac_toe);
    }
}
