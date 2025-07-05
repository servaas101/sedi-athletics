<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Events') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('admin.events.create') }}" class="btn btn-primary mb-3">Add New Event</a>

                    <x-table>
                        <x-slot name="head">
                            <tr>
                                <th>Meet</th>
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
                            @foreach($events as $event)
                                <tr>
                                    <td>{{ $event->meet->name }}</td>
                                    <td>{{ $event->gender }}</td>
                                    <td>{{ $event->category }}</td>
                                    <td>{{ $event->distance }}</td>
                                    <td>{{ $event->round }}</td>
                                    <td>{{ $event->heat_number }}</td>
                                    <td>{{ $event->scheduled_time }}</td>
                                    <td>
                                        <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="d-inline">
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