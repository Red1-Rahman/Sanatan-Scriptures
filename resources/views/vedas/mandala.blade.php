@extends('layouts.app')

@section('title', $veda->name_english . ' - Mandala ' . $mandala)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Breadcrumb -->
    <nav class="flex mb-8 text-sm" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-2">
            <li><a href="{{ route('vedas.index') }}" class="text-saffron-600 hover:text-saffron-700">Vedas</a></li>
            <li><span class="text-gray-500">/</span></li>
            <li><a href="{{ route('vedas.show', $veda->veda_number) }}" class="text-saffron-600 hover:text-saffron-700">{{ $veda->name_english }}</a></li>
            <li><span class="text-gray-500">/</span></li>
            <li class="text-gray-700 dark:text-gray-300">Mandala {{ $mandala }}</li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="bg-gradient-to-r from-saffron-500 to-orange-500 rounded-xl shadow-lg p-6 mb-8 text-white">
        <h1 class="text-3xl font-bold">{{ $veda->name_english }} - Mandala {{ $mandala }}</h1>
        <p class="text-lg opacity-90 mt-2">{{ $suktas->count() }} Suktas • {{ $verses->count() }} Verses</p>
    </div>

    <!-- Verses List -->
    <div class="space-y-6">
        @php
            $currentSukta = null;
        @endphp
        
        @foreach($verses as $verse)
            @if($currentSukta !== $verse->sukta_number)
                @php
                    $currentSukta = $verse->sukta_number;
                @endphp
                
                <!-- Sukta Header -->
                <div class="bg-gradient-to-r from-orange-100 to-amber-100 dark:from-gray-700 dark:to-gray-600 rounded-lg p-4 mt-8 first:mt-0">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
                        Sukta {{ $verse->sukta_number }}
                    </h2>
                    <div class="flex flex-wrap gap-4 text-sm text-gray-700 dark:text-gray-300">
                        @if($verse->deity)
                        <div><span class="font-semibold">Subject:</span> {{ $verse->deity }}</div>
                        @endif
                        @if($verse->rishi)
                        <div><span class="font-semibold">Rishi:</span> {{ $verse->rishi }}</div>
                        @endif
                        @if($verse->metre)
                        <div><span class="font-semibold">Metre:</span> {{ $verse->metre }}</div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Verse Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow">
                <!-- Verse Header -->
                <div class="flex items-center justify-between mb-4 pb-3 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center space-x-3">
                        <span class="bg-saffron-100 dark:bg-saffron-900 text-saffron-800 dark:text-saffron-200 px-3 py-1 rounded-full text-sm font-semibold">
                            {{ $verse->verse_reference }}
                        </span>
                        @auth
                        <div class="flex space-x-2">
                            @if($verse->user_progress && $verse->user_progress->is_read)
                                <span class="text-green-600 dark:text-green-400" title="Read">✓</span>
                            @endif
                            @if($verse->user_progress && $verse->user_progress->is_understood)
                                <span class="text-blue-600 dark:text-blue-400" title="Understood">💡</span>
                            @endif
                            @if($verse->user_progress && $verse->user_progress->is_memorized)
                                <span class="text-yellow-600 dark:text-yellow-400" title="Memorized">⭐</span>
                            @endif
                        </div>
                        @endauth
                    </div>
                </div>

                <!-- Sanskrit Text -->
                <div class="mb-4">
                    <div class="text-sanskrit-lg font-sanskrit text-gray-900 dark:text-white leading-relaxed">
                        {{ $verse->sanskrit_text }}
                    </div>
                </div>

                <!-- Transliteration -->
                <div class="mb-4">
                    <div class="text-base font-transliteration italic text-gray-700 dark:text-gray-300">
                        {{ $verse->transliteration }}
                    </div>
                </div>

                <!-- English Translation -->
                <div class="mb-4">
                    <div class="text-base text-gray-800 dark:text-gray-200">
                        {{ $verse->translation_english }}
                    </div>
                </div>

                <!-- Hindi Translation (if available) -->
                @if($verse->translation_hindi)
                <div class="mb-4">
                    <div class="text-base text-gray-700 dark:text-gray-300 font-sanskrit">
                        {{ $verse->translation_hindi }}
                    </div>
                </div>
                @endif

                <!-- Commentary (if available) -->
                @if($verse->commentary)
                <div class="bg-amber-50 dark:bg-gray-700 rounded-lg p-4 mb-4">
                    <div class="text-sm text-gray-700 dark:text-gray-300">
                        <span class="font-semibold">Commentary:</span> {{ $verse->commentary }}
                    </div>
                </div>
                @endif

                @auth
                <!-- Action Buttons -->
                <div class="flex flex-wrap gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <button onclick="markProgress({{ $verse->id }}, 'read')" class="flex-1 sm:flex-none px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg font-semibold transition {{ $verse->user_progress && $verse->user_progress->is_read ? 'opacity-50' : '' }}">
                        <span class="mr-1">✓</span> Mark as Read
                    </button>
                    <button onclick="markProgress({{ $verse->id }}, 'understood')" class="flex-1 sm:flex-none px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg font-semibold transition {{ $verse->user_progress && $verse->user_progress->is_understood ? 'opacity-50' : '' }}">
                        <span class="mr-1">💡</span> Mark as Understood
                    </button>
                    <button onclick="markProgress({{ $verse->id }}, 'memorized')" class="flex-1 sm:flex-none px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg font-semibold transition {{ $verse->user_progress && $verse->user_progress->is_memorized ? 'opacity-50' : '' }}">
                        <span class="mr-1">⭐</span> Mark as Memorized
                    </button>
                </div>
                @endauth
            </div>
        @endforeach
    </div>

    <!-- Navigation -->
    <div class="mt-8 text-center">
        <a href="{{ route('vedas.show', $veda->veda_number) }}" class="inline-flex items-center text-saffron-600 dark:text-saffron-400 hover:text-saffron-700 dark:hover:text-saffron-300 font-semibold">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to {{ $veda->name_english }}
        </a>
    </div>
</div>

@auth
@push('scripts')
<script>
function markProgress(verseId, type) {
    const routes = {
        'read': '{{ route("verse.mark-read", ":id") }}',
        'understood': '{{ route("verse.mark-understood", ":id") }}',
        'memorized': '{{ route("verse.mark-memorized", ":id") }}'
    };

    const url = routes[type].replace(':id', verseId);

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast(data.message, 'success');
            // Reload page to update progress indicators
            setTimeout(() => location.reload(), 1000);
        }
    })
    .catch(error => {
        showToast('An error occurred', 'error');
        console.error('Error:', error);
    });
}

function showToast(message, type) {
    const toast = document.createElement('div');
    toast.className = `px-6 py-4 rounded-lg shadow-lg ${type === 'success' ? 'bg-green-500' : 'bg-red-500'} text-white font-semibold transform transition-all`;
    toast.textContent = message;
    
    const container = document.getElementById('toast-container');
    container.appendChild(toast);
    
    setTimeout(() => {
        toast.style.opacity = '0';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}
</script>
@endpush
@endauth
@endsection
