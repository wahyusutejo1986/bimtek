<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ env('APP_NAME') }} - News Portal</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        
        <style>
            body {
                font-family: 'Inter', sans-serif;
            }
            
            .gradient-bg {
                background: linear-gradient(135deg, #1e1b4b 0%, #312e81 25%, #4c1d95 50%, #581c87 75%, #1f2937 100%);
                position: relative;
            }
            
            .gradient-bg::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.6);
                z-index: 1;
            }
            
            .gradient-bg > * {
                position: relative;
                z-index: 2;
            }
            
            .text-white-contrast {
                color: #ffffff;
                text-shadow: 0 4px 8px rgba(0, 0, 0, 0.8), 0 2px 4px rgba(0, 0, 0, 0.6);
            }
            
            .text-white-soft {
                color: rgba(255, 255, 255, 0.95);
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.7), 0 1px 2px rgba(0, 0, 0, 0.5);
            }
            
            .card-hover {
                transition: all 0.3s ease;
            }
            
            .card-hover:hover {
                transform: translateY(-5px);
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            }
            
            .animate-fade-in-up {
                animation: fadeInUp 0.6s ease-out;
            }
            
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            .hero-pattern {
                background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.08'%3E%3Ccircle cx='5' cy='5' r='5'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            }
            
            /* Dark theme floating nodes */
            .node {
                position: absolute;
                background: rgba(255, 255, 255, 0.05);
                border: 1px solid rgba(255, 255, 255, 0.1);
                border-radius: 50%;
                animation: float 6s ease-in-out infinite;
            }
                background-image: 
                    radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
                    radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.15) 0%, transparent 50%),
                    radial-gradient(circle at 40% 40%, rgba(120, 219, 255, 0.1) 0%, transparent 50%);
                animation: backgroundShift 20s ease-in-out infinite;
            }
            
            .stats-bg {
                background: linear-gradient(45deg, #f0f9ff 0%, #e0e7ff 50%, #fdf2f8 100%);
                background-size: 400% 400%;
                animation: gradientShift 15s ease infinite;
            }
            
            @keyframes backgroundShift {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-20px); }
            }
            
            @keyframes gradientShift {
                0% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
                100% { background-position: 0% 50%; }
            }
            
            /* Floating Nodes Animation */
            .floating-nodes {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                overflow: hidden;
                z-index: 1;
            }
            
            .node {
                position: absolute;
                background: rgba(255, 255, 255, 0.1);
                border-radius: 50%;
                animation: float 6s ease-in-out infinite;
            }
            
            .node:nth-child(1) {
                width: 80px;
                height: 80px;
                left: 10%;
                animation-delay: 0s;
                animation-duration: 8s;
            }
            
            .node:nth-child(2) {
                width: 120px;
                height: 120px;
                left: 70%;
                animation-delay: 2s;
                animation-duration: 10s;
            }
            
            .node:nth-child(3) {
                width: 60px;
                height: 60px;
                left: 85%;
                animation-delay: 4s;
                animation-duration: 6s;
            }
            
            .node:nth-child(4) {
                width: 100px;
                height: 100px;
                left: 30%;
                animation-delay: 1s;
                animation-duration: 12s;
            }
            
            .node:nth-child(5) {
                width: 40px;
                height: 40px;
                left: 50%;
                animation-delay: 3s;
                animation-duration: 7s;
            }
            
            @keyframes float {
                0%, 100% {
                    transform: translateY(100vh) rotate(0deg);
                    opacity: 0;
                }
                10%, 90% {
                    opacity: 1;
                }
                50% {
                    transform: translateY(-100px) rotate(180deg);
                }
            }
            
            /* Geometric Background Pattern */
            .geometric-bg {
                background-image: 
                    linear-gradient(30deg, transparent 40%, rgba(79, 70, 229, 0.05) 40%, rgba(79, 70, 229, 0.05) 60%, transparent 60%),
                    linear-gradient(90deg, transparent 40%, rgba(124, 58, 237, 0.05) 40%, rgba(124, 58, 237, 0.05) 60%, transparent 60%);
                background-size: 60px 60px;
                animation: geometricMove 25s linear infinite;
            }
            
            @keyframes geometricMove {
                0% { background-position: 0 0, 0 0; }
                100% { background-position: 60px 60px, -60px -60px; }
            }
            
            /* Particle System */
            .particles {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                overflow: hidden;
                z-index: 1;
            }
            
            .particle {
                position: absolute;
                background: rgba(255, 255, 255, 0.8);
                border-radius: 50%;
                animation: particleFloat 15s linear infinite;
                box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
            }
            
            .particle:nth-child(odd) {
                background: rgba(251, 191, 36, 0.9);
                box-shadow: 0 0 15px rgba(251, 191, 36, 0.6);
            }
            
            .particle:nth-child(1) { width: 4px; height: 4px; left: 10%; animation-delay: 0s; }
            .particle:nth-child(2) { width: 6px; height: 6px; left: 20%; animation-delay: 2s; }
            .particle:nth-child(3) { width: 3px; height: 3px; left: 30%; animation-delay: 4s; }
            .particle:nth-child(4) { width: 5px; height: 5px; left: 40%; animation-delay: 6s; }
            .particle:nth-child(5) { width: 4px; height: 4px; left: 50%; animation-delay: 8s; }
            .particle:nth-child(6) { width: 7px; height: 7px; left: 60%; animation-delay: 10s; }
            .particle:nth-child(7) { width: 3px; height: 3px; left: 70%; animation-delay: 12s; }
            .particle:nth-child(8) { width: 5px; height: 5px; left: 80%; animation-delay: 14s; }
            .particle:nth-child(9) { width: 4px; height: 4px; left: 90%; animation-delay: 16s; }
            .particle:nth-child(10) { width: 6px; height: 6px; left: 95%; animation-delay: 18s; }
            
            @keyframes particleFloat {
                0% {
                    transform: translateY(100vh) translateX(0px);
                    opacity: 0;
                }
                10% {
                    opacity: 1;
                }
                90% {
                    opacity: 1;
                }
                100% {
                    transform: translateY(-100px) translateX(50px);
                    opacity: 0;
                }
            }
            
            .btn-white {
                background-color: #ffffff;
                color: #4f46e5;
                font-weight: 600;
                border: 2px solid transparent;
                transition: all 0.3s ease;
            }
            
            .btn-white:hover {
                background-color: #f8fafc;
                transform: translateY(-2px);
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            }
            
            .btn-outline-white {
                background-color: transparent;
                color: #ffffff;
                font-weight: 600;
                border: 2px solid #ffffff;
                transition: all 0.3s ease;
            }
            
            .btn-outline-white:hover {
                background-color: #ffffff;
                color: #4f46e5;
                transform: translateY(-2px);
                box-shadow: 0 8px 16px rgba(255, 255, 255, 0.2);
            }
        </style>
    </head>
    <body class="antialiased bg-gray-50">
        <!-- Navigation -->
        <nav class="fixed w-full z-50 bg-white/90 backdrop-blur-sm shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 flex items-center">
                            <i class="fas fa-newspaper text-3xl text-indigo-600 mr-3"></i>
                            <h1 class="text-2xl font-bold text-gray-900">{{ config('app.name', 'Laravel') }}</h1>
                        </div>
                    </div>
                    
                    @if (Route::has('login'))
                        <div class="flex items-center space-x-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition duration-200 flex items-center">
                                    <i class="fas fa-tachometer-alt mr-2"></i>
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="text-gray-600 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition duration-200">
                                    Login
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition duration-200">
                                        Register
                                    </a>
                                @endif
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="gradient-bg hero-pattern relative overflow-hidden pt-20">
            <!-- Floating Nodes -->
            <div class="floating-nodes">
                <div class="node"></div>
                <div class="node"></div>
                <div class="node"></div>
                <div class="node"></div>
                <div class="node"></div>
            </div>
            
            <!-- Particles -->
            <div class="particles">
                <div class="particle"></div>
                <div class="particle"></div>
                <div class="particle"></div>
                <div class="particle"></div>
                <div class="particle"></div>
                <div class="particle"></div>
                <div class="particle"></div>
                <div class="particle"></div>
                <div class="particle"></div>
                <div class="particle"></div>
            </div>
            
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
                <div class="text-center animate-fade-in-up">
                    <h1 class="text-4xl md:text-6xl font-bold text-white-contrast mb-6">
                        Welcome to <span class="text-yellow-300 font-extrabold">News Portal</span>
                    </h1>
                    <p class="text-xl md:text-2xl text-white-soft mb-8 max-w-3xl mx-auto leading-relaxed">
                        Discover the latest news, insights, and stories from around the world. Stay informed with our comprehensive coverage.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('login') }}" class="btn-white px-8 py-3 rounded-lg flex items-center justify-center">
                            <i class="fas fa-rocket mr-2"></i>
                            Get Started
                        </a>
                        <a href="#features" class="btn-outline-white px-8 py-3 rounded-lg flex items-center justify-center">
                            <i class="fas fa-info-circle mr-2"></i>
                            Learn More
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Floating Elements -->
            <div class="absolute top-20 left-10 text-white/30 text-6xl animate-pulse">
                <i class="fas fa-newspaper"></i>
            </div>
            <div class="absolute bottom-20 right-10 text-white/30 text-4xl animate-pulse">
                <i class="fas fa-globe"></i>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="py-20 bg-white features-bg geometric-bg relative overflow-hidden">
            <!-- Background Animation Elements -->
            <div class="absolute top-10 left-20 w-32 h-32 bg-gradient-to-r from-blue-200 to-purple-300 rounded-full opacity-20 animate-pulse"></div>
            <div class="absolute bottom-20 right-20 w-24 h-24 bg-gradient-to-r from-purple-200 to-pink-300 rounded-full opacity-20 animate-pulse"></div>
            <div class="absolute top-1/2 left-10 w-16 h-16 bg-gradient-to-r from-green-200 to-blue-300 rounded-full opacity-20 animate-pulse"></div>
            
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Powerful Features</h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">Everything you need to manage and share news content effectively</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="card-hover bg-gradient-to-br from-blue-50 to-indigo-100 p-8 rounded-2xl">
                        <div class="w-16 h-16 bg-blue-600 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-edit text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Content Management</h3>
                        <p class="text-gray-600">Create, edit, and organize your posts with our intuitive content management system. Support for rich media and categorization.</p>
                    </div>

                    <div class="card-hover bg-gradient-to-br from-green-50 to-emerald-100 p-8 rounded-2xl">
                        <div class="w-16 h-16 bg-green-600 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-users text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">User Authentication</h3>
                        <p class="text-gray-600">Secure user registration and login system with role-based access control and user profile management.</p>
                    </div>

                    <div class="card-hover bg-gradient-to-br from-purple-50 to-violet-100 p-8 rounded-2xl">
                        <div class="w-16 h-16 bg-purple-600 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-comments text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Interactive Comments</h3>
                        <p class="text-gray-600">Engage your audience with a robust commenting system that encourages discussion and community building.</p>
                    </div>

                    <div class="card-hover bg-gradient-to-br from-orange-50 to-red-100 p-8 rounded-2xl">
                        <div class="w-16 h-16 bg-orange-600 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-tags text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Categories & Tags</h3>
                        <p class="text-gray-600">Organize content with flexible categorization and tagging system for better content discovery and navigation.</p>
                    </div>

                    <div class="card-hover bg-gradient-to-br from-pink-50 to-rose-100 p-8 rounded-2xl">
                        <div class="w-16 h-16 bg-pink-600 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-photo-video text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Media Support</h3>
                        <p class="text-gray-600">Rich media support including images and videos to make your content more engaging and visually appealing.</p>
                    </div>

                    <div class="card-hover bg-gradient-to-br from-cyan-50 to-blue-100 p-8 rounded-2xl">
                        <div class="w-16 h-16 bg-cyan-600 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-mobile-alt text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Responsive Design</h3>
                        <p class="text-gray-600">Fully responsive design that works perfectly on all devices - desktop, tablet, and mobile.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="py-20 bg-gray-50 stats-bg relative overflow-hidden">
            <!-- Background Animation Elements -->
            <div class="absolute top-5 right-20 w-40 h-40 bg-gradient-to-br from-indigo-300 to-purple-400 rounded-full opacity-10 animate-pulse"></div>
            <div class="absolute bottom-10 left-20 w-28 h-28 bg-gradient-to-br from-green-300 to-blue-400 rounded-full opacity-10 animate-pulse"></div>
            <div class="absolute top-1/3 left-1/2 w-20 h-20 bg-gradient-to-br from-orange-300 to-red-400 rounded-full opacity-10 animate-pulse"></div>
            
            <!-- Floating Numbers Animation -->
            <div class="absolute inset-0 overflow-hidden">
                <div class="absolute top-10 left-10 text-6xl font-bold text-indigo-200 opacity-20 animate-pulse">01</div>
                <div class="absolute top-20 right-10 text-4xl font-bold text-green-200 opacity-20 animate-pulse">02</div>
                <div class="absolute bottom-20 left-20 text-5xl font-bold text-purple-200 opacity-20 animate-pulse">03</div>
                <div class="absolute bottom-10 right-20 text-3xl font-bold text-orange-200 opacity-20 animate-pulse">04</div>
            </div>
            
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
                    <div class="animate-fade-in-up">
                        <div class="text-4xl font-bold text-indigo-600 mb-2">1000+</div>
                        <div class="text-gray-600">Articles Published</div>
                    </div>
                    <div class="animate-fade-in-up">
                        <div class="text-4xl font-bold text-green-600 mb-2">50+</div>
                        <div class="text-gray-600">Active Writers</div>
                    </div>
                    <div class="animate-fade-in-up">
                        <div class="text-4xl font-bold text-purple-600 mb-2">10K+</div>
                        <div class="text-gray-600">Monthly Readers</div>
                    </div>
                    <div class="animate-fade-in-up">
                        <div class="text-4xl font-bold text-orange-600 mb-2">99%</div>
                        <div class="text-gray-600">Uptime</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="gradient-bg py-20 relative overflow-hidden">
            <!-- Animated Background Elements -->
            <div class="absolute inset-0">
                <!-- Geometric Shapes -->
                <div class="absolute top-10 left-10 w-32 h-32 border-4 border-white opacity-20 rotate-45 animate-pulse"></div>
                <div class="absolute bottom-20 right-20 w-24 h-24 border-4 border-yellow-300 opacity-40 rounded-full animate-pulse"></div>
                <div class="absolute top-1/2 right-10 w-16 h-16 bg-white opacity-15 transform rotate-12 animate-pulse"></div>
                
                <!-- Floating Particles -->
                <div class="particles">
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                </div>
                
                <!-- Grid Pattern -->
                <div class="absolute inset-0 opacity-8" style="background-image: url(&quot;data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.6' fill-rule='evenodd'%3E%3Cpath d='M0 0h40v40H0V0zm20 20h20v20H20V20z'/%3E%3C/g%3E%3C/svg%3E&quot;);"></div>
            </div>
            
            <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8 relative z-10">
                <h2 class="text-3xl md:text-4xl font-bold text-white-contrast mb-6">Ready to Get Started?</h2>
                <p class="text-xl text-white-soft mb-8">Join our community of writers and readers today!</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-white px-8 py-3 rounded-lg flex items-center justify-center">
                            <i class="fas fa-tachometer-alt mr-2"></i>
                            Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="btn-white px-8 py-3 rounded-lg flex items-center justify-center">
                            <i class="fas fa-user-plus mr-2"></i>
                            Create Account
                        </a>
                        <a href="{{ route('login') }}" class="btn-outline-white px-8 py-3 rounded-lg flex items-center justify-center">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Sign In
                        </a>
                    @endauth
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="col-span-1 md:col-span-2">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-newspaper text-2xl text-indigo-400 mr-3"></i>
                            <h3 class="text-xl font-bold">{{ config('app.name', 'Laravel') }}</h3>
                        </div>
                        <p class="text-gray-400 mb-4">Your trusted source for news and information. Built with Laravel and modern web technologies.</p>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-400 hover:text-white transition duration-200">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white transition duration-200">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white transition duration-200">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white transition duration-200">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                    
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-400 hover:text-white transition duration-200">Home</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition duration-200">About</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition duration-200">Contact</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition duration-200">Privacy Policy</a></li>
                        </ul>
                    </div>
                    
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Support</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-400 hover:text-white transition duration-200">Help Center</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition duration-200">Documentation</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition duration-200">API</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition duration-200">Status</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="border-t border-gray-800 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center">
                    <div class="text-gray-400 text-sm">
                        © {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
                    </div>
                    <div class="text-gray-400 text-sm mt-4 md:mt-0">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </div>
                </div>
            </div>
        </footer>

        <!-- Smooth Scrolling Script -->
        <script>
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });
        </script>
    </body>
</html>
