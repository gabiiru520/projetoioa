<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\ContactMessageController as AdminMessageController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PageContentController as AdminPageContentController;
use App\Http\Controllers\Admin\PortfolioController as AdminPortfolioController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\TeamController as AdminTeamController;
use App\Http\Controllers\Admin\TurmaController as AdminTurmaController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\TurmaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Sitemap XML (SEO)
|--------------------------------------------------------------------------
*/
Route::get('/sitemap.xml', function () {
    $path = public_path('sitemap.xml');
    if (!file_exists($path)) {
        \Illuminate\Support\Facades\Artisan::call('sitemap:generate');
    }
    return response()->file($path, ['Content-Type' => 'application/xml; charset=utf-8']);
});

/*
|--------------------------------------------------------------------------
| Media / Uploads Fallback (Locaweb Hospedagem I)
|--------------------------------------------------------------------------
*/
Route::get('/media/{path}', [MediaController::class, 'serve'])
    ->where('path', '.*')
    ->name('media.serve');

/*
|--------------------------------------------------------------------------
| Public Institutional Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/sobre', [AboutController::class, 'index'])->name('about');
Route::get('/cursos', [CourseController::class, 'index'])->name('courses.index');
Route::get('/cursos/{slug}', [CourseController::class, 'show'])->name('courses.show');
Route::get('/turmas', [TurmaController::class, 'index'])->name('turmas.index');
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/contato', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contato', [ContactController::class, 'store'])->name('contact.store');

/*
|--------------------------------------------------------------------------
| Admin Authentication
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    /*
    |----------------------------------------------------------------------
    | Admin Protected Area (CMS)
    |----------------------------------------------------------------------
    */
    Route::middleware('auth')->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Profile & Account
        Route::get('/profile', [AdminUserController::class, 'profile'])->name('profile');
        Route::put('/profile', [AdminUserController::class, 'updateProfile'])->name('profile.update');

        // CRUDs
        Route::resource('courses', AdminCourseController::class);
        Route::resource('turmas', AdminTurmaController::class);
        Route::resource('portfolio', AdminPortfolioController::class);
        Route::resource('posts', AdminPostController::class);
        Route::resource('team', AdminTeamController::class);
        Route::resource('users', AdminUserController::class);

        // Page Contents
        Route::get('/pages', [AdminPageContentController::class, 'index'])->name('pages.index');
        Route::post('/pages', [AdminPageContentController::class, 'update'])->name('pages.update');

        // Inbound Contact Messages
        Route::get('/messages', [AdminMessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/{message}', [AdminMessageController::class, 'show'])->name('messages.show');
        Route::delete('/messages/{message}', [AdminMessageController::class, 'destroy'])->name('messages.destroy');

        // General Site Settings
        Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [AdminSettingController::class, 'update'])->name('settings.update');
    });
});
