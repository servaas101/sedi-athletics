<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Discipline') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.disciplines.update', $discipline) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="competition_id" class="form-label">Competition</label>
                            <select class="form-select" id="competition_id" name="competition_id" required>
                                @foreach($competitions as $competition)
                                    <option value="{{ $competition->id }}" {{ $discipline->competition_id == $competition->id ? 'selected' : '' }}>{{ $competition->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <input type="text" class="form-control" id="gender" name="gender" value="{{ $discipline->gender }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <input type="text" class="form-control" id="category" name="category" value="{{ $discipline->category }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="distance" class="form-label">Distance</label>
                            <input type="text" class="form-control" id="distance" name="distance" value="{{ $discipline->distance }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="round" class="form-label">Round</label>
                            <input type="text" class="form-control" id="round" name="round" value="{{ $discipline->round }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="heat_number" class="form-label">Heat Number</label>
                            <input type="number" class="form-control" id="heat_number" name="heat_number" value="{{ $discipline->heat_number }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="scheduled_time" class="form-label">Scheduled Time</label>
                            <input type="time" class="form-control" id="scheduled_time" name="scheduled_time" value="{{ $discipline->scheduled_time }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>