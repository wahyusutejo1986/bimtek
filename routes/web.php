<?php

use App\Http\Controllers\VulnerableController;
use App\Http\Controllers\OwaspController;
use App\Http\Livewire\Categories\Categories;
use App\Http\Livewire\Categories\Categoryposts;
use App\Http\Livewire\Posts\Posts;
use App\Http\Livewire\Posts\Post as p;
use App\Http\Livewire\Tags\Tagposts;
use App\Http\Livewire\Tags\Tags;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('test', function () {
//     $category = App\Models\Category::find(3);
//     // return $category->posts;

//     $comment = App\Models\Comment::find(152);
//     // return $comment->author;
//     // return $comment->post;

//     $post = App\Models\Post::find(152);
//     // return $post->category;
//     // return $post->author;
//     // return $post->images;
//     // return $post->comments;
//     // return $post->tags;

//     $tag = App\Models\Tag::find(5);
//     // return $tag->posts;

//     $author = App\Models\User::find(88);
//     // return $author->posts;
//     return $author->comments;
// });

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('dashboard/categories', Categories::class)->name('categories');
Route::get('dashboard/categories/{id}/posts', Categoryposts::class);

Route::get('dashboard/posts', Posts::class)->name('posts');
Route::get('dashboard/posts/{id}', p::class);

Route::get('dashboard/tags', Tags::class)->name('tags');
Route::get('dashboard/tags/{id}/posts', Tagposts::class);

/*
|--------------------------------------------------------------------------
| Vulnerable Routes - For Cybersecurity Training Only
|--------------------------------------------------------------------------
|
| These routes contain intentional security vulnerabilities for educational
| purposes. DO NOT use in production environments!
|
*/

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // Basic Vulnerability Dashboard
    Route::get('/vulnerable', [VulnerableController::class, 'dashboard'])->name('vulnerable.dashboard');
    
    // IDOR Vulnerabilities
    Route::get('/vulnerable/post/{id}', [VulnerableController::class, 'viewPost'])->name('vulnerable.post.view');
    Route::get('/vulnerable/post/edit/{id}', [VulnerableController::class, 'editPost'])->name('vulnerable.post.edit');
    Route::put('/vulnerable/post/{id}', [VulnerableController::class, 'updatePost'])->name('vulnerable.post.update');
    Route::get('/vulnerable/user/{id}', [VulnerableController::class, 'viewUserProfile'])->name('vulnerable.user.profile');
    
    // SQL Injection Vulnerabilities
    Route::get('/vulnerable/search', [VulnerableController::class, 'search'])->name('vulnerable.search');
    Route::get('/vulnerable/users', [VulnerableController::class, 'searchUsers'])->name('vulnerable.users');
});

/*
|--------------------------------------------------------------------------
| OWASP Top 10 2021 Vulnerabilities - Advanced Training
|--------------------------------------------------------------------------
|
| Comprehensive implementation of OWASP Top 10 vulnerabilities for 
| professional cybersecurity training. Each vulnerability is properly
| documented and demonstrates real-world attack scenarios.
|
| ⚠️ WARNING: Contains dangerous vulnerabilities! Training use only!
|
*/

Route::middleware(['auth:sanctum', 'verified'])->prefix('owasp')->group(function () {
    // OWASP Dashboard
    Route::get('/dashboard', [OwaspController::class, 'dashboard'])->name('owasp.dashboard');
    
    // A01:2021 – Broken Access Control
    Route::get('/a01/user/{id}', [OwaspController::class, 'viewUserProfile'])->name('owasp.a01.user');
    Route::get('/a01/edit-post/{id}', [OwaspController::class, 'editAnyPost'])->name('owasp.a01.edit');
    Route::put('/a01/update-post/{id}', [OwaspController::class, 'updateAnyPost'])->name('owasp.a01.update');
    
    // A02:2021 – Cryptographic Failures
    Route::get('/a02/passwords', [OwaspController::class, 'showPasswords'])->name('owasp.a02.passwords');
    Route::post('/a02/store-weak', [OwaspController::class, 'storeWeakData'])->name('owasp.a02.store');
    
    // A03:2021 – Injection
    Route::get('/a03/search', [OwaspController::class, 'searchPosts'])->name('owasp.a03.search');
    Route::match(['GET', 'POST'], '/a03/login', [OwaspController::class, 'vulnerableLogin'])->name('owasp.a03.login');
    
    // A04:2021 – Insecure Design
    Route::match(['GET', 'POST'], '/a04/password-reset', [OwaspController::class, 'insecurePasswordReset'])->name('owasp.a04.reset');
    
    // A05:2021 – Security Misconfiguration
    Route::get('/a05/debug', [OwaspController::class, 'debugInfo'])->name('owasp.a05.debug');
    
    // A06:2021 – Vulnerable and Outdated Components
    Route::get('/a06/components', [OwaspController::class, 'vulnerableComponents'])->name('owasp.a06.components');
    
    // A07:2021 – Identification and Authentication Failures
    Route::match(['GET', 'POST'], '/a07/weak-auth', [OwaspController::class, 'weakAuth'])->name('owasp.a07.auth');
    
    // A08:2021 – Software and Data Integrity Failures
    Route::match(['GET', 'POST'], '/a08/deserialization', [OwaspController::class, 'unsafeDeserialization'])->name('owasp.a08.deserialize');
    
    // A09:2021 – Security Logging and Monitoring Failures
    Route::get('/a09/logging', [OwaspController::class, 'insufficientLogging'])->name('owasp.a09.logging');
    
    // A10:2021 – Server-Side Request Forgery (SSRF)
    Route::get('/a10/ssrf', [OwaspController::class, 'ssrfVulnerability'])->name('owasp.a10.ssrf');
    
    // Bonus Vulnerabilities
    Route::get('/bonus/xss', [OwaspController::class, 'xssDemo'])->name('owasp.bonus.xss');
    Route::post('/bonus/comment', [OwaspController::class, 'storeXssComment'])->name('owasp.bonus.comment');
});

/*
|--------------------------------------------------------------------------
| End of Vulnerable Routes
|--------------------------------------------------------------------------
*/
