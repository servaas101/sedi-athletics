<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Schools') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('hub.schools.create') }}" class="btn btn-primary mb-3">Add New School</a>

                    <x-table>
                        <x-slot name="head">
                            <tr>
                                <th>Name</th>
                                <th>Code</th>
                                <th>API Token</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </x-slot>
                        <x-slot name="body">
                            @foreach($schools as $school)
                                <tr>
                                    <td>{{ $school->name }}</td>
                                    <td>{{ $school->code }}</td>
                                    <td>{{ $school->api_token }}</td>
                                    <td>{{ $school->status }}</td>
                                    <td>
                                        <a href="{{ route('hub.schools.edit', $school) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('hub.schools.destroy', $school) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </x-slot>
                    </x-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>