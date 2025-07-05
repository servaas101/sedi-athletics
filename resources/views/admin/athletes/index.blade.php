<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Athletes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('admin.athletes.create') }}" class="btn btn-primary mb-3">Add New Athlete</a>

                    <x-table>
                        <x-slot name="head">
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Team</th>
                                <th>Gender</th>
                                <th>Date of Birth</th>
                                <th>Actions</th>
                            </tr>
                        </x-slot>
                        <tbody>
                            @foreach($athletes as $athlete)
                                <tr>
                                    <td>{{ $athlete->first_name }}</td>
                                    <td>{{ $athlete->last_name }}</td>
                                    <td>{{ $athlete->team->name }}</td>
                                    <td>{{ $athlete->gender }}</td>
                                    <td>{{ $athlete->dob }}</td>
                                    <td>
                                        <a href="{{ route('admin.athletes.edit', $athlete) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('admin.athletes.destroy', $athlete) }}" method="POST" class="d-inline">
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