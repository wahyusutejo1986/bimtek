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
}
