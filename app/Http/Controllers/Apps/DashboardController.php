<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $count_user = User::count();

        $absens = Absensi::when(request()->r, function($absens) {
            $absens = $absens->where('name', 'like', '%'. request()->r . '%');
            })->whereDate('created_at', Carbon::today())->with('user')->latest()->paginate(5);

        // dd($count_user);

        return Inertia::render('Apps/Dashboard/Index', [
            'count_user' => $count_user,
            'absen_today'=> $absens
        ]);

        
    }
}
