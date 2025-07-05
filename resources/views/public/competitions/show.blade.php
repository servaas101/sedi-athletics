@extends('layouts.public')

@section('title', $competition->name)

@section('content')
<div class="container mt-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('competitions.index') }}">Competitions</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $competition->name }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Competition Details -->
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h1 class="h3 mb-0">{{ $competition->name }}</h1>
                    <small>Competition Code: {{ $competition->code }}</small>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5><i class="fas fa-info-circle text-primary"></i> Competition Details</h5>
                            <ul class="list-unstyled">
                                <li><strong><i class="fas fa-map-marker-alt"></i> Location:</strong> {{ $competition->location }}</li>
                                <li><strong><i class="fas fa-school"></i> Organized by:</strong> {{ $competition->school->name }}</li>
                                <li><strong><i class="fas fa-calendar-start"></i> Start Date:</strong> {{ \Carbon\Carbon::parse($competition->start_date)->format('F d, Y') }}</li>
                                <li><strong><i class="fas fa-calendar-end"></i> End Date:</strong> {{ \Carbon\Carbon::parse($competition->end_date)->format('F d, Y') }}</li>
                                <li><strong><i class="fas fa-flag"></i> Status:</strong> 
                                    <span class="badge 
                                        @if($competition->status == 'scheduled') bg-warning text-dark
                                        @elseif($competition->status == 'completed') bg-success
                                        @else bg-secondary
                                        @endif">
                                        {{ ucfirst($competition->status) }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            @if($competition->description)
                                <h5><i class="fas fa-file-alt text-primary"></i> Description</h5>
                                <p class="text-muted">{{ $competition->description }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Disciplines Section -->
            @if($disciplines->count() > 0)
                <div class="card shadow-sm mt-4">
                    <div class="card-header">
                        <h4><i class="fas fa-running text-primary"></i> Disciplines ({{ $disciplines->count() }})</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Discipline</th>
                                        <th>Category</th>
                                        <th>Gender</th>
                                        <th>Distance</th>
                                        <th>Round</th>
                                        <th>Scheduled Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($disciplines as $discipline)
                                        <tr>
                                            <td>{{ $discipline->name }}</td>
                                            <td>{{ $discipline->category }}</td>
                                            <td>
                                                <span class="badge {{ $discipline->gender == 'male' ? 'bg-info' : 'bg-pink' }}">
                                                    {{ ucfirst($discipline->gender) }}
                                                </span>
                                            </td>
                                            <td>{{ $discipline->distance ?? 'N/A' }}</td>
                                            <td>{{ ucfirst($discipline->round ?? 'Final') }}</td>
                                            <td>
                                                @if($discipline->scheduled_time)
                                                    {{ \Carbon\Carbon::parse($discipline->scheduled_time)->format('M d, Y H:i') }}
                                                @else
                                                    <span class="text-muted">TBD</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Results Section -->
            @if($results->count() > 0)
                <div class="card shadow-sm mt-4">
                    <div class="card-header">
                        <h4><i class="fas fa-medal text-primary"></i> Latest Results ({{ $results->count() }})</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Rank</th>
                                        <th>Athlete</th>
                                        <th>Team</th>
                                        <th>Event</th>
                                        <th>Time/Distance</th>
                                        <th>Points</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($results as $result)
                                        <tr>
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
                                            <td>
                                                <a href="{{ route('athletes.show', $result->athlete->id) }}" class="text-decoration-none">
                                                    {{ $result->athlete->first_name }} {{ $result->athlete->last_name }}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('teams.show', $result->athlete->team->id) }}" class="text-decoration-none">
                                                    {{ $result->athlete->team->name }}
                                                </a>
                                            </td>
                                            <td>{{ $result->discipline->name }} - {{ $result->discipline->category }}</td>
                                            <td>{{ $result->time ?? 'N/A' }}</td>
                                            <td>{{ $result->points ?? 'N/A' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Quick Stats -->
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5><i class="fas fa-chart-bar text-primary"></i> Quick Stats</h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="border-end">
                                <h3 class="text-primary">{{ $disciplines->count() }}</h3>
                                <small class="text-muted">Disciplines</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <h3 class="text-success">{{ $results->count() }}</h3>
                            <small class="text-muted">Results</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Participating Teams -->
            @if($teams->count() > 0)
                <div class="card shadow-sm mt-4">
                    <div class="card-header">
                        <h5><i class="fas fa-users text-primary"></i> Participating Teams</h5>
                    </div>
                    <div class="card-body">
                        @foreach($teams as $team)
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <a href="{{ route('teams.show', $team->id) }}" class="text-decoration-none">
                                    <strong>{{ $team->name }}</strong>
                                </a>
                                <small class="text-muted">{{ $team->school->name }}</small>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Actions -->
            <div class="card shadow-sm mt-4">
                <div class="card-header">
                    <h5><i class="fas fa-tools text-primary"></i> Actions</h5>
                </div>
                <div class="card-body">
                    <a href="{{ route('competitions.index') }}" class="btn btn-outline-primary btn-sm w-100 mb-2">
                        <i class="fas fa-arrow-left"></i> Back to Competitions
                    </a>
                    @auth
                        @if(Auth::user()->role === 'super_admin' || Auth::user()->role === 'school_admin')
                            <a href="{{ route('admin.competitions.show', $competition->id) }}" class="btn btn-outline-success btn-sm w-100">
                                <i class="fas fa-edit"></i> Manage Competition
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-pink {
    background-color: #e91e63 !important;
}
</style>
@endsection