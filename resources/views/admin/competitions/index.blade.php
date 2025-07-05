<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Competitions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('admin.competitions.create') }}" class="btn btn-primary mb-3">Add New Competition</a>

                    <x-table>
                        <x-slot name="head">
                            <tr>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </x-slot>
                        <tbody>
                            @foreach($competitions as $competition)
                                <tr>
                                    <td>{{ $competition->code }}</td>
                                    <td>{{ $competition->name }}</td>
                                    <td>{{ $competition->start_date }}</td>
                                    <td>{{ $competition->end_date }}</td>
                                    <td>{{ $competition->location }}</td>
                                    <td>{{ $competition->status }}</td>
                                    <td>
                                        <a href="{{ route('admin.competitions.edit', $competition) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('admin.competitions.destroy', $competition) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </x-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>