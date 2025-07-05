<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Disciplines') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('admin.disciplines.create') }}" class="btn btn-primary mb-3">Add New Discipline</a>

                    <x-table>
                        <x-slot name="head">
                            <tr>
                                <th>Competition</th>
                                <th>Gender</th>
                                <th>Category</th>
                                <th>Distance</th>
                                <th>Round</th>
                                <th>Heat Number</th>
                                <th>Scheduled Time</th>
                                <th>Actions</th>
                            </tr>
                        </x-slot>
                        <tbody>
                            @foreach($disciplines as $discipline)
                                <tr>
                                    <td>{{ $discipline->competition->name }}</td>
                                    <td>{{ $discipline->gender }}</td>
                                    <td>{{ $discipline->category }}</td>
                                    <td>{{ $discipline->distance }}</td>
                                    <td>{{ $discipline->round }}</td>
                                    <td>{{ $discipline->heat_number }}</td>
                                    <td>{{ $discipline->scheduled_time }}</td>
                                    <td>
                                        <a href="{{ route('admin.disciplines.edit', $discipline) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('admin.disciplines.destroy', $discipline) }}" method="POST" class="d-inline">
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