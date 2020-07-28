<?php

use Illuminate\Support\Facades\Route;
use App\TheLoai;
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
Route::get('/', 'HomeController@index');

Route::get('lien-he','HomeController@Contact');

Route::get('loai-tin/{unsigned_name}','HomeController@LoaiTin');

Route::get('tin-tuc/{unsigned_name}.html','HomeController@TinTuc');

Route::get('dang-nhap','HomeController@Login');

Route::post('dang-nhap','HomeController@LoginAuth');

Route::get('dang-xuat','HomeController@Logout');

Route::post('binh-luan/{article_id}','CommentController@Them');

Route::get('quan-ly-thong-tin','HomeController@UserConf');

Route::post('quan-ly-thong-tin','HomeController@ExUserConf');

Route::get('dang-ky-tai-khoan','HomeController@Register');

Route::post('dang-ky-tai-khoan','HomeController@DoRegister');

Route::get('tim-kiem','HomeController@Search');


//Route::get('/admin','AdminController@index');
//Route::get('/dashboard','AdminController@show_dashboard');
//Route::get('/logout','AdminController@logout');
//Route::post('/admin-dashboard','AdminController@dashboard');

Route::get('/admin/dangnhap','UserController@getDangnhapAdmin');
Route::get('/admin','UserController@getDangnhapAdmin');
Route::post('/admin/dangnhap','UserController@postDangnhapAdmin');
Route::get('/admin/logout','UserController@logout');

Route::group(['prefix' => 'admin','middleware' => 'adminAuth'],  function () {
    /////////////////
    // Group The Loai
    /////////////////
    Route::group(['prefix' => 'theloai'], function () {
        Route::get('danhsach', 'TheLoaiController@getDanhSach');

        Route::get('sua/{id}', 'TheLoaiController@getSua');
        Route::post('sua/{id}', 'TheLoaiController@postSua');

        Route::get('them', 'TheLoaiController@getThem');
        Route::post('them', 'TheLoaiController@postThem');

        Route::get('xoa/{id}', 'TheLoaiController@getXoa');
        Route::post('xoa/{id}', 'TheLoaiController@postXoa');
    });
    /////////////////
    // Group Loai tin
    /////////////////
    Route::group(['prefix' => 'loaitin'], function () {
        Route::get('danhsach', 'LoaiTinController@getDanhSach');

        Route::get('sua/{id}', 'LoaiTinController@getSua');
        Route::post('sua/{id}', 'LoaiTinController@postSua');

        Route::get('them', 'LoaiTinController@getThem');
        Route::post('them', 'LoaiTinController@postThem');

        Route::get('xoa/{id}', 'LoaiTinController@getXoa');
    });

    /////////////////
    // Group Tintuc
    /////////////////
    Route::group(['prefix' => 'tintuc'], function () {
        Route::get('danhsach', 'TinTucController@getDanhSach');

        Route::get('sua/{id}', 'TinTucController@getSua');
        Route::post('sua/{id}', 'TinTucController@postSua');

        Route::get('them', 'TinTucController@getThem');
        Route::post('them', 'TinTucController@postThem');

        Route::get('xoa/{id}', 'TinTucController@getXoa');
    });

    /////////////////
    // Group User
    /////////////////
    Route::group(['prefix' => 'user'], function () {
        Route::get('danhsach', 'UserController@getDanhSach');

        Route::get('sua/{id}', 'UserController@getSua');
        Route::post('sua/{id}', 'UserController@postSua');

        Route::get('them', 'UserController@getThem');
        Route::post('them', 'UserController@postThem');

        Route::get('xoa/{id}', 'UserController@getXoa');
    });
    Route::group(['prefix' => 'ajax'], function () {
        Route::get('loaitin/{idTheLoai}', 'AjaxController@getLoaiTin');
    });

    Route::group(['prefix' => 'slide'],function(){
        Route::get('danhsach','SlideController@getDanhSach');

        Route::get('them','SlideController@getThem');

        Route::post('them','SlideController@postThem');

        Route::get('sua/{id}','SlideController@getSua');

        Route::post('sua/{id}','SlideController@postSua');

        Route::get('xoa/{id}','SlideController@getXoa');
    });

    Route::group(['prefix' => 'comment'],function(){
        Route::get('danhsach','CommentController@getDanhSach');

        Route::get('xoa/{id}','CommentController@Xoa');
    });
});





