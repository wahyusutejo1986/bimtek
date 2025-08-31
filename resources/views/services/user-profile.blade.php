<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-user text-blue-600 mr-2"></i>
            {{ __('User Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Professional Header -->
            <div class="bg-blue-50 border border-blue-200 text-blue-800 px-4 py-3 rounded mb-6">
                <div class="flex items-center">
                    <i class="fas fa-info-circle mr-2"></i>
                    <strong>User Profile:</strong> View detailed information about organization members.
                </div>
            </div>

            <!-- User Profile -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="w-16 h-16 bg-gray-300 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-gray-600 text-2xl"></i>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">
                                {{ $user->first_name }} {{ $user->last_name }}
                            </h1>
                            <p class="text-sm text-gray-600">
                                Member ID: <span class="font-mono bg-gray-100 px-2 py-1 rounded">{{ $user->id }}</span>
                            </p>
                        </div>
                    </div>

                    <!-- User Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                            <h3 class="text-lg font-medium text-gray-800 mb-3">
                                <i class="fas fa-address-card mr-1"></i>
                                Contact Information
                            </h3>
                            <div class="space-y-2 text-sm">
                                <div>
                                    <span class="text-gray-600">Email:</span>
                                    <span class="font-mono text-gray-700">{{ $user->email }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-600">Member Since:</span>
                                    <span>{{ $user->created_at->format('M d, Y') }}</span>
                                </div>
                                @if($user->email_verified_at)
                                <div>
                                    <span class="text-gray-600">Email Verified:</span>
                                    <span class="text-green-600">{{ $user->email_verified_at->format('M d, Y') }}</span>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <h3 class="text-lg font-medium text-blue-800 mb-3">
                                <i class="fas fa-chart-bar mr-1"></i>
                                User Statistics
                            </h3>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Total Posts:</span>
                                    <span class="font-semibold">{{ $user->posts->count() }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Total Comments:</span>
                                    <span class="font-semibold">{{ $user->comments->count() }}</span>
                                </div>
                                @if($user->posts->count() > 0)
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Latest Post:</span>
                                    <span>{{ $user->posts->first()->created_at->format('M d, Y') }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- User's Posts -->
                    @if($user->posts->count() > 0)
                    <div class="mt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">
                            <i class="fas fa-newspaper mr-1"></i>
                            User's Posts ({{ $user->posts->count() }})
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($user->posts->take(6) as $post)
                            <div class="border border-gray-200 rounded-lg p-4">
                                <h4 class="font-medium text-gray-900 mb-2">{{ $post->title }}</h4>
                                <p class="text-sm text-gray-600 mb-2">
                                    {{ Str::limit($post->content, 100) }}
                                </p>
                                <div class="flex justify-between items-center text-xs text-gray-500">
                                    <span>{{ $post->created_at->format('M d, Y') }}</span>
                                    <a href="{{ route('services.post.view', ['id' => $post->id]) }}" 
                                       class="text-blue-600 hover:text-blue-800">
                                        View Post →
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @if($user->posts->count() > 6)
                        <p class="text-sm text-gray-500 mt-2">
                            ... and {{ $user->posts->count() - 6 }} more posts
                        </p>
                        @endif
                    </div>
                    @endif
                </div>

                <!-- Actions -->
                <div class="bg-gray-50 px-4 py-3 sm:px-6 flex justify-between">
                    <div class="space-x-2">
                        @if($user->posts->count() > 0)
                        <a href="{{ route('services.post.edit', ['id' => $user->posts->first()->id]) }}" 
                           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">
                            <i class="fas fa-edit mr-1"></i>
                            Edit Content
                        </a>
                        @endif
                    </div>
                    <a href="{{ route('services.dashboard') }}" 
                       class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded text-sm">
                        <i class="fas fa-arrow-left mr-1"></i>
                        Back to Services
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
