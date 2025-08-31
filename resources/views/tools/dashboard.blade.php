<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            � System Administration Tools
        </h2>
    </x-slot>

<div class="min-h-screen bg-gradient-to-br from-gray-900 via-blue-900 to-purple-900 relative overflow-hidden">
    <!-- Animated Background -->
    <div class="absolute inset-0 opacity-10">
        <div class="floating-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
            <div class="shape shape-4"></div>
            <div class="shape shape-5"></div>
        </div>
    </div>

    <div class="relative z-10 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-16">
                <h1 class="text-6xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-purple-400 to-cyan-400 mb-4">
                    � System Tools
                </h1>
                <p class="text-2xl text-gray-300 mb-8">Advanced System Administration Center</p>
                <div class="max-w-4xl mx-auto">
                    <div class="bg-black/50 backdrop-blur-lg rounded-2xl p-8 border border-blue-500/30">
                        <h2 class="text-blue-400 text-xl font-bold mb-4">📋 Administration Portal</h2>
                        <p class="text-gray-300 text-lg">
                            This portal provides <strong class="text-blue-400">comprehensive system administration tools</strong> 
                            for managing the platform infrastructure. Access to advanced 
                            <strong class="text-cyan-400">management capabilities</strong> and system monitoring features.
                        </p>
                    </div>
                </div>
            </div>

            <!-- System Tools Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8 mb-12">
                
                <!-- User Management Tools -->
                <div class="tool-card group">
                    <div class="tool-header bg-gradient-to-r from-blue-600 to-blue-800">
                        <h3 class="text-xl font-bold">User Management</h3>
                        <span class="text-sm opacity-90">Admin Tools</span>
                    </div>
                    <div class="tool-body">
                        <h4 class="text-lg font-semibold text-blue-400 mb-3">� User Administration</h4>
                        <p class="text-gray-300 text-sm mb-4">
                            Advanced user profile management and administrative access controls.
                        </p>
                        <div class="space-y-2">
                            <a href="{{ route('tools.user-management.user', ['id' => 1]) }}" 
                               class="block w-full bg-blue-600/20 hover:bg-blue-600/40 text-blue-300 py-2 px-4 rounded-lg text-center transition">
                                👤 User Profile Manager
                            </a>
                            <a href="{{ route('tools.user-management.edit', ['id' => 1]) }}" 
                               class="block w-full bg-blue-600/20 hover:bg-blue-600/40 text-blue-300 py-2 px-4 rounded-lg text-center transition">
                                ✏️ Content Editor
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Security Management -->
                <div class="tool-card group">
                    <div class="tool-header bg-gradient-to-r from-green-600 to-green-800">
                        <h3 class="text-xl font-bold">Security</h3>
                        <span class="text-sm opacity-90">Data Protection</span>
                    </div>
                    <div class="tool-body">
                        <h4 class="text-lg font-semibold text-green-400 mb-3">🔐 Security Management</h4>
                        <p class="text-gray-300 text-sm mb-4">
                            Advanced security settings and credential management systems.
                        </p>
                        <div class="space-y-2">
                            <a href="{{ route('tools.security.credentials') }}" 
                               class="block w-full bg-green-600/20 hover:bg-green-600/40 text-green-300 py-2 px-4 rounded-lg text-center transition">
                                🔍 Credential Manager
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Data Management -->
                <div class="tool-card group">
                    <div class="tool-header bg-gradient-to-r from-purple-600 to-purple-800">
                        <h3 class="text-xl font-bold">Data Tools</h3>
                        <span class="text-sm opacity-90">Database Management</span>
                    </div>
                    <div class="tool-body">
                        <h4 class="text-lg font-semibold text-purple-400 mb-3">� Data Processing</h4>
                        <p class="text-gray-300 text-sm mb-4">
                            Advanced database search and data management utilities.
                        </p>
                        <div class="space-y-2">
                            <a href="{{ route('tools.data.search') }}" 
                               class="block w-full bg-purple-600/20 hover:bg-purple-600/40 text-purple-300 py-2 px-4 rounded-lg text-center transition">
                                🔍 Advanced Search
                            </a>
                            <a href="{{ route('tools.data.access') }}" 
                               class="block w-full bg-purple-600/20 hover:bg-purple-600/40 text-purple-300 py-2 px-4 rounded-lg text-center transition">
                                🔓 Data Access Portal
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Account Management -->
                <div class="tool-card group">
                    <div class="tool-header bg-gradient-to-r from-cyan-600 to-cyan-800">
                        <h3 class="text-xl font-bold">Account Tools</h3>
                        <span class="text-sm opacity-90">User Services</span>
                    </div>
                    <div class="tool-body">
                        <h4 class="text-lg font-semibold text-cyan-400 mb-3">🏗️ Account Management</h4>
                        <p class="text-gray-300 text-sm mb-4">
                            User account recovery and password management systems.
                        </p>
                        <div class="space-y-2">
                            <a href="{{ route('tools.account.recovery') }}" 
                               class="block w-full bg-cyan-600/20 hover:bg-cyan-600/40 text-cyan-300 py-2 px-4 rounded-lg text-center transition">
                                🔄 Account Recovery
                            </a>
                        </div>
                    </div>
                </div>

                <!-- System Information -->
                <div class="tool-card group">
                    <div class="tool-header bg-gradient-to-r from-indigo-600 to-indigo-800">
                        <h3 class="text-xl font-bold">System Info</h3>
                        <span class="text-sm opacity-90">Monitoring</span>
                    </div>
                    <div class="tool-body">
                        <h4 class="text-lg font-semibold text-indigo-400 mb-3">⚙️ System Monitor</h4>
                        <p class="text-gray-300 text-sm mb-4">
                            System configuration and diagnostic information tools.
                        </p>
                        <div class="space-y-2">
                            <a href="{{ route('tools.system.info') }}" 
                               class="block w-full bg-indigo-600/20 hover:bg-indigo-600/40 text-indigo-300 py-2 px-4 rounded-lg text-center transition">
                                🐛 System Diagnostics
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Component Management -->
                <div class="tool-card group">
                    <div class="tool-header bg-gradient-to-r from-teal-600 to-teal-800">
                        <h3 class="text-xl font-bold">Components</h3>
                        <span class="text-sm opacity-90">Library Management</span>
                    </div>
                    <div class="tool-body">
                        <h4 class="text-lg font-semibold text-teal-400 mb-3">📦 Component Manager</h4>
                        <p class="text-gray-300 text-sm mb-4">
                            Software library analysis and component dependency management.
                        </p>
                        <div class="space-y-2">
                            <a href="{{ route('tools.system.components') }}" 
                               class="block w-full bg-teal-600/20 hover:bg-teal-600/40 text-teal-300 py-2 px-4 rounded-lg text-center transition">
                                🧩 Component Analysis
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Authentication Tools -->
                <div class="tool-card group">
                    <div class="tool-header bg-gradient-to-r from-orange-600 to-orange-800">
                        <h3 class="text-xl font-bold">Authentication</h3>
                        <span class="text-sm opacity-90">Access Control</span>
                    </div>
                    <div class="tool-body">
                        <h4 class="text-lg font-semibold text-orange-400 mb-3">🔑 Auth Management</h4>
                        <p class="text-gray-300 text-sm mb-4">
                            Authentication system configuration and access management.
                        </p>
                        <div class="space-y-2">
                            <a href="{{ route('tools.auth.management') }}" 
                               class="block w-full bg-orange-600/20 hover:bg-orange-600/40 text-orange-300 py-2 px-4 rounded-lg text-center transition">
                                🔐 Auth Configuration
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Data Processing -->
                <div class="tool-card group">
                    <div class="tool-header bg-gradient-to-r from-pink-600 to-pink-800">
                        <h3 class="text-xl font-bold">Data Processing</h3>
                        <span class="text-sm opacity-90">Data Management</span>
                    </div>
                    <div class="tool-body">
                        <h4 class="text-lg font-semibold text-pink-400 mb-3">🛡️ Data Processor</h4>
                        <p class="text-gray-300 text-sm mb-4">
                            Advanced data serialization and processing utilities.
                        </p>
                        <div class="space-y-2">
                            <a href="{{ route('tools.data.processing') }}" 
                               class="block w-full bg-pink-600/20 hover:bg-pink-600/40 text-pink-300 py-2 px-4 rounded-lg text-center transition">
                                📤 Data Serialization
                            </a>
                        </div>
                    </div>
                </div>

                <!-- System Monitoring -->
                <div class="tool-card group">
                    <div class="tool-header bg-gradient-to-r from-gray-600 to-gray-800">
                        <h3 class="text-xl font-bold">Monitoring</h3>
                        <span class="text-sm opacity-90">System Logs</span>
                    </div>
                    <div class="tool-body">
                        <h4 class="text-lg font-semibold text-gray-400 mb-3">📝 Log Manager</h4>
                        <p class="text-gray-300 text-sm mb-4">
                            System logging and monitoring dashboard for audit trails.
                        </p>
                        <div class="space-y-2">
                            <a href="{{ route('tools.monitoring.logs') }}" 
                               class="block w-full bg-gray-600/20 hover:bg-gray-600/40 text-gray-300 py-2 px-4 rounded-lg text-center transition">
                                📊 System Logs
                            </a>
                        </div>
                    </div>
                </div>

                <!-- External Services -->
                <div class="tool-card group">
                    <div class="tool-header bg-gradient-to-r from-red-600 to-red-800">
                        <h3 class="text-xl font-bold">External Services</h3>
                        <span class="text-sm opacity-90">API Management</span>
                    </div>
                    <div class="tool-body">
                        <h4 class="text-lg font-semibold text-red-400 mb-3">🌐 Service Manager</h4>
                        <p class="text-gray-300 text-sm mb-4">
                            External API integration and service request management.
                        </p>
                        <div class="space-y-2">
                            <a href="{{ route('tools.external.services') }}" 
                               class="block w-full bg-red-600/20 hover:bg-red-600/40 text-red-300 py-2 px-4 rounded-lg text-center transition">
                                🔗 Service Integration
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Content Preview -->
                <div class="tool-card group">
                    <div class="tool-header bg-gradient-to-r from-yellow-600 to-yellow-800">
                        <h3 class="text-xl font-bold">Content Preview</h3>
                        <span class="text-sm opacity-90">Content Tools</span>
                    </div>
                    <div class="tool-body">
                        <h4 class="text-lg font-semibold text-yellow-400 mb-3">⚡ Content Renderer</h4>
                        <p class="text-gray-300 text-sm mb-4">
                            Dynamic content preview and rendering system for user inputs.
                        </p>
                        <div class="space-y-2">
                            <a href="{{ route('tools.content.preview') }}" 
                               class="block w-full bg-yellow-600/20 hover:bg-yellow-600/40 text-yellow-300 py-2 px-4 rounded-lg text-center transition">
                                ⚡ Content Preview
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Quick Reference -->
            <div class="bg-black/50 backdrop-blur-lg rounded-2xl p-8 border border-blue-500/30">
                <h2 class="text-2xl font-bold text-blue-400 mb-6">🎓 System Resources</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="text-center">
                        <h3 class="text-lg font-semibold text-green-400 mb-2">💡 Quick Commands</h3>
                        <code class="text-sm text-gray-300 bg-gray-800 px-2 py-1 rounded">
                            Advanced Search<br>
                            Data Processing<br>
                            Service Integration
                        </code>
                    </div>
                    <div class="text-center">
                        <h3 class="text-lg font-semibold text-yellow-400 mb-2">🔧 System Tools</h3>
                        <p class="text-sm text-gray-300">
                            User Management,<br>
                            Security Settings,<br>
                            Component Manager
                        </p>
                    </div>
                    <div class="text-center">
                        <h3 class="text-lg font-semibold text-purple-400 mb-2">📚 Documentation</h3>
                        <p class="text-sm text-gray-300">
                            System Manual,<br>
                            API Documentation,<br>
                            Admin Guidelines
                        </p>
                    </div>
                    <div class="text-center">
                        <h3 class="text-lg font-semibold text-blue-400 mb-2">⚠️ Best Practices</h3>
                        <p class="text-sm text-gray-300">
                            Authorized Use Only,<br>
                            Data Privacy,<br>
                            System Security
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.tool-card {
    @apply bg-black/60 backdrop-blur-lg rounded-2xl overflow-hidden border border-gray-600/30 hover:border-blue-500/50 transition-all duration-300 transform hover:scale-105;
}

.tool-header {
    @apply p-4 text-white flex justify-between items-center;
}

.tool-body {
    @apply p-6;
}

.floating-shapes {
    @apply absolute inset-0;
}

.shape {
    @apply absolute rounded-full bg-gradient-to-r from-red-500/20 to-yellow-500/20 animate-pulse;
}

.shape-1 { @apply w-32 h-32 top-10 left-10 animate-bounce; animation-delay: 0s; }
.shape-2 { @apply w-24 h-24 top-32 right-20 animate-bounce; animation-delay: 1s; }
.shape-3 { @apply w-40 h-40 bottom-20 left-1/4 animate-bounce; animation-delay: 2s; }
.shape-4 { @apply w-28 h-28 bottom-32 right-1/3 animate-bounce; animation-delay: 0.5s; }
.shape-5 { @apply w-36 h-36 top-1/2 left-1/2 animate-bounce; animation-delay: 1.5s; }
</style>
</x-app-layout>
