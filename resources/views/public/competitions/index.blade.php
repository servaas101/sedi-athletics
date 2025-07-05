@extends('layouts.public')

@section('title', 'Competitions')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Athletics Competitions</h1>
            
            <!-- Search Form -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <form action="{{ route('competitions.index') }}" method="GET" class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search competitions..." 
                               aria-label="Search" name="search" value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i> Search
                        </button>
                    </form>
                </div>
            </div>

            @if($competitions->count() > 0)
                <div class="row">
                    @foreach($competitions as $competition)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100 shadow-sm">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="card-title mb-0">{{ $competition->name }}</h5>
                                    <small class="text-light">Code: {{ $competition->code }}</small>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">
                                        <strong><i class="fas fa-map-marker-alt"></i> Location:</strong> {{ $competition->location }}<br>
                                        <strong><i class="fas fa-school"></i> School:</strong> {{ $competition->school->name }}<br>
                                        <strong><i class="fas fa-calendar"></i> Date:</strong> 
                                        {{ \Carbon\Carbon::parse($competition->start_date)->format('M d, Y') }}
                                        @if($competition->start_date != $competition->end_date)
                                            - {{ \Carbon\Carbon::parse($competition->end_date)->format('M d, Y') }}
                                        @endif
                                    </p>
                                    
                                    @if($competition->description)
                                        <p class="card-text text-muted">{{ Str::limit($competition->description, 100) }}</p>
                                    @endif
                                    
                                    <span class="badge 
                                        @if($competition->status == 'scheduled') bg-warning text-dark
                                        @elseif($competition->status == 'completed') bg-success
                                        @else bg-secondary
                                        @endif">
                                        {{ ucfirst($competition->status) }}
                                    </span>
                                </div>
                                <div class="card-footer">
                                    <a href="{{ route('competitions.show', $competition->code) }}" 
                                       class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-eye"></i> View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $competitions->appends(request()->query())->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-trophy fa-3x text-muted mb-3"></i>
                    <h3 class="text-muted">No Competitions Found</h3>
                    <p class="text-muted">There are currently no competitions available.</p>
                    @if(request('search'))
                        <a href="{{ route('competitions.index') }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left"></i> View All Competitions
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
@endsection