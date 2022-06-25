<?php

namespace Config;


// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('AuthController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.



// AUTH
$routes->group('', function ($routes) {
    $routes->get('/', 'AuthController::index', ["as" => "login"]);
    $routes->get('/logout', 'AuthController::logout', ["as" => "logout", "filter" => "auth"]);
    $routes->post('/auth/login', 'AuthController::login', ["as" => "authenticate"]);
});



//DASHBOARD
$routes->group('', ['filter' => 'auth'], function ($routes) {

    // DASHBOARD
    $routes->get('dashboard', 'DashboardController::show', ["as" => "dashboard.show"]);


    // LOG ACTIVITY
    $routes->get('/log-activity', 'LogActivityController::show', ["as" => "log.show", 'filter' => 'isOwner']);


    // UNIT
    $routes->group('unit', function ($routes) {
        $routes->get('/', 'UnitController::show', ["as" => "unit.show"]);
        $routes->post('store', 'UnitController::store', ["as" => "unit.store"]);
        $routes->post('update', 'UnitController::update', ["as" => "unit.update"]);
    });


    // CUSTOMER
    $routes->group('customer', function ($routes) {
        $routes->get('/', 'CustomerController::show', ["as" => "customer.show"]);
        $routes->post('store', 'CustomerController::store', ["as" => "customer.store"]);
        $routes->post('update', 'CustomerController::update', ["as" => "customer.update"]);
        $routes->post('delete', 'CustomerController::destroy', ["as" => "customer.destroy"]);
    });


    // USER MANAGEMENT
    $routes->group('/user-management', ['filter' => 'isOwner'], function ($routes) {
        $routes->get('/', 'UserManagementController::show', ["as" => "usermanagement.show"]);
        $routes->post('store', 'UserManagementController::store', ["as" => "usermanagement.store"]);
        $routes->post('destroy', 'UserManagementController::destroy', ["as" => "usermanagement.destroy"]);
        $routes->post('update', 'UserManagementController::update', ["as" => "usermanagement.update"]);
    });


    // ROLL TRANSACTION
    $routes->group('roll-transaction', function ($routes) {
        $routes->get('/', 'RollTransactionController::show', ["as" => "rolltransaction.show"]);
        $routes->get('restock', 'RollTransactionController::edit', ["as" => "rolltransaction.edit"]);
        $routes->post('store', 'RollTransactionController::store', ["as" => "rolltransaction.store"]);
    });


    // ROLL
    $routes->group('roll', function ($routes) {
        $routes->get('barcode/print/(:any)/(:any)/(:any)/(:num)', 'RollController::printBarcode/$1/$2/$3/$4', ["as" => "roll.printbarcode"]);
        $routes->get('search', 'RollController::search', ["as" => "roll.search"]);
        $routes->get('/', 'RollController::show', ["as" => "roll.show"]);
        $routes->post('store', 'RollController::store', ["as" => "roll.store"]);
        $routes->get('report', 'RollController::report', ["as" => "roll.report"]);
        $routes->post('update', 'RollController::update', ["as" => "roll.update"]);
        $routes->post('destroy', 'RollController::destroy', ["as" => "roll.destroy"]);
        $routes->get('downloadBarcode/(:any)/(:any)/(:any)/(:num)', 'RollController::downloadBarcode/$1/$2/$3/$4', ["as" => "roll.downloadBarcode"]);
    });


    // INVOICE
    $routes->group('invoice', function ($routes) {
        $routes->get('/', 'InvoiceController::show', ["as" => "invoice.show"]);
        $routes->get('edit/(:any)', 'InvoiceController::edit/$1', ["as" => "invoice.refund"]);
        $routes->get('print/(:any)', 'InvoiceController::printInvoice/$1', ["as" => "invoice.print"]);
        $routes->get('report', 'InvoiceController::report', ["as" => "invoice.report", 'filter' => 'isOwner']);

        $routes->post('printReport', 'InvoiceController::printReport', ["as" => "invoice.printreport", 'filter' => 'isOwner']);
        $routes->post('updatePayment', 'InvoiceController::updatePaymentStatus', ["as" => "invoice.updatePayment"]);
    });

    // SHOPPING
    $routes->get('/shopping', 'ShoppingController::show', ["as" => "shopping.show"]);
});

$routes->get('error_401', function () {
    return view('errors/html/error_401');
}, ["as" => "error_401"]);

// REST API
$routes->group('api', function ($routes) {
    $routes->post('shopping/store', 'RESTAPI\ShoppingApi::store');
    $routes->post('refund/update', 'RESTAPI\RefundApi::update');

    $routes->get('rolls', 'RESTAPI\RollAPI::index');
    $routes->get('rolls/(:any)', 'RESTAPI\RollAPI::show/$1');

    $routes->get('invoice', 'RESTAPI\InvoiceAPI::getAllInvoice');
    $routes->post('invoice/report', 'RESTAPI\InvoiceAPI::report');
    $routes->get('invoice/(:num)', 'RESTAPI\InvoiceAPI::invoiceById/$1');
    $routes->get('invoice/last', 'RESTAPI\InvoiceAPI::lastInvoice');
    $routes->get('invoice/yearly', 'RESTAPI\InvoiceAPI::getInvoiceYearly');
    $routes->get('invoice/monthly', 'RESTAPI\InvoiceAPI::getInvoiceMonthly');

    $routes->get('roll-transactions/(:any)', 'RESTAPI\RollTransactionAPI::show/$1');
    $routes->get('roll-transactions', 'RESTAPI\RollTransactionAPI::index');

    // $routes->get('profit/(:alpha)/(:num)', 'RESTAPI\ProfitApi::show/$1/$2');
});













/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
