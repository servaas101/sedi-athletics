<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\DisciplineController;

Route::get('/', function () {
    $upcomingCompetitions = \App\Models\Competition::with('school')
        ->where('start_date', '>=', now())
        ->orderBy('start_date')
        ->take(3)
        ->get();
    
    $latestResults = \App\Models\Result::with(['athlete.team', 'discipline.competition'])
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();
    
    return view('welcome', compact('upcomingCompetitions', 'latestResults'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:super_admin'])->prefix('hub')->name('hub.')->group(function () {
    Route::get('/dashboard', [SuperAdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('schools', SuperAdminController::class)->except(['show']);
});

Route::middleware(['auth', 'role:school_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('teams', [AdminController::class, 'indexTeams'])->name('teams.index');
    Route::get('teams/create', [AdminController::class, 'createTeam'])->name('teams.create');
    Route::post('teams', [AdminController::class, 'storeTeam'])->name('teams.store');
    Route::get('teams/{team}/edit', [AdminController::class, 'editTeam'])->name('teams.edit');
    Route::put('teams/{team}', [AdminController::class, 'updateTeam'])->name('teams.update');
    Route::delete('teams/{team}', [AdminController::class, 'destroyTeam'])->name('teams.destroy');

    Route::get('athletes', [AdminController::class, 'indexAthletes'])->name('athletes.index');
    Route::get('athletes/create', [AdminController::class, 'createAthlete'])->name('athletes.create');
    Route::post('athletes', [AdminController::class, 'storeAthlete'])->name('athletes.store');
    Route::get('athletes/{athlete}/edit', [AdminController::class, 'editAthlete'])->name('athletes.edit');
    Route::put('athletes/{athlete}', [AdminController::class, 'updateAthlete'])->name('athletes.update');
    Route::delete('athletes/{athlete}', [AdminController::class, 'destroyAthlete'])->name('athletes.destroy');

    Route::get('competitions', [AdminController::class, 'indexCompetitions'])->name('competitions.index');
    Route::get('competitions/create', [AdminController::class, 'createCompetition'])->name('competitions.create');
    Route::post('competitions', [AdminController::class, 'storeCompetition'])->name('competitions.store');
    Route::get('competitions/{competition}/edit', [AdminController::class, 'editCompetition'])->name('competitions.edit');
    Route::put('competitions/{competition}', [AdminController::class, 'updateCompetition'])->name('competitions.update');
    Route::delete('competitions/{competition}', [AdminController::class, 'destroyCompetition'])->name('competitions.destroy');

    Route::get('disciplines', [AdminController::class, 'indexDisciplines'])->name('disciplines.index');
    Route::get('disciplines/create', [AdminController::class, 'createDiscipline'])->name('disciplines.create');
    Route::post('disciplines', [AdminController::class, 'storeDiscipline'])->name('disciplines.store');
    Route::get('disciplines/{discipline}/edit', [AdminController::class, 'editDiscipline'])->name('disciplines.edit');
    Route::put('disciplines/{discipline}', [AdminController::class, 'updateDiscipline'])->name('disciplines.update');
    Route::delete('disciplines/{discipline}', [AdminController::class, 'destroyDiscipline'])->name('disciplines.destroy');

    Route::get('results', [AdminController::class, 'indexResults'])->name('results.index');
    Route::get('results/create', [AdminController::class, 'createResult'])->name('results.create');
    Route::post('results', [AdminController::class, 'storeResult'])->name('results.store');
    Route::get('results/{result}/edit', [AdminController::class, 'editResult'])->name('results.edit');
    Route::put('results/{result}', [AdminController::class, 'updateResult'])->name('results.update');
    Route::delete('results/{result}', [AdminController::class, 'destroyResult'])->name('results.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Public routes
Route::get('/competitions', [App\Http\Controllers\PublicController::class, 'competitions'])->name('public.competitions.index');
Route::get('/competitions/{code}', [App\Http\Controllers\PublicController::class, 'competitionShow'])->name('public.competitions.show');
Route::get('/disciplines/{id}/results', [App\Http\Controllers\PublicController::class, 'disciplineResults'])->name('public.disciplines.results');
Route::get('/athletes/{athlete}', [App\Http\Controllers\PublicController::class, 'athleteShow'])->name('public.athletes.show');
Route::get('/teams', [App\Http\Controllers\PublicController::class, 'teamsIndex'])->name('public.teams.index');
Route::get('/teams/{team}', [App\Http\Controllers\PublicController::class, 'teamShow'])->name('public.teams.show');

// Legacy route aliases for backward compatibility
Route::get('/competitions-legacy', [App\Http\Controllers\PublicController::class, 'competitions'])->name('competitions.index');
Route::get('/competitions-legacy/{code}', [App\Http\Controllers\PublicController::class, 'competitionShow'])->name('competitions.show');
Route::get('/athletes-legacy/{athlete}', [App\Http\Controllers\PublicController::class, 'athleteShow'])->name('athletes.show');
Route::get('/teams-legacy/{team}', [App\Http\Controllers\PublicController::class, 'teamShow'])->name('teams.show');

use App\Http\Controllers\HubController;

Route::middleware('auth')->group(function () {
    Route::get('/hub/schools', [HubController::class, 'schools'])->name('hub.schools');
    Route::get('/hub/meets', [HubController::class, 'meets'])->name('hub.meets');
});

require __DIR__.'/auth.php';
