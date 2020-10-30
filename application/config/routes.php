<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'ShopController/home';
$route['404_override'] = 'AppController/pageNotFound';
$route['translate_uri_dashes'] = false;

//ongkir route
$route["ongkir/(:any)/(:num)/(:any)"] = "ShopController/ongkir/$1/$2/$3";

//store address
$route["admin/store-address"] = "ShopController/storeAddress";
$route["admin/store-address/update"] = "ShopController/storeAddressUpdate";

//account routines
$route['profile/(:any)'] = "ProfileController/profile/$1";
$route['profile/edit'] = "ProfileController/editProfile";
$route['profile/update'] = "ProfileController/updateProfile";
$route['address/create'] = "ProfileController/createAddress";
$route['address/(:any)/edit'] = "ProfileController/editAddress/$1";
$route['address/regency'] = "ProfileController/getCity";
$route['address/district'] = "ProfileController/getDistrict";
$route['address/village/(:any)'] = "ProfileController/getVillage/$1";
$route['address/addaddress'] = "ProfileController/addAddress";
$route['address/(:any)/update'] = "ProfileController/updateAddress/$1";
$route['address/(:any)/detail'] = "ProfileController/detailAddress/$1";
$route['bank/(:any)/detail'] = "ProfileController/detailBank/$1";

//shop
$route["home"] = 'ShopController/home';
$route["products"] = 'ShopController/products';
$route["products/(:any)/detail"] = 'ShopController/productDetail/$1';
$route["carts"] = 'ShopController/carts';
$route["addcart"] = 'ShopController/addCart';
$route["addqty"] = 'ShopController/addQty';
$route["checkcart"] = 'ShopController/checkCart';
$route["comment-list/(:any)"] = 'ShopController/commentList/$1';
$route["review-list/(:any)"] = 'ShopController/reviewList/$1';
$route["post-comment/(:any)/create"] = 'ShopController/postComment/$1';
$route["post-review/(:any)/create"] = 'ShopController/postReview/$1';
$route["post-reply-comment/(:any)/reply/(:any)"] = 'ShopController/postReplyComment/$1/$2';
$route["open-comment-box/(:any)"] = 'ShopController/commentBox/$1';
$route["checkout"] = 'ShopController/checkout';
$route["checkout/pay"] = 'ShopController/pay';
$route['shop-logout'] = 'ShopController/logout';


//bank routes
$route["admin/banks"] = "BankController";
$route["admin/banks-table"] = "BankController/bankTable";
$route["admin/banks/create"] = "BankController/create";
$route["admin/banks/add"] = "BankController/add";
$route["admin/banks/(:any)/edit"] = "BankController/edit/$1";
$route["admin/banks/(:any)/update"] = "BankController/update/$1";
$route["admin/banks/(:any)/delete"] = "BankController/delete/$1";
$route['admin/banks/(:any)/removeUpload'] = 'BankController/removeUpload/$1';

//admin routes
$route['admin'] = 'AppController';

//shop categories
$route['admin/shop-categories'] = 'StoreController/categories';
$route['admin/set-shop-categories/(:any)'] = 'StoreController/setCategories/$1';
$route['admin/update-shop-categories/(:any)'] = 'StoreController/updateCategories/$1';

//banners routes
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

//subcategories routes
$route['admin/categories/(:any)/subcategories'] = 'SubcategoriesController/subcategories/$1';
$route['admin/categories/(:any)/subcategories/create'] = 'SubcategoriesController/create/$1';
$route['admin/categories/(:any)/subcategories/add'] = 'SubcategoriesController/add/$1';
$route['admin/categories/(:any)/subcategories/list'] = 'SubcategoriesController/listSubcategories/$1';
$route['admin/subcategories/(:any)/edit'] = 'SubcategoriesController/edit/$1';
$route['admin/subcategories/(:any)/update'] = 'SubcategoriesController/update/$1';
$route['admin/subcategories/(:any)/removeUpload'] = 'SubcategoriesController/removeUpload/$1';

//brands routes
$route['admin/brands'] = 'BrandController';
$route['admin/brands-table'] = 'BrandController/brandsTable';
$route['admin/brands/create'] = 'BrandController/create';
$route['admin/brands/add'] = 'BrandController/add';
$route['admin/brands/(:any)/delete'] = 'BrandController/delete/$1';
$route['admin/brands/(:any)/edit'] = 'BrandController/edit/$1';
$route['admin/brands/(:any)/update'] = 'BrandController/update/$1';
$route['admin/brands/(:any)/removeUpload'] = 'BrandController/removeUpload/$1';

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
$route['admin/products/fav'] = 'ProductsController/productFav';
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