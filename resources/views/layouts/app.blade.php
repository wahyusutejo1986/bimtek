<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <style>
            body {
                font-family: 'Inter', sans-serif;
            }
            
            .sidebar-gradient {
                background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
                position: relative;
            }
            
            .sidebar-gradient::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.15);
                z-index: 1;
            }
            
            .sidebar-gradient > * {
                position: relative;
                z-index: 2;
            }
            
            .nav-link {
                transition: all 0.3s ease;
                color: rgba(255, 255, 255, 0.9);
                text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            }
            
            .nav-link:hover {
                transform: translateX(5px);
                background-color: rgba(255, 255, 255, 0.15);
                color: #ffffff;
                text-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
            }
            
            .nav-link.active {
                background-color: rgba(255, 255, 255, 0.25);
                border-left: 4px solid #ffffff;
                color: #ffffff;
                text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
                font-weight: 600;
            }
            
            .sidebar-title {
                color: #ffffff;
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            }
            
            .sidebar-user-info {
                color: rgba(255, 255, 255, 0.95);
                text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            }
            
            .sidebar-user-email {
                color: rgba(255, 255, 255, 0.8);
            }
        </style>

        @livewireStyles

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.js" defer></script>
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <div class="min-h-screen flex">
            <!-- Sidebar -->
            <div class="hidden md:flex md:flex-col md:w-64">
                <div class="flex flex-col flex-grow pt-5 overflow-y-auto sidebar-gradient">
                    <div class="flex items-center flex-shrink-0 px-6">
                        <i class="fas fa-newspaper text-2xl text-white mr-3"></i>
                        <h1 class="text-xl font-bold sidebar-title">{{ config('app.name', 'Laravel') }}</h1>
                    </div>
                    <div class="mt-8 flex-1 flex flex-col">
                        <nav class="flex-1 px-4 space-y-2">
                            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }} group flex items-center px-4 py-3 text-sm font-medium rounded-lg">
                                <i class="fas fa-tachometer-alt mr-3 text-lg"></i>
                                Dashboard
                            </a>
                            
                            <a href="{{ route('posts') }}" class="nav-link {{ request()->routeIs('posts') ? 'active' : '' }} group flex items-center px-4 py-3 text-sm font-medium rounded-lg">
                                <i class="fas fa-newspaper mr-3 text-lg"></i>
                                Posts
                            </a>
                            
                            <a href="{{ route('categories') }}" class="nav-link {{ request()->routeIs('categories') ? 'active' : '' }} group flex items-center px-4 py-3 text-sm font-medium rounded-lg">
                                <i class="fas fa-folder mr-3 text-lg"></i>
                                Categories
                            </a>
                            
                            <a href="{{ route('tags') }}" class="nav-link {{ request()->routeIs('tags') ? 'active' : '' }} group flex items-center px-4 py-3 text-sm font-medium rounded-lg">
                                <i class="fas fa-tags mr-3 text-lg"></i>
                                Tags
                            </a>
                            
                            <div class="border-t border-white/20 my-4"></div>
                            
                            <a href="{{ route('profile.show') }}" class="nav-link group flex items-center px-4 py-3 text-sm font-medium rounded-lg">
                                <i class="fas fa-user-cog mr-3 text-lg"></i>
                                Profile Settings
                            </a>
                        </nav>
                    </div>
                    
                    <!-- User Info -->
                    <div class="flex-shrink-0 flex border-t border-white/20 p-4">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium sidebar-user-info">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</p>
                                <p class="text-xs sidebar-user-email">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="flex-1 flex flex-col overflow-hidden">
                @livewire('navigation-dropdown')

                <!-- Page Heading -->
                @if (isset($header))
                    <header class="bg-white shadow-sm border-b border-gray-200">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <!-- Page Content -->
                <main class="flex-1 overflow-x-hidden overflow-y-auto">
                    {{ $slot }}
                </main>
            </div>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
