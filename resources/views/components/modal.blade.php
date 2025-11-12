@props([
    'id',
    'title',
    'maxWidth' => '4xl',
    'topOffset' => '20'
])

@php
    $modalType = preg_replace('/ProductModal$/', '', $id);
    $closeFunction = 'close' . ucfirst($modalType) . 'Modal';
@endphp

<div id="{{ $id }}" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-{{ $topOffset }} mx-auto p-5 border w-11/12 max-w-{{ $maxWidth }} shadow-lg rounded-lg bg-white {{ $topOffset === '10' ? 'my-10' : '' }}">
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200">
            <h2 class="text-2xl font-bold text-gray-800">{{ $title }}</h2>
            <button onclick="{{ $closeFunction }}()" class="text-gray-600 hover:text-gray-900 transition duration-150">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <div id="{{ $id }}Content" class="mb-6">
            @include('components.loading-spinner')
        </div>
    </div>
</div>
