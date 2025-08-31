<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🚪 A01:2021 - Broken Access Control
        </h2>
    </x-slot>

<div class="min-h-screen bg-gradient-to-br from-gray-900 via-red-900 to-black py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-red-400 mb-2">{{ $vulnerability }}</h1>
            <p class="text-gray-300 text-lg">{{ $description }}</p>
            <div class="mt-4 inline-block bg-red-600/20 text-red-300 px-4 py-2 rounded-lg">
                🚨 <strong>Risk Level: CRITICAL</strong> - Complete authorization bypass
            </div>
        </div>

        <!-- Navigation -->
        <div class="mb-8 text-center">
            <a href="{{ route('tools.dashboard') }}" 
               class="inline-block bg-gray-700 hover:bg-gray-600 text-white px-6 py-2 rounded-lg mr-4 transition">
                ← Back to OWASP Dashboard
            </a>
            <a href="{{ route('tools.user-management.user', ['id' => rand(1, 10)]) }}" 
               class="inline-block bg-red-600 hover:bg-red-500 text-white px-6 py-2 rounded-lg transition">
                🎲 Random User Profile
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            <!-- User Profile (Vulnerable) -->
            <div class="bg-black/60 backdrop-blur-lg rounded-2xl p-6 border border-red-500/30">
                <h2 class="text-2xl font-bold text-red-400 mb-4">👤 User Profile (ID: {{ $user->id }})</h2>
                
                <div class="space-y-4">
                    <div class="bg-gray-800/50 p-4 rounded-lg">
                        <label class="text-gray-400 text-sm">Name</label>
                        <p class="text-white font-semibold">{{ $user->name }}</p>
                    </div>
                    
                    <div class="bg-gray-800/50 p-4 rounded-lg">
                        <label class="text-gray-400 text-sm">Email</label>
                        <p class="text-white font-semibold">{{ $user->email }}</p>
                    </div>
                    
                    <div class="bg-gray-800/50 p-4 rounded-lg">
                        <label class="text-gray-400 text-sm">Account Created</label>
                        <p class="text-white font-semibold">{{ $user->created_at->format('Y-m-d H:i:s') }}</p>
                    </div>
                    
                    @if($user->email_verified_at)
                    <div class="bg-gray-800/50 p-4 rounded-lg">
                        <label class="text-gray-400 text-sm">Email Verified</label>
                        <p class="text-green-400 font-semibold">✅ {{ $user->email_verified_at->format('Y-m-d H:i:s') }}</p>
                    </div>
                    @endif
                    
                    <!-- Sensitive Information Exposure -->
                    <div class="bg-red-900/30 p-4 rounded-lg border border-red-500/50">
                        <label class="text-red-400 text-sm">🔓 Password Hash (Exposed!)</label>
                        <p class="text-red-300 font-mono text-xs break-all">{{ $user->password }}</p>
                    </div>
                    
                    @if($user->remember_token)
                    <div class="bg-red-900/30 p-4 rounded-lg border border-red-500/50">
                        <label class="text-red-400 text-sm">🔓 Remember Token (Exposed!)</label>
                        <p class="text-red-300 font-mono text-xs break-all">{{ $user->remember_token }}</p>
                    </div>
                    @endif
                </div>

                <!-- Action Buttons (Vulnerable) -->
                <div class="mt-6 space-y-2">
                    <a href="{{ route('tools.user-management.user', ['id' => $user->id - 1]) }}" 
                       class="block w-full bg-red-600/20 hover:bg-red-600/40 text-red-300 py-2 px-4 rounded-lg text-center transition">
                        ← Previous User (ID: {{ $user->id - 1 }})
                    </a>
                    <a href="{{ route('tools.user-management.user', ['id' => $user->id + 1]) }}" 
                       class="block w-full bg-red-600/20 hover:bg-red-600/40 text-red-300 py-2 px-4 rounded-lg text-center transition">
                        Next User (ID: {{ $user->id + 1 }}) →
                    </a>
                </div>
            </div>

            <!-- User's Posts -->
            <div class="bg-black/60 backdrop-blur-lg rounded-2xl p-6 border border-red-500/30">
                <h2 class="text-2xl font-bold text-red-400 mb-4">📝 User's Posts ({{ $posts->count() }})</h2>
                
                @if($posts->count() > 0)
                    <div class="space-y-4">
                        @foreach($posts as $post)
                        <div class="bg-gray-800/50 p-4 rounded-lg">
                            <h3 class="text-white font-semibold mb-2">{{ $post->title }}</h3>
                            <p class="text-gray-300 text-sm mb-3">{{ Str::limit($post->content, 100) }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-400 text-xs">{{ $post->created_at->diffForHumans() }}</span>
                                <a href="{{ route('tools.user-management.edit', ['id' => $post->id]) }}" 
                                   class="bg-yellow-600/20 hover:bg-yellow-600/40 text-yellow-300 px-3 py-1 rounded text-sm transition">
                                    ✏️ Edit (No Auth Check!)
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <p class="text-gray-400">This user has no posts yet.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Vulnerability Explanation -->
        <div class="mt-8 bg-black/60 backdrop-blur-lg rounded-2xl p-6 border border-yellow-500/30">
            <h2 class="text-2xl font-bold text-yellow-400 mb-4">🎓 Educational Content</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold text-red-400 mb-3">🚨 Vulnerability Details</h3>
                    <ul class="text-gray-300 space-y-2 text-sm">
                        <li>• <strong>Missing Authorization:</strong> No check if user can access this profile</li>
                        <li>• <strong>Direct Object Reference:</strong> User ID directly in URL</li>
                        <li>• <strong>Information Disclosure:</strong> Password hashes and tokens exposed</li>
                        <li>• <strong>Horizontal Privilege Escalation:</strong> Access any user's data</li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-green-400 mb-3">🛡️ How to Fix</h3>
                    <ul class="text-gray-300 space-y-2 text-sm">
                        <li>• <strong>Authorization Check:</strong> Verify user owns the resource</li>
                        <li>• <strong>Indirect References:</strong> Use UUIDs or session-based IDs</li>
                        <li>• <strong>Data Filtering:</strong> Only show necessary information</li>
                        <li>• <strong>Access Control Lists:</strong> Implement proper permissions</li>
                    </ul>
                </div>
            </div>

            <div class="mt-6 bg-gray-800/50 p-4 rounded-lg">
                <h4 class="text-yellow-400 font-semibold mb-2">🔍 Test URLs:</h4>
                <div class="font-mono text-sm text-gray-300 space-y-1">
                    <p>/owasp/a01/user/1 (View user ID 1)</p>
                    <p>/owasp/a01/user/999 (Try non-existent user)</p>
                    <p>/owasp/a01/edit-post/1 (Edit any post)</p>
                </div>
            </div>
        </div>

    </div>
</div>
</x-app-layout>
