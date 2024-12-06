<?php

namespace App\Policies;

use App\Models\TicTacToe;
use App\Models\User;

class TicTacToePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TicTacToe $tic_tac_toe): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TicTacToe $tic_tac_toe): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TicTacToe $tic_tac_toe): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, TicTacToe $tic_tac_toe): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, TicTacToe $tic_tac_toe): bool
    {
        //
    }

    public function join(User $user, TicTacToe $tic_tac_toe): bool
    {
        return $tic_tac_toe->player_one_id !== $user->id && $tic_tac_toe->player_two_id === null;
    }

    public function rejoin(User $user, TicTacToe $tic_tac_toe) {
        return $tic_tac_toe->player_two_id === $user->id || $tic_tac_toe->player_one_id === $user->id;
    }
}