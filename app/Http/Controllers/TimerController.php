<?php

namespace App\Http\Controllers;

use App\Models\Timer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TimerController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard', [
            'canLogin' => false,
            'canRegister' => false,
            'timers' => Auth::user()->timers()->get(),
        ]);
    }

    public function create()
    {

    }

    public function store()
    {
        Timer::create(request()->validate([
            'name' => 'required',
            'sets' => 'required',
            'rest' => 'required',
            'duration' => 'required',
        ]) + ['user_id' => Auth::user()->id]);
        return redirect('/dashboard')->withSuccess('Timer Saved');
    }

    public function update(Timer $timer)
    {
        $timer->update(request()->validate([
            'sets' => 'required',
            'rest' => 'required',
            'duration' => 'required',
        ]));
        return redirect('/dashboard')->withSuccess('Timer Updated');
    }

    public function destroy(Timer $timer)
    {   
        Timer::find($timer->id)->delete();
        return redirect('/dashboard')->withSuccess('Timer Deleted');
    }
}
