<?php
 return array(
     //Товар:
     'product/([0-9]+)' => 'product/index/$1', //actionIndex ProductController
     'category/([0-9]+)/page-([0-9]+)' => 'product/Category/$1/$2', //actionCategory  ProductController
     'category/([0-9]+)' => 'product/Category/$1', //actionCategory  ProductController
     'search' => 'product/search', //actionSearch  ProductController
     //Пользователь:
     'user/register' => 'user/register', //actionRegister  UserController
     'user/login' => 'user/login', //actionLogin  UserController
     'user/logout' => 'user/logout', ////actionLogout  UserController
     'cabinet/edit' => 'cabinet/editName', //actionEdit CabinetController
     'cabinet' => 'cabinet/index', //actionIndex CabinetController
     //Корзина
     'cart/addProductAjax/([0-9]+)' => 'cart/addProductAjax/$1', //actionAddProductAjax CartController
     'cart/subtractAjax/([0-9]+)' => 'cart/subtractAjax/$1', //actionSubtractAjaxAjax CartController
     'cart/cartAjax/([0-9]+)' => 'cart/cartAjax/$1',
     'cart/checkout' => 'cart/checkout', //actionCheckOut CartController
     'cart' => 'cart/index', //actionIndex CartController
     //Управление товарами:
     'admin/product/create' => 'adminProduct/create',
     'admin/product/delete/([0-9]+)' => 'adminProduct/delete/$1',
     'admin/product/update/([0-9]+)' => 'adminProduct/update/$1',
     'admin/product' => 'adminProduct/index',
     //Управление категориями:
     'admin/category/create' => 'adminCategory/create',
     'admin/category/delete/([0-9]+)' => 'adminCategory/delete/$1',
     'admin/category/update/([0-9]+)' => 'adminCategory/update/$1',
     'admin/category' => 'adminCategory/index',
     //Управление заказами:
     'admin/order/update/([0-9]+)' => 'adminOrder/update/$1',
     'admin/order/delete/([0-9]+)' => 'adminOrder/delete/$1',
     'admin/order/([a-z_]+)/page-([0-9]+)' => 'adminOrder/index/$1/$2',
     'admin/order/([a-z_]+)' => 'adminOrder/index/$1',
     //Генератор заказов:
     'admin/generate' => 'adminGenerate/index',
     //Админпанель:
     'admin' => 'admin/index',  //actionIndex AdminController
     //Каталог
     'catalog' => 'site/index', //actionView  SiteController
     //Главная страница:
     '' => 'site/index', //actionView  SiteController
 );