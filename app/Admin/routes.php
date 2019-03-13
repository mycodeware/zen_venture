<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    $router->resource('users', UserController::class);

    $router->resource('investors', InvestorController::class);
    $router->get('/investors/identity/{filename}', 'InvestorController@identity')->name('investors.identity');
    $router->patch('/investors/setIdentified/{id}', 'InvestorController@setIdentified');
    $router->patch('/investors/changeStarred/{id}', 'InvestorController@changeStarred');
    $router->patch('/investors/changeTrusted/{id}', 'InvestorController@changeTrusted');
    $router->resource('companies', CompanyController::class);
    $router->get('/companies/identity/{filename}', 'CompanyController@identity')->name('companies.identity');
    $router->patch('/companies/setIdentified/{id}', 'CompanyController@setIdentified');
    $router->patch('/companies/changeStarred/{id}', 'CompanyController@changeStarred');
    $router->patch('/companies/changeTrusted/{id}', 'CompanyController@changeTrusted');
    $router->resource('startups', EntrepreneurController::class);
    $router->get('/startups/identity/{filename}', 'EntrepreneurController@identity')->name('startups.identity');
    $router->patch('/startups/setIdentified/{id}', 'EntrepreneurController@setIdentified');
    $router->patch('/startups/changeStarred/{id}', 'EntrepreneurController@changeStarred');
    $router->resource('professionals', FreelancerController::class);
    $router->get('/professionals/identity/{filename}', 'FreelancerController@identity')->name('professionals.identity');
    $router->patch('/professionals/setIdentified/{id}', 'FreelancerController@setIdentified');
    $router->patch('/professionals/changeStarred/{id}', 'FreelancerController@changeStarred');

    $router->resource('posts', PostController::class);

});
