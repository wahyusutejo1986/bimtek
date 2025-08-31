<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-edit text-blue-600 mr-2"></i>
            {{ __('Edit Content') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Professional Header -->
            <div class="bg-blue-50 border border-blue-200 text-blue-800 px-4 py-3 rounded mb-6">
                <div class="flex items-center">
                    <i class="fas fa-info-circle mr-2"></i>
                    <strong>Content Editor:</strong> Modify and update published content in the knowledge base.
                </div>
            </div>

            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
            @endif

            <!-- Edit Form -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <form method="POST" action="{{ route('services.post.update') }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $post->id }}">
                    
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
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">
                            <i class="fas fa-save mr-1"></i>
                            Save Changes
                        </button>
                        <div class="space-x-2">
                            <a href="{{ route('services.post.view', ['id' => $post->id]) }}" 
                               class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm">
                                <i class="fas fa-eye mr-1"></i>
                                View Content
                            </a>
                            <a href="{{ route('services.dashboard') }}" 
                               class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded text-sm">
                                <i class="fas fa-arrow-left mr-1"></i>
                                Back to Services
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
