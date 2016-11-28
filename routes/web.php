<?php

use JasperPHP\JasperPHP;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('{page}/{subs?}', ['uses' => 'PageController@index'])->where(['page' => '^((?!admin).)*$', 'subs' => '.*']);

Route::get('/reports', function () {
    $output = public_path() . '/report/'.time().'_hello_world';
    $report = new JasperPHP;
    $report->process(
    public_path() . '/report/hello_world.jrxml',
    $output,
    array('pdf', 'rtf', 'xml'),
    array(),
    array()
    )->execute();
});
