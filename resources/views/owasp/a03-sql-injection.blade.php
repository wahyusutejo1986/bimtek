@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-yellow-900 to-black py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-yellow-400 mb-2">{{ $vulnerability }}</h1>
            <p class="text-gray-300 text-lg">{{ $description }}</p>
            <div class="mt-4 inline-block bg-yellow-600/20 text-yellow-300 px-4 py-2 rounded-lg">
                💉 <strong>Risk Level: CRITICAL</strong> - Database compromise possible
            </div>
        </div>

        <!-- Navigation -->
        <div class="mb-8 text-center">
            <a href="{{ route('owasp.dashboard') }}" 
               class="inline-block bg-gray-700 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition">
                ← Back to OWASP Dashboard
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            <!-- SQL Injection Testing -->
            <div class="bg-black/60 backdrop-blur-lg rounded-2xl p-6 border border-yellow-500/30">
                <h2 class="text-2xl font-bold text-yellow-400 mb-4">💉 SQL Injection Testing</h2>
                
                <form method="GET" action="{{ route('owasp.a03.search') }}" class="space-y-4">
                    <div>
                        <label class="block text-gray-300 text-sm font-semibold mb-2">
                            Search Posts (Vulnerable to SQL Injection)
                        </label>
                        <input type="text" 
                               name="query" 
                               value="{{ $query }}"
                               placeholder="Try: ' OR 1=1 --" 
                               class="w-full bg-gray-800 text-white border border-gray-600 rounded-lg px-4 py-2 focus:border-yellow-500 focus:outline-none">
                    </div>
                    <button type="submit" 
                            class="w-full bg-yellow-600 hover:bg-yellow-500 text-white font-semibold py-2 px-4 rounded-lg transition">
                        🔍 Execute SQL Search
                    </button>
                </form>

                @if($query)
                <div class="mt-6 bg-gray-800/50 p-4 rounded-lg">
                    <h3 class="text-yellow-400 font-semibold mb-2">🔍 Executed SQL Query:</h3>
                    <pre class="text-green-300 text-sm bg-black/50 p-3 rounded overflow-x-auto">{{ $sql }}</pre>
                </div>
                @endif

                @if(isset($error))
                <div class="mt-4 bg-red-900/30 p-4 rounded-lg border border-red-500/50">
                    <h3 class="text-red-400 font-semibold mb-2">❌ Database Error (Information Disclosure):</h3>
                    <pre class="text-red-300 text-sm">{{ $error }}</pre>
                </div>
                @endif
            </div>

            <!-- Sample Payloads -->
            <div class="bg-black/60 backdrop-blur-lg rounded-2xl p-6 border border-yellow-500/30">
                <h2 class="text-2xl font-bold text-yellow-400 mb-4">⚡ Sample SQL Injection Payloads</h2>
                
                <div class="space-y-4">
                    <div class="bg-gray-800/50 p-4 rounded-lg">
                        <h4 class="text-green-400 font-semibold mb-2">1. Basic Boolean Injection</h4>
                        <code class="text-yellow-300 text-sm bg-black/50 px-2 py-1 rounded block">
                            ' OR 1=1 --
                        </code>
                        <p class="text-gray-400 text-xs mt-2">Returns all records by making condition always true</p>
                    </div>

                    <div class="bg-gray-800/50 p-4 rounded-lg">
                        <h4 class="text-green-400 font-semibold mb-2">2. UNION-based Injection</h4>
                        <code class="text-yellow-300 text-sm bg-black/50 px-2 py-1 rounded block">
                            ' UNION SELECT id,email,password,created_at FROM users --
                        </code>
                        <p class="text-gray-400 text-xs mt-2">Extracts user data including password hashes</p>
                    </div>

                    <div class="bg-gray-800/50 p-4 rounded-lg">
                        <h4 class="text-green-400 font-semibold mb-2">3. Information Gathering</h4>
                        <code class="text-yellow-300 text-sm bg-black/50 px-2 py-1 rounded block">
                            ' UNION SELECT DATABASE(),VERSION(),USER(),NOW() --
                        </code>
                        <p class="text-gray-400 text-xs mt-2">Reveals database name, version, and current user</p>
                    </div>

                    <div class="bg-gray-800/50 p-4 rounded-lg">
                        <h4 class="text-green-400 font-semibold mb-2">4. Table Discovery</h4>
                        <code class="text-yellow-300 text-sm bg-black/50 px-2 py-1 rounded block">
                            ' UNION SELECT table_name,1,2,3 FROM information_schema.tables --
                        </code>
                        <p class="text-gray-400 text-xs mt-2">Lists all tables in the database</p>
                    </div>

                    <div class="bg-gray-800/50 p-4 rounded-lg">
                        <h4 class="text-red-400 font-semibold mb-2">5. Destructive Payload (DON'T USE!)</h4>
                        <code class="text-red-300 text-sm bg-red-900/30 px-2 py-1 rounded block">
                            '; DROP TABLE posts; --
                        </code>
                        <p class="text-red-400 text-xs mt-2">⚠️ Would delete entire posts table! For education only!</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search Results -->
        @if($query && !isset($error))
        <div class="mt-8 bg-black/60 backdrop-blur-lg rounded-2xl p-6 border border-green-500/30">
            <h2 class="text-2xl font-bold text-green-400 mb-4">📊 Query Results ({{ count($posts) }} records)</h2>
            
            @if(count($posts) > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-gray-600">
                                <th class="text-left py-2 px-4 text-gray-300">ID</th>
                                <th class="text-left py-2 px-4 text-gray-300">Title</th>
                                <th class="text-left py-2 px-4 text-gray-300">Content</th>
                                <th class="text-left py-2 px-4 text-gray-300">Author</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                            <tr class="border-b border-gray-700">
                                <td class="py-2 px-4 text-white">{{ $post->id ?? 'N/A' }}</td>
                                <td class="py-2 px-4 text-white">{{ Str::limit($post->title ?? 'N/A', 30) }}</td>
                                <td class="py-2 px-4 text-gray-300">{{ Str::limit($post->content ?? 'N/A', 50) }}</td>
                                <td class="py-2 px-4 text-blue-300">{{ $post->author ?? $post->name ?? 'N/A' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-400 text-center py-4">No results found for your query.</p>
            @endif
        </div>
        @endif

        <!-- Educational Content -->
        <div class="mt-8 bg-black/60 backdrop-blur-lg rounded-2xl p-6 border border-blue-500/30">
            <h2 class="text-2xl font-bold text-blue-400 mb-4">🎓 Educational Content</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold text-red-400 mb-3">🚨 Vulnerability Details</h3>
                    <ul class="text-gray-300 space-y-2 text-sm">
                        <li>• <strong>String Concatenation:</strong> User input directly in SQL query</li>
                        <li>• <strong>No Input Validation:</strong> Special characters not escaped</li>
                        <li>• <strong>Error Disclosure:</strong> Database errors exposed to user</li>
                        <li>• <strong>Privilege Escalation:</strong> Access to any database table</li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-green-400 mb-3">🛡️ How to Fix</h3>
                    <ul class="text-gray-300 space-y-2 text-sm">
                        <li>• <strong>Prepared Statements:</strong> Use parameterized queries</li>
                        <li>• <strong>Input Validation:</strong> Sanitize all user input</li>
                        <li>• <strong>Least Privilege:</strong> Database user minimal permissions</li>
                        <li>• <strong>Error Handling:</strong> Generic error messages</li>
                    </ul>
                </div>
            </div>

            <div class="mt-6 bg-gray-800/50 p-4 rounded-lg">
                <h4 class="text-blue-400 font-semibold mb-2">🔧 Secure Code Example:</h4>
                <pre class="text-green-300 text-sm overflow-x-auto"><code>// SECURE: Using Laravel Query Builder
$posts = DB::table('posts')
    ->join('users', 'posts.user_id', '=', 'users.id')
    ->where('posts.title', 'LIKE', '%' . $query . '%')
    ->orWhere('posts.content', 'LIKE', '%' . $query . '%')
    ->select('posts.*', 'users.name as author')
    ->get();</code></pre>
            </div>
        </div>

    </div>
</div>
@endsection
