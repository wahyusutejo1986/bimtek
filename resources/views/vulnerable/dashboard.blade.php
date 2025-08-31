<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-bug text-red-600 mr-2"></i>
            {{ __('Vulnerability Testing Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Warning Banner -->
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    <strong>WARNING:</strong> This section contains intentional security vulnerabilities for educational purposes only!
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-newspaper text-gray-400 text-2xl"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Posts</dt>
                                    <dd class="text-lg font-medium text-gray-900">{{ $totalPosts }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-users text-gray-400 text-2xl"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Users</dt>
                                    <dd class="text-lg font-medium text-gray-900">{{ $totalUsers }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-user text-gray-400 text-2xl"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Current User ID</dt>
                                    <dd class="text-lg font-medium text-gray-900">{{ $currentUser->id }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Vulnerability Categories -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- IDOR Vulnerabilities -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                            <i class="fas fa-key text-red-500 mr-2"></i>
                            IDOR Vulnerabilities
                        </h3>
                        <p class="text-sm text-gray-600 mb-4">
                            Insecure Direct Object Reference - Access resources without proper authorization checks.
                        </p>
                        
                        <div class="space-y-3">
                            <div class="border-l-4 border-red-400 pl-4">
                                <p class="text-sm font-medium text-gray-900">View Any Post</p>
                                <p class="text-xs text-gray-600">Try: /vulnerable/post/1, /vulnerable/post/2, etc.</p>
                                <a href="{{ route('vulnerable.post.view', 1) }}" class="text-red-600 hover:text-red-900 text-sm">
                                    Test IDOR Post Access →
                                </a>
                            </div>
                            
                            <div class="border-l-4 border-red-400 pl-4">
                                <p class="text-sm font-medium text-gray-900">Edit Any Post</p>
                                <p class="text-xs text-gray-600">Try: /vulnerable/post/edit/1, /vulnerable/post/edit/2, etc.</p>
                                <a href="{{ route('vulnerable.post.edit', 1) }}" class="text-red-600 hover:text-red-900 text-sm">
                                    Test IDOR Post Edit →
                                </a>
                            </div>
                            
                            <div class="border-l-4 border-red-400 pl-4">
                                <p class="text-sm font-medium text-gray-900">View Any User Profile</p>
                                <p class="text-xs text-gray-600">Try: /vulnerable/user/1, /vulnerable/user/2, etc.</p>
                                <a href="{{ route('vulnerable.user.profile', 1) }}" class="text-red-600 hover:text-red-900 text-sm">
                                    Test IDOR User Access →
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SQL Injection Vulnerabilities -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                            <i class="fas fa-database text-red-500 mr-2"></i>
                            SQL Injection Vulnerabilities
                        </h3>
                        <p class="text-sm text-gray-600 mb-4">
                            Unfiltered user input directly concatenated into SQL queries.
                        </p>
                        
                        <div class="space-y-3">
                            <div class="border-l-4 border-red-400 pl-4">
                                <p class="text-sm font-medium text-gray-900">Post Search</p>
                                <p class="text-xs text-gray-600">Try: ' OR 1=1 --, ' UNION SELECT..., etc.</p>
                                <a href="{{ route('vulnerable.search') }}" class="text-red-600 hover:text-red-900 text-sm">
                                    Test SQL Injection →
                                </a>
                            </div>
                            
                            <div class="border-l-4 border-red-400 pl-4">
                                <p class="text-sm font-medium text-gray-900">User Search</p>
                                <p class="text-xs text-gray-600">Try: ' OR '1'='1, ' UNION SELECT..., etc.</p>
                                <a href="{{ route('vulnerable.users') }}" class="text-red-600 hover:text-red-900 text-sm">
                                    Test User SQLi →
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Exploit Examples -->
            <div class="mt-8 bg-gray-900 overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-white mb-4">
                        <i class="fas fa-terminal text-green-400 mr-2"></i>
                        Sample Exploit Payloads
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="text-sm font-medium text-green-400 mb-2">IDOR Examples:</h4>
                            <div class="bg-gray-800 p-3 rounded text-xs font-mono text-gray-300">
                                <div>/vulnerable/post/1</div>
                                <div>/vulnerable/post/99</div>
                                <div>/vulnerable/user/1</div>
                                <div>/vulnerable/post/edit/1</div>
                            </div>
                        </div>
                        
                        <div>
                            <h4 class="text-sm font-medium text-green-400 mb-2">SQL Injection Examples:</h4>
                            <div class="bg-gray-800 p-3 rounded text-xs font-mono text-gray-300">
                                <div>' OR 1=1 --</div>
                                <div>' UNION SELECT 1,2,3,4 --</div>
                                <div>' OR '1'='1</div>
                                <div>'; DROP TABLE posts; --</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
