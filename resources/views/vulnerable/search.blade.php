<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-search text-red-600 mr-2"></i>
            {{ __('Vulnerable Search') }} - SQL Injection Demo
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Warning -->
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    <strong>SQL Injection Vulnerability:</strong> This search is vulnerable to SQL injection attacks!
                </div>
            </div>

            <!-- Search Form -->
            <div class="bg-white overflow-hidden shadow rounded-lg mb-6">
                <div class="px-4 py-5 sm:p-6">
                    <form method="GET" action="{{ route('vulnerable.search') }}">
                        <div class="flex">
                            <input type="text" 
                                   name="query" 
                                   value="{{ $query }}"
                                   placeholder="Search posts... (try: ' OR 1=1 --)"
                                   class="flex-1 border border-gray-300 rounded-l-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
                            <button type="submit" 
                                    class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-r-md">
                                <i class="fas fa-search mr-1"></i>
                                Search
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Exploit Examples -->
            <div class="bg-gray-900 rounded-lg p-4 mb-6">
                <h3 class="text-green-400 font-medium mb-2">Try these SQL injection payloads:</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs font-mono">
                    <div>
                        <p class="text-gray-300 mb-1">Basic injection:</p>
                        <code class="text-red-400">' OR 1=1 --</code>
                    </div>
                    <div>
                        <p class="text-gray-300 mb-1">Union injection:</p>
                        <code class="text-red-400">' UNION SELECT id,email,password,created_at FROM users --</code>
                    </div>
                    <div>
                        <p class="text-gray-300 mb-1">Boolean injection:</p>
                        <code class="text-red-400">' OR '1'='1</code>
                    </div>
                    <div>
                        <p class="text-gray-300 mb-1">Time-based injection:</p>
                        <code class="text-red-400">' OR SLEEP(5) --</code>
                    </div>
                </div>
            </div>

            <!-- Error Display -->
            @if(isset($error))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <strong>SQL Error:</strong>
                <pre class="mt-2 text-sm">{{ $error }}</pre>
            </div>
            @endif

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
                <a href="{{ route('vulnerable.dashboard') }}" 
                   class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">
                    <i class="fas fa-arrow-left mr-1"></i>
                    Back to Vulnerability Dashboard
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
