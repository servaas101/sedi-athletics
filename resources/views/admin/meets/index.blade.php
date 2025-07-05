<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Meets') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('admin.meets.create') }}" class="btn btn-primary mb-3">Add New Meet</a>

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
                            @foreach($meets as $meet)
                                <tr>
                                    <td>{{ $meet->code }}</td>
                                    <td>{{ $meet->name }}</td>
                                    <td>{{ $meet->start_date }}</td>
                                    <td>{{ $meet->end_date }}</td>
                                    <td>{{ $meet->location }}</td>
                                    <td>{{ $meet->status }}</td>
                                    <td>
                                        <a href="{{ route('admin.meets.edit', $meet) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('admin.meets.destroy', $meet) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </x-slot>
                    </x-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>