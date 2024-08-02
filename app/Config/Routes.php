<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('AdminDashboard', 'Home::AdminDashboard');
$routes->post('dologin','Home::dologin');
$routes->get('login', 'Home::login');


$routes->get('coustmordashboard', 'Home::coustmordashboard');
$routes->get('profile', 'Home::profile');
$routes->post('Updateprofile','Home::Updateprofile');
$routes->get('order', 'Home::order');
$routes->get('add_to_card/(:any)', 'Home::add_to_card/$1');
$routes->get('add_to_cardfors/(:any)', 'Home::add_to_cardfors/$1');

$routes->get('addorder', 'Home::addorder');

$routes->get('AdminDashboard', 'Home::AdminDashboard');
$routes->get('Watersupplypoints', 'Home::addproduct');
$routes->get('waterreffilpoint', 'Home::waterreffilpoint');
$routes->post('getSocietiesByZone','Home::getSocietiesByZone');
$routes->post('getBuildingsBySociety','Home::getBuildingsBySociety');
$routes->post('add_product','Home::add_product');
$routes->get('productlist', 'Home::produact_list');
$routes->post('addproduct/(:any)', 'Home::addproduct/$1');
$routes->get('addproduct/(:any)', 'Home::addproduct/$1');
$routes->post('deleteproduct','Home::deleteproduct');
$routes->get('logout', 'Home::logout');
$routes->get('addCoustmer', 'Home::addCoustmer');
$routes->get('addCoustmers', 'Home::addCoustmers');
$routes->post('addCoustmersbyadmin','Home::addCoustmersbyadmin');
$routes->get('Receivedorder', 'Home::Receivedorder');
$routes->get('orderpayment', 'Home::orderpayment');
$routes->get('allotdelivery', 'Home::allotdelivery');
$routes->post('allotpartnerstocustomer', 'Home::allotpartnerstocustomer');

$routes->get('produactlist', 'Home::produact_list');
$routes->post('updatepaymentstatus', 'Home::updatepaymentstatus');
$routes->post('deliverypaymentcollect', 'Home::deliverypaymentcollect');
$routes->get('userlist', 'Home::userlist');
$routes->get('deliveredorder', 'Home::deliveredorder');
$routes->get('Customerlist', 'Home::Customerlist');
$routes->get('product', 'Home::productpage');

$routes->get('coustmerlisting', 'Home::coustmerlisting');
$routes->get('Staffdelivery', 'Home::Staffdelivery');
$routes->get('Orderlist', 'Home::Orderlist');
$routes->get('yourorder', 'Home::yourorder');
$routes->post('updateorderstatus','Home::updateorderstatus');
$routes->post('deletuser','Home::deletuser');
$routes->get('Purchasebill', 'Home::Purchasebill');
$routes->get('fuelbill', 'Home::fuelbill');
$routes->post('fuelbilling','Home::fuelbilling');
$routes->get('WaterPurchasereport', 'Home::WaterPurchasereport');
$routes->get('FuelBillreport', 'Home::FuelBillreport');

$routes->get('adduser', 'Home::adduser');
$routes->get('adduser/(:any)', 'Home::adduser/$1');

$routes->post('Purchasebilling','Home::Purchasebilling');
 
$routes->post('addstaff','Home::addstaff');
$routes->post('allotpartners','Home::allotpartners');
$routes->post('ordertanker','Home::ordertanker');

$routes->get('addmenu', 'Home::addmenu');
$routes->post('set_menu','Home::setmenu');
$routes->post('orderbook','Home::orderbook');
$routes->post('add_to_card/orderbook','Home::orderbook');

$routes->get('ordehistory', 'Home::ordehistory');
$routes->get('Subscriptions', 'Home::Subscriptions');
$routes->post('Subscriptionsbook','Home::Subscriptionsbook');
$routes->post('add_to_cardfors/Subscriptionsbook','Home::Subscriptionsbook');
$routes->post('addwatersupplypoint','Home::addwatersupplypoint');
$routes->post('addwaterreffilpoint','Home::addwaterreffilpoint');

$routes->post('Home/paymentsucess','Home::paymentsucess');
$routes->get('addtankers', 'Home::addtankers');
$routes->post('add_tankersbyadmin','Home::add_tankersbyadmin');
