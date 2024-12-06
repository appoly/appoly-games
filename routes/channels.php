<?php

use App\Models\TicTacToe;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('lobby', function (User $user) {
    return true;
});

Broadcast::channel('room.{tic_tac_toe}', function (User $user, TicTacToe $tic_tac_toe) {
    if(!in_array($user->id, [$tic_tac_toe->player_one_id, $tic_tac_toe->player_two_id])) {
        return false;
    }

    return ['id' => $user->id];
});