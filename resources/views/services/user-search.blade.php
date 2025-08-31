<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-users text-blue-600 mr-2"></i>
            {{ __('User Directory') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Professional Header -->
            <div class="bg-blue-50 border border-blue-200 text-blue-800 px-4 py-3 rounded mb-6">
                <div class="flex items-center">
                    <i class="fas fa-info-circle mr-2"></i>
                    <strong>User Directory:</strong> Search and browse user profiles in the organization directory.
                </div>
            </div>

            <!-- Search Form -->
            <div class="bg-white overflow-hidden shadow rounded-lg mb-6">
                <div class="px-4 py-5 sm:p-6">
                    <form method="GET" action="{{ route('services.users') }}">
                        <div class="flex">
                            <input type="text" 
                                   name="name" 
                                   value="{{ $name }}"
                                   placeholder="Search users by name..."
                                   class="flex-1 border border-gray-300 rounded-l-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <button type="submit" 
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-r-md">
                                <i class="fas fa-search mr-1"></i>
                                Search Directory
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Results -->
            @if($users->count() > 0)
            <div class="bg-white shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        User Search Results ({{ $users->count() }} found)
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        Query: <code class="bg-gray-100 px-2 py-1 rounded">{{ $name }}</code>
                    </p>
                </div>
                <ul class="divide-y divide-gray-200">
                    @foreach($users as $user)
                    <li class="px-4 py-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-gray-600"></i>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-sm font-medium text-gray-900">
                                        {{ $user->first_name ?? 'N/A' }} {{ $user->last_name ?? '' }}
                                    </h4>
                                    <p class="text-sm text-gray-600">
                                        📧 {{ $user->email ?? 'N/A' }}
                                    </p>
                                    @if(isset($user->created_at))
                                    <p class="text-xs text-gray-500">
                                        Joined: {{ date('M d, Y', strtotime($user->created_at)) }}
                                    </p>
                                    @endif
                                </div>
                            </div>
                            <div class="text-xs text-gray-400 text-right">
                                <div>ID: {{ $user->id ?? 'N/A' }}</div>
                                @if(isset($user->id))
                                <a href="{{ route('services.user.profile', ['id' => $user->id]) }}" 
                                   class="text-blue-600 hover:text-blue-800 mt-1 inline-block">
                                    View Profile →
                                </a>
                                @endif
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            @elseif(!empty($name))
            <div class="text-center py-8">
                <i class="fas fa-users text-gray-400 text-3xl mb-2"></i>
                <p class="text-gray-600">No users found for: <strong>{{ $name }}</strong></p>
            </div>
            @endif

            <!-- Back to Dashboard -->
            <div class="mt-6">
                <a href="{{ route('services.dashboard') }}" 
                   class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">
                    <i class="fas fa-arrow-left mr-1"></i>
                    Back to Services Dashboard
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
