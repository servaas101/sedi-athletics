<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $team->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3>Team Details</h3>
                    <p><strong>School:</strong> {{ $team->school->name }}</p>
                    <p><strong>Description:</strong> {{ $team->description }}</p>

                    <h4 class="mt-4">Athlete Roster</h4>
                    <x-table>
                        <x-slot name="head">
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Gender</th>
                                <th>Date of Birth</th>
                                <th>Actions</th>
                            </tr>
                        </x-slot>
                        <x-slot name="body">
                            @forelse($team->athletes as $athlete)
                                <tr>
                                    <td>{{ $athlete->first_name }}</td>
                                    <td>{{ $athlete->last_name }}</td>
                                    <td>{{ $athlete->gender }}</td>
                                    <td>{{ $athlete->dob }}</td>
                                    <td>
                                        <a href="{{ url('/athletes/' . $athlete->id) }}" class="btn btn-sm btn-info">View Profile</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No athletes in this team.</td>
                                </tr>
                            @endforelse
                        </x-slot>
                    </x-table>

                    <h4 class="mt-4">Medal Tally (Placeholder)</h4>
                    <p>Medal tally for the team will be displayed here.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>