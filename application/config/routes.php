<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'ShopController/home';
$route['404_override'] = 'AppController/pageNotFound';
$route['translate_uri_dashes'] = false;

//shop
$route["home"] = 'ShopController/home';

//admin routes
$route['admin'] = 'AppController';

//banners
$route["admin/banners"] = "StoreController/banner";
$route["admin/banners-product-list"] = "StoreController/productBanner";
$route["admin/set-banners/(:any)"] = "StoreController/setBanner/$1";
$route["admin/add-banners/(:any)"] = "StoreController/addBanner/$1";
$route["admin/edit-banners/(:any)"] = "StoreController/editBanner/$1";
$route["admin/update-banners/(:any)"] = "StoreController/updateBanner/$1";
$route["admin/delete-banners/(:any)"] = "StoreController/deleteBanner/$1";

//auth routes
$route['login'] = 'AuthController/login';
$route['register'] = 'AuthController/register';
$route['forgot-password'] = 'AuthController/forgotPassword';
$route['auth/login'] = 'AuthController/authLogin';
$route['auth/register'] = 'AuthController/authRegister';
$route['auth/send-link-forgot'] = 'AuthController/sendLinkForgot';
$route['reset-password/(:any)'] = 'AuthController/resetPassword/$1';
$route['auth/reset/(:any)'] = 'AuthController/reset/$1';
$route['logout'] = 'AppController/logout';

//users routes
$route['admin/users'] = 'UsersController/users';
$route['admin/users-table'] = 'UsersController/usersTable';
$route['admin/users/create'] = 'UsersController/create';
$route['admin/users/add'] = 'UsersController/add';
$route['admin/users/(:any)/delete'] = 'UsersController/delete/$1';
$route['admin/users/(:any)/edit'] = 'UsersController/edit/$1';
$route['admin/users/(:any)/update'] = 'UsersController/update/$1';

//categories routes
$route['admin/categories'] = 'CategoriesController/categories';
$route['admin/categories-table'] = 'CategoriesController/categoriesTable';
$route['admin/categories/create'] = 'CategoriesController/create';
$route['admin/categories/add'] = 'CategoriesController/add';
$route['admin/categories/(:any)/delete'] = 'CategoriesController/delete/$1';
$route['admin/categories/(:any)/edit'] = 'CategoriesController/edit/$1';
$route['admin/categories/(:any)/update'] = 'CategoriesController/update/$1';
$route['admin/categories/(:any)/removeUpload'] = 'CategoriesController/removeUpload/$1';

//subcategories
$route['admin/categories/(:any)/subcategories'] = 'SubcategoriesController/subcategories/$1';
$route['admin/categories/(:any)/subcategories/create'] = 'SubcategoriesController/create/$1';
$route['admin/categories/(:any)/subcategories/add'] = 'SubcategoriesController/add/$1';
$route['admin/categories/(:any)/subcategories/list'] = 'SubcategoriesController/listSubcategories/$1';
$route['admin/subcategories/(:any)/edit'] = 'SubcategoriesController/edit/$1';
$route['admin/subcategories/(:any)/update'] = 'SubcategoriesController/update/$1';
$route['admin/subcategories/(:any)/removeUpload'] = 'SubcategoriesController/removeUpload/$1';

//products routes
$route['admin/products'] = 'ProductsController/products';
$route['admin/products-table'] = 'ProductsController/productsTable';
$route['admin/products/create'] = 'ProductsController/create';
$route['admin/products/(:any)/add'] = 'ProductsController/add/$1';
$route['admin/products/(:any)/delete'] = 'ProductsController/delete/$1';
$route['admin/products/(:any)/edit'] = 'ProductsController/edit/$1';
$route['admin/products/(:any)/update'] = 'ProductsController/update/$1';
$route['admin/products/(:any)/uploads'] = 'ProductsController/uploads/$1';
$route['admin/products/(:any)/removeUpload'] = 'ProductsController/removeUpload/$1';
$route['admin/products/(:any)/delete-covers'] = 'ProductsController/deleteCovers/$1';
$route['admin/products/(:any)/stock'] = 'ProductsController/stock/$1';
$route['admin/products/(:any)/stock-update'] = 'ProductsController/updateStock/$1';
//products grids
$route['admin/products-grid'] = 'ProductsController/productsGrid';
$route['admin/products-grid-list'] = 'ProductsController/productsGridList';

//roles routes 
$route['admin/roles'] = 'RolesController/roles';
$route['admin/roles-table'] = 'RolesController/rolesTable';
$route['admin/roles/(:any)/edit'] = 'RolesController/edit/$1';
$route['admin/roles/(:any)/update'] = 'RolesController/update/$1';

//home routes
$route['admin/dashboard'] = "HomeController/dashboard";