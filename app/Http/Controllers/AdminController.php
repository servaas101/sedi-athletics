<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Athlete;
use App\Models\Competition;
use App\Models\Discipline;
use App\Models\Result;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $schoolId = $user->school_id;

        $teamsCount = Team::where('school_id', $schoolId)->count();
        $athletesCount = Athlete::whereHas('team', function ($query) use ($schoolId) {
            $query->where('school_id', $schoolId);
        })->count();
        $competitionsCount = Competition::where('school_id', $schoolId)->count();
        $disciplinesCount = Discipline::whereHas('competition', function ($query) use ($schoolId) {
            $query->where('school_id', $schoolId);
        })->count();
        $resultsCount = Result::whereHas('event', function ($query) use ($schoolId) {
            $query->whereHas('meet', function ($query) use ($schoolId) {
                $query->where('school_id', $schoolId);
            });
        })->count();

        return view('admin.dashboard', compact('teamsCount', 'athletesCount', 'competitionsCount', 'disciplinesCount', 'resultsCount'));
    }

    // Teams
    public function indexTeams()
    {
        $user = auth()->user();
        $schoolId = $user->school_id;
        $teams = Team::where('school_id', $schoolId)->get();
        return view('admin.teams.index', compact('teams'));
    }

    public function createTeam()
    {
        return view('admin.teams.create');
    }

    public function storeTeam(Request $request)
    {
        $user = auth()->user();
        $schoolId = $user->school_id;

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Team::create(array_merge($request->all(), ['school_id' => $schoolId]));
        return redirect()->route('admin.teams.index')->with('success', 'Team created successfully.');
    }

    public function editTeam(Team $team)
    {
        return view('admin.teams.edit', compact('team'));
    }

    public function updateTeam(Request $request, Team $team)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $team->update($request->all());
        return redirect()->route('admin.teams.index')->with('success', 'Team updated successfully.');
    }

    public function destroyTeam(Team $team)
    {
        $team->delete();
        return redirect()->route('admin.teams.index')->with('success', 'Team deleted successfully.');
    }

    // Athletes
    public function indexAthletes()
    {
        $user = auth()->user();
        $schoolId = $user->school_id;
        $athletes = Athlete::whereHas('team', function ($query) use ($schoolId) {
            $query->where('school_id', $schoolId);
        })->get();
        $teams = Team::where('school_id', $schoolId)->get();
        return view('admin.athletes.index', compact('athletes', 'teams'));
    }

    public function createAthlete()
    {
        $user = auth()->user();
        $schoolId = $user->school_id;
        $teams = Team::where('school_id', $schoolId)->get();
        return view('admin.athletes.create', compact('teams'));
    }

    public function storeAthlete(Request $request)
    {
        $request->validate([
            'team_id' => 'required|exists:teams,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string|in:male,female',
            'dob' => 'required|date',
            'photo_url' => 'nullable|url',
        ]);

        Athlete::create($request->all());
        return redirect()->route('admin.athletes.index')->with('success', 'Athlete created successfully.');
    }

    public function editAthlete(Athlete $athlete)
    {
        $user = auth()->user();
        $schoolId = $user->school_id;
        $teams = Team::where('school_id', $schoolId)->get();
        return view('admin.athletes.edit', compact('athlete', 'teams'));
    }

    public function updateAthlete(Request $request, Athlete $athlete)
    {
        $request->validate([
            'team_id' => 'required|exists:teams,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string|in:male,female',
            'dob' => 'required|date',
            'photo_url' => 'nullable|url',
        ]);

        $athlete->update($request->all());
        return redirect()->route('admin.athletes.index')->with('success', 'Athlete updated successfully.');
    }

    public function destroyAthlete(Athlete $athlete)
    {
        $athlete->delete();
        return redirect()->route('admin.athletes.index')->with('success', 'Athlete deleted successfully.');
    }

    // Competitions
    public function indexCompetitions()
    {
        $user = auth()->user();
        $schoolId = $user->school_id;
        $competitions = Competition::where('school_id', $schoolId)->get();
        return view('admin.competitions.index', compact('competitions'));
    }

    public function createCompetition()
    {
        return view('admin.competitions.create');
    }

    public function storeCompetition(Request $request)
    {
        $user = auth()->user();
        $schoolId = $user->school_id;

        $request->validate([
            'code' => 'required|string|max:255|unique:competitions',
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string',
        ]);

        Competition::create(array_merge($request->all(), ['school_id' => $schoolId]));
        return redirect()->route('admin.competitions.index')->with('success', 'Competition created successfully.');
    }

    public function editCompetition(Competition $competition)
    {
        return view('admin.competitions.edit', compact('competition'));
    }

    public function updateCompetition(Request $request, Competition $competition)
    {
        $request->validate([
            'code' => 'required|string|max:255|unique:competitions,code,' . $competition->id,
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string',
        ]);

        $competition->update($request->all());
        return redirect()->route('admin.competitions.index')->with('success', 'Competition updated successfully.');
    }

    public function destroyCompetition(Competition $competition)
    {
        $competition->delete();
        return redirect()->route('admin.competitions.index')->with('success', 'Competition deleted successfully.');
    }

    // Disciplines
    public function indexDisciplines()
    {
        $user = auth()->user();
        $schoolId = $user->school_id;
        $disciplines = Discipline::whereHas('competition', function ($query) use ($schoolId) {
            $query->where('school_id', $schoolId);
        })->get();
        $competitions = Competition::where('school_id', $schoolId)->get();
        return view('admin.disciplines.index', compact('disciplines', 'competitions'));
    }

    public function createDiscipline()
    {
        $user = auth()->user();
        $schoolId = $user->school_id;
        $competitions = Competition::where('school_id', $schoolId)->get();
        return view('admin.disciplines.create', compact('competitions'));
    }

    public function storeDiscipline(Request $request)
    {
        $request->validate([
            'competition_id' => 'required|exists:competitions,id',
            'gender' => 'required|string',
            'category' => 'required|string',
            'distance' => 'required|string',
            'round' => 'required|string',
            'heat_number' => 'required|integer',
            'scheduled_time' => 'required|date_format:H:i:s',
        ]);

        Discipline::create($request->all());
        return redirect()->route('admin.disciplines.index')->with('success', 'Discipline created successfully.');
    }

    public function editDiscipline(Discipline $discipline)
    {
        $user = auth()->user();
        $schoolId = $user->school_id;
        $competitions = Competition::where('school_id', $schoolId)->get();
        return view('admin.disciplines.edit', compact('discipline', 'competitions'));
    }

    public function updateDiscipline(Request $request, Discipline $discipline)
    {
        $request->validate([
            'competition_id' => 'required|exists:competitions,id',
            'gender' => 'required|string',
            'category' => 'required|string',
            'distance' => 'required|string',
            'round' => 'required|string',
            'heat_number' => 'required|integer',
            'scheduled_time' => 'required|date_format:H:i:s',
        ]);

        $discipline->update($request->all());
        return redirect()->route('admin.disciplines.index')->with('success', 'Discipline updated successfully.');
    }

    public function destroyDiscipline(Discipline $discipline)
    {
        $discipline->delete();
        return redirect()->route('admin.disciplines.index')->with('success', 'Discipline deleted successfully.');
    }

    // Results
    public function indexResults()
    {
        $user = auth()->user();
        $schoolId = $user->school_id;
        $results = Result::whereHas('discipline', function ($query) use ($schoolId) {
            $query->whereHas('competition', function ($query) use ($schoolId) {
                $query->where('school_id', $schoolId);
            });
        })->get();
        $disciplines = Discipline::whereHas('competition', function ($query) use ($schoolId) {
            $query->where('school_id', $schoolId);
        })->get();
        $athletes = Athlete::whereHas('team', function ($query) use ($schoolId) {
            $query->where('school_id', $schoolId);
        })->get();
        return view('admin.results.index', compact('results', 'disciplines', 'athletes'));
    }

    public function createResult()
    {
        $user = auth()->user();
        $schoolId = $user->school_id;
        $disciplines = Discipline::whereHas('competition', function ($query) use ($schoolId) {
            $query->where('school_id', $schoolId);
        })->get();
        $athletes = Athlete::whereHas('team', function ($query) use ($schoolId) {
            $query->where('school_id', $schoolId);
        })->get();
        return view('admin.results.create', compact('disciplines', 'athletes'));
    }

    public function storeResult(Request $request)
    {
        $request->validate([
            'discipline_id' => 'required|exists:disciplines,id',
            'athlete_id' => 'required|exists:athletes,id',
            'rank' => 'required|integer',
            'time' => 'required|string',
            'points' => 'required|integer',
            'recorded_at' => 'required|date',
        ]);

        Result::create($request->all());
        return redirect()->route('admin.results.index')->with('success', 'Result created successfully.');
    }

    public function editResult(Result $result)
    {
        $user = auth()->user();
        $schoolId = $user->school_id;
        $disciplines = Discipline::whereHas('competition', function ($query) use ($schoolId) {
            $query->where('school_id', $schoolId);
        })->get();
        $athletes = Athlete::whereHas('team', function ($query) use ($schoolId) {
            $query->where('school_id', $schoolId);
        })->get();
        return view('admin.results.edit', compact('result', 'disciplines', 'athletes'));
    }

    public function updateResult(Request $request, Result $result)
    {
        $request->validate([
            'discipline_id' => 'required|exists:disciplines,id',
            'athlete_id' => 'required|exists:athletes,id',
            'rank' => 'required|integer',
            'time' => 'required|string',
            'points' => 'required|integer',
            'recorded_at' => 'required|date',
        ]);

        $result->update($request->all());
        return redirect()->route('admin.results.index')->with('success', 'Result updated successfully.');
    }

    public function destroyResult(Result $result)
    {
        $result->delete();
        return redirect()->route('admin.results.index')->with('success', 'Result deleted successfully.');
    }
}
