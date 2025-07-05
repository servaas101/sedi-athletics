<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $athlete->first_name }} {{ $athlete->last_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ $athlete->photo_url ?: 'https://via.placeholder.com/150' }}" class="img-fluid rounded-circle" alt="Athlete Photo">
                        </div>
                        <div class="col-md-8">
                            <h3>Athlete Details</h3>
                            <p><strong>Team:</strong> {{ $athlete->team->name }}</p>
                            <p><strong>Gender:</strong> {{ $athlete->gender }}</p>
                            <p><strong>Date of Birth:</strong> {{ $athlete->dob }}</p>

                            <h4 class="mt-4">Personal Bests</h4>
                            <ul>
                                @forelse($athlete->results->groupBy('discipline.category') as $category => $results)
                                    <li><strong>{{ $category }}:</strong>
                                        @foreach($results->sortBy('time') as $result)
                                            {{ $result->time }} ({{ $result->discipline->distance }}) - {{ $result->discipline->competition->name }}
                                        @endforeach
                                    </li>
                                @empty
                                    <li>No personal bests recorded.</li>
                                @endforelse
                            </ul>

                            <h4 class="mt-4">Event History</h4>
                            <x-table>
                                <x-slot name="head">
                                    <tr>
                                        <th>Meet</th>
                                        <th>Event</th>
                                        <th>Rank</th>
                                        <th>Time</th>
                                        <th>Points</th>
                                        <th>Date</th>
                                    </tr>
                                </x-slot>
                                <x-slot name="body">
                                    @forelse($athlete->results->sortByDesc('recorded_at') as $result)
                                        <tr>
                                            <td>{{ $result->discipline->competition->name }}</td>
                                            <td>{{ $result->discipline->category }} {{ $result->discipline->distance }}</td>
                                            <td>{{ $result->rank }}</td>
                                            <td>{{ $result->time }}</td>
                                            <td>{{ $result->points }}</td>
                                            <td>{{ $result->recorded_at->format('Y-m-d') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No event history found.</td>
                                        </tr>
                                    @endforelse
                                </x-slot>
                            </x-table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>