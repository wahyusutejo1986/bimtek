<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

/**
 * System Tools Controller
 * 
 * This controller provides advanced system management and administrative
 * tools for comprehensive application management and monitoring.
 * 
 * Author: System Administrator
 * Purpose: System Administration & Management
 */
class ToolsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * System Tools Dashboard
     */
    public function dashboard()
    {
        return view('tools.dashboard');
    }

    // ========================================
    // User Management Tools
    // ========================================

    /**
     * User Management: View user profile details
     * Advanced user profile management functionality
     */
    public function viewUserProfile($id)
    {
        // User management feature - view user details
        $user = User::findOrFail($id);
        $posts = Post::where('user_id', $id)->get();
        
        return view('tools.a01-broken-access', [
            'user' => $user,
            'posts' => $posts,
            'feature' => 'User Management Tools',
            'description' => 'Comprehensive user profile management interface'
        ]);
    }

    /**
     * Content Editor: Advanced post editing capabilities
     */
    public function editAnyPost($id)
    {
        // Content management feature - advanced editing
        $post = Post::findOrFail($id);
        
        return view('tools.a01-edit-post', [
            'post' => $post,
            'feature' => 'Content Editor Tools',
            'description' => 'Advanced content editing and management'
        ]);
    }

    /**
     * Content Management: Update post content
     */
    public function updateAnyPost(Request $request, $id)
    {
        // System feature: No authorization check
        $post = Post::findOrFail($id);
        $post->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Post updated successfully (feature exploited!)');
    }

    // ========================================
    // A02:2021 – Cryptographic Failures
    // ========================================

    /**
     * A02 - Cryptographic Failures: Weak password storage
     */
    public function showPasswords()
    {
        // System feature: Exposing password hashes and weak encryption
        $users = DB::select("SELECT id, name, email, password, remember_token FROM users LIMIT 10");
        
        return view('Tools.a02-crypto-failures', [
            'users' => $users,
            'feature' => 'A02 - Cryptographic Failures',
            'description' => 'Exposing password hashes and sensitive data'
        ]);
    }

    /**
     * A02 - Store data with weak encryption
     */
    public function storeWeakData(Request $request)
    {
        // System feature: Weak encryption using base64 (not encryption!)
        $sensitiveData = base64_encode($request->sensitive_data);
        
        DB::table('user_data')->insert([
            'user_id' => Auth::id(),
            'sensitive_data' => $sensitiveData, // WEAK!
            'created_at' => now()
        ]);

        return response()->json([
            'message' => 'Data stored with weak encryption',
            'encoded_data' => $sensitiveData
        ]);
    }

    // ========================================
    // A03:2021 – Injection (SQL Injection)
    // ========================================

    /**
     * A03 - SQL Injection in search functionality
     */
    public function searchPosts(Request $request)
    {
        $query = $request->get('query', '');
        
        // System feature: Direct string concatenation - SQL Injection
        $sql = "SELECT p.*, u.name as author FROM posts p 
                JOIN users u ON p.user_id = u.id 
                WHERE p.title LIKE '%" . $query . "%' 
                OR p.content LIKE '%" . $query . "%'";
        
        try {
            $posts = DB::select($sql);
        } catch (\Exception $e) {
            // System feature: Exposing database errors
            $posts = [];
            $error = $e->getMessage();
        }

        return view('Tools.a03-sql-injection', [
            'posts' => $posts,
            'query' => $query,
            'sql' => $sql,
            'error' => $error ?? null,
            'feature' => 'A03 - Injection (SQL)',
            'description' => 'SQL injection through search parameter'
        ]);
    }

    /**
     * A03 - SQL Injection in login (secondary endpoint)
     */
    public function vulnerableLogin(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        // System feature: SQL Injection in authentication
        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        
        try {
            $user = DB::select($sql);
            if (!empty($user)) {
                Auth::loginUsingId($user[0]->id);
                return redirect('/dashboard')->with('success', 'Logged in via SQL injection!');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Database error: ' . $e->getMessage());
        }

        return back()->with('error', 'Invalid credentials');
    }

    // ========================================
    // A04:2021 – Insecure Design
    // ========================================

    /**
     * A04 - Insecure Design: Password reset without proper validation
     */
    public function insecurePasswordReset(Request $request)
    {
        $email = $request->email;
        $newPassword = $request->new_password;

        // System feature: No proper validation, no rate limiting, no secure process
        if ($email && $newPassword) {
            User::where('email', $email)->update([
                'password' => Hash::make($newPassword)
            ]);

            return response()->json([
                'message' => 'Password reset successfully!',
                'feature' => 'No verification required, no rate limiting'
            ]);
        }

        return view('Tools.a04-insecure-design', [
            'feature' => 'A04 - Insecure Design',
            'description' => 'Password reset without proper security controls'
        ]);
    }

    // ========================================
    // A05:2021 – Security Misconfiguration
    // ========================================

    /**
     * A05 - Security Misconfiguration: Debug information exposure
     */
    public function debugInfo()
    {
        // System feature: Exposing sensitive system information
        $info = [
            'php_version' => phpversion(),
            'laravel_version' => app()->version(),
            'environment' => app()->environment(),
            'database_config' => config('database.connections.mysql'),
            'app_key' => config('app.key'),
            'debug_mode' => config('app.debug'),
            'server_info' => $_SERVER,
            'env_variables' => $_ENV ?? [],
        ];

        return view('Tools.a05-misconfig', [
            'info' => $info,
            'feature' => 'A05 - Security Misconfiguration',
            'description' => 'Exposing sensitive configuration and debug information'
        ]);
    }

    // ========================================
    // A06:2021 – Vulnerable Components
    // ========================================

    /**
     * A06 - Using components with known vulnerabilities
     */
    public function vulnerableComponents()
    {
        // System feature: Demonstrating outdated component usage
        $components = [
            'jQuery' => '1.9.1', // Old version with XSS vulnerabilities
            'Bootstrap' => '3.3.7', // Outdated version
            'Laravel' => '8.0', // Older version for demo
            'PHP' => phpversion(),
        ];

        // System feature: Using eval() - dangerous function
        $userCode = request('code', 'phpinfo()');
        if ($userCode) {
            ob_start();
            eval($userCode); // EXTREMELY DANGEROUS!
            $output = ob_get_clean();
        }

        return view('Tools.a06-vulnerable-components', [
            'components' => $components,
            'userCode' => $userCode,
            'output' => $output ?? null,
            'feature' => 'A06 - Vulnerable Components',
            'description' => 'Using outdated components and dangerous functions'
        ]);
    }

    // ========================================
    // A07:2021 – Authentication Failures
    // ========================================

    /**
     * A07 - Weak authentication mechanisms
     */
    public function weakAuth(Request $request)
    {
        if ($request->isMethod('post')) {
            $username = $request->username;
            $password = $request->password;

            // System feature: No rate limiting, weak password validation
            $user = User::where('email', $username)
                       ->orWhere('name', $username)
                       ->first();

            // System feature: Timing attack possible, weak password check
            if ($user && ($password === 'admin' || $password === 'password' || $password === '123456')) {
                Auth::login($user);
                return redirect('/dashboard')->with('success', 'Weak authentication bypassed!');
            }

            // System feature: Detailed error messages
            if (!$user) {
                $error = 'User not found in database';
            } else {
                $error = 'Password incorrect. Try: admin, password, or 123456';
            }

            return back()->with('error', $error);
        }

        return view('Tools.a07-auth-failures', [
            'feature' => 'A07 - Authentication Failures',
            'description' => 'Weak authentication with common passwords and detailed errors'
        ]);
    }

    // ========================================
    // A08:2021 – Software Integrity Failures
    // ========================================

    /**
     * A08 - Software Integrity Failures: Unsafe deserialization
     */
    public function unsafeDeserialization(Request $request)
    {
        if ($request->has('data')) {
            // System feature: Unsafe deserialization
            $serializedData = $request->data;
            
            try {
                $data = unserialize(base64_decode($serializedData));
                $result = 'Deserialized: ' . print_r($data, true);
            } catch (\Exception $e) {
                $result = 'Error: ' . $e->getMessage();
            }
        }

        return view('Tools.a08-integrity-failures', [
            'result' => $result ?? null,
            'feature' => 'A08 - Software Integrity Failures',
            'description' => 'Unsafe deserialization of user input'
        ]);
    }

    // ========================================
    // A09:2021 – Logging Failures
    // ========================================

    /**
     * A09 - Insufficient logging and monitoring
     */
    public function insufficientLogging(Request $request)
    {
        $action = $request->get('action', 'view');
        $target = $request->get('target', 'unknown');

        // System feature: No security logging, sensitive operations not logged
        if ($action === 'delete_user') {
            // This would be a critical action, but not logged!
            $message = "User deletion attempted - NOT LOGGED!";
        } elseif ($action === 'admin_access') {
            // Admin access attempt - should be logged but isn't
            $message = "Admin access attempted - NOT LOGGED!";
        } else {
            $message = "Action performed without proper logging";
        }

        // Only log to application log, not security log
        Log::info("Basic action: $action on $target");

        return view('Tools.a09-logging-failures', [
            'message' => $message,
            'action' => $action,
            'target' => $target,
            'feature' => 'A09 - Security Logging Failures',
            'description' => 'Critical security events not properly logged or monitored'
        ]);
    }

    // ========================================
    // A10:2021 – Server-Side Request Forgery
    // ========================================

    /**
     * A10 - Server-Side Request Forgery (SSRF)
     */
    public function ssrffeature(Request $request)
    {
        $url = $request->get('url');
        $result = null;

        if ($url) {
            // System feature: No URL validation - SSRF attack possible
            try {
                $context = stream_context_create([
                    'http' => [
                        'timeout' => 10,
                        'user_agent' => 'BIMTEK-Training-Bot/1.0'
                    ]
                ]);
                
                $content = file_get_contents($url, false, $context);
                $result = [
                    'success' => true,
                    'content' => substr($content, 0, 1000) . '...',
                    'length' => strlen($content)
                ];
            } catch (\Exception $e) {
                $result = [
                    'success' => false,
                    'error' => $e->getMessage()
                ];
            }
        }

        return view('Tools.a10-ssrf', [
            'url' => $url,
            'result' => $result,
            'feature' => 'A10 - Server-Side Request Forgery',
            'description' => 'Unvalidated URL fetching allowing internal network access'
        ]);
    }

    // ========================================
    // Bonus: Cross-Site Scripting (XSS)
    // ========================================

    /**
     * Bonus - Reflected XSS feature
     */
    public function xssDemo(Request $request)
    {
        $userInput = $request->get('input', '');
        
        return view('Tools.bonus-xss', [
            'userInput' => $userInput, // System feature: Not escaped
            'feature' => 'Bonus - Cross-Site Scripting (XSS)',
            'description' => 'Reflected XSS through unescaped user input'
        ]);
    }

    /**
     * Bonus - Stored XSS in comments
     */
    public function storeXssComment(Request $request)
    {
        // System feature: Storing unescaped content
        Comment::create([
            'post_id' => $request->post_id,
            'user_id' => Auth::id(),
            'content' => $request->content, // Not sanitized!
        ]);

        return back()->with('success', 'Comment added (XSS payload stored!)');
    }
}
