<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Results') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('admin.results.create') }}" class="btn btn-primary mb-3">Add New Result</a>

                    <x-table>
                        <x-slot name="head">
                            <tr>
                                <th>Event</th>
                                <th>Athlete</th>
                                <th>Rank</th>
                                <th>Time</th>
                                <th>Points</th>
                                <th>Recorded At</th>
                                <th>Actions</th>
                            </tr>
                        </x-slot>
                        <tbody>
                            @foreach($results as $result)
                                <tr>
                                    <td>{{ $result->discipline->competition->name }} - {{ $result->discipline->category }} {{ $result->discipline->distance }}</td>
                                    <td>{{ $result->athlete->first_name }} {{ $result->athlete->last_name }}</td>
                                    <td>{{ $result->rank }}</td>
                                    <td>{{ $result->time }}</td>
                                    <td>{{ $result->points }}</td>
                                    <td>{{ $result->recorded_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.results.edit', $result) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('admin.results.destroy', $result) }}" method="POST" class="d-inline">
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