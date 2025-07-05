@extends('layouts.public')

@section('title', 'Teams')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="display-4 fw-bold text-center mb-3">Teams</h1>
            <p class="lead text-center text-muted">Browse all participating teams and their athletes</p>
        </div>
    </div>

    @if($teams->count() > 0)
        <div class="row g-4">
            @foreach($teams as $team)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="card-title mb-0">{{ $team->name }}</h5>
                            <small>{{ $team->school->name }}</small>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-6">
                                    <div class="border-end">
                                        <h4 class="text-primary mb-0">{{ $team->athletes->count() }}</h4>
                                        <small class="text-muted">Athletes</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <h4 class="text-success mb-0">{{ $team->athletes->sum(function($athlete) { return $athlete->results->count(); }) }}</h4>
                                    <small class="text-muted">Results</small>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('public.teams.show', $team->id) }}" class="btn btn-outline-primary btn-sm w-100">
                                <i class="fas fa-eye"></i> View Team Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($teams->hasPages())
            <div class="row mt-5">
                <div class="col-12 d-flex justify-content-center">
                    {{ $teams->links() }}
                </div>
            </div>
        @endif
    @else
        <div class="row">
            <div class="col-12 text-center">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> No teams found.
                </div>
            </div>
        </div>
    @endif
</div>
@endsection