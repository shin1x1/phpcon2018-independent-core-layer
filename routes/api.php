<?php
/**
 * @var \Illuminate\Routing\Router $router
 */

use Acme\Point\Application\AddPoint\Actions\PutAddPointAction;
use Acme\Point\Application\AddPointDomain\Actions\PutAddPointAction as PutAddPointActionDomain;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$router->put('/customers/add_point', PutAddPointAction::class);
$router->put('/customers/add_point_domain', PutAddPointActionDomain::class);
