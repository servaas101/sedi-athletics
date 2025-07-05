@extends('layouts.public')

@section('title', $athlete->first_name . ' ' . $athlete->last_name)

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="mb-0">{{ $athlete->first_name }} {{ $athlete->last_name }}</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Gender:</strong> {{ ucfirst($athlete->gender) }}</p>
                            <p><strong>Date of Birth:</strong> {{ $athlete->date_of_birth ? $athlete->date_of_birth->format('F j, Y') : 'N/A' }}</p>
                            <p><strong>Team:</strong> 
                                <a href="{{ route('public.teams.show', $athlete->team->id) }}" class="text-decoration-none">
                                    {{ $athlete->team->name }}
                                </a>
                            </p>
                            <p><strong>School:</strong> 
                                @if($athlete->team && $athlete->team->school)
                                    {{ $athlete->team->school->name }}
                                @else
                                    N/A
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Results Section -->
            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="mb-0">Competition Results</h3>
                </div>
                <div class="card-body">
                    @if($athlete->results->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Competition</th>
                                        <th>Discipline</th>
                                        <th>Rank</th>
                                        <th>Time/Distance</th>
                                        <th>Points</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($athlete->results as $result)
                                        <tr class="{{ $result->rank <= 3 ? 'table-warning' : '' }}">
                                            <td>
                                                <a href="{{ route('public.competitions.show', $result->discipline->competition->code) }}" class="text-decoration-none">
                                                    {{ $result->discipline->competition->name }}
                                                </a>
                                            </td>
                                            <td>{{ $result->discipline->category }} {{ $result->discipline->distance }}</td>
                                            <td>
                                                @if($result->rank <= 3)
                                                    <span class="badge bg-warning text-dark">{{ $result->rank }}</span>
                                                @else
                                                    {{ $result->rank }}
                                                @endif
                                            </td>
                                            <td>{{ $result->time }}</td>
                                            <td>{{ $result->points }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted">No competition results found for this athlete.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Quick Stats</h4>
                </div>
                <div class="card-body">
                    <p><strong>Total Competitions:</strong> {{ $athlete->results->pluck('discipline.competition.id')->unique()->count() }}</p>
                    <p><strong>Total Results:</strong> {{ $athlete->results->count() }}</p>
                    <p><strong>Top 3 Finishes:</strong> {{ $athlete->results->where('rank', '<=', 3)->count() }}</p>
                    <p><strong>Total Points:</strong> {{ $athlete->results->sum('points') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection