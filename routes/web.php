<?php

use App\Http\Controllers\ServicesController;
use App\Http\Controllers\ToolsController;
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
| Business Services Routes - Content & User Management
|--------------------------------------------------------------------------
|
| These routes provide content management and user services functionality
| for the application.
|
*/

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // Content Management Services
    Route::get('/services', [ServicesController::class, 'dashboard'])->name('services.dashboard');
    
    // Content Management - Business-friendly URLs
    Route::get('/services/content/view', [ServicesController::class, 'viewPost'])->name('services.post.view');
    Route::get('/services/content/edit', [ServicesController::class, 'editPost'])->name('services.post.edit');
    Route::put('/services/content/update', [ServicesController::class, 'updatePost'])->name('services.post.update');
    Route::get('/services/profile/view', [ServicesController::class, 'viewUserProfile'])->name('services.user.profile');
    
    // Search Services
    Route::get('/services/search/content', [ServicesController::class, 'search'])->name('services.search');
    Route::get('/services/directory/users', [ServicesController::class, 'searchUsers'])->name('services.users');
    
    // File Management
    Route::get('/services/files/manager', [ServicesController::class, 'uploadForm'])->name('services.upload');
    Route::post('/services/files/upload', [ServicesController::class, 'handleUpload'])->name('services.upload.handle');
});

/*
|--------------------------------------------------------------------------
| System Tools Routes - Advanced Management Features
|--------------------------------------------------------------------------
|
| Advanced system management and administrative tools for comprehensive
| application management and monitoring.
|
*/

Route::middleware(['auth:sanctum', 'verified'])->prefix('tools')->group(function () {
    // System Tools Dashboard
    Route::get('/dashboard', [ToolsController::class, 'dashboard'])->name('tools.dashboard');
    
    // A01:2021 – User Management Tools
    Route::get('/user-management/profile', [ToolsController::class, 'viewUserProfile'])->name('tools.user-management.user');
    Route::get('/content-editor/edit', [ToolsController::class, 'editAnyPost'])->name('tools.user-management.edit');
    Route::put('/content-editor/update', [ToolsController::class, 'updateAnyPost'])->name('tools.user-management.update');
    
    // A02:2021 – Security Management
    Route::get('/security/credentials', [ToolsController::class, 'showPasswords'])->name('tools.security.credentials');
    Route::post('/security/store-data', [ToolsController::class, 'storeWeakData'])->name('tools.security.store');
    
    // A03:2021 – Data Management
    Route::get('/data/search', [ToolsController::class, 'searchPosts'])->name('tools.data.search');
    Route::match(['GET', 'POST'], '/data/access', [ToolsController::class, 'vulnerableLogin'])->name('tools.data.access');
    
    // A04:2021 – Account Management
    Route::match(['GET', 'POST'], '/account/recovery', [ToolsController::class, 'insecurePasswordReset'])->name('tools.account.recovery');
    
    // A05:2021 – System Information
    Route::get('/system/info', [ToolsController::class, 'debugInfo'])->name('tools.system.info');
    
    // A06:2021 – Component Management
    Route::get('/system/components', [ToolsController::class, 'vulnerableComponents'])->name('tools.system.components');
    
    // A07:2021 – Authentication Tools
    Route::match(['GET', 'POST'], '/auth/management', [ToolsController::class, 'weakAuth'])->name('tools.auth.management');
    
    // A08:2021 – Data Processing
    Route::match(['GET', 'POST'], '/data/processing', [ToolsController::class, 'unsafeDeserialization'])->name('tools.data.processing');
    
    // A09:2021 – System Monitoring
    Route::get('/monitoring/logs', [ToolsController::class, 'insufficientLogging'])->name('tools.monitoring.logs');
    
    // A10:2021 – External Services
    Route::get('/external/services', [ToolsController::class, 'ssrfVulnerability'])->name('tools.external.services');
    
    // Additional Tools
    Route::get('/content/preview', [ToolsController::class, 'xssDemo'])->name('tools.content.preview');
    Route::post('/content/comment', [ToolsController::class, 'storeXssComment'])->name('tools.content.comment');
});

/*
|--------------------------------------------------------------------------
| End of Vulnerable Routes
|--------------------------------------------------------------------------
*/
