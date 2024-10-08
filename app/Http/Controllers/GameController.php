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

    public function saveTime(Request $request)
    {
        $user = Auth::user();

        $user->time = gmdate("H:i:s", $request->time);
        $user->save();

        return response()->json(['message' => 'Time saved successfully', 'time' => $user->time]);
    }

    public function showLeaderboard()
    {
        $users = User::orderBy('score', 'desc')->orderBy('time', 'asc')->get();

        return view('leaderboard', ['users' => $users]);
    }
}
