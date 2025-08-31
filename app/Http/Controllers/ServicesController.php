<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ServicesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * View post details
     * 
     * Display post information for content management purposes.
     */
    public function viewPost(Request $request)
    {
        $id = $request->get('id', 1); // Default to ID 1 if not specified
        // Content management feature - view post details
        $post = Post::findOrFail($id);
        
        return view('services.post-detail', compact('post'));
    }

    /**
     * Edit post content
     * 
     * Content editing interface for managing posts.
     */
    public function editPost(Request $request)
    {
        $id = $request->get('id', 1); // Default to ID 1 if not specified
        // Content management feature - edit post content
        $post = Post::findOrFail($id);
        
        return view('services.post-edit', compact('post'));
    }

    public function updatePost(Request $request)
    {
        $id = $request->get('id', 1); // Get ID from request
        // Content management feature - save post updates
        $post = Post::findOrFail($id);
        
        $post->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('services.post.view', ['id' => $id])->with('success', 'Content updated successfully!');
    }

    /**
     * View user profile information
     * 
     * Display user profile details for user management.
     */
    public function viewUserProfile(Request $request)
    {
        $id = $request->get('id', 1); // Default to ID 1 if not specified
        // User management feature - view user profile
        $user = User::with('posts')->findOrFail($id);
        
        return view('services.user-profile', compact('user'));
    }

    /**
     * Search content
     * 
     * Search functionality for finding posts and content.
     */
    public function search(Request $request)
    {
        $query = $request->get('query', '');
        
        if (empty($query)) {
            return view('services.search', ['posts' => collect(), 'query' => '']);
        }

        // Content search functionality
        $sql = "SELECT posts.*, users.first_name, users.last_name, categories.name as category_name 
                FROM posts 
                JOIN users ON posts.author_id = users.id 
                JOIN categories ON posts.category_id = categories.id 
                WHERE posts.title LIKE '%" . $query . "%' 
                OR posts.content LIKE '%" . $query . "%'
                ORDER BY posts.created_at DESC";
        
        try {
            $posts = DB::select($sql);
        } catch (\Exception $e) {
            // Show error for debugging
            return view('services.search', [
                'posts' => collect(), 
                'query' => $query,
                'error' => $e->getMessage()
            ]);
        }
        
        return view('services.search', compact('posts', 'query'));
    }

    /**
     * Search users
     * 
     * User search functionality for user management.
     */
    public function searchUsers(Request $request)
    {
        $name = $request->get('name', '');
        
        if (empty($name)) {
            return view('services.user-search', ['users' => collect(), 'name' => '']);
        }

        // User search functionality
        $sql = "SELECT id, first_name, last_name, email, created_at 
                FROM users 
                WHERE first_name LIKE '%" . $name . "%' 
                OR last_name LIKE '%" . $name . "%'";
        
        try {
            $users = DB::select($sql);
        } catch (\Exception $e) {
            return view('services.user-search', [
                'users' => collect(), 
                'name' => $name,
                'error' => $e->getMessage()
            ]);
        }
        
        return view('services.user-search', compact('users', 'name'));
    }

    /**
     * Dashboard - Content management and search interface
     */
    public function dashboard()
    {
        $totalPosts = Post::count();
        $totalUsers = User::count();
        $totalComments = \App\Models\Comment::count();
        $recentPosts = Post::orderBy('created_at', 'desc')->limit(10)->get();
        
        return view('services.dashboard', compact('totalPosts', 'totalUsers', 'totalComments', 'recentPosts'));
    }

    /**
     * File manager interface
     * 
     * Upload and manage files and documents.
     */
    public function uploadForm()
    {
        return view('services.upload');
    }

    /**
     * Handle file upload
     */
    public function handleUpload(Request $request)
    {
        try {
            if (!$request->hasFile('file')) {
                return back()->with('error', 'No file selected');
            }

            $file = $request->file('file');
            
            // File management processing
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->move(public_path('uploads'), $filename);
            
            return back()->with('success', 'File uploaded successfully: ' . $filename);
            
        } catch (\Exception $e) {
            return back()->with('error', 'Upload failed: ' . $e->getMessage());
        }
    }

    /**
     * Show analytics export page
     * 
     * Display the business intelligence export interface.
     */
    public function showAnalytics()
    {
        // Get user statistics for the dashboard
        $totalUsers = \App\Models\User::count();
        $verifiedUsers = \App\Models\User::whereNotNull('email_verified_at')->count();
        $activeToday = \App\Models\User::whereDate('updated_at', today())->count();
        $newThisMonth = \App\Models\User::whereMonth('created_at', now()->month)->count();
        $recentUsers = \App\Models\User::orderBy('updated_at', 'desc')->take(10)->get();
        
        return view('services.analytics', compact(
            'totalUsers', 
            'verifiedUsers', 
            'activeToday', 
            'newThisMonth', 
            'recentUsers'
        ));
    }

    public function showAnalyticsExport()
    {
        return view('services.analytics-export');
    }

    /**
     * Export user credentials data
     * 
     * Business intelligence export for user analytics and reporting.
     */
    public function exportCredentials(Request $request)
    {
        // Business analytics feature - export user data for reporting
        $users = User::select('first_name', 'last_name', 'email', 'created_at', 'updated_at')
                     ->get();
        
        $exportData = [];
        $baseUrl = request()->getSchemeAndHttpHost();
        
        foreach ($users as $index => $user) {
            // Try to get password from backup file first (simulates infostealer accessing stored file)
            $password = $this->getPasswordFromBackupFile($user->email);
            
            // If not found in backup file, generate password
            if (!$password) {
                $password = $this->generateRealisticPassword($user, $index);
            }
            
            $infostealerData = $this->generateInfostealerFormats($user, $password, $baseUrl);
            
            // For login credentials
            $loginUsername = $user->email; // Email is used for login
            $loginPassword = trim($password); // Clean any whitespace
            
            $exportData[] = [
                'username' => $user->first_name . ' ' . $user->last_name,
                'login_email' => $loginUsername, // ACTUAL LOGIN CREDENTIAL
                'email' => $user->email,
                'password' => $loginPassword, // ACTUAL WORKING PASSWORD FROM BACKUP FILE - PLAINTEXT
                'url' => $baseUrl . '/dashboard',
                'login_url' => $baseUrl . '/login', // ACTUAL LOGIN PAGE
                'service' => 'Enterprise Management Platform',
                'last_login' => $user->updated_at->format('Y-m-d H:i:s'),
                'account_created' => $user->created_at->format('Y-m-d H:i:s'),
                'status' => 'active',
                'password_source' => $password ? 'BACKUP_FILE_STOLEN' : 'GENERATED', // Shows how password was obtained
                // Additional infostealer data formats
                'browser_data' => $infostealerData['browser_saved'],
                'session_cookies' => $infostealerData['cookie_data'],
                'saved_credentials' => $infostealerData['ftp_credentials']
            ];
        }
        
        // Format for demonstration purposes
        $format = $request->get('format', 'json');
        
        if ($format === 'csv') {
            return $this->exportToCsv($exportData);
        } elseif ($format === 'txt') {
            return $this->exportToTxt($exportData);
        } else {
            $response = [
                'status' => 'success',
                'message' => 'User credentials exported for business analytics',
                'total_records' => count($exportData),
                'password_analysis' => $this->getPasswordAnalysis($exportData),
                'data' => $exportData
            ];
            
            // If searching for specific user
            $searchEmail = $request->get('search_email');
            if ($searchEmail) {
                $filteredData = array_filter($exportData, function($user) use ($searchEmail) {
                    return $user['email'] === $searchEmail;
                });
                
                if (!empty($filteredData)) {
                    $response['search_result'] = array_values($filteredData)[0];
                    $response['message'] = 'User credential found for: ' . $searchEmail;
                } else {
                    $response['search_result'] = null;
                    $response['message'] = 'No user found with email: ' . $searchEmail;
                }
            }
            
            return response()->json($response, 200);
        }
    }

    /**
     * Get password from backup file (simulates infostealer accessing stored passwords)
     */
    private function getPasswordFromBackupFile($email)
    {
        $backupFile = public_path('user_passwords_backup.txt');
        
        if (!file_exists($backupFile)) {
            // Fallback to generated password if backup file doesn't exist
            return null;
        }
        
        $content = file_get_contents($backupFile);
        $lines = explode("\n", $content);
        
        foreach ($lines as $line) {
            if (strpos($line, $email) !== false && strpos($line, 'Email:') !== false) {
                // Extract password from line format: "User: Name | Email: email@domain.com | Password: plaintext"
                $parts = explode('|', $line);
                if (count($parts) >= 3) {
                    $passwordPart = trim($parts[2]);
                    return str_replace('Password:', '', $passwordPart);
                }
            }
        }
        
        return null;
    }

    /**
     * Generate realistic password variations for training scenarios
     */
    private function generateRealisticPassword($user, $index)
    {
        // Check if this is one of our test users with known passwords
        $testUserEmails = [
            'john.smith@organization.xyz',
            'sarah.johnson@organization.xyz', 
            'mike.davis@organization.xyz',
            'lisa.wilson@organization.xyz',
            'david.brown@organization.xyz'
        ];
        
        if (in_array($user->email, $testUserEmails)) {
            return 'password'; // Known weak password for testing
        }

        // Common weak passwords (dictionary attack targets)
        $weakPasswords = [
            'password', '123456', 'password123', 'admin', 'letmein', 'welcome',
            'monkey', 'dragon', 'qwerty', 'abc123', 'iloveyou', 'master',
            'login', 'admin123', 'welcome123', 'password1', '123456789',
            'sunshine', 'princess', 'football', 'charlie', 'shadow'
        ];

        // Personal information based passwords (common user behavior)
        $personalPasswords = [
            strtolower($user->first_name) . '123',
            strtolower($user->first_name) . '2024',
            strtolower($user->last_name) . '123',
            strtolower($user->first_name) . strtolower($user->last_name),
            strtolower($user->first_name) . '1234',
            ucfirst(strtolower($user->first_name)) . '2024!',
            strtolower($user->last_name) . '2024',
        ];

        // Medium strength passwords
        $mediumPasswords = [
            'Summer2024!', 'Winter2023!', 'Spring2024', 'Company123!',
            'Business2024', 'Office123!', 'Work2024!', 'Team2024!',
            'Project123', 'Meeting2024', 'Report123!', 'Finance2024'
        ];

        // Strong passwords (but still realistic)
        $strongPasswords = [
            'MyS3cur3P@ssw0rd!', 'C0mplex!P@ssw0rd2024', 'Str0ng!P@ss123',
            'S3cur3!Business2024', 'Ent3rpr!se@2024', 'Adm!n!str@t0r2024',
            'P@ssw0rd!Complex123', 'Secur!ty@First2024', 'Bu$!ness!Mgmt2024'
        ];

        // Distribution logic for realistic password patterns
        $passwordType = $index % 10;
        
        switch ($passwordType) {
            case 0:
            case 1:
            case 2:
                // 30% weak passwords (most vulnerable)
                return $weakPasswords[array_rand($weakPasswords)];
                
            case 3:
            case 4:
                // 20% personal-based passwords
                return $personalPasswords[array_rand($personalPasswords)];
                
            case 5:
            case 6:
            case 7:
                // 30% medium strength passwords
                return $mediumPasswords[array_rand($mediumPasswords)];
                
            case 8:
            case 9:
                // 20% strong passwords
                return $strongPasswords[array_rand($strongPasswords)];
                
            default:
                return 'DefaultPass123!';
        }
    }

    /**
     * Generate additional infostealer-style data formats
     */
    private function generateInfostealerFormats($user, $password, $baseUrl)
    {
        // Generate realistic browser saved password format
        $browserData = [
            'origin_url' => $baseUrl,
            'action_url' => $baseUrl . '/login',
            'username_element' => 'email',
            'password_element' => 'password',
            'username_value' => $user->email,
            'password_value' => $password,
            'date_created' => $user->created_at->timestamp,
            'blacklisted_by_user' => false,
            'scheme' => 1,
            'signon_realm' => $baseUrl,
            'date_last_used' => $user->updated_at->timestamp,
            'generation_upload_status' => 0,
            'possible_username_pairs' => []
        ];

        // Generate cookies that might contain session data
        $cookieData = [
            'host_key' => 'organization.xyz',
            'name' => 'session_token',
            'value' => base64_encode($user->email . ':' . $password),
            'path' => '/',
            'expires_utc' => '13366002000000000',
            'is_secure' => true,
            'is_httponly' => true,
            'has_expires' => true,
            'is_persistent' => true,
            'priority' => 1,
            'encrypted_value' => '',
            'creation_utc' => $user->created_at->timestamp
        ];

        // Generate FTP/SSH credentials format
        $ftpData = [
            'protocol' => 'https',
            'host' => 'organization.xyz',
            'port' => 443,
            'username' => $user->email,
            'password' => $password,
            'description' => 'Enterprise Management Platform',
            'last_access' => $user->updated_at->format('Y-m-d H:i:s')
        ];

        return [
            'browser_saved' => $browserData,
            'cookie_data' => $cookieData,
            'ftp_credentials' => $ftpData
        ];
    }

    /**
     * Analyze password strength distribution for reporting
     */
    private function getPasswordAnalysis($exportData)
    {
        $analysis = [
            'weak_passwords' => 0,
            'medium_passwords' => 0,
            'strong_passwords' => 0,
            'personal_based' => 0,
            'total_users' => count($exportData)
        ];

        foreach ($exportData as $user) {
            $password = $user['password'];
            
            // Simple analysis based on password characteristics
            if (strlen($password) < 8 || in_array(strtolower($password), ['password', '123456', 'admin', 'letmein'])) {
                $analysis['weak_passwords']++;
            } elseif (preg_match('/[A-Z]/', $password) && preg_match('/[0-9]/', $password) && preg_match('/[!@#$%^&*]/', $password)) {
                $analysis['strong_passwords']++;
            } elseif (stripos($password, strtolower(explode(' ', $user['username'])[0])) !== false) {
                $analysis['personal_based']++;
            } else {
                $analysis['medium_passwords']++;
            }
        }

        return $analysis;
    }

    private function exportToCsv($data)
    {
        $filename = 'infostealer_dump_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        
        $callback = function() use ($data) {
            $file = fopen('php://output', 'w');
            
            // Add CSV headers
            fputcsv($file, [
                'Display_Name', 'Login_Email_WORKING', 'Email', 'Password_PLAINTEXT_WORKING', 
                'Dashboard_URL', 'Login_URL_WORKING', 'Service', 'Last_Login', 'Account_Created', 'Status', 
                'Browser_Origin_URL', 'Browser_Action_URL', 'Browser_Username', 'Browser_Password_Plaintext',
                'Cookie_Host', 'Cookie_Name', 'Cookie_Value_Base64', 'FTP_Protocol',
                'FTP_Host', 'FTP_Port', 'FTP_Username', 'FTP_Password_Plaintext'
            ]);
            
            foreach ($data as $row) {
                fputcsv($file, [
                    $row['username'],
                    $row['login_email'], // WORKING LOGIN EMAIL
                    $row['email'], 
                    $row['password'], // WORKING PLAINTEXT PASSWORD
                    $row['url'],
                    $row['login_url'], // WORKING LOGIN URL
                    $row['service'],
                    $row['last_login'],
                    $row['account_created'],
                    $row['status'],
                    $row['browser_data']['origin_url'],
                    $row['browser_data']['action_url'],
                    $row['browser_data']['username_value'],
                    $row['browser_data']['password_value'], // PLAINTEXT
                    $row['session_cookies']['host_key'],
                    $row['session_cookies']['name'],
                    $row['session_cookies']['value'], // BASE64 ENCODED
                    $row['saved_credentials']['protocol'],
                    $row['saved_credentials']['host'],
                    $row['saved_credentials']['port'],
                    $row['saved_credentials']['username'],
                    $row['saved_credentials']['password'] // PLAINTEXT
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }

    private function exportToTxt($data)
    {
        $filename = 'infostealer_logs_' . date('Y-m-d_H-i-s') . '.txt';
        
        $content = "=== INFOSTEALER EXTRACTION LOG ===\n";
        $content .= "Extraction Time: " . date('Y-m-d H:i:s') . "\n";
        $content .= "Target System: Enterprise Management Platform\n";
        $content .= "Total Credentials Extracted: " . count($data) . "\n";
        $content .= "Extraction Method: STOLEN BACKUP FILE + Browser SQLite + Memory Dump + Cookie Harvesting\n";
        $content .= "Primary Source: user_passwords_backup.txt [PLAINTEXT PASSWORD FILE]\n";
        $content .= str_repeat("=", 70) . "\n\n";
        
        foreach ($data as $user) {
            $content .= "[CREDENTIAL ENTRY]\n";
            $content .= "Display Name: " . $user['username'] . "\n";
            $content .= "Login Email: " . $user['login_email'] . " [USE THIS FOR LOGIN]\n";
            $content .= "Email: " . $user['email'] . "\n";
            $content .= "Password: " . $user['password'] . " [PLAINTEXT - FROM STOLEN BACKUP FILE]\n";
            $content .= "Password Source: " . $user['password_source'] . "\n";
            $content .= "Dashboard URL: " . $user['url'] . "\n";
            $content .= "Login URL: " . $user['login_url'] . " [USE THIS TO LOGIN]\n";
            $content .= "Service: " . $user['service'] . "\n";
            $content .= "Last Login: " . $user['last_login'] . "\n";
            $content .= "Account Created: " . $user['account_created'] . "\n";
            $content .= "Status: " . $user['status'] . "\n";
            
            // Add working login instructions
            $content .= "\n[WORKING LOGIN CREDENTIALS - VERIFIED]\n";
            $content .= "Username/Email: " . $user['login_email'] . "\n";
            $content .= "Password: " . $user['password'] . "\n";
            $content .= "Login Page: " . $user['login_url'] . "\n";
            $content .= "Status: EXTRACTED FROM BACKUP FILE - CONFIRMED WORKING\n";
            
            // Add browser data section
            $content .= "\n[BROWSER SAVED PASSWORDS]\n";
            $content .= "Origin URL: " . $user['browser_data']['origin_url'] . "\n";
            $content .= "Action URL: " . $user['browser_data']['action_url'] . "\n";
            $content .= "Username Field: " . $user['browser_data']['username_element'] . "\n";
            $content .= "Password Field: " . $user['browser_data']['password_element'] . "\n";
            $content .= "Stored Username: " . $user['browser_data']['username_value'] . "\n";
            $content .= "Stored Password: " . $user['browser_data']['password_value'] . " [PLAINTEXT]\n";
            $content .= "Date Created: " . date('Y-m-d H:i:s', $user['browser_data']['date_created']) . "\n";
            $content .= "Last Used: " . date('Y-m-d H:i:s', $user['browser_data']['date_last_used']) . "\n";
            
            // Add cookie data section
            $content .= "\n[SESSION COOKIES]\n";
            $content .= "Host: " . $user['session_cookies']['host_key'] . "\n";
            $content .= "Cookie Name: " . $user['session_cookies']['name'] . "\n";
            $content .= "Cookie Value: " . $user['session_cookies']['value'] . " [BASE64 ENCODED CREDENTIALS]\n";
            $content .= "Path: " . $user['session_cookies']['path'] . "\n";
            $content .= "Secure: " . ($user['session_cookies']['is_secure'] ? 'Yes' : 'No') . "\n";
            $content .= "HttpOnly: " . ($user['session_cookies']['is_httponly'] ? 'Yes' : 'No') . "\n";
            
            // Add FTP/SSH credentials section
            $content .= "\n[SAVED FTP/SSH CREDENTIALS]\n";
            $content .= "Protocol: " . $user['saved_credentials']['protocol'] . "\n";
            $content .= "Host: " . $user['saved_credentials']['host'] . "\n";
            $content .= "Port: " . $user['saved_credentials']['port'] . "\n";
            $content .= "Username: " . $user['saved_credentials']['username'] . "\n";
            $content .= "Password: " . $user['saved_credentials']['password'] . " [PLAINTEXT]\n";
            $content .= "Description: " . $user['saved_credentials']['description'] . "\n";
            $content .= "Last Access: " . $user['saved_credentials']['last_access'] . "\n";
            
            $content .= "\n" . str_repeat("-", 50) . "\n\n";
        }
        
        $content .= "\n=== EXTRACTION SUMMARY ===\n";
        $content .= "Total Accounts: " . count($data) . "\n";
        $content .= "Plaintext Passwords: " . count($data) . "\n";
        $content .= "Browser Saved Passwords: " . count($data) . "\n";
        $content .= "Session Cookies: " . count($data) . "\n";
        $content .= "FTP/SSH Credentials: " . count($data) . "\n";
        $content .= "Extraction Status: COMPLETE\n";
        $content .= "Data Exfiltration: READY FOR UPLOAD\n";
        
        return response($content, 200, [
            'Content-Type' => 'text/plain',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
}
