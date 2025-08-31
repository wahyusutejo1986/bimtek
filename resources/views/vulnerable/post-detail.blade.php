<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-eye text-red-600 mr-2"></i>
            {{ __('Post Details') }} - IDOR Vulnerability
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Vulnerability Warning -->
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    <strong>IDOR Vulnerability:</strong> You can view any post by changing the ID in the URL!
                </div>
            </div>

            <!-- Post Content -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">{{ $post->title }}</h1>
                            <p class="text-sm text-gray-600 mt-1">
                                Post ID: <span class="font-mono bg-gray-100 px-2 py-1 rounded">{{ $post->id }}</span>
                                | Author ID: <span class="font-mono bg-gray-100 px-2 py-1 rounded">{{ $post->author_id }}</span>
                            </p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-600">
                                by {{ $post->author->first_name }} {{ $post->author->last_name }}
                            </p>
                            <p class="text-xs text-gray-500">
                                {{ $post->created_at->format('M d, Y') }}
                            </p>
                        </div>
                    </div>

                    <div class="prose max-w-none">
                        <p class="text-gray-800 leading-relaxed">{{ $post->content }}</p>
                    </div>

                    <!-- Category and Tags -->
                    <div class="mt-6 flex flex-wrap gap-2">
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">
                            {{ $post->category->name }}
                        </span>
                        @foreach($post->tags as $tag)
                        <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm">
                            #{{ $tag->name }}
                        </span>
                        @endforeach
                    </div>
                </div>

                <!-- Actions -->
                <div class="bg-gray-50 px-4 py-3 sm:px-6 flex justify-between">
                    <div class="flex space-x-2">
                        <a href="{{ route('vulnerable.post.edit', $post->id) }}" 
                           class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded text-sm">
                            <i class="fas fa-edit mr-1"></i>
                            Edit Post (IDOR)
                        </a>
                        <a href="{{ route('vulnerable.user.profile', $post->author_id) }}" 
                           class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded text-sm">
                            <i class="fas fa-user mr-1"></i>
                            View Author (IDOR)
                        </a>
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
                    IDOR Testing - Try These URLs:
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-300 text-sm mb-2">Previous/Next Posts:</p>
                        <div class="space-y-1">
                            @for($i = max(1, $post->id - 2); $i <= $post->id + 2; $i++)
                            <a href="{{ route('vulnerable.post.view', $i) }}" 
                               class="block text-red-400 hover:text-red-300 text-sm font-mono
                                      {{ $i == $post->id ? 'bg-gray-800 px-2 py-1 rounded' : '' }}">
                                /vulnerable/post/{{ $i }} {{ $i == $post->id ? '(current)' : '' }}
                            </a>
                            @endfor
                        </div>
                    </div>
                    <div>
                        <p class="text-gray-300 text-sm mb-2">Random Access:</p>
                        <div class="space-y-1">
                            @foreach([1, 10, 25, 50, 100] as $testId)
                            <a href="{{ route('vulnerable.post.view', $testId) }}" 
                               class="block text-red-400 hover:text-red-300 text-sm font-mono">
                                /vulnerable/post/{{ $testId }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
