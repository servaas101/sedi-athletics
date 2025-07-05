<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $competition->name }} ({{ $competition->code }})
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3>Competition Details</h3>
                    <p><strong>Location:</strong> {{ $competition->location }}</p>
                    <p><strong>Date:</strong> {{ $competition->start_date }} to {{ $competition->end_date }}</p>
                    <p><strong>Status:</strong> {{ $competition->status }}</p>
                    <p><strong>Description:</strong> {{ $competition->description }}</p>

                    <h3 class="mt-4">Disciplines</h3>
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
                            @forelse($competition->disciplines as $discipline)
                                <tr>
                                    <td>{{ $discipline->gender }}</td>
                                    <td>{{ $discipline->category }}</td>
                                    <td>{{ $discipline->distance }}</td>
                                    <td>{{ $discipline->round }}</td>
                                    <td>{{ $discipline->heat_number }}</td>
                                    <td>{{ $discipline->scheduled_time }}</td>
                                    <td>
                                        <a href="{{ url('/disciplines/' . $discipline->id . '/results') }}" class="btn btn-sm btn-info">View Results</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No disciplines found for this competition.</td>
                                </tr>
                            @endforelse
                        </x-slot>
                    </x-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>