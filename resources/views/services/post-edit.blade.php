<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-edit text-red-600 mr-2"></i>
            {{ __('Edit Post') }} - IDOR Vulnerability
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Vulnerability Warning -->
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    <strong>IDOR Vulnerability:</strong> You can edit any post by changing the ID! No ownership check performed.
                </div>
            </div>

            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
            @endif

            <!-- Edit Form -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <form method="POST" action="{{ route('services.post.update', $post->id) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="px-4 py-5 sm:p-6">
                        <div class="mb-4">
                            <div class="flex justify-between items-center mb-2">
                                <label for="title" class="block text-sm font-medium text-gray-700">Post Title</label>
                                <span class="text-xs text-gray-500">
                                    Editing Post ID: <span class="font-mono bg-gray-100 px-2 py-1 rounded">{{ $post->id }}</span>
                                    | Author: {{ $post->author->first_name }} {{ $post->author->last_name }}
                                </span>
                            </div>
                            <input type="text" 
                                   name="title" 
                                   id="title" 
                                   value="{{ $post->title }}"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500"
                                   required>
                        </div>

                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Content</label>
                            <textarea name="content" 
                                      id="content" 
                                      rows="10"
                                      class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500"
                                      required>{{ $post->content }}</textarea>
                        </div>

                        <!-- Post Info -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-medium text-gray-900 mb-2">Post Information (Read-Only)</h4>
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div>
                                    <span class="text-gray-600">Post ID:</span>
                                    <span class="font-mono">{{ $post->id }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-600">Author ID:</span>
                                    <span class="font-mono">{{ $post->author_id }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-600">Created:</span>
                                    <span>{{ $post->created_at->format('M d, Y H:i') }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-600">Category:</span>
                                    <span>{{ $post->category->name }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 flex justify-between">
                        <button type="submit" 
                                class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded">
                            <i class="fas fa-save mr-1"></i>
                            Save Changes (Vulnerable)
                        </button>
                        <div class="space-x-2">
                            <a href="{{ route('services.post.view', $post->id) }}" 
                               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">
                                <i class="fas fa-eye mr-1"></i>
                                View Post
                            </a>
                            <a href="{{ route('services.dashboard') }}" 
                               class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded text-sm">
                                <i class="fas fa-arrow-left mr-1"></i>
                                Back
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- IDOR Testing Panel -->
            <div class="mt-6 bg-gray-900 rounded-lg p-4">
                <h3 class="text-green-400 font-medium mb-3">
                    <i class="fas fa-bug mr-2"></i>
                    IDOR Testing - Edit Other Posts:
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-300 text-sm mb-2">Try editing these posts:</p>
                        <div class="space-y-1">
                            @for($i = max(1, $post->id - 2); $i <= $post->id + 2; $i++)
                            <a href="{{ route('services.post.edit', $i) }}" 
                               class="block text-red-400 hover:text-red-300 text-sm font-mono
                                      {{ $i == $post->id ? 'bg-gray-800 px-2 py-1 rounded' : '' }}">
                                /vulnerable/post/edit/{{ $i }} {{ $i == $post->id ? '(current)' : '' }}
                            </a>
                            @endfor
                        </div>
                    </div>
                    <div>
                        <p class="text-gray-300 text-sm mb-2">Random post editing:</p>
                        <div class="space-y-1">
                            @foreach([1, 10, 25, 50, 100] as $testId)
                            <a href="{{ route('services.post.edit', $testId) }}" 
                               class="block text-red-400 hover:text-red-300 text-sm font-mono">
                                /vulnerable/post/edit/{{ $testId }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
