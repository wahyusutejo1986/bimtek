<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-user text-red-600 mr-2"></i>
            {{ __('User Profile') }} - IDOR Vulnerability
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Vulnerability Warning -->
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    <strong>IDOR Vulnerability:</strong> You can view any user's profile by changing the ID in the URL!
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
                                User ID: <span class="font-mono bg-gray-100 px-2 py-1 rounded">{{ $user->id }}</span>
                            </p>
                        </div>
                    </div>

                    <!-- Sensitive Information (Should be protected!) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                            <h3 class="text-lg font-medium text-red-800 mb-3">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                Sensitive Information
                            </h3>
                            <div class="space-y-2 text-sm">
                                <div>
                                    <span class="text-gray-600">Email:</span>
                                    <span class="font-mono text-red-700">{{ $user->email }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-600">Account Created:</span>
                                    <span>{{ $user->created_at->format('M d, Y H:i:s') }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-600">Last Updated:</span>
                                    <span>{{ $user->updated_at->format('M d, Y H:i:s') }}</span>
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
                                    <a href="{{ route('vulnerable.post.view', $post->id) }}" 
                                       class="text-red-600 hover:text-red-800">
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
                        <a href="{{ route('vulnerable.post.edit', $user->posts->first()->id) }}" 
                           class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded text-sm">
                            <i class="fas fa-edit mr-1"></i>
                            Edit Their Post (IDOR)
                        </a>
                        @endif
                    </div>
                    <a href="{{ route('vulnerable.dashboard') }}" 
                       class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded text-sm">
                        <i class="fas fa-arrow-left mr-1"></i>
                        Back
                    </a>
                </div>
            </div>

            <!-- IDOR Testing Panel -->
            <div class="mt-6 bg-gray-900 rounded-lg p-4">
                <h3 class="text-green-400 font-medium mb-3">
                    <i class="fas fa-bug mr-2"></i>
                    IDOR Testing - View Other Users:
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-300 text-sm mb-2">Sequential access:</p>
                        <div class="space-y-1">
                            @for($i = max(1, $user->id - 2); $i <= $user->id + 2; $i++)
                            <a href="{{ route('vulnerable.user.profile', $i) }}" 
                               class="block text-red-400 hover:text-red-300 text-sm font-mono
                                      {{ $i == $user->id ? 'bg-gray-800 px-2 py-1 rounded' : '' }}">
                                /vulnerable/user/{{ $i }} {{ $i == $user->id ? '(current)' : '' }}
                            </a>
                            @endfor
                        </div>
                    </div>
                    <div>
                        <p class="text-gray-300 text-sm mb-2">Random user access:</p>
                        <div class="space-y-1">
                            @foreach([1, 5, 10, 25, 50, 100] as $testId)
                            <a href="{{ route('vulnerable.user.profile', $testId) }}" 
                               class="block text-red-400 hover:text-red-300 text-sm font-mono">
                                /vulnerable/user/{{ $testId }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
