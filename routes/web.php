<?php
/**
 * Created by PhpStorm.
 * User: alexey
 * Date: 20.07.18
 * Time: 21:47
 */

Route::middleware('web')
    ->namespace('ARudkovskiy\\Admin\\Http\\Controllers')
    ->group(function () {
        Route::get('admin/signin', 'DashboardController@signIn')
            ->name('admin.signin');
        Route::post('admin/signin', 'DashboardController@signInCheck');
    });

Route::middleware([
    'web',
    \ARudkovskiy\Admin\Http\Middleware\AdminMiddleware::class
])
    ->prefix('admin')
    ->namespace('ARudkovskiy\\Admin\\Http\\Controllers')
    ->name('admin.')
    ->group(function() {
        Route::get('/', 'SimpleController@indexAction')->name('dashboard');

        // CRUD stuff
        Route::prefix('entity')
            ->group(function () {
                Route::get('/', 'CrudController@index')->name('crud.index');
                Route::get('/create','CrudController@create')->name('crud.create');
                Route::get('/edit', 'CrudController@edit')->name('crud.edit');
                Route::post('/edit', 'CrudController@update')->name('crud.update');
                Route::post('/create', 'CrudController@save')->name('crud.save');

                Route::get('/delete', 'CrudController@delete')->name('crud.delete');
            });

        Route::prefix('media')
            ->group(function () {
                Route::get('/', 'MediaController@index')->name('media.index');
                Route::post('/', 'MediaController@upload')->name('media.upload');
            });

        Route::get('test', function () {
            return 'test';
        });

        Route::prefix('api')
            ->namespace('API')
            ->name('api.')
            ->group(function () {
                Route::get('/translation', 'TranslationController@translation')->name('translation');
                Route::post('search', 'SearchController@index')->name('search');
            });

    });
