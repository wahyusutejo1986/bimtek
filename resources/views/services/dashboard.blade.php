<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-search text-blue-600 mr-2"></i>
            {{ __('Content Search & Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

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
                                <i class="fas fa-comments text-gray-400 text-2xl"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Comments</dt>
                                    <dd class="text-lg font-medium text-gray-900">{{ $totalComments }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Content Management -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center mb-4">
                            <i class="fas fa-newspaper text-blue-500 mr-2"></i>
                            Content Management
                        </h3>
                        <p class="text-sm text-gray-600 mb-4">
                            Browse and manage posts, view detailed information, and edit content.
                        </p>
                        
                        <div class="space-y-3">
                            <div class="border-l-4 border-blue-400 pl-4">
                                <p class="text-sm font-medium text-gray-900">Post Browser</p>
                                <p class="text-xs text-gray-600">View individual posts and their details</p>
                                <a href="{{ route('services.post.view', ['id' => 1]) }}" class="text-blue-600 hover:text-blue-900 text-sm">
                                    Browse Posts →
                                </a>
                            </div>
                            
                            <div class="border-l-4 border-blue-400 pl-4">
                                <p class="text-sm font-medium text-gray-900">Content Editor</p>
                                <p class="text-xs text-gray-600">Edit and update existing posts</p>
                                <a href="{{ route('services.post.edit', ['id' => 1]) }}" class="text-blue-600 hover:text-blue-900 text-sm">
                                    Content Editor →
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- User Management -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center mb-4">
                            <i class="fas fa-users text-green-500 mr-2"></i>
                            User Management
                        </h3>
                        <p class="text-sm text-gray-600 mb-4">
                            Search users, view profiles, and manage user accounts.
                        </p>
                        
                        <div class="space-y-3">
                            <div class="border-l-4 border-green-400 pl-4">
                                <p class="text-sm font-medium text-gray-900">User Directory</p>
                                <p class="text-xs text-gray-600">Browse user profiles and information</p>
                                <a href="{{ route('services.user.profile', ['id' => 1]) }}" class="text-green-600 hover:text-green-900 text-sm">
                                    User Directory →
                                </a>
                            </div>
                            
                            <div class="border-l-4 border-green-400 pl-4">
                                <p class="text-sm font-medium text-gray-900">User Search</p>
                                <p class="text-xs text-gray-600">Search and filter users by various criteria</p>
                                <a href="{{ route('services.users') }}" class="text-green-600 hover:text-green-900 text-sm">
                                    User Search →
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search Features -->
            <div class="mt-8 bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center mb-4">
                        <i class="fas fa-search text-purple-500 mr-2"></i>
                        Advanced Search
                    </h3>
                    <p class="text-sm text-gray-600 mb-6">
                        Powerful search functionality to find content across the platform.
                    </p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="border border-gray-200 rounded-lg p-4">
                            <h4 class="font-medium text-gray-900 mb-2">Content Search</h4>
                            <p class="text-sm text-gray-600 mb-3">Search through all posts and content</p>
                            <a href="{{ route('services.search') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded text-sm transition">
                                Open Search →
                            </a>
                        </div>
                        
                        <div class="border border-gray-200 rounded-lg p-4">
                            <h4 class="font-medium text-gray-900 mb-2">File Manager</h4>
                            <p class="text-sm text-gray-600 mb-3">Upload and manage files and documents</p>
                            <a href="{{ route('services.upload') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded text-sm transition">
                                File Manager →
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="mt-8 bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                        <i class="fas fa-clock text-indigo-500 mr-2"></i>
                        Recent Activity
                    </h3>
                    
                    <div class="flow-root">
                        <ul class="-mb-8">
                            @foreach($recentPosts->take(5) as $post)
                            <li>
                                <div class="relative pb-8">
                                    @if(!$loop->last)
                                    <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                    @endif
                                    <div class="relative flex space-x-3">
                                        <div>
                                            <span class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">
                                                <i class="fas fa-file-alt text-white text-sm"></i>
                                            </span>
                                        </div>
                                        <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                            <div>
                                                <p class="text-sm text-gray-500">New post: <span class="font-medium text-gray-900">{{ $post->title }}</span></p>
                                            </div>
                                            <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                                {{ $post->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
