<?php

Route::group(array('prefix' => 'agent'), function ()
{
	$route_slug 	   = 'admin_';
	$module_controller = 'Agent\AuthController@';
	Route::get('/', 						 ['as' => $route_slug.'login',		    			'uses' => $module_controller.'login']);

	Route::post('/validate_login', 			 ['as' => $route_slug.'validate',	    			'uses' => $module_controller.'validate_login']);

	Route::get('/forgot_admin_password', 	['as' => $route_slug.'forgot_admin_password',	    'uses' => $module_controller.'forgot_admin_password']);

	$module_controller = "Agent\PasswordController@";
	Route::get('forgot_password',			 ['as' => $route_slug.'forgot_password',			'uses' => $module_controller.'forgot_password']);
	
	Route::post('forgot_password/post_email',['as' => $route_slug.'forgot_password_post_email', 'uses' => $module_controller.'postEmail']);
	
	Route::post('forgot_password/postReset', ['as' => $route_slug.'forgot_password_post_reset', 'uses' => $module_controller.'postReset']);
	
	Route::get('/reset_password/{token?}', 	 ['uses'=>$module_controller.'get_email'])->name('password.reset');

});



Route::group(array('prefix' => 'agent','middleware'=>'auth_agent'), function ()
{
	$route_slug 	   = 'admin_';

	$module_controller = 'Agent\DashboardController@';

	Route::get('/dashboard', 						 ['as' => $route_slug.'dashboard',		    			'uses' => $module_controller.'dashboard']);

	$module_controller = 'Agent\AuthController@';
	
	Route::get('logout', 							['as' => $route_slug.'logout', 		        'uses' => $module_controller.'logout']);

	Route::group(array('prefix' => 'user'), function ()
	{
		$route_slug 	   = 'staff_';

		$module_controller = 'Agent\StaffManagementController@';
		
		Route::get('/',							['as' => $route_slug.'index', 				'uses' => $module_controller.'index']);

		Route::get('/load_data',				['as' => $route_slug.'load_d_verifiedata',  'uses' => $module_controller.'load_data']);
		
		Route::post('/store_staff',				['as' => $route_slug.'store_staff', 		'uses' => $module_controller.'store_staff']);

		Route::get('/edit_staff/{id}',	  		['as' => $route_slug.'edit_staff', 			'uses' => $module_controller.'edit_staff']);

		Route::post('/update',	  				['as' => $route_slug.'update', 				'uses' => $module_controller.'update']);

		Route::get('/view/{id}',    			['as' => $route_slug.'view', 				'uses' => $module_controller.'view']);

		Route::get('/block/{id?}',				['as' => $route_slug.'categories', 			'uses' => $module_controller.'block']);

		Route::get('/unblock/{id?}',			['as' => $route_slug.'categories',			'uses' => $module_controller.'unblock']);

		Route::post('/multi_action',			['as' => $route_slug.'users', 				'uses' => $module_controller.'multi_action']);

		Route::get('/delete/{id}',				['as' => $route_slug.'delete', 				'uses' => $module_controller.'delete']);
		
		Route::get('/get_countries',			['as' => $route_slug.'get_countries', 		'uses' => $module_controller.'get_countries']);
		
		Route::get('/edit_get_countries/{id}',	['as' => $route_slug.'edit_get_countries', 	'uses' => $module_controller.'edit_get_countries']);

	});

	Route::group(array('prefix' => 'orders'), function ()
	{
		$route_slug 	   = 'orders_';

		$module_controller = 'Agent\OrderManagementController@';

		Route::get('/',									['as' => $route_slug.'', 		   		  'uses' => $module_controller.'index']);

		Route::get('/load_printingorders_data',			['as' => $route_slug.'load_printingorders_data',  		  'uses' => $module_controller.'load_printingorders_data']);
		
		Route::get('/get_printingorder_printing_status/{id}',	['as' => $route_slug.'get_printingorder_printing_status',  'uses' => $module_controller.'get_printingorder_printing_status']);
		Route::get('/get_printingorder_printing_status_update',	['as' => $route_slug.'get_printingorder_printing_status_update',  'uses' => $module_controller.'get_printingorder_printing_status_update']);


		Route::get('/edit_printing_orders/{id}',		['as' => $route_slug.'edit_printing_orders',  	  		  'uses' => $module_controller.'edit_printing_orders']);
		
		Route::get('/load_orderproducts_data/{id}',		['as' => $route_slug.'load_orderproducts_data',   		  'uses' => $module_controller.'load_orderproducts_data']);
		
		Route::get('/load_extranotes_data/{id}',		['as' => $route_slug.'load_extranotes_data',  	  		  'uses' => $module_controller.'load_extranotes_data']);
		
		Route::post('/store_printing_order_note',		['as' => $route_slug.'store_printing_order_note', 		  'uses' => $module_controller.'store_printing_order_note']);
		
		Route::get('/get_product_finance_details/{id}',	['as' => $route_slug.'get_product_finance_details',  	  'uses' => $module_controller.'get_product_finance_details']);
	
		Route::get('/load_orderstatushistory_data/{id}',['as' => $route_slug.'load_orderstatushistory_data',  	  'uses' => $module_controller.'load_orderstatushistory_data']);
	
		Route::get('/load_ordercompensation_data/{id}',	['as' => $route_slug.'load_ordercompensation_data',  	  'uses' => $module_controller.'load_ordercompensation_data']);
		
		Route::get('/load_evaluation_data/{id}',		['as' => $route_slug.'load_evaluation_data',  	  		  'uses' => $module_controller.'load_evaluation_data']);
		
		Route::get('/delete_compensation/{id}',			['as' => $route_slug.'delete_compensation',  	 		  'uses' => $module_controller.'delete_compensation']);
	
		Route::get('/get_orderproduct_items/{id}',		['as' => $route_slug.'get_orderproduct_items',  	  	  'uses' => $module_controller.'get_orderproduct_items']);
		
		Route::post('/store_printing_order_compensation',			['as' => $route_slug.'store_printing_order_compensation',  	  'uses' => $module_controller.'store_printing_order_compensation']);

		Route::get('/calculate_rate',					['as' => $route_slug.'calculate_rate',  		  'uses' => $module_controller.'calculate_rate']);
		
		Route::get('/create_pickup',					['as' => $route_slug.'create_pickup',  		  	  'uses' => $module_controller.'create_pickup']);
		
		Route::get('/create_shipment',					['as' => $route_slug.'create_shipment',  		  'uses' => $module_controller.'create_shipment']);
		
		Route::get('/qrcode/{id}',							['as' => $route_slug.'qrcode',  		  'uses' => $module_controller.'qrcode']);


	});

	Route::group(array('prefix' => 'invoices'), function ()
	{
		$route_slug 	   = 'invoices_';

		$module_controller = 'Agent\InvoiceController@';

		Route::get('/',								['as' => $route_slug.'index', 		   				'uses' => $module_controller.'index']);

		Route::get('/load_data',					['as' => $route_slug.'load_data',  	  				'uses' => $module_controller.'load_data']);
		
		Route::get('/get_invoice_data/{id}',		['as' => $route_slug.'get_invoice_data',  	  		'uses' => $module_controller.'get_invoice_data']);

		Route::post('/pay_invoice',					['as' => $route_slug.'pay_invoice',  	  			'uses' => $module_controller.'pay_invoice']);

		Route::any('/export_invoices',				['as' => $route_slug.'export_invoices',  	  		'uses' => $module_controller.'export_invoices']);
		
	});


	Route::group(array('prefix' => 'products'), function ()
	{
		$route_slug 	   = 'product_';

		$module_controller = 'Agent\ProductController@';

		Route::get('/',							['as' => $route_slug.'index', 				'uses' => $module_controller.'index']);

		Route::get('/load_data',				['as' => $route_slug.'load_d_verifiedata',  'uses' => $module_controller.'load_data']);

	});

	

});



