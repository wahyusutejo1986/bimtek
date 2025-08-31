<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🔥 OWASP Top 10 2021 - Advanced Cybersecurity Training
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
                <h1 class="text-6xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-red-400 via-yellow-400 to-pink-400 mb-4">
                    🔥 OWASP Top 10 2021
                </h1>
                <p class="text-2xl text-gray-300 mb-8">Advanced Cybersecurity Training Laboratory</p>
                <div class="max-w-4xl mx-auto">
                    <div class="bg-black/50 backdrop-blur-lg rounded-2xl p-8 border border-red-500/30">
                        <h2 class="text-red-400 text-xl font-bold mb-4">⚠️ EXTREME WARNING ⚠️</h2>
                        <p class="text-gray-300 text-lg">
                            This laboratory contains the <strong class="text-red-400">most dangerous web vulnerabilities</strong> 
                            according to OWASP Top 10 2021. These are real, exploitable vulnerabilities that can completely 
                            compromise systems. Use only in <strong class="text-yellow-400">isolated training environments</strong>.
                        </p>
                    </div>
                </div>
            </div>

            <!-- OWASP Top 10 Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8 mb-12">
                
                <!-- A01: Broken Access Control -->
                <div class="vulnerability-card group">
                    <div class="vulnerability-header bg-gradient-to-r from-red-600 to-red-800">
                        <h3 class="text-xl font-bold">A01:2021</h3>
                        <span class="text-sm opacity-90">Critical Risk</span>
                    </div>
                    <div class="vulnerability-body">
                        <h4 class="text-lg font-semibold text-red-400 mb-3">🚪 Broken Access Control</h4>
                        <p class="text-gray-300 text-sm mb-4">
                            Access any user's data, edit posts without permission, bypass authorization checks.
                        </p>
                        <div class="space-y-2">
                            <a href="{{ route('owasp.a01.user', 1) }}" 
                               class="block w-full bg-red-600/20 hover:bg-red-600/40 text-red-300 py-2 px-4 rounded-lg text-center transition">
                                👤 View Any User Profile
                            </a>
                            <a href="{{ route('owasp.a01.edit', 1) }}" 
                               class="block w-full bg-red-600/20 hover:bg-red-600/40 text-red-300 py-2 px-4 rounded-lg text-center transition">
                                ✏️ Edit Any Post
                            </a>
                        </div>
                    </div>
                </div>

                <!-- A02: Cryptographic Failures -->
                <div class="vulnerability-card group">
                    <div class="vulnerability-header bg-gradient-to-r from-orange-600 to-red-700">
                        <h3 class="text-xl font-bold">A02:2021</h3>
                        <span class="text-sm opacity-90">High Risk</span>
                    </div>
                    <div class="vulnerability-body">
                        <h4 class="text-lg font-semibold text-orange-400 mb-3">🔐 Cryptographic Failures</h4>
                        <p class="text-gray-300 text-sm mb-4">
                            Weak encryption, exposed password hashes, insecure data storage.
                        </p>
                        <div class="space-y-2">
                            <a href="{{ route('owasp.a02.passwords') }}" 
                               class="block w-full bg-orange-600/20 hover:bg-orange-600/40 text-orange-300 py-2 px-4 rounded-lg text-center transition">
                                🔍 View Password Hashes
                            </a>
                        </div>
                    </div>
                </div>

                <!-- A03: Injection -->
                <div class="vulnerability-card group">
                    <div class="vulnerability-header bg-gradient-to-r from-yellow-600 to-orange-700">
                        <h3 class="text-xl font-bold">A03:2021</h3>
                        <span class="text-sm opacity-90">Critical Risk</span>
                    </div>
                    <div class="vulnerability-body">
                        <h4 class="text-lg font-semibold text-yellow-400 mb-3">💉 Injection Attacks</h4>
                        <p class="text-gray-300 text-sm mb-4">
                            SQL injection in search, authentication bypass, database manipulation.
                        </p>
                        <div class="space-y-2">
                            <a href="{{ route('owasp.a03.search') }}" 
                               class="block w-full bg-yellow-600/20 hover:bg-yellow-600/40 text-yellow-300 py-2 px-4 rounded-lg text-center transition">
                                🔍 SQL Injection Search
                            </a>
                            <a href="{{ route('owasp.a03.login') }}" 
                               class="block w-full bg-yellow-600/20 hover:bg-yellow-600/40 text-yellow-300 py-2 px-4 rounded-lg text-center transition">
                                🔓 Vulnerable Login
                            </a>
                        </div>
                    </div>
                </div>

                <!-- A04: Insecure Design -->
                <div class="vulnerability-card group">
                    <div class="vulnerability-header bg-gradient-to-r from-green-600 to-yellow-700">
                        <h3 class="text-xl font-bold">A04:2021</h3>
                        <span class="text-sm opacity-90">High Risk</span>
                    </div>
                    <div class="vulnerability-body">
                        <h4 class="text-lg font-semibold text-green-400 mb-3">🏗️ Insecure Design</h4>
                        <p class="text-gray-300 text-sm mb-4">
                            Flawed security architecture, missing security controls, design weaknesses.
                        </p>
                        <div class="space-y-2">
                            <a href="{{ route('owasp.a04.reset') }}" 
                               class="block w-full bg-green-600/20 hover:bg-green-600/40 text-green-300 py-2 px-4 rounded-lg text-center transition">
                                🔄 Insecure Password Reset
                            </a>
                        </div>
                    </div>
                </div>

                <!-- A05: Security Misconfiguration -->
                <div class="vulnerability-card group">
                    <div class="vulnerability-header bg-gradient-to-r from-blue-600 to-green-700">
                        <h3 class="text-xl font-bold">A05:2021</h3>
                        <span class="text-sm opacity-90">Medium Risk</span>
                    </div>
                    <div class="vulnerability-body">
                        <h4 class="text-lg font-semibold text-blue-400 mb-3">⚙️ Security Misconfiguration</h4>
                        <p class="text-gray-300 text-sm mb-4">
                            Debug mode enabled, sensitive info exposure, default configurations.
                        </p>
                        <div class="space-y-2">
                            <a href="{{ route('owasp.a05.debug') }}" 
                               class="block w-full bg-blue-600/20 hover:bg-blue-600/40 text-blue-300 py-2 px-4 rounded-lg text-center transition">
                                🐛 Debug Information
                            </a>
                        </div>
                    </div>
                </div>

                <!-- A06: Vulnerable Components -->
                <div class="vulnerability-card group">
                    <div class="vulnerability-header bg-gradient-to-r from-indigo-600 to-blue-700">
                        <h3 class="text-xl font-bold">A06:2021</h3>
                        <span class="text-sm opacity-90">High Risk</span>
                    </div>
                    <div class="vulnerability-body">
                        <h4 class="text-lg font-semibold text-indigo-400 mb-3">📦 Vulnerable Components</h4>
                        <p class="text-gray-300 text-sm mb-4">
                            Outdated libraries, dangerous functions, component vulnerabilities.
                        </p>
                        <div class="space-y-2">
                            <a href="{{ route('owasp.a06.components') }}" 
                               class="block w-full bg-indigo-600/20 hover:bg-indigo-600/40 text-indigo-300 py-2 px-4 rounded-lg text-center transition">
                                🧩 Component Analysis
                            </a>
                        </div>
                    </div>
                </div>

                <!-- A07: Authentication Failures -->
                <div class="vulnerability-card group">
                    <div class="vulnerability-header bg-gradient-to-r from-purple-600 to-indigo-700">
                        <h3 class="text-xl font-bold">A07:2021</h3>
                        <span class="text-sm opacity-90">High Risk</span>
                    </div>
                    <div class="vulnerability-body">
                        <h4 class="text-lg font-semibold text-purple-400 mb-3">🔑 Authentication Failures</h4>
                        <p class="text-gray-300 text-sm mb-4">
                            Weak passwords, no rate limiting, detailed error messages.
                        </p>
                        <div class="space-y-2">
                            <a href="{{ route('owasp.a07.auth') }}" 
                               class="block w-full bg-purple-600/20 hover:bg-purple-600/40 text-purple-300 py-2 px-4 rounded-lg text-center transition">
                                🔐 Weak Authentication
                            </a>
                        </div>
                    </div>
                </div>

                <!-- A08: Software Integrity Failures -->
                <div class="vulnerability-card group">
                    <div class="vulnerability-header bg-gradient-to-r from-pink-600 to-purple-700">
                        <h3 class="text-xl font-bold">A08:2021</h3>
                        <span class="text-sm opacity-90">High Risk</span>
                    </div>
                    <div class="vulnerability-body">
                        <h4 class="text-lg font-semibold text-pink-400 mb-3">🛡️ Integrity Failures</h4>
                        <p class="text-gray-300 text-sm mb-4">
                            Unsafe deserialization, untrusted sources, integrity violations.
                        </p>
                        <div class="space-y-2">
                            <a href="{{ route('owasp.a08.deserialize') }}" 
                               class="block w-full bg-pink-600/20 hover:bg-pink-600/40 text-pink-300 py-2 px-4 rounded-lg text-center transition">
                                📤 Unsafe Deserialization
                            </a>
                        </div>
                    </div>
                </div>

                <!-- A09: Logging Failures -->
                <div class="vulnerability-card group">
                    <div class="vulnerability-header bg-gradient-to-r from-gray-600 to-pink-700">
                        <h3 class="text-xl font-bold">A09:2021</h3>
                        <span class="text-sm opacity-90">Medium Risk</span>
                    </div>
                    <div class="vulnerability-body">
                        <h4 class="text-lg font-semibold text-gray-400 mb-3">📝 Logging Failures</h4>
                        <p class="text-gray-300 text-sm mb-4">
                            No security logging, insufficient monitoring, audit trail gaps.
                        </p>
                        <div class="space-y-2">
                            <a href="{{ route('owasp.a09.logging') }}" 
                               class="block w-full bg-gray-600/20 hover:bg-gray-600/40 text-gray-300 py-2 px-4 rounded-lg text-center transition">
                                📊 Logging Analysis
                            </a>
                        </div>
                    </div>
                </div>

                <!-- A10: SSRF -->
                <div class="vulnerability-card group">
                    <div class="vulnerability-header bg-gradient-to-r from-red-700 to-gray-700">
                        <h3 class="text-xl font-bold">A10:2021</h3>
                        <span class="text-sm opacity-90">High Risk</span>
                    </div>
                    <div class="vulnerability-body">
                        <h4 class="text-lg font-semibold text-red-400 mb-3">🌐 Server-Side Request Forgery</h4>
                        <p class="text-gray-300 text-sm mb-4">
                            Unvalidated URL fetching, internal network access, SSRF attacks.
                        </p>
                        <div class="space-y-2">
                            <a href="{{ route('owasp.a10.ssrf') }}" 
                               class="block w-full bg-red-700/20 hover:bg-red-700/40 text-red-300 py-2 px-4 rounded-lg text-center transition">
                                🔗 SSRF Testing
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Bonus: XSS -->
                <div class="vulnerability-card group">
                    <div class="vulnerability-header bg-gradient-to-r from-yellow-700 to-red-800">
                        <h3 class="text-xl font-bold">Bonus</h3>
                        <span class="text-sm opacity-90">Critical Risk</span>
                    </div>
                    <div class="vulnerability-body">
                        <h4 class="text-lg font-semibold text-yellow-400 mb-3">⚡ Cross-Site Scripting</h4>
                        <p class="text-gray-300 text-sm mb-4">
                            Reflected and stored XSS vulnerabilities, script injection.
                        </p>
                        <div class="space-y-2">
                            <a href="{{ route('owasp.bonus.xss') }}" 
                               class="block w-full bg-yellow-700/20 hover:bg-yellow-700/40 text-yellow-300 py-2 px-4 rounded-lg text-center transition">
                                ⚡ XSS Playground
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Quick Reference -->
            <div class="bg-black/50 backdrop-blur-lg rounded-2xl p-8 border border-blue-500/30">
                <h2 class="text-2xl font-bold text-blue-400 mb-6">🎓 Training Resources</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="text-center">
                        <h3 class="text-lg font-semibold text-green-400 mb-2">💡 Sample Payloads</h3>
                        <code class="text-sm text-gray-300 bg-gray-800 px-2 py-1 rounded">
                            ' OR 1=1 --<br>
                            &lt;script&gt;alert(1)&lt;/script&gt;<br>
                            http://localhost:22/
                        </code>
                    </div>
                    <div class="text-center">
                        <h3 class="text-lg font-semibold text-yellow-400 mb-2">🔧 Tools</h3>
                        <p class="text-sm text-gray-300">
                            Burp Suite, SQLmap,<br>
                            OWASP ZAP, Nikto,<br>
                            Browser DevTools
                        </p>
                    </div>
                    <div class="text-center">
                        <h3 class="text-lg font-semibold text-purple-400 mb-2">📚 References</h3>
                        <p class="text-sm text-gray-300">
                            OWASP Top 10 2021,<br>
                            CWE Database,<br>
                            NIST Guidelines
                        </p>
                    </div>
                    <div class="text-center">
                        <h3 class="text-lg font-semibold text-red-400 mb-2">⚠️ Ethics</h3>
                        <p class="text-sm text-gray-300">
                            Training Only,<br>
                            Authorized Testing,<br>
                            Responsible Disclosure
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.vulnerability-card {
    @apply bg-black/60 backdrop-blur-lg rounded-2xl overflow-hidden border border-gray-600/30 hover:border-red-500/50 transition-all duration-300 transform hover:scale-105;
}

.vulnerability-header {
    @apply p-4 text-white flex justify-between items-center;
}

.vulnerability-body {
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
