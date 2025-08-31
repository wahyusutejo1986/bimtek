<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
                <i class="fas fa-tachometer-alt mr-3 text-indigo-600"></i>
                {{ __('Dashboard') }}
            </h2>
            <div class="text-sm text-gray-600">
                Welcome back, {{ Auth::user()->name }}!
            </div>
        </div>
    </x-slot>

    <style>
        .dashboard-bg {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0e7ff 25%, #fdf2f8 50%, #f0fdf4 75%, #fff7ed 100%);
            background-size: 400% 400%;
            animation: gradientShift 20s ease infinite;
            position: relative;
        }
        
        .dashboard-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                radial-gradient(circle at 25% 25%, rgba(79, 70, 229, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 75% 75%, rgba(124, 58, 237, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 50% 50%, rgba(16, 185, 129, 0.1) 0%, transparent 50%);
            animation: backgroundFloat 25s ease-in-out infinite;
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        @keyframes backgroundFloat {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-10px) rotate(1deg); }
            66% { transform: translateY(10px) rotate(-1deg); }
        }
        
        .floating-icons {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }
        
        .floating-icon {
            position: absolute;
            opacity: 0.1;
            animation: iconFloat 15s linear infinite;
        }
        
        .floating-icon:nth-child(1) {
            left: 10%;
            font-size: 2rem;
            animation-delay: 0s;
        }
        
        .floating-icon:nth-child(2) {
            left: 70%;
            font-size: 1.5rem;
            animation-delay: 5s;
        }
        
        .floating-icon:nth-child(3) {
            left: 30%;
            font-size: 1.8rem;
            animation-delay: 10s;
        }
        
        .floating-icon:nth-child(4) {
            left: 90%;
            font-size: 1.2rem;
            animation-delay: 15s;
        }
        
        @keyframes iconFloat {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }
            10%, 90% {
                opacity: 0.1;
            }
            50% {
                transform: translateY(-50px) rotate(180deg);
            }
            100% {
                transform: translateY(-100vh) rotate(360deg);
                opacity: 0;
            }
        }
        
        .card-gradient {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9) 0%, rgba(255, 255, 255, 0.8) 100%);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>

    <div class="py-12 dashboard-bg min-h-screen relative overflow-hidden">
        <!-- Floating Icons Background -->
        <div class="floating-icons">
            <i class="floating-icon fas fa-chart-line text-blue-500"></i>
            <i class="floating-icon fas fa-users text-green-500"></i>
            <i class="floating-icon fas fa-newspaper text-purple-500"></i>
            <i class="floating-icon fas fa-comments text-orange-500"></i>
        </div>
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="card-gradient overflow-hidden shadow-lg rounded-2xl transform hover:scale-105 transition duration-300 hover:shadow-2xl">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-gradient-to-r from-blue-400 to-blue-600 rounded-full flex items-center justify-center">
                                    <i class="fas fa-newspaper text-white text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-600">Total Posts</div>
                                <div class="text-2xl font-bold text-gray-900">{{ \App\Models\Post::count() }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-gradient overflow-hidden shadow-lg rounded-2xl transform hover:scale-105 transition duration-300 hover:shadow-2xl">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-gradient-to-r from-green-400 to-green-600 rounded-full flex items-center justify-center">
                                    <i class="fas fa-folder text-white text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-600">Categories</div>
                                <div class="text-2xl font-bold text-gray-900">{{ \App\Models\Category::count() }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-gradient overflow-hidden shadow-lg rounded-2xl transform hover:scale-105 transition duration-300 hover:shadow-2xl">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-comments text-purple-600 text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-600">Comments</div>
                                <div class="text-2xl font-bold text-gray-900">{{ \App\Models\Comment::count() }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-lg rounded-2xl transform hover:scale-105 transition duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-tags text-orange-600 text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-600">Tags</div>
                                <div class="text-2xl font-bold text-gray-900">{{ \App\Models\Tag::count() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white overflow-hidden shadow-lg rounded-2xl mb-8">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-bolt mr-2 text-yellow-500"></i>
                        Quick Actions
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <a href="{{ route('posts') }}" class="flex items-center p-4 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl hover:from-blue-600 hover:to-blue-700 transition duration-300 transform hover:scale-105">
                            <i class="fas fa-plus-circle text-2xl mr-3"></i>
                            <div>
                                <div class="font-semibold">Manage Posts</div>
                                <div class="text-sm opacity-90">Create and edit posts</div>
                            </div>
                        </a>

                        <a href="{{ route('categories') }}" class="flex items-center p-4 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-xl hover:from-green-600 hover:to-green-700 transition duration-300 transform hover:scale-105">
                            <i class="fas fa-folder-plus text-2xl mr-3"></i>
                            <div>
                                <div class="font-semibold">Categories</div>
                                <div class="text-sm opacity-90">Organize your content</div>
                            </div>
                        </a>

                        <a href="{{ route('tags') }}" class="flex items-center p-4 bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-xl hover:from-purple-600 hover:to-purple-700 transition duration-300 transform hover:scale-105">
                            <i class="fas fa-tag text-2xl mr-3"></i>
                            <div>
                                <div class="font-semibold">Tags</div>
                                <div class="text-sm opacity-90">Tag management</div>
                            </div>
                        </a>

                        <a href="{{ route('profile.show') }}" class="flex items-center p-4 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-xl hover:from-orange-600 hover:to-orange-700 transition duration-300 transform hover:scale-105">
                            <i class="fas fa-user-cog text-2xl mr-3"></i>
                            <div>
                                <div class="font-semibold">Profile</div>
                                <div class="text-sm opacity-90">Account settings</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Recent Posts -->
                <div class="bg-white overflow-hidden shadow-lg rounded-2xl">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                            <i class="fas fa-clock mr-2 text-blue-500"></i>
                            Recent Posts
                        </h3>
                        <div class="space-y-4">
                            @forelse(\App\Models\Post::latest()->take(5)->get() as $post)
                                <div class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-200">
                                    <div class="w-2 h-2 bg-blue-500 rounded-full mr-3"></div>
                                    <div class="flex-1">
                                        <div class="font-medium text-gray-900 truncate">{{ $post->title }}</div>
                                        <div class="text-sm text-gray-600">{{ $post->created_at->diffForHumans() }}</div>
                                    </div>
                                    <i class="fas fa-chevron-right text-gray-400"></i>
                                </div>
                            @empty
                                <div class="text-center py-8 text-gray-500">
                                    <i class="fas fa-file-alt text-4xl mb-4"></i>
                                    <p>No posts yet. <a href="{{ route('posts') }}" class="text-blue-600 hover:underline">Create your first post!</a></p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- System Info -->
                <div class="bg-white overflow-hidden shadow-lg rounded-2xl">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                            <i class="fas fa-info-circle mr-2 text-green-500"></i>
                            System Information
                        </h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                <span class="text-gray-600">Laravel Version</span>
                                <span class="font-semibold text-gray-900">{{ app()->version() }}</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                <span class="text-gray-600">PHP Version</span>
                                <span class="font-semibold text-gray-900">{{ PHP_VERSION }}</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                <span class="text-gray-600">Environment</span>
                                <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">{{ app()->environment() }}</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                <span class="text-gray-600">Debug Mode</span>
                                <span class="px-2 py-1 text-xs font-semibold {{ config('app.debug') ? 'text-red-800 bg-red-100' : 'text-green-800 bg-green-100' }} rounded-full">
                                    {{ config('app.debug') ? 'ON' : 'OFF' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
