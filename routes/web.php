<?php

use App\Http\Controllers\ServicesController;
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
    
    // Business Intelligence & Analytics
    Route::get('/services/analytics', [ServicesController::class, 'showAnalytics'])->name('services.analytics');
    Route::get('/services/analytics/legacy-export', [ServicesController::class, 'showAnalyticsExport'])->name('services.analytics.legacy');
    Route::get('/services/analytics/export', [ServicesController::class, 'exportCredentials'])->name('services.analytics.export');
    
    // Access to stolen backup file (for training demonstration)
    Route::get('/services/analytics/backup-file', function() {
        $filePath = public_path('user_passwords_backup.txt');
        if (file_exists($filePath)) {
            return response()->file($filePath, [
                'Content-Type' => 'text/plain',
                'Content-Disposition' => 'inline; filename="user_passwords_backup.txt"'
            ]);
        }
        return response('Backup file not found', 404);
    })->name('services.analytics.backup');
});

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|

/*
|--------------------------------------------------------------------------
| End of Vulnerable Routes
|--------------------------------------------------------------------------
*/
