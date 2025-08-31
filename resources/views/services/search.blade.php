<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-search text-blue-600 mr-2"></i>
            {{ __('Content Search') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Professional Header -->
            <div class="bg-blue-50 border border-blue-200 text-blue-800 px-4 py-3 rounded mb-6">
                <div class="flex items-center">
                    <i class="fas fa-info-circle mr-2"></i>
                    <strong>Content Search:</strong> Search through published articles and content in the knowledge base.
                </div>
            </div>

            <!-- Search Form -->
            <div class="bg-white overflow-hidden shadow rounded-lg mb-6">
                <div class="px-4 py-5 sm:p-6">
                    <form method="GET" action="{{ route('services.search') }}">
                        <div class="flex">
                            <input type="text" 
                                   name="query" 
                                   value="{{ $query }}"
                                   placeholder="Search content by title or keywords..."
                                   class="flex-1 border border-gray-300 rounded-l-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <button type="submit" 
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-r-md">
                                <i class="fas fa-search mr-1"></i>
                                Search Content
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Results -->
            @if($posts->count() > 0)
            <div class="bg-white shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Search Results ({{ $posts->count() }} found)
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        Query: <code class="bg-gray-100 px-2 py-1 rounded">{{ $query }}</code>
                    </p>
                </div>
                <ul class="divide-y divide-gray-200">
                    @foreach($posts as $post)
                    <li class="px-4 py-4">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <h4 class="text-sm font-medium text-gray-900">
                                    {{ $post->title ?? 'N/A' }}
                                </h4>
                                <p class="text-sm text-gray-600">
                                    by {{ $post->first_name ?? 'Unknown' }} {{ $post->last_name ?? '' }} 
                                    in {{ $post->category_name ?? 'N/A' }}
                                </p>
                                @if(isset($post->content))
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ Str::limit($post->content, 100) }}
                                </p>
                                @endif
                            </div>
                            <div class="text-xs text-gray-400">
                                ID: {{ $post->id ?? 'N/A' }}
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            @elseif(!empty($query))
            <div class="text-center py-8">
                <i class="fas fa-search text-gray-400 text-3xl mb-2"></i>
                <p class="text-gray-600">No results found for: <strong>{{ $query }}</strong></p>
            </div>
            @endif

            <!-- Back to Dashboard -->
            <div class="mt-6">
                <a href="{{ route('services.dashboard') }}" 
                   class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">
                    <i class="fas fa-arrow-left mr-1"></i>
                    Back to Services Dashboard
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
