<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $meet->name }} ({{ $meet->code }})
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3>Meet Details</h3>
                    <p><strong>Location:</strong> {{ $meet->location }}</p>
                    <p><strong>Date:</strong> {{ $meet->start_date }} to {{ $meet->end_date }}</p>
                    <p><strong>Status:</strong> {{ $meet->status }}</p>
                    <p><strong>Description:</strong> {{ $meet->description }}</p>

                    <h3 class="mt-4">Events</h3>
                    <x-table>
                        <x-slot name="head">
                            <tr>
                                <th>Gender</th>
                                <th>Category</th>
                                <th>Distance</th>
                                <th>Round</th>
                                <th>Heat Number</th>
                                <th>Scheduled Time</th>
                                <th>Actions</th>
                            </tr>
                        </x-slot>
                        <x-slot name="body">
                            @forelse($meet->events as $event)
                                <tr>
                                    <td>{{ $event->gender }}</td>
                                    <td>{{ $event->category }}</td>
                                    <td>{{ $event->distance }}</td>
                                    <td>{{ $event->round }}</td>
                                    <td>{{ $event->heat_number }}</td>
                                    <td>{{ $event->scheduled_time }}</td>
                                    <td>
                                        <a href="{{ url('/events/' . $event->id . '/results') }}" class="btn btn-sm btn-info">View Results</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No events found for this meet.</td>
                                </tr>
                            @endforelse
                        </x-slot>
                    </x-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>