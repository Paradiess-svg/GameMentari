<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'player')
            ->orderBy('score', 'desc')
            ->get();

        return view('admin/dashboard', ['users' => $users]);
    }

    public function destroy($id): RedirectResponse
    {
        $users = User::findOrFail($id);
        $users->delete();

        return redirect()->route('admin-dashboard')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
