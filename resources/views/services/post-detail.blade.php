<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-eye text-blue-600 mr-2"></i>
            {{ __('Content Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Professional Header -->
            <div class="bg-blue-50 border border-blue-200 text-blue-800 px-4 py-3 rounded mb-6">
                <div class="flex items-center">
                    <i class="fas fa-info-circle mr-2"></i>
                    <strong>Content Viewer:</strong> View detailed information about published content.
                </div>
            </div>

            <!-- Post Content -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">{{ $post->title }}</h1>
                            <p class="text-sm text-gray-600 mt-1">
                                Content ID: <span class="font-mono bg-gray-100 px-2 py-1 rounded">{{ $post->id }}</span>
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
                        <a href="{{ route('services.post.edit', ['id' => $post->id]) }}" 
                           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">
                            <i class="fas fa-edit mr-1"></i>
                            Edit Content
                        </a>
                        <a href="{{ route('services.user.profile', ['id' => $post->author_id]) }}" 
                           class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm">
                            <i class="fas fa-user mr-1"></i>
                            View Author Profile
                        </a>
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
