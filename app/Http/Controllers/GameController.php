<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function updateScore(Request $request)
    {
        $user = Auth::user();

        $additionalScore = $request->correctCount * 10;

        $user->score = $user->score + $additionalScore;
        $user->save();

        return response()->json(['message' => 'Score updated successfully', 'newScore' => $user->score]);
    }

    public function updateStatus(Request $request)
    {
        $user = Auth::user();

        $user->status = 'Y';
        $user->save();

        return response()->json(['message' => 'Status updated successfully']);
    }

    public function showLeaderboard()
    {
        $users = User::where('role', 'player')
            ->orderBy('score', 'desc')
            ->get();

        return view('leaderboard', ['users' => $users]);
    }
}
