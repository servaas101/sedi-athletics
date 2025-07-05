<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Result') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.results.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="discipline_id" class="form-label">Discipline</label>
                            <select class="form-select" id="discipline_id" name="discipline_id" required>
                                @foreach($disciplines as $discipline)
                                    <option value="{{ $discipline->id }}">{{ $discipline->competition->name }} - {{ $discipline->category }} {{ $discipline->distance }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="athlete_id" class="form-label">Athlete</label>
                            <select class="form-select" id="athlete_id" name="athlete_id" required>
                                @foreach($athletes as $athlete)
                                    <option value="{{ $athlete->id }}">{{ $athlete->first_name }} {{ $athlete->last_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="rank" class="form-label">Rank</label>
                            <input type="number" class="form-control" id="rank" name="rank" required>
                        </div>
                        <div class="mb-3">
                            <label for="time" class="form-label">Time</label>
                            <input type="text" class="form-control" id="time" name="time" placeholder="e.g., 00:01:23.456" required>
                        </div>
                        <div class="mb-3">
                            <label for="points" class="form-label">Points</label>
                            <input type="number" class="form-control" id="points" name="points" required>
                        </div>
                        <div class="mb-3">
                            <label for="recorded_at" class="form-label">Recorded At</label>
                            <input type="datetime-local" class="form-control" id="recorded_at" name="recorded_at" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>