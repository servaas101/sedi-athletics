<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hub Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="row">
                        <div class="col-md-4">
                            <x-card>
                                <x-slot name="header">Total Schools</x-slot>
                                <h3 class="text-center">{{ $totalSchools }}</h3>
                            </x-card>
                        </div>
                        <div class="col-md-4">
                            <x-card>
                                <x-slot name="header">Active Schools</x-slot>
                                <h3 class="text-center">{{ $activeSchools }}</h3>
                            </x-card>
                        </div>
                        <div class="col-md-4">
                            <x-card>
                                <x-slot name="header">Inactive Schools</x-slot>
                                <h3 class="text-center">{{ $inactiveSchools }}</h3>
                            </x-card>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>