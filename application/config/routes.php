<?php

return [
	//MainController
	'' => [
		'controller' => 'main',
		'action' => 'index',
	],
	'blog' => [
		'controller' => 'main',
		'action' => 'blog',
	],
	'actions' => [
		'controller' => 'main',
		'action' => 'actions',
	],
	//OtherController
	'other/other' => [
		'controller' => 'other',
		'action' => 'other',
	],
	//MerchantController
	'merchant/perfectmoney' => [
		'controller' => 'merchant',
		'action' => 'perfectmoney',
	],
	//DashboardController
	'dashboard/perfectmoney' => [
		'controller' => 'dashboard',
		'action' => 'perfectmoney',
	],
	'dashboard/visitadd' => [
		'controller' => 'dashboard',
		'action' => 'visitadd',
	],
	'dashboard/services' => [
		'controller' => 'dashboard',
		'action' => 'services',
	],
	'dashboard/services/{page:\d+}' => [
		'controller' => 'dashboard',
		'action' => 'services',
	],
	'dashboard/visit/{id:\d+}' => [
		'controller' => 'dashboard',
		'action' => 'visit',
	],
	'dashboard/use/{id:\w+}' => [
		'controller' => 'dashboard',
		'action' => 'use',
	],
	'dashboard/history' => [
		'controller' => 'dashboard',
		'action' => 'history',
	],
	'dashboard/history/{page:\d+}' => [
		'controller' => 'dashboard',
		'action' => 'history',
	],
	'dashboard/referrals' => [
		'controller' => 'dashboard',
		'action' => 'referrals',
	],
	'dashboard/referrals/{page:\d+}' => [
		'controller' => 'dashboard',
		'action' => 'referrals',
	],
	// AccountController
	'account/login' => [
		'controller' => 'account',
		'action' => 'login',
	],
	'account/agreement' => [
		'controller' => 'account',
		'action' => 'agreement',
	],
	'account/confidential' => [
		'controller' => 'account',
		'action' => 'confidential',
	],
	'account/register' => [
		'controller' => 'account',
		'action' => 'register',
	],
		'account/register/{ref:\w+}' => [
		'controller' => 'account',
		'action' => 'register',
	],
	'account/moment' => [
		'controller' => 'account',
		'action' => 'moment',
	],
		'account/moment/{ref:\w+}' => [
		'controller' => 'account',
		'action' => 'moment',
	],
	'account/recovery' => [
		'controller' => 'account',
		'action' => 'recovery',
	],
	'account/confirm/{token:\w+}' => [  //??????
		'controller' => 'account',
		'action' => 'confirm',
	],
		'account/reset/{token:\w+}' => [  //??????
		'controller' => 'account',
		'action' => 'reset',
	],
		'account/profile' => [
		'controller' => 'account',
		'action' => 'profile',
	],
		'account/logout' => [
		'controller' => 'account',
		'action' => 'logout',
	],
	'account/download' => [
		'controller' => 'account',
		'action' => 'download',
	],
	// AdminController
	'admin/withdraw' => [
		'controller' => 'admin',
		'action' => 'withdraw',
	],
	'admin/calendar/{date:\w+}' => [
		'controller' => 'admin',
		'action' => 'calendar',
	],
	'admin/history' => [
		'controller' => 'admin',
		'action' => 'history',
	],
	'admin/history/{page:\d+}' => [
		'controller' => 'admin',
		'action' => 'history',
	],
	'admin/tariffs' => [
		'controller' => 'admin',
		'action' => 'tariffs',
	],
	'admin/tariffs/{page:\d+}' => [
		'controller' => 'admin',
		'action' => 'tariffs',
	],
	'admin/clients' => [
		'controller' => 'admin',
		'action' => 'clients',
	],
	'admin/clients/{page:\d+}' => [
		'controller' => 'admin',
		'action' => 'clients',
	],
	'admin/price' => [
		'controller' => 'admin',
		'action' => 'price',
	],
	'admin/price/{page:\d+}' => [
		'controller' => 'admin',
		'action' => 'price',
	],
	'admin/login' => [
		'controller' => 'admin',
		'action' => 'login',
	],
	'admin/logout' => [
		'controller' => 'admin',
		'action' => 'logout',
	],

	'admin/addclient' => [
		'controller' => 'admin',
		'action' => 'addclient',
	],
		'admin/addclient/{ref:\w+}' => [
		'controller' => 'admin',
		'action' => 'addclient',
	],

	'admin/addservice' => [
		'controller' => 'admin',
		'action' => 'addservice',
	],
	'admin/addservice/{ref:\w+}' => [
		'controller' => 'admin',
		'action' => 'addservice',
	],

	'admin/addvisit' => [
		'controller' => 'admin',
		'action' => 'addvisit',
	],

	'admin/clientprofile/{id:\w+}' => [
		'controller' => 'admin',
		'action' => 'clientprofile',
	],


];