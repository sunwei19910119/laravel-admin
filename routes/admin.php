<?php

Route::group(['prefix' => 'admin','namespace' => 'Admin'], function() {
    
//    Route::group(['prefix' => '/auth', 'namespace' => "Auth", 'middleware' => ['csrf']], function () {
//        Route::get('login',                     'LoginController@showLoginForm')->name('login');
//        Route::post('login',                    'LoginController@login');
//        Route::get('logout',                    'LoginController@logout')->name('logout');
//        Route::post('logout',                   'LoginController@logout')->name('logout');
//    });

    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login')->name('admin.login.store');
    Route::get('logout', 'LoginController@logout')->name('admin.logout');

    Route::group(['middleware' => ['auth:admin', 'permission']], function () {
        Route::post('/menu/tree',               'MenuController@tree');
        Route::resource('/menu',                'MenuController');
        Route::get('/role/{id}/permission',     'RoleController@permissionEdit');
        Route::post('/role/{id}/permission',    'RoleController@permissionStore');
        Route::resource('/role',                'RoleController');
        Route::resource('/permission',          'PermissionController');

        Route::resource('/',                    'HomeController');
        Route::resource('/admin_user',          'AdminUserController');
    });
});