<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Challenge;
use App\Batch;
use Carbon\Carbon;

class LandingController extends Controller
{
    /**
     * Display the landing page with upcoming challenges
     */
    public function index()
    {
        // Get challenges that have batches starting after 2 days
        $upcomingChallenges = Challenge::with(['batches' => function($query) {
            $query->where('start_date', '>=', Carbon::now()->addDays(2)->toDateString())
                  ->where('status', 'active')
                  ->orderBy('start_date', 'asc');
        }])
        ->whereHas('batches', function($query) {
            $query->where('start_date', '>=', Carbon::now()->addDays(2)->toDateString())
                  ->where('status', 'active');
        })
        ->where('status', 'active')
        ->limit(6) // Limit to 6 challenges for the landing page
        ->get();

        return view('landing.index', compact('upcomingChallenges'));
    }

    /**
     * Display all available challenges with their batches
     */
    public function challenges()
    {
        // Get all active challenges with their batches
        $challenges = Challenge::with(['batches' => function($query) {
            $query->where('start_date', '>=', Carbon::now()->addDays(2)->toDateString())
                  ->where('status', 'active')
                  ->orderBy('start_date', 'asc');
        }])
        ->where('status', 'active')
        ->orderBy('created_at', 'desc')
        ->get();

        return view('landing.challenges', compact('challenges'));
    }
}
