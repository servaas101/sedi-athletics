<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Competitions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="/competitions" method="GET" class="d-flex mb-3">
                        <input class="form-control me-2" type="search" placeholder="Search Competitions" aria-label="Search" name="search" value="{{ request('search') }}">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>

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
                        <x-slot name="body">
                            @forelse($competitions as $competition)
                                <tr>
                                    <td>{{ $competition->code }}</td>
                                    <td>{{ $competition->name }}</td>
                                    <td>{{ $competition->start_date }}</td>
                                    <td>{{ $competition->end_date }}</td>
                                    <td>{{ $competition->location }}</td>
                                    <td>{{ $competition->status }}</td>
                                    <td>
                                        <a href="{{ url('/competitions/' . $competition->code) }}" class="btn btn-sm btn-info">View Details</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No competitions found.</td>
                                </tr>
                            @endforelse
                        </x-slot>
                    </x-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>