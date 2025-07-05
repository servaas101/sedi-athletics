<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit School') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('hub.schools.update', $school) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">School Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $school->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="code" class="form-label">School Code</label>
                            <input type="text" class="form-control" id="code" name="code" value="{{ $school->code }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="api_token" class="form-label">API Token (Optional)</label>
                            <input type="text" class="form-control" id="api_token" name="api_token" value="{{ $school->api_token }}">
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="active" {{ $school->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $school->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>