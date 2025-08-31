<x-slot name="header">
    <div class="flex items-center justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
            <i class="fas fa-newspaper mr-3 text-indigo-600"></i>
            Posts Management
        </h2>
        <div class="text-sm text-gray-600">
            {{ $posts->total() }} total posts
        </div>
    </div>
</x-slot>

<div class="py-8 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Success Message -->
        @if (session()->has('message'))
            <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6 rounded-r-lg animate-fade-in-up">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">{{ session('message') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Header Actions -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">All Posts</h3>
                    <p class="text-gray-600">Manage your blog posts and content</p>
                </div>
                @if (Request::getPathInfo() == '/dashboard/posts')
                    <button wire:click="create()" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-200 inline-flex items-center transform hover:scale-105">
                        <i class="fas fa-plus mr-2"></i>
                        Create New Post
                    </button>
                @endif
            </div>
        </div>

        <!-- Create/Edit Modal -->
        @if ($isOpen)
            @include('livewire.posts.create')
        @endif

        <!-- Posts Grid -->
        @if($posts->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                @foreach ($posts as $post)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover animate-fade-in-up">
                        <!-- Post Image -->
                        @php
                            $featuredImage = $post->images->where('featured', true)->first();
                        @endphp
                        
                        @if($featuredImage)
                            <div class="h-48 bg-cover bg-center relative" style="background-image: url('{{ $featuredImage->url }}')">
                                <div class="absolute inset-0 bg-black bg-opacity-20"></div>
                                <div class="absolute top-4 right-4">
                                    @if($post->category)
                                        <span class="bg-indigo-600 text-white px-3 py-1 rounded-full text-xs font-medium">
                                            {{ $post->category->name }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="h-48 bg-gradient-to-br from-indigo-500 to-purple-600 relative">
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <i class="fas fa-newspaper text-white text-4xl opacity-50"></i>
                                </div>
                                <div class="absolute top-4 right-4">
                                    @if($post->category)
                                        <span class="bg-white bg-opacity-20 text-white px-3 py-1 rounded-full text-xs font-medium">
                                            {{ $post->category->name }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <!-- Post Content -->
                        <div class="p-6">
                            <div class="flex items-center text-sm text-gray-500 mb-3">
                                <i class="fas fa-user mr-2"></i>
                                {{ $post->author->name }}
                                <span class="mx-2">•</span>
                                <i class="fas fa-calendar mr-2"></i>
                                {{ $post->created_at->format('M d, Y') }}
                            </div>
                            
                            <h3 class="font-bold text-xl mb-3 text-gray-900 line-clamp-2">{{ $post->title }}</h3>
                            
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                {{ Str::words(strip_tags($post->content), 20, '...') }}
                            </p>

                            <!-- Tags -->
                            @if($post->tags->count() > 0)
                                <div class="mb-4">
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($post->tags->take(3) as $tag)
                                            <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded-md text-xs">
                                                #{{ $tag->name }}
                                            </span>
                                        @endforeach
                                        @if($post->tags->count() > 3)
                                            <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded-md text-xs">
                                                +{{ $post->tags->count() - 3 }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <!-- Stats -->
                            <div class="flex items-center text-sm text-gray-500 mb-4">
                                <div class="flex items-center mr-4">
                                    <i class="fas fa-eye mr-1"></i>
                                    <span>{{ rand(50, 500) }}</span>
                                </div>
                                <div class="flex items-center mr-4">
                                    <i class="fas fa-comments mr-1"></i>
                                    <span>{{ $post->comments->count() }}</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-heart mr-1"></i>
                                    <span>{{ rand(5, 50) }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="bg-gray-50 px-6 py-4 flex space-x-3">
                            <a href="{{ url('dashboard/posts', $post->id) }}" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white text-center py-2 px-4 rounded-lg font-medium transition duration-200 inline-flex items-center justify-center">
                                <i class="fas fa-eye mr-2"></i>
                                View
                            </a>
                            <button wire:click="edit({{ $post->id }})" class="flex-1 bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg font-medium transition duration-200 inline-flex items-center justify-center">
                                <i class="fas fa-edit mr-2"></i>
                                Edit
                            </button>
                            <button wire:click="delete({{ $post->id }})" onclick="return confirm('Are you sure you want to delete this post?')" class="flex-1 bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg font-medium transition duration-200 inline-flex items-center justify-center">
                                <i class="fas fa-trash mr-2"></i>
                                Delete
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-xl shadow-lg p-12 text-center">
                <div class="max-w-md mx-auto">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-newspaper text-gray-400 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">No posts yet</h3>
                    <p class="text-gray-600 mb-6">Get started by creating your first blog post. Share your thoughts with the world!</p>
                    <button wire:click="create()" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-200 inline-flex items-center">
                        <i class="fas fa-plus mr-2"></i>
                        Create Your First Post
                    </button>
                </div>
            </div>
        @endif

        <!-- Pagination -->
        @if($posts->hasPages())
            <div class="mt-8">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
