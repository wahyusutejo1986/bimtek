<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VulnerableController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * VULNERABILITY 1: IDOR (Insecure Direct Object Reference)
     * 
     * This endpoint allows authenticated users to view ANY post by ID
     * without checking if they own the post or have permission to view it.
     * 
     * Exploit: /vulnerable/post/1, /vulnerable/post/2, etc.
     * Risk: Users can access other users' private/draft posts
     */
    public function viewPost($id)
    {
        // VULNERABLE: No authorization check - any authenticated user can view any post
        $post = Post::findOrFail($id);
        
        return view('vulnerable.post-detail', compact('post'));
    }

    /**
     * VULNERABILITY 1b: IDOR - Edit Post without Authorization
     * 
     * Allows any authenticated user to edit any post by changing the ID
     * 
     * Exploit: /vulnerable/post/edit/1, /vulnerable/post/edit/2, etc.
     * Risk: Users can modify content they don't own
     */
    public function editPost($id)
    {
        // VULNERABLE: No ownership verification
        $post = Post::findOrFail($id);
        
        return view('vulnerable.post-edit', compact('post'));
    }

    public function updatePost(Request $request, $id)
    {
        // VULNERABLE: No authorization check
        $post = Post::findOrFail($id);
        
        $post->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('vulnerable.post.view', $id)->with('success', 'Post updated successfully!');
    }

    /**
     * VULNERABILITY 1c: IDOR - User Profile Access
     * 
     * View any user's profile information without authorization
     * 
     * Exploit: /vulnerable/user/1, /vulnerable/user/2, etc.
     * Risk: Access to sensitive user information
     */
    public function viewUserProfile($id)
    {
        // VULNERABLE: Any authenticated user can view any user's profile
        $user = User::with('posts')->findOrFail($id);
        
        return view('vulnerable.user-profile', compact('user'));
    }

    /**
     * VULNERABILITY 2: SQL Injection
     * 
     * Search functionality vulnerable to SQL injection
     * Only accessible to authenticated users
     * 
     * Exploit Examples:
     * - /vulnerable/search?query=' OR 1=1 --
     * - /vulnerable/search?query=' UNION SELECT username,password,email FROM users --
     * - /vulnerable/search?query=' OR '1'='1
     */
    public function search(Request $request)
    {
        $query = $request->get('query', '');
        
        if (empty($query)) {
            return view('vulnerable.search', ['posts' => collect(), 'query' => '']);
        }

        // VULNERABLE: Direct string concatenation in SQL query
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
            // Show error for debugging (also vulnerable - information disclosure)
            return view('vulnerable.search', [
                'posts' => collect(), 
                'query' => $query,
                'error' => $e->getMessage()
            ]);
        }
        
        return view('vulnerable.search', compact('posts', 'query'));
    }

    /**
     * VULNERABILITY 2b: SQL Injection in User Search
     * 
     * Advanced SQL injection in user search functionality
     * 
     * Exploit Examples:
     * - /vulnerable/users?name=' OR 1=1 --
     * - /vulnerable/users?name=' UNION SELECT id,email,password,created_at FROM users --
     */
    public function searchUsers(Request $request)
    {
        $name = $request->get('name', '');
        
        if (empty($name)) {
            return view('vulnerable.user-search', ['users' => collect(), 'name' => '']);
        }

        // VULNERABLE: SQL injection in user search
        $sql = "SELECT id, first_name, last_name, email, created_at 
                FROM users 
                WHERE first_name LIKE '%" . $name . "%' 
                OR last_name LIKE '%" . $name . "%'";
        
        try {
            $users = DB::select($sql);
        } catch (\Exception $e) {
            return view('vulnerable.user-search', [
                'users' => collect(), 
                'name' => $name,
                'error' => $e->getMessage()
            ]);
        }
        
        return view('vulnerable.user-search', compact('users', 'name'));
    }

    /**
     * Vulnerability Dashboard - Lists all vulnerable endpoints
     */
    public function dashboard()
    {
        $totalPosts = Post::count();
        $totalUsers = User::count();
        $currentUser = Auth::user();
        
        return view('vulnerable.dashboard', compact('totalPosts', 'totalUsers', 'currentUser'));
    }
}
