<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Results for Discipline: {{ $discipline->competition->name }} - {{ $discipline->category }} {{ $discipline->distance }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3>Discipline Details</h3>
                    <p><strong>Gender:</strong> {{ $discipline->gender }}</p>
                    <p><strong>Round:</strong> {{ $discipline->round }}</p>
                    <p><strong>Heat Number:</strong> {{ $discipline->heat_number }}</p>
                    <p><strong>Scheduled Time:</strong> {{ $discipline->scheduled_time }}</p>

                    <h3 class="mt-4">Results</h3>
                    <x-table>
                        <x-slot name="head">
                            <tr>
                                <th>Rank</th>
                                <th>Athlete</th>
                                <th>Team</th>
                                <th>Time</th>
                                <th>Points</th>
                            </tr>
                        </x-slot>
                        <x-slot name="body">
                            @forelse($results as $result)
                                <tr class="{{ $result->rank <= 3 ? 'table-warning' : '' }}">
                                    <td>{{ $result->rank }}</td>
                                    <td>{{ $result->athlete->first_name }} {{ $result->athlete->last_name }}</td>
                                    <td>{{ $result->athlete->team->name }}</td>
                                    <td>{{ $result->time }}</td>
                                    <td>{{ $result->points }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No results found for this discipline.</td>
                                </tr>
                            @endforelse
                        </x-slot>
                    </x-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>