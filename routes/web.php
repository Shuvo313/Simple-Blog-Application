<?
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;

// Public Routes
Route::get('/', [FrontendController::class,'home']);
Route::get('/blog/{slug}', [FrontendController::class,'show']);
Route::get('/category/{slug}', [FrontendController::class,'category']);

// Auth Routes
Route::get('/login',[AuthController::class,'loginForm'])->name('login');
Route::post('/login',[AuthController::class,'login']);
Route::get('/register',[AuthController::class,'registerForm']);
Route::post('/register',[AuthController::class,'register']);
Route::post('/logout',[AuthController::class,'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth.session','admin'])->prefix('admin')->name('admin.')->group(function(){
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::resource('/categories', CategoryController::class);
    Route::resource('/posts', PostController::class);
});
