<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FanTypeNameEnController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogQueryController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TopPageController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckRoute1;
use App\Http\Middleware\CheckRoute12;
use App\Http\Middleware\CheckRoute13;
use Illuminate\Support\Facades\Artisan;
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
Auth::routes();
Route::get('/', [LoginController::class, 'index'])->name('logincustom');
Auth::routes(['register' => false]);
Route::get('/mypage', [DashboardController::class, 'mypage'])->name('mypage');
Route::group(['middleware' => [CheckRoute12::class]], function () {
  Route::get('top-page/{type}', [TopPageController::class, 'top_page_type'])->name('top-page-type'); // Màn list banner
  Route::get('/top-page/{type}/edit/{id}', [TopPageController::class, 'top_page_type_edit_id_get'])->name('top-page-type-edit-id-get'); // Màn edit cho banner với id tương ứng
  Route::put('/top-page/{type}/edit/{id}', [TopPageController::class, 'top_page_type_edit_id_put'])->name('top-page-type-edit-id-put'); // Màn edit banner
  Route::get('/top-page/{type}/copy', [TopPageController::class, 'top_page_type_copy_get'])->name('top-page-type-copy-get'); // Màn copy banner
  Route::get('top-page/{type}/create', [TopPageController::class, 'top_page_type_create_get'])->name('top-page-type-create-get'); // Màn đăng ký banner
  Route::post('top-page/{type}/create', [TopPageController::class, 'top_page_type_create_post'])->name('top-page-type-create-post'); // Màn đăng ký banner
});
Route::group(['middleware' => [CheckRoute13::class]], function () {
  Route::get('content/copy', [MovieController::class, 'copy'])->name('content.copy');
  Route::resource('content', MovieController::class);
  Route::resource('tag', TagController::class); // Màn tạo & List
});
Route::post('content/uploadimage', [MovieController::class, 'uploadimage'])->name('content.uploadimage');
Route::group(['middleware' => [CheckRoute1::class]], function () {
  Route::resource("fan-type", FanTypeNameEnController::class);
  Route::post('unique-fantype', [FanTypeNameEnController::class, 'existsFantype'])->name('exists-fantype');
  Route::get('log', [LogQueryController::class, 'index'])->name('log.index');
  Route::resource("user", UserController::class);
});
//  \URL::forceScheme('https');
// Route::get("movies", [MovieController::class, 'index']);
\URL::forceScheme('http');
//t
