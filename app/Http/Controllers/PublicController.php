<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Competition;
use App\Models\Discipline;
use App\Models\Result;
use App\Models\Athlete;
use App\Models\Team;

class PublicController extends Controller
{
    public function competitions(Request $request)
    {
        $query = Competition::with('school')
            ->where('status', 'scheduled')
            ->orWhere('status', 'completed');

        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('location', 'like', '%' . $request->search . '%')
                  ->orWhere('code', 'like', '%' . $request->search . '%');
            });
        }

        $competitions = $query->orderBy('start_date', 'desc')->paginate(12);
        
        return view('public.competitions.index', compact('competitions'));
    }

    public function competitionShow($code)
    {
        $competition = Competition::with(['school', 'disciplines.results.athlete.team'])
            ->where('code', $code)
            ->firstOrFail();

        $disciplines = $competition->disciplines()->with('results.athlete.team')->get();
        
        // Get all results for this competition
        $results = Result::with(['athlete.team', 'discipline'])
            ->whereHas('discipline', function($query) use ($competition) {
                $query->where('competition_id', $competition->id);
            })
            ->orderBy('rank')
            ->take(10)
            ->get();
        
        // Get participating teams
        $teams = Team::with('school')
            ->whereHas('athletes.results.discipline', function($query) use ($competition) {
                $query->where('competition_id', $competition->id);
            })
            ->distinct()
            ->get();
        
        return view('public.competitions.show', compact('competition', 'disciplines', 'results', 'teams'));
    }

    public function athleteShow(Athlete $athlete)
    {
        $athlete->load(['team.school', 'results.discipline.competition']);
        
        return view('public.athletes.show', compact('athlete'));
    }

    public function teamsIndex()
    {
        $teams = Team::with(['school', 'athletes'])->paginate(12);
        
        return view('public.teams.index', compact('teams'));
    }

    public function teamShow(Team $team)
    {
        $team->load(['school', 'athletes.results']);
        
        return view('public.teams.show', compact('team'));
    }

    public function disciplineResults($id)
    {
        $discipline = Discipline::with(['competition', 'results.athlete'])
            ->findOrFail($id);
        
        $results = $discipline->results()
            ->with('athlete')
            ->orderBy('rank')
            ->get();
        
        return view('public.disciplines.results', compact('discipline', 'results'));
    }
}
