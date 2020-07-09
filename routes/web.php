<?php

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

Route::redirect('/', '/login', 301);
Route::get('/home', 'HomeController@index');
Route::get('/add_company', 'CompanyController@create');
Route::post('/save_company', 'CompanyController@save')->name('save_company');
Route::post('/delete_company', 'CompanyController@delete')->name('delete_company');
Route::get('/modify_company/{id}', 'CompanyController@modify');
Route::post('/edit_company', 'CompanyController@edit')->name('edit_company');
Route::get('/company_list', 'CompanyController@index')->name('company_list');

Route::get('/view_company_emplyees/{id}', 'EmployeeController@index')->name('view_company_emplyees');
Route::get('/add_employee/{id}', 'EmployeeController@create');
Route::get('/modify_employee/{id}', 'EmployeeController@modify');
Route::post('/edit_employee', 'EmployeeController@edit')->name('edit_employee');
Route::post('/save_employee', 'EmployeeController@save')->name('save_employee');
Route::post('/delete_employee', 'EmployeeController@delete')->name('delete_employee');
