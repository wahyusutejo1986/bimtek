<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Organization.xyz - Enterprise Business Management Platform</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        
        <style>
            :root {
                --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
                --enterprise-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
                --dark-gradient: linear-gradient(135deg, #0c0c0c 0%, #1a1a2e 50%, #16213e 100%);
            }
            
            body {
                font-family: 'Inter', 'Poppins', sans-serif;
                background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
            }
            
            .enterprise-gradient {
                background: var(--dark-gradient);
                position: relative;
                overflow: hidden;
            }
            
            .enterprise-gradient::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: 
                    radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.2) 0%, transparent 50%),
                    radial-gradient(circle at 80% 20%, rgba(72, 187, 255, 0.15) 0%, transparent 50%),
                    radial-gradient(circle at 40% 40%, rgba(88, 209, 255, 0.1) 0%, transparent 50%);
                z-index: 1;
            }
            
            .enterprise-gradient > * {
                position: relative;
                z-index: 2;
            }
            
            .text-enterprise-white {
                color: #ffffff;
                text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            }
            
            .text-enterprise-soft {
                color: rgba(255, 255, 255, 0.95);
                text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            }
            
            .enterprise-card {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(20px);
                border: 1px solid rgba(255, 255, 255, 0.2);
                box-shadow: 
                    0 25px 50px -12px rgba(0, 0, 0, 0.1),
                    0 0 0 1px rgba(255, 255, 255, 0.05);
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            }
            
            .enterprise-card:hover {
                transform: translateY(-8px) scale(1.02);
                box-shadow: 
                    0 35px 60px -12px rgba(0, 0, 0, 0.15),
                    0 0 0 1px rgba(255, 255, 255, 0.1);
            }
            
            .animate-fade-in-up {
                animation: fadeInUp 0.8s ease-out;
            }
            
            .animate-fade-in-up-delay {
                animation: fadeInUp 0.8s ease-out 0.2s both;
            }
            
            .animate-fade-in-up-delay-2 {
                animation: fadeInUp 0.8s ease-out 0.4s both;
            }
            
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(40px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            /* Advanced floating particles */
            .particle-system {
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
                border-radius: 50%;
                animation: particleFloat 20s linear infinite;
                pointer-events: none;
            }
            
            .particle:nth-child(1) { 
                width: 3px; height: 3px; 
                background: rgba(255, 255, 255, 0.8);
                left: 5%; 
                animation-delay: 0s;
                box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
            }
            .particle:nth-child(2) { 
                width: 5px; height: 5px; 
                background: rgba(72, 187, 255, 0.9);
                left: 15%; 
                animation-delay: 3s;
                box-shadow: 0 0 15px rgba(72, 187, 255, 0.6);
            }
            .particle:nth-child(3) { 
                width: 4px; height: 4px; 
                background: rgba(120, 119, 198, 0.8);
                left: 25%; 
                animation-delay: 6s;
                box-shadow: 0 0 12px rgba(120, 119, 198, 0.5);
            }
            .particle:nth-child(4) { 
                width: 6px; height: 6px; 
                background: rgba(88, 209, 255, 0.9);
                left: 35%; 
                animation-delay: 9s;
                box-shadow: 0 0 18px rgba(88, 209, 255, 0.6);
            }
            .particle:nth-child(5) { 
                width: 3px; height: 3px; 
                background: rgba(255, 255, 255, 0.7);
                left: 45%; 
                animation-delay: 12s;
                box-shadow: 0 0 10px rgba(255, 255, 255, 0.4);
            }
            .particle:nth-child(6) { 
                width: 5px; height: 5px; 
                background: rgba(72, 187, 255, 0.8);
                left: 55%; 
                animation-delay: 15s;
                box-shadow: 0 0 15px rgba(72, 187, 255, 0.5);
            }
            .particle:nth-child(7) { 
                width: 4px; height: 4px; 
                background: rgba(120, 119, 198, 0.9);
                left: 65%; 
                animation-delay: 18s;
                box-shadow: 0 0 12px rgba(120, 119, 198, 0.6);
            }
            .particle:nth-child(8) { 
                width: 7px; height: 7px; 
                background: rgba(88, 209, 255, 0.8);
                left: 75%; 
                animation-delay: 21s;
                box-shadow: 0 0 20px rgba(88, 209, 255, 0.5);
            }
            .particle:nth-child(9) { 
                width: 3px; height: 3px; 
                background: rgba(255, 255, 255, 0.9);
                left: 85%; 
                animation-delay: 24s;
                box-shadow: 0 0 10px rgba(255, 255, 255, 0.6);
            }
            .particle:nth-child(10) { 
                width: 5px; height: 5px; 
                background: rgba(72, 187, 255, 0.7);
                left: 95%; 
                animation-delay: 27s;
                box-shadow: 0 0 15px rgba(72, 187, 255, 0.4);
            }
            
            @keyframes particleFloat {
                0% {
                    transform: translateY(100vh) translateX(0px) rotate(0deg);
                    opacity: 0;
                }
                10% {
                    opacity: 1;
                }
                90% {
                    opacity: 1;
                }
                100% {
                    transform: translateY(-100px) translateX(100px) rotate(360deg);
                    opacity: 0;
                }
            }
            
            /* Enterprise button styles */
            .btn-enterprise-primary {
                background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
                color: #ffffff;
                font-weight: 600;
                border: none;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                box-shadow: 0 4px 15px rgba(79, 172, 254, 0.4);
            }
            
            .btn-enterprise-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 25px rgba(79, 172, 254, 0.6);
                background: linear-gradient(135deg, #00f2fe 0%, #4facfe 100%);
            }
            
            .btn-enterprise-secondary {
                background: rgba(255, 255, 255, 0.1);
                color: #ffffff;
                font-weight: 600;
                border: 2px solid rgba(255, 255, 255, 0.3);
                backdrop-filter: blur(10px);
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }
            
            .btn-enterprise-secondary:hover {
                background: rgba(255, 255, 255, 0.2);
                border-color: rgba(255, 255, 255, 0.5);
                transform: translateY(-2px);
                box-shadow: 0 8px 25px rgba(255, 255, 255, 0.2);
            }
            
            /* Geometric background patterns */
            .geometric-bg {
                background-image: 
                    linear-gradient(30deg, transparent 40%, rgba(79, 172, 254, 0.03) 40%, rgba(79, 172, 254, 0.03) 60%, transparent 60%),
                    linear-gradient(90deg, transparent 40%, rgba(0, 242, 254, 0.03) 40%, rgba(0, 242, 254, 0.03) 60%, transparent 60%);
                background-size: 80px 80px;
                animation: geometricMove 30s linear infinite;
            }
            
            @keyframes geometricMove {
                0% { background-position: 0 0, 0 0; }
                100% { background-position: 80px 80px, -80px -80px; }
            }
            
            /* Stats counter animation */
            .stat-number {
                background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                font-weight: 900;
            }
            
            /* Enhanced card shadows and interactions */
            .feature-card {
                background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
                border: 1px solid rgba(79, 172, 254, 0.1);
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            }
            
            .feature-card:hover {
                transform: translateY(-10px) rotateX(5deg);
                box-shadow: 
                    0 20px 40px rgba(79, 172, 254, 0.15),
                    0 10px 20px rgba(0, 0, 0, 0.1);
                border-color: rgba(79, 172, 254, 0.3);
            }
            
            .feature-icon {
                background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
                transition: all 0.3s ease;
            }
            
            .feature-card:hover .feature-icon {
                transform: scale(1.1) rotate(5deg);
                box-shadow: 0 8px 20px rgba(79, 172, 254, 0.4);
            }
        </style>
    </head>
    <body class="antialiased">
        <!-- Enterprise Navigation -->
        <nav class="fixed w-full z-50 bg-white/95 backdrop-blur-lg shadow-xl border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center mr-4 shadow-lg">
                                <i class="fas fa-building text-xl text-white"></i>
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold bg-gradient-to-r from-gray-900 to-gray-600 bg-clip-text text-transparent">Organization.xyz</h1>
                                <p class="text-xs text-gray-500 font-medium">Enterprise Management</p>
                            </div>
                        </div>
                    </div>
                    
                    @if (Route::has('login'))
                        <div class="flex items-center space-x-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn-enterprise-primary px-6 py-3 rounded-xl flex items-center text-sm font-semibold">
                                    <i class="fas fa-tachometer-alt mr-2"></i>
                                    Business Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 px-4 py-2 rounded-lg text-sm font-semibold transition duration-200">
                                    Sign In
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn-enterprise-primary px-6 py-3 rounded-xl text-sm font-semibold">
                                        Get Started
                                    </a>
                                @endif
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </nav>

        <!-- Enterprise Hero Section -->
        <section class="enterprise-gradient min-h-screen flex items-center relative overflow-hidden pt-20">
            <!-- Advanced Particle System -->
            <div class="particle-system">
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
            
            <!-- Geometric Background -->
            <div class="absolute inset-0 geometric-bg opacity-30"></div>
            
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
                <div class="grid lg:grid-cols-2 gap-16 items-center">
                    <!-- Hero Content -->
                    <div class="animate-fade-in-up">
                        <div class="mb-8">
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-blue-500/20 text-blue-300 border border-blue-400/30 backdrop-blur-sm">
                                <i class="fas fa-star mr-2"></i>
                                Enterprise-Grade Platform
                            </span>
                        </div>
                        <h1 class="text-5xl lg:text-7xl font-black text-enterprise-white mb-8 leading-tight">
                            Streamline Your
                            <span class="bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent">
                                Business Operations
                            </span>
                        </h1>
                        <p class="text-xl lg:text-2xl text-enterprise-soft mb-12 leading-relaxed">
                            Comprehensive business management platform designed for modern enterprises. Accelerate growth, optimize workflows, and drive innovation with our integrated business solutions.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-6 mb-8">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn-enterprise-primary px-8 py-4 rounded-xl text-lg font-semibold inline-flex items-center justify-center">
                                    <i class="fas fa-tachometer-alt mr-3"></i>
                                    Access Business Dashboard
                                </a>
                            @else
                                <a href="{{ route('register') }}" class="btn-enterprise-primary px-8 py-4 rounded-xl text-lg font-semibold inline-flex items-center justify-center">
                                    <i class="fas fa-rocket mr-3"></i>
                                    Start Your Business Journey
                                </a>
                            @endauth
                            <a href="#features" class="btn-enterprise-secondary px-8 py-4 rounded-xl text-lg font-semibold inline-flex items-center justify-center">
                                <i class="fas fa-info-circle mr-3"></i>
                                Explore Capabilities
                            </a>
                        </div>
                        
                        <!-- Trust Indicators -->
                        <div class="flex items-center space-x-8 text-enterprise-soft">
                            <div class="flex items-center">
                                <i class="fas fa-shield-alt text-green-400 mr-2"></i>
                                <span class="text-sm font-medium">Enterprise Security</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-clock text-blue-400 mr-2"></i>
                                <span class="text-sm font-medium">24/7 Support</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-chart-line text-cyan-400 mr-2"></i>
                                <span class="text-sm font-medium">Scalable Solutions</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Hero Visual -->
                    <div class="animate-fade-in-up-delay lg:pl-12">
                        <div class="relative">
                            <div class="enterprise-card rounded-3xl p-8 transform rotate-6 hover:rotate-3 transition-transform duration-500">
                                <div class="text-center">
                                    <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-2xl mx-auto mb-6 flex items-center justify-center">
                                        <i class="fas fa-chart-pie text-3xl text-white"></i>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-3">Business Analytics</h3>
                                    <p class="text-gray-600 text-sm leading-relaxed">Real-time insights and performance metrics to drive strategic decision-making.</p>
                                </div>
                            </div>
                            
                            <div class="enterprise-card rounded-3xl p-8 transform -rotate-3 hover:rotate-0 transition-transform duration-500 mt-6 ml-8">
                                <div class="text-center">
                                    <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl mx-auto mb-6 flex items-center justify-center">
                                        <i class="fas fa-users text-3xl text-white"></i>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-3">Team Collaboration</h3>
                                    <p class="text-gray-600 text-sm leading-relaxed">Seamless collaboration tools for distributed teams and project management.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Enterprise Features Section -->
        <section id="features" class="py-24 bg-gradient-to-br from-slate-50 to-blue-50 relative overflow-hidden">
            <!-- Background Elements -->
            <div class="absolute top-10 left-20 w-32 h-32 bg-gradient-to-r from-blue-400/10 to-cyan-500/10 rounded-full animate-pulse"></div>
            <div class="absolute bottom-20 right-20 w-24 h-24 bg-gradient-to-r from-purple-400/10 to-pink-500/10 rounded-full animate-pulse"></div>
            <div class="absolute top-1/2 left-10 w-16 h-16 bg-gradient-to-r from-green-400/10 to-blue-500/10 rounded-full animate-pulse"></div>
            
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="text-center mb-20 animate-fade-in-up">
                    <div class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-blue-500/10 text-blue-600 border border-blue-200 mb-6">
                        <i class="fas fa-rocket mr-2"></i>
                        Enterprise Solutions
                    </div>
                    <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-6">
                        Comprehensive Business
                        <span class="bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent">Management Suite</span>
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                        Everything your organization needs to streamline operations, enhance productivity, and drive sustainable growth in today's competitive landscape.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 animate-fade-in-up-delay">
                    <div class="feature-card rounded-3xl p-8 shadow-xl">
                        <div class="feature-icon w-16 h-16 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-chart-line text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Business Intelligence</h3>
                        <p class="text-gray-600 leading-relaxed">Advanced analytics and real-time reporting tools to make data-driven decisions and monitor KPIs across all business units.</p>
                        <div class="mt-6 flex items-center text-sm text-blue-600 font-medium">
                            <i class="fas fa-arrow-right mr-2"></i>
                            Explore Analytics
                        </div>
                    </div>

                    <div class="feature-card rounded-3xl p-8 shadow-xl">
                        <div class="feature-icon w-16 h-16 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-users-cog text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Team Management</h3>
                        <p class="text-gray-600 leading-relaxed">Comprehensive user access control, role-based permissions, and team collaboration tools for seamless organizational workflow.</p>
                        <div class="mt-6 flex items-center text-sm text-blue-600 font-medium">
                            <i class="fas fa-arrow-right mr-2"></i>
                            Manage Teams
                        </div>
                    </div>

                    <div class="feature-card rounded-3xl p-8 shadow-xl">
                        <div class="feature-icon w-16 h-16 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-file-alt text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Document Processing</h3>
                        <p class="text-gray-600 leading-relaxed">Intelligent document management with automated processing, secure storage, and collaborative editing capabilities.</p>
                        <div class="mt-6 flex items-center text-sm text-blue-600 font-medium">
                            <i class="fas fa-arrow-right mr-2"></i>
                            Process Documents
                        </div>
                    </div>

                    <div class="feature-card rounded-3xl p-8 shadow-xl">
                        <div class="feature-icon w-16 h-16 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-search text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Enterprise Search</h3>
                        <p class="text-gray-600 leading-relaxed">Powerful search engine with advanced filtering, categorization, and content discovery across all business data.</p>
                        <div class="mt-6 flex items-center text-sm text-blue-600 font-medium">
                            <i class="fas fa-arrow-right mr-2"></i>
                            Search Content
                        </div>
                    </div>

                    <div class="feature-card rounded-3xl p-8 shadow-xl">
                        <div class="feature-icon w-16 h-16 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-shield-alt text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Security & Compliance</h3>
                        <p class="text-gray-600 leading-relaxed">Enterprise-grade security with multi-factor authentication, audit trails, and compliance management for regulatory requirements.</p>
                        <div class="mt-6 flex items-center text-sm text-blue-600 font-medium">
                            <i class="fas fa-arrow-right mr-2"></i>
                            Security Tools
                        </div>
                    </div>

                    <div class="feature-card rounded-3xl p-8 shadow-xl">
                        <div class="feature-icon w-16 h-16 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-cogs text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">System Administration</h3>
                        <p class="text-gray-600 leading-relaxed">Comprehensive admin tools for system monitoring, performance optimization, and infrastructure management across all platforms.</p>
                        <div class="mt-6 flex items-center text-sm text-blue-600 font-medium">
                            <i class="fas fa-arrow-right mr-2"></i>
                            Admin Tools
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Enterprise Performance Stats -->
        <section class="py-24 bg-gradient-to-br from-gray-900 to-slate-800 relative overflow-hidden">
            <!-- Background Elements -->
            <div class="absolute top-5 right-20 w-40 h-40 bg-gradient-to-br from-blue-500/10 to-cyan-500/10 rounded-full animate-pulse"></div>
            <div class="absolute bottom-10 left-20 w-28 h-28 bg-gradient-to-br from-purple-500/10 to-pink-500/10 rounded-full animate-pulse"></div>
            <div class="absolute top-1/3 left-1/2 w-20 h-20 bg-gradient-to-br from-green-500/10 to-blue-500/10 rounded-full animate-pulse"></div>
            
            <!-- Floating Numbers Animation -->
            <div class="absolute inset-0 overflow-hidden">
                <div class="absolute top-10 left-10 text-6xl font-bold text-blue-500/20 animate-pulse">$</div>
                <div class="absolute top-20 right-10 text-4xl font-bold text-cyan-500/20 animate-pulse">%</div>
                <div class="absolute bottom-20 left-20 text-5xl font-bold text-purple-500/20 animate-pulse">+</div>
                <div class="absolute bottom-10 right-20 text-3xl font-bold text-green-500/20 animate-pulse">#</div>
            </div>
            
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="text-center mb-16 animate-fade-in-up">
                    <h2 class="text-4xl md:text-5xl font-black text-white mb-6">
                        Trusted by Leading
                        <span class="bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent">Organizations</span>
                    </h2>
                    <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                        Our enterprise platform powers business operations for companies worldwide, delivering measurable results and driving sustainable growth.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-12 text-center animate-fade-in-up-delay">
                    <div class="enterprise-card p-8 rounded-2xl">
                        <div class="stat-number text-5xl font-black mb-3">850+</div>
                        <div class="text-gray-600 font-semibold text-lg">Enterprise Clients</div>
                        <div class="text-gray-500 text-sm mt-2">Global organizations trust our platform</div>
                    </div>
                    <div class="enterprise-card p-8 rounded-2xl">
                        <div class="stat-number text-5xl font-black mb-3">99.9%</div>
                        <div class="text-gray-600 font-semibold text-lg">System Uptime</div>
                        <div class="text-gray-500 text-sm mt-2">Enterprise-grade reliability</div>
                    </div>
                    <div class="enterprise-card p-8 rounded-2xl">
                        <div class="stat-number text-5xl font-black mb-3">2.5M+</div>
                        <div class="text-gray-600 font-semibold text-lg">Transactions Processed</div>
                        <div class="text-gray-500 text-sm mt-2">Monthly business operations</div>
                    </div>
                    <div class="enterprise-card p-8 rounded-2xl">
                        <div class="stat-number text-5xl font-black mb-3">47%</div>
                        <div class="text-gray-600 font-semibold text-lg">Productivity Increase</div>
                        <div class="text-gray-500 text-sm mt-2">Average improvement for clients</div>
                    </div>
                </div>

                <!-- Trust Indicators -->
                <div class="mt-20 flex flex-wrap justify-center items-center gap-12 opacity-60 animate-fade-in-up-delay-2">
                    <div class="flex items-center text-gray-400">
                        <i class="fas fa-certificate text-2xl mr-3"></i>
                        <span class="font-semibold">ISO 27001 Certified</span>
                    </div>
                    <div class="flex items-center text-gray-400">
                        <i class="fas fa-shield-alt text-2xl mr-3"></i>
                        <span class="font-semibold">SOC 2 Type II Compliant</span>
                    </div>
                    <div class="flex items-center text-gray-400">
                        <i class="fas fa-lock text-2xl mr-3"></i>
                        <span class="font-semibold">GDPR Ready</span>
                    </div>
                    <div class="flex items-center text-gray-400">
                        <i class="fas fa-award text-2xl mr-3"></i>
                        <span class="font-semibold">Enterprise Security</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Enterprise CTA Section -->
        <section class="enterprise-gradient py-24 relative overflow-hidden">
            <!-- Advanced Background Elements -->
            <div class="absolute inset-0">
                <!-- Geometric Patterns -->
                <div class="absolute top-10 left-10 w-32 h-32 border-4 border-white/20 rotate-45 animate-pulse"></div>
                <div class="absolute bottom-20 right-20 w-24 h-24 border-4 border-cyan-400/40 rounded-full animate-pulse"></div>
                <div class="absolute top-1/2 right-10 w-16 h-16 bg-white/10 transform rotate-12 animate-pulse"></div>
                
                <!-- Enhanced Particle System -->
                <div class="particle-system">
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                </div>
                
                <!-- Grid Pattern -->
                <div class="absolute inset-0 opacity-5 geometric-bg"></div>
            </div>
            
            <div class="max-w-5xl mx-auto text-center px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="animate-fade-in-up">
                    <div class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-white/10 text-white border border-white/20 backdrop-blur-sm mb-8">
                        <i class="fas fa-lightning-bolt mr-2"></i>
                        Transform Your Business Today
                    </div>
                    <h2 class="text-4xl md:text-6xl font-black text-enterprise-white mb-8 leading-tight">
                        Ready to Accelerate Your
                        <span class="bg-gradient-to-r from-cyan-400 to-blue-400 bg-clip-text text-transparent">
                            Digital Transformation?
                        </span>
                    </h2>
                    <p class="text-xl md:text-2xl text-enterprise-soft mb-12 max-w-4xl mx-auto leading-relaxed">
                        Join thousands of successful organizations that have revolutionized their operations with our comprehensive business management platform. Start your journey to operational excellence today.
                    </p>
                    
                    <div class="flex flex-col lg:flex-row gap-6 justify-center mb-12">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn-enterprise-primary px-10 py-5 rounded-xl text-lg font-bold inline-flex items-center justify-center transform hover:scale-105 transition-all duration-300">
                                <i class="fas fa-tachometer-alt mr-3"></i>
                                Access Your Business Dashboard
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="btn-enterprise-primary px-10 py-5 rounded-xl text-lg font-bold inline-flex items-center justify-center transform hover:scale-105 transition-all duration-300">
                                <i class="fas fa-rocket mr-3"></i>
                                Start Free Enterprise Trial
                            </a>
                        @endauth
                        <a href="#features" class="btn-enterprise-secondary px-10 py-5 rounded-xl text-lg font-bold inline-flex items-center justify-center">
                            <i class="fas fa-phone mr-3"></i>
                            Schedule Demo Call
                        </a>
                    </div>
                    
                    <!-- Value Propositions -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-enterprise-soft">
                        <div class="flex items-center justify-center">
                            <i class="fas fa-check-circle text-green-400 mr-3 text-xl"></i>
                            <span class="font-semibold">30-Day Free Trial</span>
                        </div>
                        <div class="flex items-center justify-center">
                            <i class="fas fa-headset text-blue-400 mr-3 text-xl"></i>
                            <span class="font-semibold">24/7 Enterprise Support</span>
                        </div>
                        <div class="flex items-center justify-center">
                            <i class="fas fa-credit-card text-cyan-400 mr-3 text-xl"></i>
                            <span class="font-semibold">No Setup Fees</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Enterprise Footer -->
        <footer class="bg-gradient-to-br from-gray-900 to-slate-800 text-white py-16 border-t border-gray-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                    <!-- Company Information -->
                    <div class="col-span-1 md:col-span-2">
                        <div class="flex items-center mb-6">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-building text-lg text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-white">Organization.xyz</h3>
                                <p class="text-sm text-gray-400">Enterprise Management Platform</p>
                            </div>
                        </div>
                        <p class="text-gray-300 mb-6 leading-relaxed max-w-md">
                            Empowering organizations worldwide with comprehensive business management solutions. Transform your operations with our enterprise-grade platform designed for scalability and security.
                        </p>
                        <div class="flex space-x-4">
                            <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center text-gray-400 hover:text-blue-400 hover:bg-gray-700 transition duration-200">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center text-gray-400 hover:text-blue-400 hover:bg-gray-700 transition duration-200">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center text-gray-400 hover:text-blue-400 hover:bg-gray-700 transition duration-200">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center text-gray-400 hover:text-blue-400 hover:bg-gray-700 transition duration-200">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Business Solutions -->
                    <div>
                        <h4 class="text-lg font-bold mb-6 text-white">Business Solutions</h4>
                        <ul class="space-y-3">
                            <li><a href="/services" class="text-gray-300 hover:text-blue-400 transition duration-200 flex items-center"><i class="fas fa-arrow-right mr-2 text-xs"></i>Services Directory</a></li>
                            <li><a href="/tools" class="text-gray-300 hover:text-blue-400 transition duration-200 flex items-center"><i class="fas fa-arrow-right mr-2 text-xs"></i>Admin Tools</a></li>
                            <li><a href="#features" class="text-gray-300 hover:text-blue-400 transition duration-200 flex items-center"><i class="fas fa-arrow-right mr-2 text-xs"></i>Platform Features</a></li>
                            <li><a href="/dashboard" class="text-gray-300 hover:text-blue-400 transition duration-200 flex items-center"><i class="fas fa-arrow-right mr-2 text-xs"></i>Business Dashboard</a></li>
                        </ul>
                    </div>
                    
                    <!-- Enterprise Support -->
                    <div>
                        <h4 class="text-lg font-bold mb-6 text-white">Enterprise Support</h4>
                        <ul class="space-y-3">
                            <li><a href="#" class="text-gray-300 hover:text-blue-400 transition duration-200 flex items-center"><i class="fas fa-headset mr-2 text-xs"></i>24/7 Support</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-blue-400 transition duration-200 flex items-center"><i class="fas fa-book mr-2 text-xs"></i>Documentation</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-blue-400 transition duration-200 flex items-center"><i class="fas fa-code mr-2 text-xs"></i>API Reference</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-blue-400 transition duration-200 flex items-center"><i class="fas fa-shield-alt mr-2 text-xs"></i>Security Center</a></li>
                        </ul>
                    </div>
                </div>
                
                <!-- Footer Bottom -->
                <div class="border-t border-gray-700 mt-12 pt-8">
                    <div class="flex flex-col md:flex-row justify-between items-center">
                        <div class="text-gray-400 text-sm mb-4 md:mb-0">
                            © {{ date('Y') }} Organization.xyz Enterprise Management Platform. All rights reserved.
                        </div>
                        <div class="flex items-center space-x-6 text-gray-400 text-sm">
                            <a href="#" class="hover:text-blue-400 transition duration-200">Privacy Policy</a>
                            <a href="#" class="hover:text-blue-400 transition duration-200">Terms of Service</a>
                            <a href="#" class="hover:text-blue-400 transition duration-200">Security</a>
                            <span class="text-gray-500">Laravel v{{ Illuminate\Foundation\Application::VERSION }}</span>
                        </div>
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
