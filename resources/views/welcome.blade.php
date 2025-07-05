@extends('layouts.public')

@section('title', 'Home')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Welcome to Sedi Athletics</h1>
                <p class="lead mb-4">Your premier platform for managing athletics competitions, tracking results, and celebrating athletic excellence.</p>
                <div class="d-flex gap-3">
                    <a href="{{ route('public.competitions.index') }}" class="btn btn-light btn-lg">
                        <i class="fas fa-trophy"></i> View Competitions
                    </a>
                    @guest
                        <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-user-plus"></i> Join Now
                        </a>
                    @endguest
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <i class="fas fa-running fa-10x text-white opacity-75"></i>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-12">
                <h2 class="display-5 fw-bold">Why Choose Sedi Athletics?</h2>
                <p class="lead text-muted">Comprehensive athletics management made simple</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 text-center border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <i class="fas fa-trophy fa-3x text-primary"></i>
                        </div>
                        <h4>Competition Management</h4>
                        <p class="text-muted">Organize and manage athletics competitions with ease. Track events, schedules, and participants all in one place.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100 text-center border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <i class="fas fa-chart-line fa-3x text-success"></i>
                        </div>
                        <h4>Real-time Results</h4>
                        <p class="text-muted">Get instant access to competition results, rankings, and performance statistics as they happen.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100 text-center border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <i class="fas fa-users fa-3x text-info"></i>
                        </div>
                        <h4>Team & Athlete Tracking</h4>
                        <p class="text-muted">Manage teams, athletes, and their performance across multiple competitions and events.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Upcoming Competitions -->
@if($upcomingCompetitions && $upcomingCompetitions->count() > 0)
<section class="py-5 bg-light">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2 class="display-6 fw-bold">Upcoming Competitions</h2>
                <p class="lead text-muted">Don't miss these exciting upcoming events</p>
            </div>
        </div>
        
        <div class="row g-4">
            @foreach($upcomingCompetitions->take(3) as $competition)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="card-title mb-0">{{ $competition->name }}</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <i class="fas fa-map-marker-alt text-primary"></i> {{ $competition->location }}<br>
                                <i class="fas fa-calendar text-primary"></i> {{ \Carbon\Carbon::parse($competition->start_date)->format('M d, Y') }}<br>
                                <i class="fas fa-school text-primary"></i> {{ $competition->school->name }}
                            </p>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('public.competitions.show', $competition->code) }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-eye"></i> View Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ route('public.competitions.index') }}" class="btn btn-primary">
                <i class="fas fa-trophy"></i> View All Competitions
            </a>
        </div>
    </div>
</section>
@endif

<!-- Latest Results -->
@if($latestResults && $latestResults->count() > 0)
<section class="py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2 class="display-6 fw-bold">Latest Results</h2>
                <p class="lead text-muted">Recent competition highlights</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>Competition</th>
                                <th>Event</th>
                                <th>Athlete</th>
                                <th>Team</th>
                                <th>Rank</th>
                                <th>Time/Distance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($latestResults->take(5) as $result)
                                <tr>
                                    <td>
                                        <a href="{{ route('public.competitions.show', $result->discipline->competition->code) }}" class="text-decoration-none">
                                            {{ $result->discipline->competition->name }}
                                        </a>
                                    </td>
                                    <td>{{ $result->discipline->category }} - {{ $result->discipline->distance }}</td>
                                    <td>
                                        <a href="{{ route('public.athletes.show', $result->athlete->id) }}" class="text-decoration-none">
                                            {{ $result->athlete->first_name }} {{ $result->athlete->last_name }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('public.teams.show', $result->athlete->team->id) }}" class="text-decoration-none">
                                            {{ $result->athlete->team->name }}
                                        </a>
                                    </td>
                                    <td>
                                        @if($result->rank <= 3)
                                            <span class="badge 
                                                @if($result->rank == 1) bg-warning
                                                @elseif($result->rank == 2) bg-secondary
                                                @else bg-dark
                                                @endif">
                                                {{ $result->rank }}
                                            </span>
                                        @else
                                            {{ $result->rank }}
                                        @endif
                                    </td>
                                    <td>{{ $result->time ?? 'N/A' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Call to Action -->
@guest
<section class="py-5 bg-primary text-white">
    <div class="container text-center">
        <h2 class="display-6 fw-bold mb-4">Ready to Get Started?</h2>
        <p class="lead mb-4">Join our platform today and start managing your athletics competitions like a pro!</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('register') }}" class="btn btn-light btn-lg">
                <i class="fas fa-user-plus"></i> Create Account
            </a>
            <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg">
                <i class="fas fa-sign-in-alt"></i> Login
            </a>
        </div>
    </div>
</section>
@endguest
@endsection