<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ⚙️ A05:2021 - Security Misconfiguration
        </h2>
    </x-slot>

<div class="min-h-screen bg-gradient-to-br from-gray-900 via-blue-900 to-black py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-blue-400 mb-2">{{ $vulnerability }}</h1>
            <p class="text-gray-300 text-lg">{{ $description }}</p>
            <div class="mt-4 inline-block bg-blue-600/20 text-blue-300 px-4 py-2 rounded-lg">
                ⚙️ <strong>Risk Level: MEDIUM-HIGH</strong> - Sensitive information exposure
            </div>
        </div>

        <!-- Navigation -->
        <div class="mb-8 text-center">
            <a href="{{ route('tools.dashboard') }}" 
               class="inline-block bg-gray-700 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition">
                ← Back to OWASP Dashboard
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            <!-- Application Configuration -->
            <div class="bg-black/60 backdrop-blur-lg rounded-2xl p-6 border border-blue-500/30">
                <h2 class="text-2xl font-bold text-blue-400 mb-4">🔧 Application Configuration</h2>
                
                <div class="space-y-4">
                    <div class="bg-gray-800/50 p-4 rounded-lg">
                        <h4 class="text-blue-300 font-semibold mb-2">PHP Version</h4>
                        <p class="text-white">{{ $info['php_version'] }}</p>
                    </div>
                    
                    <div class="bg-gray-800/50 p-4 rounded-lg">
                        <h4 class="text-blue-300 font-semibold mb-2">Laravel Version</h4>
                        <p class="text-white">{{ $info['laravel_version'] }}</p>
                    </div>
                    
                    <div class="bg-gray-800/50 p-4 rounded-lg">
                        <h4 class="text-blue-300 font-semibold mb-2">Environment</h4>
                        <p class="text-white">{{ $info['environment'] }}</p>
                    </div>
                    
                    <div class="bg-red-900/30 p-4 rounded-lg border border-red-500/50">
                        <h4 class="text-red-400 font-semibold mb-2">🚨 Debug Mode (EXPOSED!)</h4>
                        <p class="text-red-300">{{ $info['debug_mode'] ? 'ENABLED - DANGEROUS!' : 'Disabled' }}</p>
                    </div>
                </div>
            </div>

            <!-- Database Configuration -->
            <div class="bg-black/60 backdrop-blur-lg rounded-2xl p-6 border border-blue-500/30">
                <h2 class="text-2xl font-bold text-blue-400 mb-4">🗄️ Database Configuration</h2>
                
                <div class="space-y-4">
                    @if(isset($info['database_config']))
                        <div class="bg-red-900/30 p-4 rounded-lg border border-red-500/50">
                            <h4 class="text-red-400 font-semibold mb-2">🔓 Database Host</h4>
                            <p class="text-red-300 font-mono">{{ $info['database_config']['host'] ?? 'N/A' }}</p>
                        </div>
                        
                        <div class="bg-red-900/30 p-4 rounded-lg border border-red-500/50">
                            <h4 class="text-red-400 font-semibold mb-2">🔓 Database Port</h4>
                            <p class="text-red-300 font-mono">{{ $info['database_config']['port'] ?? 'N/A' }}</p>
                        </div>
                        
                        <div class="bg-red-900/30 p-4 rounded-lg border border-red-500/50">
                            <h4 class="text-red-400 font-semibold mb-2">🔓 Database Name</h4>
                            <p class="text-red-300 font-mono">{{ $info['database_config']['database'] ?? 'N/A' }}</p>
                        </div>
                        
                        <div class="bg-red-900/30 p-4 rounded-lg border border-red-500/50">
                            <h4 class="text-red-400 font-semibold mb-2">🔓 Database Username</h4>
                            <p class="text-red-300 font-mono">{{ $info['database_config']['username'] ?? 'N/A' }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Application Key Exposure -->
        <div class="mt-8 bg-black/60 backdrop-blur-lg rounded-2xl p-6 border border-red-500/30">
            <h2 class="text-2xl font-bold text-red-400 mb-4">🔑 Critical Security Keys (EXPOSED!)</h2>
            
            <div class="bg-red-900/30 p-4 rounded-lg border border-red-500/50">
                <h4 class="text-red-400 font-semibold mb-2">🚨 Application Key</h4>
                <p class="text-red-300 font-mono text-sm break-all">{{ $info['app_key'] }}</p>
                <p class="text-red-400 text-xs mt-2">⚠️ This key is used for encryption! Exposure allows data decryption!</p>
            </div>
        </div>

        <!-- Server Information -->
        <div class="mt-8 bg-black/60 backdrop-blur-lg rounded-2xl p-6 border border-yellow-500/30">
            <h2 class="text-2xl font-bold text-yellow-400 mb-4">🖥️ Server Information (Information Disclosure)</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @if(isset($info['server_info']))
                    <div class="bg-gray-800/50 p-4 rounded-lg">
                        <h4 class="text-yellow-300 font-semibold mb-2">Server Software</h4>
                        <p class="text-white text-sm">{{ $info['server_info']['SERVER_SOFTWARE'] ?? 'N/A' }}</p>
                    </div>
                    
                    <div class="bg-gray-800/50 p-4 rounded-lg">
                        <h4 class="text-yellow-300 font-semibold mb-2">Document Root</h4>
                        <p class="text-white text-sm font-mono">{{ $info['server_info']['DOCUMENT_ROOT'] ?? 'N/A' }}</p>
                    </div>
                    
                    <div class="bg-gray-800/50 p-4 rounded-lg">
                        <h4 class="text-yellow-300 font-semibold mb-2">Server Name</h4>
                        <p class="text-white text-sm">{{ $info['server_info']['SERVER_NAME'] ?? 'N/A' }}</p>
                    </div>
                    
                    <div class="bg-gray-800/50 p-4 rounded-lg">
                        <h4 class="text-yellow-300 font-semibold mb-2">PHP Self</h4>
                        <p class="text-white text-sm font-mono">{{ $info['server_info']['PHP_SELF'] ?? 'N/A' }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Environment Variables -->
        @if(isset($info['env_variables']) && count($info['env_variables']) > 0)
        <div class="mt-8 bg-black/60 backdrop-blur-lg rounded-2xl p-6 border border-orange-500/30">
            <h2 class="text-2xl font-bold text-orange-400 mb-4">🌍 Environment Variables (Partial Exposure)</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-h-96 overflow-y-auto">
                @foreach(array_slice($info['env_variables'], 0, 20) as $key => $value)
                <div class="bg-gray-800/50 p-3 rounded-lg">
                    <h4 class="text-orange-300 font-semibold text-sm mb-1">{{ $key }}</h4>
                    <p class="text-white text-xs font-mono break-all">{{ Str::limit($value, 50) }}</p>
                </div>
                @endforeach
            </div>
            
            @if(count($info['env_variables']) > 20)
            <p class="text-orange-400 text-sm mt-4 text-center">
                ... and {{ count($info['env_variables']) - 20 }} more environment variables exposed!
            </p>
            @endif
        </div>
        @endif

        <!-- Educational Content -->
        <div class="mt-8 bg-black/60 backdrop-blur-lg rounded-2xl p-6 border border-green-500/30">
            <h2 class="text-2xl font-bold text-green-400 mb-4">🎓 Educational Content</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold text-red-400 mb-3">🚨 Misconfiguration Issues</h3>
                    <ul class="text-gray-300 space-y-2 text-sm">
                        <li>• <strong>Debug Mode Enabled:</strong> Exposes sensitive error information</li>
                        <li>• <strong>Configuration Exposure:</strong> Database credentials visible</li>
                        <li>• <strong>Application Key Exposed:</strong> Encryption/decryption possible</li>
                        <li>• <strong>Server Info Disclosure:</strong> Helps attackers fingerprint system</li>
                        <li>• <strong>Environment Variables:</strong> May contain secrets and credentials</li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-green-400 mb-3">🛡️ How to Fix</h3>
                    <ul class="text-gray-300 space-y-2 text-sm">
                        <li>• <strong>Production Environment:</strong> Set APP_ENV=production</li>
                        <li>• <strong>Disable Debug:</strong> Set APP_DEBUG=false</li>
                        <li>• <strong>Secure Headers:</strong> Hide server information</li>
                        <li>• <strong>Error Pages:</strong> Custom error pages, no stack traces</li>
                        <li>• <strong>Environment Security:</strong> Protect .env files</li>
                    </ul>
                </div>
            </div>

            <div class="mt-6 bg-gray-800/50 p-4 rounded-lg">
                <h4 class="text-blue-400 font-semibold mb-2">🔧 Security Configuration Checklist:</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-red-300">❌ Debug mode enabled</p>
                        <p class="text-red-300">❌ Configuration exposed</p>
                        <p class="text-red-300">❌ Server info disclosed</p>
                        <p class="text-red-300">❌ Environment variables exposed</p>
                    </div>
                    <div>
                        <p class="text-green-300">✅ Should disable debug mode</p>
                        <p class="text-green-300">✅ Should hide configuration</p>
                        <p class="text-green-300">✅ Should mask server info</p>
                        <p class="text-green-300">✅ Should protect environment</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</x-app-layout>
