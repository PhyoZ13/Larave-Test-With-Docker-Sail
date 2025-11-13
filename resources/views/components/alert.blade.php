@props(['type' => 'success', 'message' => null])

@php
    $message = $message ?? session('success');
    $alertId = 'alert-' . uniqid();
    
    $classes = [
        'success' => ['bg' => 'bg-green-100', 'border' => 'border-green-400', 'text' => 'text-green-700', 'button' => 'text-green-700 hover:text-green-900'],
        'error' => ['bg' => 'bg-red-100', 'border' => 'border-red-400', 'text' => 'text-red-700', 'button' => 'text-red-700 hover:text-red-900'],
        'warning' => ['bg' => 'bg-yellow-100', 'border' => 'border-yellow-400', 'text' => 'text-yellow-700', 'button' => 'text-yellow-700 hover:text-yellow-900'],
        'info' => ['bg' => 'bg-blue-100', 'border' => 'border-blue-400', 'text' => 'text-blue-700', 'button' => 'text-blue-700 hover:text-blue-900'],
    ];
    
    $style = $classes[$type] ?? $classes['success'];
@endphp

@if($message)
    <div id="{{ $alertId }}" class="mb-4 p-4 pr-10 border rounded relative {{ $style['bg'] }} {{ $style['border'] }} {{ $style['text'] }}">
        {{ $message }}
        <button type="button" class="close-alert absolute top-2 right-2 {{ $style['button'] }} focus:outline-none">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
@endif

