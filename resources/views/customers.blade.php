@php

@endphp

<x-app-layout>
    <x-slot name="header">
        <style src="/public/build/assets/app-652e9b8e.css"></style>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customers') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                {{dd($customers)}}

            </div>
        </div>
    </div>
</x-app-layout>
