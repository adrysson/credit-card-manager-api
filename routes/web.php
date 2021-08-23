<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(
    ['prefix' => 'companies'],
    function () use ($router) {
        $router->get('/', 'CompanyController@index');
        $router->post('/', 'CompanyController@store');
        $router->get('/{id}', 'CompanyController@view');
        $router->put('/{id}', 'CompanyController@update');
        $router->delete('/{id}', 'CompanyController@destroy');
        // links
        $router->get('/{companyId}/cards', 'CompanyCardController@index');
    }
);

$router->group(
    ['prefix' => 'cards'],
    function () use ($router) {
        $router->get('/', 'CardController@index');
        $router->post('/', 'CardController@store');
        $router->get('/{id}', 'CardController@view');
        $router->put('/{id}', 'CardController@update');
        $router->delete('/{id}', 'CardController@destroy');
        // links
        // $router->get('/{cardId}/invoices', 'CardInvoiceController@index');
    }
);

$router->group(
    ['prefix' => 'invoices'],
    function () use ($router) {
        $router->get('/', 'InvoiceController@index');
        $router->post('/', 'InvoiceController@store');
        $router->get('/{id}', 'InvoiceController@view');
        $router->put('/{id}', 'InvoiceController@update');
        $router->delete('/{id}', 'InvoiceController@destroy');
    }
);


$router->group(
    ['prefix' => 'transactions'],
    function () use ($router) {
        $router->get('/', 'TransactionController@index');
        $router->post('/', 'TransactionController@store');
        $router->get('/{id}', 'TransactionController@view');
        $router->put('/{id}', 'TransactionController@update');
        $router->delete('/{id}', 'TransactionController@destroy');
    }
);
