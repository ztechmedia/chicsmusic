<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'AppController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = false;

//auth routes
$route['logout'] = 'AuthController/logout';

//users routes
$route['users'] = 'UsersController/users';
$route['users-table'] = 'UsersController/usersTable';
$route['users/create'] = 'UsersController/create';
$route['users/add'] = 'UsersController/add';
$route['users/(:any)/delete'] = 'UsersController/delete/$1';
$route['users/(:any)/edit'] = 'UsersController/edit/$1';
$route['users/(:any)/update'] = 'UsersController/update/$1';

//categories routes
$route['categories'] = 'CategoriesController/categories';
$route['categories-table'] = 'CategoriesController/categoriesTable';
$route['categories/create'] = 'CategoriesController/create';
$route['categories/add'] = 'CategoriesController/add';
$route['categories/(:any)/delete'] = 'CategoriesController/delete/$1';
$route['categories/(:any)/edit'] = 'CategoriesController/edit/$1';
$route['categories/(:any)/update'] = 'CategoriesController/update/$1';

//subcategories
$route['categories/(:any)/subcategories'] = 'SubcategoriesController/subcategories/$1';
$route['categories/(:any)/subcategories/create'] = 'SubcategoriesController/create/$1';
$route['categories/(:any)/subcategories/add'] = 'SubcategoriesController/add/$1';
$route['categories/(:any)/subcategories/list'] = 'SubcategoriesController/listSubcategories/$1';

//products routes
$route['products'] = 'ProductsController/products';
$route['products-table'] = 'ProductsController/productsTable';
$route['products/create'] = 'ProductsController/create';
$route['products/(:any)/add'] = 'ProductsController/add/$1';
$route['products/(:any)/delete'] = 'ProductsController/delete/$1';
$route['products/(:any)/edit'] = 'ProductsController/edit/$1';
$route['products/(:any)/update'] = 'ProductsController/update/$1';
$route['products/(:any)/uploads'] = 'ProductsController/uploads/$1';

//roles routes 
$route['roles'] = 'RolesController/roles';
$route['roles-table'] = 'RolesController/rolesTable';
$route['roles/(:any)/edit'] = 'RolesController/edit/$1';
$route['roles/(:any)/update'] = 'RolesController/update/$1';

//home routes
$route['dashboard'] = "HomeController/dashboard";

//products
$route['products'] = "ProductsController/products";
