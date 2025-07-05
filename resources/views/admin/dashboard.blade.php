<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('School Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="row">
                        <div class="col-md-4">
                            <x-card>
                                <x-slot name="title">Total Teams</x-slot>
                                <h3 class="text-center">{{ $teamsCount }}</h3>
                            </x-card>
                        </div>
                        <div class="col-md-4">
                            <x-card>
                                <x-slot name="title">Total Athletes</x-slot>
                                <h3 class="text-center">{{ $athletesCount }}</h3>
                            </x-card>
                        </div>
                        <div class="col-md-4">
                            <x-card>
                                <x-slot name="title">Total Competitions</x-slot>
                                <h3 class="text-center">{{ $competitionsCount }}</h3>
                            </x-card>
                        </div>
                        <div class="col-md-4">
                            <x-card>
                                <x-slot name="title">Total Disciplines</x-slot>
                                <h3 class="text-center">{{ $disciplinesCount }}</h3>
                            </x-card>
                        </div>
                        <div class="col-md-4">
                            <x-card>
                                <x-slot name="title">Total Results</x-slot>
                                <h3 class="text-center">{{ $resultsCount }}</h3>
                            </x-card>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>