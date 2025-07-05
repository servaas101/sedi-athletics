<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Meet Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-card>
                        <x-slot name="title">
                            All Meets
                            <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addMeetModal">Add Meet</button>
                        </x-slot>

                        <x-table>
                            <x-slot name="head">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </x-slot>
                            <tbody>
                                {{-- Meet data will be populated here via JavaScript --}}
                            </tbody>
                        </x-table>
                    </x-card>
                </div>
            </div>
        </div>
    </div>

    <x-modal id="addMeetModal" title="Add New Meet">
        <form id="addMeetForm">
            <div class="mb-3">
                <label for="name" class="form-label">Meet Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>
        </form>
        <x-slot name="footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" form="addMeetForm" class="btn btn-primary">Save Meet</button>
        </x-slot>
    </x-modal>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const meetTable = document.querySelector('tbody');
        const addMeetForm = document.getElementById('addMeetForm');
        const addMeetModal = new bootstrap.Modal(document.getElementById('addMeetModal'));

        // Fetch and display meets
        function getMeets() {
            fetch('{{ route("api.competitions.index") }}', {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('api_token')}`,
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                meetTable.innerHTML = '';
                data.forEach((meet, index) => {
                    meetTable.innerHTML += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${meet.name}</td>
                            <td>${meet.date}</td>
                            <td><span class="badge bg-success">Upcoming</span></td>
                            <td>
                                <button class="btn btn-sm btn-info">View</button>
                                <button class="btn btn-sm btn-warning">Edit</button>
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                    `;
                });
            });
        }

        // Add a new meet
        addMeetForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(this);

            fetch('{{ route("api.competitions.store") }}', {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('api_token')}`,
                    'Accept': 'application/json',
                },
                body: JSON.stringify(Object.fromEntries(formData)),
            })
            .then(response => {
                if (response.ok) {
                    addMeetModal.hide();
                    getMeets();
                    addMeetForm.reset();
                } else {
                    // Handle errors
                    alert('Error adding meet');
                }
            });
        });

        // Initial load
        getMeets();
    });
</script>
@endpush
</x-app-layout>