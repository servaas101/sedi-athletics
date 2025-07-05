@extends('layouts.public')

@section('title', $team->name)

@section('content')
<div class="container mt-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('public.teams.index') }}">Teams</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $team->name }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Team Details -->
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h1 class="h3 mb-0">{{ $team->name }}</h1>
                    <small>{{ $team->school->name }}</small>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5><i class="fas fa-info-circle text-primary"></i> Team Details</h5>
                            <ul class="list-unstyled">
                                <li><strong><i class="fas fa-school"></i> School:</strong> {{ $team->school->name }}</li>
                                <li><strong><i class="fas fa-users"></i> Athletes:</strong> {{ $team->athletes->count() }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Athletes Section -->
            @if($team->athletes->count() > 0)
                <div class="card shadow-sm mt-4">
                    <div class="card-header">
                        <h4><i class="fas fa-running text-primary"></i> Athletes ({{ $team->athletes->count() }})</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Date of Birth</th>
                                        <th>Results</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($team->athletes as $athlete)
                                        <tr>
                                            <td>
                                                <a href="{{ route('public.athletes.show', $athlete->id) }}" class="text-decoration-none">
                                                    {{ $athlete->first_name }} {{ $athlete->last_name }}
                                                </a>
                                            </td>
                                            <td>
                                                <span class="badge {{ $athlete->gender == 'male' ? 'bg-info' : 'bg-pink' }}">
                                                    {{ ucfirst($athlete->gender) }}
                                                </span>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($athlete->dob)->format('M d, Y') }}</td>
                                            <td>{{ $athlete->results->count() }} results</td>
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
                                <h3 class="text-primary">{{ $team->athletes->count() }}</h3>
                                <small class="text-muted">Athletes</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <h3 class="text-success">{{ $team->athletes->sum(function($athlete) { return $athlete->results->count(); }) }}</h3>
                            <small class="text-muted">Total Results</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection