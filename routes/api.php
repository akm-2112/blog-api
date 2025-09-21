<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use function Pest\Laravel\post;

//PUBLIC ROUTES
//Users
Route::post('/register',[AuthController::class,'register'])->name('register');
Route::post('/login',[AuthController::class,'login'])->name('login');
//Posts
Route::get('/posts', [PostController::class, 'index'])->name('post.index');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('post.show');
//Categories
Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/categories/{category}/posts', [CategoryController::class, 'posts'])->name('category.posts');
//Tags
Route::get('/tags', [TagController::class, 'index'])->name('tag.index');
Route::get('/tags/{tag}', [TagController::class, 'show'])->name('tag.show');
Route::get('/tags/{tag}/posts', [TagController::class, 'posts'])->name('tag.posts');


//Protected Routes
Route::middleware('auth:sanctum')->group(function(){

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [AuthController::class,'logout'])->name('logout');

    //Posts
    Route::post('/posts',[PostController::class,'store'])->name('post.store');
    Route::put('/posts/{post}',[PostController::class,'update'])->name('post.update');
    Route::delete('/posts/{post}',[PostController::class,'destroy'])->name('post.destroy');
    Route::get('/my-posts',[PostController::class,'myPosts'])->name('post.myPost');
    //Categories
    Route::post('/categories',[CategoryController::class,'create'])->name('category.store');
    Route::put('/categories/{category}',[CategoryController::class,'update'])->name('category.update');
    Route::delete('/categories/{category}',[CategoryController::class,'destroy'])->name('category.destroy');
    //Tags
    Route::post('/tags',[TagController::class,'create'])->name('tag.store');
    Route::put('/tags/{tag}',[TagController::class,'update'])->name('tag.update');
    Route::delete('/tags/{tag}',[TagController::class,'destroy'])->name('tag.destroy');
});

