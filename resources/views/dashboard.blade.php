<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">

            </div>
             {{-- @livewire('formulario') --}}
                <livewire:formulario lazy />
            <div class="mt-4">
                @livewire('comments')
            </div>

              {{-- @livewire('father') --}}

        </div>
    </div>
</x-app-layout>
