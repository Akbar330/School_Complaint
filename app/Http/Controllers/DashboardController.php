<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $total = $user->complaints()->count();
        $pending = $user->complaints()->where('status','pending')->count();
        $resolved = $user->complaints()->where('status','done')->count();

        return view('dashboard', compact('total','pending','resolved'));
    }
}