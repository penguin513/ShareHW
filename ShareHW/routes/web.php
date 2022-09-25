<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\HouseworksController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\MypagesController;
use Illuminate\Support\Facades\varified;

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



Route::get('/', function() {
    return view('auth.login');
});


Route::middleware(['auth', 'verified'])->prefix('houseworks')->group(function () {
    Route::get('/', [HouseworksController::class, 'housework'])->name('houseworks');
    Route::get('/detail/{id}', [HouseworksController::class, 'housework_detail'])->name('housework.detail');
    Route::get('/edit/{id}', [HouseworksController::class, 'housework_edit'])->name('housework.edit');
    Route::get('/new', [HouseworksController::class, 'housework_new'])->name('housework.new');

    Route::patch('/update', [HouseworksController::class, 'housework_update'])->name('housework.update');
    Route::post('/create', [HouseworksController::class, 'housework_create'])->name('housework.create');
    Route::delete('/remove/{id}', [HouseworksController::class, 'housework_remove'])->name('housework.remove');
    Route::post('/check', [HouseworksController::class, 'check'])->name('housework.check');
    Route::post('/clone', [HouseworksController::class, 'clone'])->name('housework.clone');


    Route::get('/schedule', [SchedulesController::class, 'schedule'])->name('schedules');
    Route::get('/schedule/detail/{id}', [SchedulesController::class, 'schedule_detail'])->name('schedule.detail');
    Route::get('/schedule/edit/{id}', [SchedulesController::class, 'schedule_edit'])->name('schedule.edit');
    Route::get('/schedule/new', [SchedulesController::class, 'schedule_new'])->name('schedule.new');

    Route::patch('/schedule/update', [SchedulesController::class, 'schedule_update'])->name('schedule.update');
    Route::post('/schedule/create', [SchedulesController::class, 'schedule_create'])->name('schedule.create');
    Route::delete('/schedule/remove/{id}', [SchedulesController::class, 'schedule_remove'])->name('schedule.remove');
});


Route::middleware(['auth', 'verified'])->prefix('items')->group(function () {
    Route::get('/', [ItemsController::class, 'item'])->name('items');
    Route::get('/detail/{id}', [ItemsController::class, 'item_detail'])->name('item.detail');
    Route::get('/edit/{id}', [ItemsController::class, 'item_edit'])->name('item.edit');
    Route::get('/new', [ItemsController::class, 'item_new'])->name('item.new');

    Route::patch('/update', [ItemsController::class, 'item_update'])->name('item.update');
    Route::post('/create', [ItemsController::class, 'item_create'])->name('item.create');
    Route::delete('/remove/{id}', [ItemsController::class, 'item_remove'])->name('item.remove');

});


Route::middleware(['auth', 'verified'])->prefix('chat')->group(function () {
    Route::get('/', [ChatsController::class, 'index'])->name('chat');
    Route::get('/edit/{id}', [ChatsController::class, 'chat_edit'])->name('chat.edit');

    Route::post('/add', [ChatsController::class, 'add'])->name('add');

    Route::patch('/update', [ChatsController::class, 'chat_update'])->name('chat.update');
    Route::delete('/remove/{id}', [ChatsController::class, 'chat_remove'])->name('chat.remove');

});

Route::get('/result/ajax', [ChatsController::class, 'getData']);


Route::middleware(['auth', 'verified'])->prefix('mypage')->group(function () {
    Route::get('/', [MypagesController::class, 'mypage'])->name('mypages');
    Route::get('/edit/{id}', [MypagesController::class, 'mypage_edit'])->name('mypage.edit');
    Route::get('/password/change', [ChangePasswordController::class, 'password_change'])->name('password.change');

    Route::post('/', [MypagesController::class, 'withdrawal'])->name('mypage.withdrawal');

    Route::patch('/update', [MypagesController::class, 'mypage_update'])->name('mypage.update');

    Route::put('/password/change', [ChangePasswordController::class, 'password_update'])->name('password.update');
});


Route::middleware(['auth', 'verified'])->prefix('contact')->group(function () {
    Route::get('/', [ContactsController::class, 'contact'])->name('contact');
    Route::get('/confirm', [ContactsController::class, 'confirm_ill'])->name('confirm_ill');
    Route::get('/thanks', [ContactsController::class, 'thanks'])->name('thanks');

    Route::post('/', [ContactsController::class, 'contact_send'])->name('contact_send');
    Route::post('/confirm', [ContactsController::class, 'confirm'])->name('confirm');

});

Route::get('/contact/privacy', [ContactsController::class, 'privacy'])->name('privacy');


// 管理者のみアクセス可
Route::middleware(['password.confirm', 'verified', 'can:admin-only'])->prefix('users')->group(function () {
    Route::get('/', [UsersController::class, 'users'])->name('users');
    Route::get('/detail/{id}', [UsersController::class, 'user_detail'])->name('user.detail');
    Route::get('/edit/{id}', [UsersController::class, 'user_edit'])->name('user.edit');

    Route::patch('/update', [UsersController::class, 'user_update'])->name('user.update');
    Route::delete('/remove/{id}', [UsersController::class, 'user_remove'])->name('user.remove');
});



require __DIR__.'/auth.php';
