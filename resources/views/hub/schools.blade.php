<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('School Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-card>
                        <x-slot name="title">
                            All Schools
                            <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addSchoolModal">Add School</button>
                        </x-slot>

                        <x-table>
                            <x-slot name="head">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>SEDI ID</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </x-slot>
                            <tbody>
                                {{-- School data will be populated here via JavaScript --}}
                            </tbody>
                        </x-table>
                    </x-card>
                </div>
            </div>
        </div>
    </div>

    <x-modal id="addSchoolModal" title="Add New School">
        <form id="addSchoolForm">
            <div class="mb-3">
                <label for="name" class="form-label">School Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="sedi_id" class="form-label">SEDI ID</label>
                <input type="text" class="form-control" id="sedi_id" name="sedi_id">
            </div>
        </form>
        <x-slot name="footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" form="addSchoolForm" class="btn btn-primary">Save School</button>
        </x-slot>
    </x-modal>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const schoolTable = document.querySelector('tbody');
        const addSchoolForm = document.getElementById('addSchoolForm');
        const addSchoolModal = new bootstrap.Modal(document.getElementById('addSchoolModal'));

        // Fetch and display schools
        function getSchools() {
            fetch('{{ route("api.schools.index") }}', {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('api_token')}`,
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                schoolTable.innerHTML = '';
                data.forEach((school, index) => {
                    schoolTable.innerHTML += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${school.name}</td>
                            <td>${school.sedi_id || 'N/A'}</td>
                            <td><span class="badge bg-success">Active</span></td>
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

        // Add a new school
        addSchoolForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(this);

            fetch('{{ route("api.schools.store") }}', {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('api_token')}`,
                    'Accept': 'application/json',
                },
                body: JSON.stringify(Object.fromEntries(formData)),
            })
            .then(response => {
                if (response.ok) {
                    addSchoolModal.hide();
                    getSchools();
                    addSchoolForm.reset();
                } else {
                    // Handle errors
                    alert('Error adding school');
                }
            });
        });

        // Initial load
        getSchools();
    });
</script>
@endpush
</x-app-layout>