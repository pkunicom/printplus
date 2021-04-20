<?php

Route::group(array('prefix' => 'admin'), function ()
{
	$route_slug 	   = 'admin_';
	$module_controller = 'Admin\AuthController@';
	Route::get('/', 						 ['as' => $route_slug.'login',		    			'uses' => $module_controller.'login']);

	Route::post('/validate_login', 			 ['as' => $route_slug.'validate',	    			'uses' => $module_controller.'validate_login']);

	Route::get('/forgot_admin_password', 	['as' => $route_slug.'forgot_admin_password',	    'uses' => $module_controller.'forgot_admin_password']);

	$module_controller = "Admin\PasswordController@";
	Route::get('forgot_password',			 ['as' => $route_slug.'forgot_password',			'uses' => $module_controller.'forgot_password']);
	
	Route::post('forgot_password/post_email',['as' => $route_slug.'forgot_password_post_email', 'uses' => $module_controller.'postEmail']);
	
	Route::post('forgot_password/postReset', ['as' => $route_slug.'forgot_password_post_reset', 'uses' => $module_controller.'postReset']);
	
	Route::get('/reset_password/{token?}', 	 ['uses'=>$module_controller.'get_email'])->name('password.reset');

	Route::get('/set_password/{enc_id}', 	['as'=>'set_password', 	'uses' => $module_controller.'set_password']);
	Route::post('/save_password/{enc_id}', 	['as'=>'save_password', 'uses' => $module_controller.'save_password']);

});



Route::group(array('prefix' => 'admin','middleware'=>'auth_admin'), function ()
{
	$route_slug 	   = 'admin_';

	$module_controller = 'Admin\DashboardController@';

	Route::get('/dashboard', 						 ['as' => $route_slug.'dashboard',		    			'uses' => $module_controller.'dashboard']);

	$module_controller = 'Admin\AuthController@';
	
	Route::get('logout', 							['as' => $route_slug.'logout', 		        'uses' => $module_controller.'logout']);

	Route::group(array('prefix' => 'staff'), function ()
	{
		$route_slug 	   = 'staff_';

		$module_controller = 'Admin\StaffManagementController@';

		Route::get('/',							['as' => $route_slug.'index', 				'uses' => $module_controller.'index']);

		Route::get('/load_data',				['as' => $route_slug.'load_d_verifiedata',  'uses' => $module_controller.'load_data']);
		
		Route::post('/store_staff',				['as' => $route_slug.'store_staff', 		'uses' => $module_controller.'store_staff']);

		Route::get('/edit_staff/{id}',	  		['as' => $route_slug.'edit_staff', 			'uses' => $module_controller.'edit_staff']);

		Route::post('/update',	  				['as' => $route_slug.'update', 				'uses' => $module_controller.'update']);

		Route::get('/view/{id}',    			['as' => $route_slug.'view', 				'uses' => $module_controller.'view']);

		Route::get('/block/{id?}',				['as' => $route_slug.'block', 			'uses' => $module_controller.'block']);

		Route::get('/unblock/{id?}',			['as' => $route_slug.'unblock',			'uses' => $module_controller.'unblock']);

		Route::post('/multi_action',			['as' => $route_slug.'users', 				'uses' => $module_controller.'multi_action']);

		Route::get('/delete/{id}',				['as' => $route_slug.'delete', 				'uses' => $module_controller.'delete']);
		
		Route::get('/get_countries',			['as' => $route_slug.'get_countries', 		'uses' => $module_controller.'get_countries']);
		
		Route::get('/edit_get_countries/{id}',	['as' => $route_slug.'edit_get_countries', 	'uses' => $module_controller.'edit_get_countries']);

	});

	Route::group(array('prefix' => 'agent'), function ()
	{
		$route_slug 	   = 'agent_';

		$module_controller = 'Admin\AgentManagementController@';

		Route::get('/',							['as' => $route_slug.'index', 				'uses' => $module_controller.'index']);

		Route::get('/load_data',				['as' => $route_slug.'load_d_verifiedata',  'uses' => $module_controller.'load_data']);
		
		Route::post('/store_agent',				['as' => $route_slug.'store_agent', 		'uses' => $module_controller.'store_agent']);

		Route::get('/edit_agent/{id}',	  		['as' => $route_slug.'edit_agent', 			'uses' => $module_controller.'edit_agent']);

		Route::post('/update_agent/{id}',	  	['as' => $route_slug.'update_agent', 		'uses' => $module_controller.'update_agent']);
		
		Route::post('/update_agent_bank/{id}',	['as' => $route_slug.'update_agent_bank', 	'uses' => $module_controller.'update_agent_bank']);

		Route::get('/view/{id}',    			['as' => $route_slug.'view', 				'uses' => $module_controller.'view']);

		Route::get('/block/{id?}',				['as' => $route_slug.'categories', 			'uses' => $module_controller.'block']);

		Route::get('/unblock/{id?}',			['as' => $route_slug.'categories',			'uses' => $module_controller.'unblock']);

		Route::post('/multi_action',			['as' => $route_slug.'users', 				'uses' => $module_controller.'multi_action']);

		Route::get('/delete/{id}',				['as' => $route_slug.'delete', 				'uses' => $module_controller.'delete']);
		
		Route::get('/get_countries',			['as' => $route_slug.'get_countries', 		'uses' => $module_controller.'get_countries']);
		
		Route::get('/get_cities/{id}',			['as' => $route_slug.'get_cities', 			'uses' => $module_controller.'get_cities']);
		
		Route::get('/check_duplicate_number/{id}',			['as' => $route_slug.'check_duplicate_number', 			'uses' => $module_controller.'check_duplicate_number']);
		
		Route::get('/edit_get_countries/{id}',	['as' => $route_slug.'edit_get_countries', 	'uses' => $module_controller.'edit_get_countries']);

		Route::get('/load_agentproducts_data/{id}',	['as' => $route_slug.'load_d_verifiedata',  'uses' => $module_controller.'load_agentproducts_data']);

		Route::get('/get_products/{id}',		['as' => $route_slug.'get_products',  		'uses' => $module_controller.'get_products']);
		
		Route::post('/store_agent_product',		['as' => $route_slug.'store_agent_product',  		'uses' => $module_controller.'store_agent_product']);
		
		Route::get('/delete_agent_product/{id}',['as' => $route_slug.'delete_agent_product',  		'uses' => $module_controller.'delete_agent_product']);
		
		Route::get('/load_agentinvoice_data/{id}',	['as' => $route_slug.'load_d_verifiedata',  'uses' => $module_controller.'load_agentinvoice_data']);
	});

	Route::group(array('prefix' => 'customers'), function ()
	{
		$route_slug 	   = 'agent_';

		$module_controller = 'Admin\CustomerManagementController@';

		Route::get('/',							['as' => $route_slug.'index', 				'uses' => $module_controller.'index']);

		Route::get('/load_data',				['as' => $route_slug.'load_d_verifiedata',  'uses' => $module_controller.'load_data']);
		
		Route::get('/edit_customer/{id}',	  	['as' => $route_slug.'edit_customer', 		'uses' => $module_controller.'edit_customer']);

		Route::post('/update_customer/{id}',	['as' => $route_slug.'update_customer', 	'uses' => $module_controller.'update_customer']);
	
		Route::post('/store_agent',				['as' => $route_slug.'store_agent', 		'uses' => $module_controller.'store_agent']);

		Route::post('/update_agent_bank/{id}',	['as' => $route_slug.'update_agent_bank', 	'uses' => $module_controller.'update_agent_bank']);

		Route::get('/view/{id}',    			['as' => $route_slug.'view', 				'uses' => $module_controller.'view']);

		Route::get('/block/{id?}',				['as' => $route_slug.'categories', 			'uses' => $module_controller.'block']);

		Route::get('/unblock/{id?}',			['as' => $route_slug.'categories',			'uses' => $module_controller.'unblock']);

		Route::post('/multi_action',			['as' => $route_slug.'users', 				'uses' => $module_controller.'multi_action']);

		Route::get('/delete/{id}',				['as' => $route_slug.'delete', 				'uses' => $module_controller.'delete']);
		
		Route::get('/get_countries',			['as' => $route_slug.'get_countries', 		'uses' => $module_controller.'get_countries']);
		
		Route::get('/get_cities/{id}',			['as' => $route_slug.'get_cities', 			'uses' => $module_controller.'get_cities']);
		
		Route::get('/edit_get_countries/{id}',	['as' => $route_slug.'edit_get_countries', 	'uses' => $module_controller.'edit_get_countries']);

		Route::get('/load_customerdiscount_data/{id}',		['as' => $route_slug.'load_customerdiscount_data',  'uses' => $module_controller.'load_customerdiscount_data']);

		Route::get('/get_category_discount/{id}',			['as' => $route_slug.'get_category_discount',  		'uses' => $module_controller.'get_category_discount']);
		
		Route::post('/update_customer_discount',			['as' => $route_slug.'update_customer_discount',  	'uses' => $module_controller.'update_customer_discount']);

		Route::get('/load_customerorders_data/{id}',		['as' => $route_slug.'load_customerorders_data',  	'uses' => $module_controller.'load_customerorders_data']);
		
		Route::get('/load_customertransaction_data/{id}',	['as' => $route_slug.'load_customertransaction_data','uses' => $module_controller.'load_customertransaction_data']);

		Route::get('/get_customerorder_id/{id}',			['as' => $route_slug.'get_customerorder_id',		'uses' => $module_controller.'get_customerorder_id']);
		
		Route::post('/add_customer_bank_transfer',			['as' => $route_slug.'add_customer_bank_transfer',	'uses' => $module_controller.'add_customer_bank_transfer']);
		
		Route::post('/add_compensation',					['as' => $route_slug.'add_compensation',	'uses' => $module_controller.'add_compensation']);
		
		Route::post('/deduct_amount',						['as' => $route_slug.'deduct_amount',	'uses' => $module_controller.'deduct_amount']);

	});

	Route::group(array('prefix' => 'orders'), function ()
	{
		$route_slug 	   = 'orders_';

		$module_controller = 'Admin\OrderManagementController@';

		Route::get('/printing_orders',					['as' => $route_slug.'printing_orders', 		   		  'uses' => $module_controller.'printing_orders']);

		Route::get('/load_printingorders_data',			['as' => $route_slug.'load_printingorders_data',  		  'uses' => $module_controller.'load_printingorders_data']);
		
		Route::get('/get_printingorder_delivery_status/{id}',	['as' => $route_slug.'get_printingorder_delivery_status',  'uses' => $module_controller.'get_printingorder_delivery_status']);
		Route::get('/get_printingorder_delivery_status_update',	['as' => $route_slug.'get_printingorder_delivery_status_update',  'uses' => $module_controller.'get_printingorder_delivery_status_update']);

		Route::get('/edit_printing_orders/{id}',		['as' => $route_slug.'edit_printing_orders',  	  		  'uses' => $module_controller.'edit_printing_orders']);
		Route::get('/view_invoice/{id}',		['as' => $route_slug.'view_invoice',  	  		  'uses' => $module_controller.'view_invoice']);
		
		Route::get('/load_orderproducts_data/{id}',		['as' => $route_slug.'load_orderproducts_data',   		  'uses' => $module_controller.'load_orderproducts_data']);
		
		Route::get('/load_extranotes_data/{id}',		['as' => $route_slug.'load_extranotes_data',  	  		  'uses' => $module_controller.'load_extranotes_data']);
		
		Route::post('/store_printing_order_note',		['as' => $route_slug.'store_printing_order_note', 		  'uses' => $module_controller.'store_printing_order_note']);
		
		Route::get('/get_product_finance_details/{id}',	['as' => $route_slug.'get_product_finance_details',  	  'uses' => $module_controller.'get_product_finance_details']);
	
		Route::get('/load_orderstatushistory_data/{id}',['as' => $route_slug.'load_orderstatushistory_data',  	  'uses' => $module_controller.'load_orderstatushistory_data']);
	
		Route::get('/load_ordercompensation_data/{id}',	['as' => $route_slug.'load_ordercompensation_data',  	  'uses' => $module_controller.'load_ordercompensation_data']);
		
		Route::get('/delete_compensation/{id}',			['as' => $route_slug.'delete_compensation',  	 		  'uses' => $module_controller.'delete_compensation']);
	
		Route::get('/get_orderproduct_items/{id}',		['as' => $route_slug.'get_orderproduct_items',  	  	  'uses' => $module_controller.'get_orderproduct_items']);
		
		Route::post('/store_printing_order_compensation',			['as' => $route_slug.'store_printing_order_compensation',  	  'uses' => $module_controller.'store_printing_order_compensation']);

		Route::any('/create_shipment',					['as' => $route_slug.'create_shipment',  	  'uses' => $module_controller.'create_shipment']);

		Route::group(array('prefix' => 'design_orders'), function ()
		{
			$route_slug 	   = 'designorders_';

			$module_controller = 'Admin\DesignOrderManagementController@';

			Route::get('/',								['as' => $route_slug.'design_orders', 		   		  'uses' => $module_controller.'design_orders']);

			Route::get('/load_designorders_data',		['as' => $route_slug.'load_designorders_data',  	  'uses' => $module_controller.'load_designorders_data']);
		
			Route::get('/edit_design_orders/{id}',		['as' => $route_slug.'edit_design_orders',  	  	  'uses' => $module_controller.'edit_design_orders']);

			Route::get('/load_orderdetails_data/{id}',	['as' => $route_slug.'load_orderdetails_data',  	  'uses' => $module_controller.'load_orderdetails_data']);
			
			Route::get('/load_orderfiles_data/{id}',	['as' => $route_slug.'load_orderfiles_data',  	  	  'uses' => $module_controller.'load_orderfiles_data']);
			
			Route::get('/delete_design_files/{id}',		['as' => $route_slug.'delete_design_files',  	  	  'uses' => $module_controller.'delete_design_files']);
			
			Route::post('/store_design_order_file',		['as' => $route_slug.'store_design_order_file',  	  	  'uses' => $module_controller.'store_design_order_file']);
		
			Route::get('/load_extranotes_data/{id}',	['as' => $route_slug.'load_extranotes_data',  	  		  'uses' => $module_controller.'load_extranotes_data']);
		
			Route::post('/store_design_order_note',		['as' => $route_slug.'store_design_order_note',  	  	  'uses' => $module_controller.'store_design_order_note']);
		
			Route::get('/load_orderstatushistory_data/{id}',	['as' => $route_slug.'load_orderstatushistory_data',  	  	  'uses' => $module_controller.'load_orderstatushistory_data']);
			
			Route::get('/load_orderquotation_data/{id}',		['as' => $route_slug.'load_orderquotation_data',  	  		  'uses' => $module_controller.'load_orderquotation_data']);
	
		});

		Route::group(array('prefix' => 'external_orders'), function ()
		{
			$route_slug 	   = 'external_orders_';

			$module_controller = 'Admin\ExternalOrdersController@';

			Route::get('/',								['as' => $route_slug.'external_orders', 		   		'uses' => $module_controller.'external_orders']);

			Route::get('/load_externalorders_data',		['as' => $route_slug.'load_externalorders_data',  	  	'uses' => $module_controller.'load_externalorders_data']);
		
			Route::get('/edit_external_orders/{id}',	['as' => $route_slug.'edit_external_orders',  	  	  	'uses' => $module_controller.'edit_external_orders']);
			
			Route::post('/store_external_order',		['as' => $route_slug.'store_external_order',  	  	  	'uses' => $module_controller.'store_external_order']);
			
			Route::post('/update_external_order',		['as' => $route_slug.'update_external_order',  	  	  	'uses' => $module_controller.'update_external_order']);
			
			Route::get('/delete_external_orders/{id}',	['as' => $route_slug.'delete_external_orders',  	  	'uses' => $module_controller.'delete_external_orders']);
			
		
		});

		Route::group(array('prefix' => 'samplekit_orders'), function ()
		{
			$route_slug 	   = 'samplekit_orders_';

			$module_controller = 'Admin\SampleKitOrdersController@';

			Route::get('/',								['as' => $route_slug.'samplekit_orders', 		   		'uses' => $module_controller.'samplekit_orders']);

			Route::get('/load_samplekitorders_data',	['as' => $route_slug.'load_samplekitorders_data',  	  	'uses' => $module_controller.'load_samplekitorders_data']);
		
		});

		Route::group(array('prefix' => 'evaluations'), function ()
		{
			$route_slug 	   = 'evaluation_';

			$module_controller = 'Admin\EvaluationController@';

			Route::get('/',								['as' => $route_slug.'index', 		   				'uses' => $module_controller.'index']);

			Route::get('/load_evaluation_data',			['as' => $route_slug.'load_evaluation_data',  	  	'uses' => $module_controller.'load_evaluation_data']);
			
			Route::get('/get_evaluation_data/{id}',		['as' => $route_slug.'get_evaluation_data',  		'uses' => $module_controller.'get_evaluation_data']);
		
			Route::get('/reject_status/{id}',			['as' => $route_slug.'reject_status',  				'uses' => $module_controller.'reject_status']);
			
			Route::get('/accept_status/{id}',			['as' => $route_slug.'accept_status',  				'uses' => $module_controller.'accept_status']);
			Route::get('/change_evalution_status',			['as' => $route_slug.'change_evalution_status',  				'uses' => $module_controller.'change_evalution_status']);
		
		});

	});

	Route::group(array('prefix' => 'invoices'), function ()
	{
		$route_slug 	   = 'invoices_';

		$module_controller = 'Admin\InvoiceController@';

		Route::get('/',								['as' => $route_slug.'index', 		   				'uses' => $module_controller.'index']);

		Route::get('/load_data',					['as' => $route_slug.'load_data',  	  				'uses' => $module_controller.'load_data']);
		
		Route::get('/get_invoice_data/{id}',		['as' => $route_slug.'get_invoice_data',  	  		'uses' => $module_controller.'get_invoice_data']);

		Route::post('/pay_invoice',					['as' => $route_slug.'pay_invoice',  	  			'uses' => $module_controller.'pay_invoice']);

		Route::any('/export_invoices',				['as' => $route_slug.'export_invoices',  	  		'uses' => $module_controller.'export_invoices']);
		
	});

	Route::group(array('prefix' => 'discounts'), function ()
	{
		$route_slug 	   = 'discounts_';

		$module_controller = 'Admin\DiscountController@';

		Route::get('/',								['as' => $route_slug.'index', 		   				'uses' => $module_controller.'index']);

		Route::get('/load_data',					['as' => $route_slug.'load_data',  	  				'uses' => $module_controller.'load_data']);
		
		Route::post('/add_discount',				['as' => $route_slug.'add_discount',  	  			'uses' => $module_controller.'add_discount']);
		
		Route::post('/edit_discount',				['as' => $route_slug.'edit_discount',  	  			'uses' => $module_controller.'edit_discount']);
		
		Route::get('/get_discount_data/{id}',		['as' => $route_slug.'get_discount_data',  	  		'uses' => $module_controller.'get_discount_data']);

		Route::get('/get_data',						['as' => $route_slug.'get_data',  	  				'uses' => $module_controller.'get_data']);
		
		Route::get('/get_category_selected_data/{id}',			['as' => $route_slug.'get_category_selected_data',  	  		'uses' => $module_controller.'get_category_selected_data']);
		
		Route::get('/get_subcategory_selected_data/{id}',			['as' => $route_slug.'get_subcategory_selected_data',  	  		'uses' => $module_controller.'get_subcategory_selected_data']);
		
		Route::get('/get_country_selected_data/{id}',			['as' => $route_slug.'get_country_selected_data',  	  		'uses' => $module_controller.'get_country_selected_data']);
	});

	Route::group(array('prefix' => 'promo_codes'), function ()
	{
		$route_slug 	   = 'promo_codes_';

		$module_controller = 'Admin\PromoCodesController@';

		Route::get('/',								['as' => $route_slug.'index', 		   				'uses' => $module_controller.'index']);

		Route::get('/load_data',					['as' => $route_slug.'load_data',  	  				'uses' => $module_controller.'load_data']);
		
		Route::post('/add_promo_code',				['as' => $route_slug.'add_promo_code',  	  		'uses' => $module_controller.'add_promo_code']);
		
		Route::post('/edit_promo_code',				['as' => $route_slug.'edit_promo_code',  	  			'uses' => $module_controller.'edit_promo_code']);
		
		Route::get('/get_promo_code_data/{id}',		['as' => $route_slug.'get_promo_code_data',  	  		'uses' => $module_controller.'get_promo_code_data']);

		
	});	


	Route::group(array('prefix' => 'category'), function ()
	{
		$route_slug 	   = 'category_';

		$module_controller = 'Admin\CategoryManagementController@';

		//category listing  : AUTHOR (Akshay Ugale)
		Route::get('/',							['as' => $route_slug.'index', 				'uses' => $module_controller.'index']);

		//load data  : AUTHOR (Akshay Ugale)
		Route::get('/load_data',				['as' => $route_slug.'load_d_verifiedata',  'uses' => $module_controller.'load_data']);

		// store new category   : AUTHOR (Akshay Ugale)
		Route::post('/store_category',			['as' => $route_slug.'store_category', 		'uses' => $module_controller.'store_category']);

		// edit category   : AUTHOR (Akshay Ugale)
		Route::get('/edit/{id}',	  			['as' => $route_slug.'edit', 				'uses' => $module_controller.'edit']);

		// update category   : AUTHOR (Akshay Ugale)
		Route::post('/update',	  				['as' => $route_slug.'update', 				'uses' => $module_controller.'update']);

		// check category english name exist or not   : AUTHOR (Akshay Ugale)
		Route::post('/en_category_check',	  	['as' => $route_slug.'en_category_check', 	'uses' => $module_controller.'en_category_check']);

		// check category arabic name exist or not   : AUTHOR (Akshay Ugale)
		Route::post('/ar_category_check',	  	['as' => $route_slug.'ar_category_check', 	'uses' => $module_controller.'ar_category_check']);

		// view category   : AUTHOR (Akshay Ugale)
		Route::get('/view/{id}',    			['as' => $route_slug.'view', 				'uses' => $module_controller.'view']);

		// block category   : AUTHOR (Akshay Ugale)
		Route::get('/block/{id?}',				['as' => $route_slug.'categories', 			'uses' => $module_controller.'block']);

		// unblock category   : AUTHOR (Akshay Ugale)
		Route::get('/unblock/{id?}',			['as' => $route_slug.'categories',			'uses' => $module_controller.'unblock']);

		// delete category   : AUTHOR (Akshay Ugale)
		Route::get('/delete/{id}',				['as' => $route_slug.'delete', 				'uses' => $module_controller.'delete']);

		Route::post('/multi_action',			['as' => $route_slug.'users', 				'uses' => $module_controller.'multi_action']);

		
		//Route for Subcategory

		// sub-category listing   : AUTHOR (Akshay Ugale)
		Route::get('/subcategory/{id}',			['as' => $route_slug.'sub_cat_index', 		'uses' => $module_controller.'sub_cat_index']);

		// sub-category load data   : AUTHOR (Akshay Ugale)
		Route::get('/load_sub_category_data',	['as' => $route_slug.'load_d_verifiedata',  'uses' => $module_controller.'load_sub_category_data']);

		// add new sub-category     : AUTHOR (Akshay Ugale)
		Route::post('/store_sub_category',		['as' => $route_slug.'store_sub_category', 	'uses' => $module_controller.'store_sub_category']);

		// edit sub-category     : AUTHOR (Akshay Ugale)
		Route::get('/edit_sub_cat/{id}',	  	['as' => $route_slug.'edit_sub_cat', 		'uses' => $module_controller.'edit_sub_cat']);

		// update sub-category     : AUTHOR (Akshay Ugale)
		Route::post('/update_sub_cat',	  		['as' => $route_slug.'update_sub_cat', 		'uses' => $module_controller.'update_sub_cat']);

		// block sub-category     : AUTHOR (Akshay Ugale)
		Route::get('/block_sub_cat/{id?}',		['as' => $route_slug.'sub-categories', 		'uses' => $module_controller.'block_sub_cat']);

		// unblock sub-category     : AUTHOR (Akshay Ugale)
		Route::get('/unblock_sub_cat/{id?}',	['as' => $route_slug.'sub-categories',		'uses' => $module_controller.'unblock_sub_cat']);

		// delete sub-category     : AUTHOR (Akshay Ugale)
		Route::get('/delete_sub_cat/{id}',		['as' => $route_slug.'sub_category_delete', 'uses' => $module_controller.'delete_sub_cat']);

		// check english sub-category exist or not     : AUTHOR (Akshay Ugale)
		Route::post('/en_sub_category_check',	['as' => $route_slug.'en_sub_category_check', 	'uses' => $module_controller.'en_sub_category_check']);

		// check arabic sub-category exist or not     : AUTHOR (Akshay Ugale)
		Route::post('/ar_sub_category_check',	['as' => $route_slug.'ar_sub_category_check', 	'uses' => $module_controller.'ar_sub_category_check']);

	});	


	Route::group(array('prefix' => 'option'), function ()
	{
		$route_slug 	   = 'option_';

		$module_controller = 'Admin\OptionManagementController@';

		// listing option     : AUTHOR (Akshay Ugale)
		Route::get('/',							['as' => $route_slug.'index', 				'uses' => $module_controller.'index']);

		// option load_data     : AUTHOR (Akshay Ugale)
		Route::get('/load_data',				['as' => $route_slug.'load_d_verifiedata',  'uses' => $module_controller.'load_data']);

		// store new  option     : AUTHOR (Akshay Ugale)
		Route::post('/store_option',			['as' => $route_slug.'store', 				'uses' => $module_controller.'store_option']);

		// edit option     : AUTHOR (Akshay Ugale)
		Route::get('/edit/{id}',	  			['as' => $route_slug.'edit', 				'uses' => $module_controller.'edit']);

		// update option     : AUTHOR (Akshay Ugale)
		Route::post('/update',	  				['as' => $route_slug.'update', 				'uses' => $module_controller.'update']);

		// check english option exist or not      : AUTHOR (Akshay Ugale)
		Route::post('/en_option_check',	  		['as' => $route_slug.'en_option_check', 	'uses' => $module_controller.'en_option_check']);

		// check arabic  option exist or not      : AUTHOR (Akshay Ugale)
		Route::post('/ar_option_check',	  		['as' => $route_slug.'ar_option_check', 	'uses' => $module_controller.'ar_option_check']);

		// block option     : AUTHOR (Akshay Ugale)
		Route::get('/block/{id?}',				['as' => $route_slug.'option', 				'uses' => $module_controller.'block']);

		// unblock option     : AUTHOR (Akshay Ugale)
		Route::get('/unblock/{id?}',			['as' => $route_slug.'option',				'uses' => $module_controller.'unblock']);

		// delete option     : AUTHOR (Akshay Ugale)
		Route::get('/delete/{id}',				['as' => $route_slug.'delete', 				'uses' => $module_controller.'delete']);

		Route::post('/multi_action',			['as' => $route_slug.'users', 				'uses' => $module_controller.'multi_action']);


		// Route for Sub-Option

		// listing sub-option     : AUTHOR (Akshay Ugale)
		Route::get('/suboption/{id}',			['as' => $route_slug.'sub_option_index', 	'uses' => $module_controller.'sub_option_index']);

		// sub-option load data     : AUTHOR (Akshay Ugale)
		Route::get('/load_sub_option_data',	 	['as' => $route_slug.'load_d_verifiedata',  'uses' => $module_controller.'load_sub_option_data']);

		// store new sub-option     : AUTHOR (Akshay Ugale)
		Route::post('/store_sub_option',		['as' => $route_slug.'store_sub_option', 	'uses' => $module_controller.'store_sub_option']);

		// edit sub-option     : AUTHOR (Akshay Ugale)
		Route::get('/edit_sub_option/{id}',	  	['as' => $route_slug.'edit_sub_option', 		'uses' => $module_controller.'edit_sub_option']);

		// update sub-option     : AUTHOR (Akshay Ugale)
		Route::post('/update_sub_option',	  		['as' => $route_slug.'update_sub_option', 		'uses' => $module_controller.'update_sub_option']);

		// block sub-option     : AUTHOR (Akshay Ugale)
		Route::get('/block_sub_cat/{id?}',		['as' => $route_slug.'sub-categories', 		'uses' => $module_controller.'block_sub_cat']);

		// unblock sub-option     : AUTHOR (Akshay Ugale)
		Route::get('/unblock_sub_cat/{id?}',	['as' => $route_slug.'sub-categories',		'uses' => $module_controller.'unblock_sub_cat']);

		// delete sub-option     : AUTHOR (Akshay Ugale)
		Route::get('/delete_sub_cat/{id}',		['as' => $route_slug.'sub_category_delete', 'uses' => $module_controller.'delete_sub_cat']);

		// check english  sub-option exist or not     : AUTHOR (Akshay Ugale)
		Route::post('/en_sub_option_check',		['as' => $route_slug.'en_sub_option_check', 	'uses' => $module_controller.'en_sub_option_check']);

		// check  arabic sub-option exist or not     : AUTHOR (Akshay Ugale)
		Route::post('/ar_sub_option_check',		['as' => $route_slug.'ar_sub_option_check', 	'uses' => $module_controller.'ar_sub_option_check']);
	});

	Route::group(array('prefix' => 'accessory'), function ()
	{
		$route_slug 	   = 'accessory_';

		$module_controller = 'Admin\AccessoryManagementController@';

		// listing accessory     : AUTHOR (Akshay Ugale)
		Route::get('/',							['as' => $route_slug.'index', 				'uses' => $module_controller.'index']);

		// load data accessory     : AUTHOR (Akshay Ugale)
		Route::get('/load_data',				['as' => $route_slug.'load_d_verifiedata',  'uses' => $module_controller.'load_data']);

		// add new  accessory     : AUTHOR (Akshay Ugale)
		Route::post('/store',					['as' => $route_slug.'store', 				'uses' => $module_controller.'store']);

		// edit accessory     : AUTHOR (Akshay Ugale)
		Route::get('/edit/{id}',	  			['as' => $route_slug.'edit', 				'uses' => $module_controller.'edit']);

		// update accessory     : AUTHOR (Akshay Ugale)
		Route::post('/update',	  				['as' => $route_slug.'update', 				'uses' => $module_controller.'update']);

		// check english accessory exist or not     : AUTHOR (Akshay Ugale)
		Route::post('/check_en_accessory',	  	['as' => $route_slug.'check_en_accessory', 	'uses' => $module_controller.'check_en_accessory']);

		// check arabic  accessory exist or not     : AUTHOR (Akshay Ugale)
		Route::post('/check_ar_accessory',	  	['as' => $route_slug.'check_ar_accessory', 	'uses' => $module_controller.'check_ar_accessory']);
		
		// block accessory     : AUTHOR (Akshay Ugale)
		Route::get('/block/{id?}',				['as' => $route_slug.'accessory', 				'uses' => $module_controller.'block']);

		// unblock accessory     : AUTHOR (Akshay Ugale)
		Route::get('/unblock/{id?}',			['as' => $route_slug.'accessory',				'uses' => $module_controller.'unblock']);

		// delete accessory     : AUTHOR (Akshay Ugale)
		Route::get('/delete/{id}',				['as' => $route_slug.'delete', 				'uses' => $module_controller.'delete']);

		Route::post('/multi_action',			['as' => $route_slug.'accessory', 				'uses' => $module_controller.'multi_action']);
	});

	Route::group(array('prefix' => 'product'), function ()
	{
		$route_slug 	   = 'product_';

		$module_controller = 'Admin\ProductManagementController@';

		// listing product     : AUTHOR (Akshay Ugale)
		Route::get('/',							['as' => $route_slug.'index', 				'uses' => $module_controller.'index']);

		// load  product data     : AUTHOR (Akshay Ugale)
		Route::get('/load_data',				['as' => $route_slug.'load_d_verifiedata',  'uses' => $module_controller.'load_data']);

		// store new  product     : AUTHOR (Akshay Ugale)
		Route::post('/store',					['as' => $route_slug.'store', 				'uses' => $module_controller.'store']);

		// block product     : AUTHOR (Akshay Ugale)
		Route::get('/block/{id?}',				['as' => $route_slug.'product', 			'uses' => $module_controller.'block']);

		// unblock product     : AUTHOR (Akshay Ugale)
		Route::get('/unblock/{id?}',			['as' => $route_slug.'product',				'uses' => $module_controller.'unblock']);

		// delete product     : AUTHOR (Akshay Ugale)
		Route::get('/delete/{id}',				['as' => $route_slug.'delete', 				'uses' => $module_controller.'delete']);

		Route::post('/multi_action',			['as' => $route_slug.'product', 				'uses' => $module_controller.'multi_action']);

		// edit product     : AUTHOR (Akshay Ugale)
		Route::get('/edit/{id}',	  			['as' => $route_slug.'edit', 				'uses' => $module_controller.'edit']);

		// update product info    : AUTHOR (Akshay Ugale)
		Route::post('/update_product_info',	 	['as' => $route_slug.'update_product_info', 'uses' => $module_controller.'update_product_info']);

		//Product Option 

		// assing new option to product     : AUTHOR (Akshay Ugale)
		Route::post('/store_product_option',	['as' => $route_slug.'store_product_option', 'uses' => $module_controller.'store_product_option']);

		// load  product-options data     : AUTHOR (Akshay Ugale)
		Route::get('/load_option_data',			['as' => $route_slug.'load_option_data',  'uses' => $module_controller.'load_option_data']);
		
		Route::get('/check_all_options/{id}',		['as' => $route_slug.'check_all_options',  'uses' => $module_controller.'check_all_options']);

		// edit  product option     : AUTHOR (Akshay Ugale)
		Route::get('/edit_product_option/{id}',	['as' => $route_slug.'edit_product_option', 'uses' => $module_controller.'edit_product_option']);
		
		// update product option     : AUTHOR (Akshay Ugale)
		Route::post('/update_product_option',	['as' => $route_slug.'update_product_option', 'uses' => $module_controller.'update_product_option']);

		// delete  product option     : AUTHOR (Akshay Ugale)
		Route::get('/delete_product_option/{id}',['as' => $route_slug.'delete_product_option', 	'uses' => $module_controller.'delete_product_option']);

		// edit  product sub Option     : AUTHOR (Akshay Ugale)
		Route::post('/get_edit_sub_option',	  	['as' => $route_slug.'get_edit_sub_option', 	'uses' => $module_controller.'get_edit_sub_option']);

		// check  product english name exist or not     : AUTHOR (Akshay Ugale)
		Route::post('/product_english_name',	['as' => $route_slug.'product_english_name', 	'uses' => $module_controller.'product_english_name']);

		// check  product arabic name exist or not     : AUTHOR (Akshay Ugale)
		Route::post('/product_arabic_name',	  	['as' => $route_slug.'product_arabic_name', 	'uses' => $module_controller.'product_arabic_name']);

		// get subcategory for product     : AUTHOR (Akshay Ugale)
		Route::post('/get_sub_category',	  	['as' => $route_slug.'get_sub_category', 	'uses' => $module_controller.'get_sub_category']);

		Route::post('/get_edit_relation_sub_option',['as' => $route_slug.'get_edit_relation_sub_option', 	'uses' => $module_controller.'get_edit_relation_sub_option']);

		Route::post('/get_edit_sub_category',	['as' => $route_slug.'get_edit_sub_category', 	'uses' => $module_controller.'get_edit_sub_category']);

		
		// Product Quantity
		// Route::post('/store_fixed_quantity',	['as' => $route_slug.'store_fixed_quantity', 	'uses' => $module_controller.'store_fixed_quantity']);
		Route::post('/store_quantity',			['as' => $route_slug.'store_quantity', 	'uses' => $module_controller.'store_quantity']);

		Route::post('/check_fixed_quantity',	['as' => $route_slug.'check_fixed_quantity', 	'uses' => $module_controller.'check_fixed_quantity']);

		Route::get('/delete_fixed_quantity/{id}',['as' => $route_slug.'delete_fixed_quantity', 	'uses' => $module_controller.'delete_fixed_quantity']);
	
		Route::get('/delete_variable_quantity/{id}',['as' => $route_slug.'delete_variable_quantity', 	'uses' => $module_controller.'delete_variable_quantity']);

		// Route::post('/store_variable_quantity',	['as' => $route_slug.'store_variable_quantity', 	'uses' => $module_controller.'store_variable_quantity']);

		

		//Product weight time cost
			
		Route::get('/load_product_weight_time_cost',['as' => $route_slug.'load_product_weight_time_cost',  'uses' => $module_controller.'load_product_weight_time_cost']);
	
		// edit product weight time & cost data     : AUTHOR (Akshay Ugale)
		Route::get('/edit_product_weight_time_cost/{id}',['as' => $route_slug.'edit_product_weight_time_cost', 	'uses' => $module_controller.'edit_product_weight_time_cost']);

		// update product weight time & cost data     : AUTHOR (Akshay Ugale)
		Route::post('/update_product_weight_time_cost',['as' => $route_slug.'update_product_weight_time_cost', 'uses' => $module_controller.'update_product_weight_time_cost']);
	

		//Product Installation
		// load product installation data     : AUTHOR (Akshay Ugale)
		Route::get('/load_product_installation/{id}',	['as' => $route_slug.'load_product_installation',  		'uses' => $module_controller.'load_product_installation']);

		// assign product installation city     : AUTHOR (Akshay Ugale)
		Route::post('/store_installation_city',			['as' => $route_slug.'store_installation_city', 		'uses' => $module_controller.'store_installation_city']);

		// edit product installation city     : AUTHOR (Akshay Ugale)
		Route::get('/edit_installation_city/{id}',		['as' => $route_slug.'edit_installation_city',  		'uses' => $module_controller.'edit_installation_city']);

		// update product installation  city    : AUTHOR (Akshay Ugale)
		Route::post('/update_product_installation_city',['as' => $route_slug.'update_product_installation_city', 'uses' => $module_controller.'update_product_installation_city']);

		// get cities     : AUTHOR (Akshay Ugale)
		Route::post('/get_cities',	  					['as' => $route_slug.'get_cities', 						'uses' => $module_controller.'get_cities']);

		Route::post('/get_edit_cities',	  				['as' => $route_slug.'get_edit_cities', 				'uses' => $module_controller.'get_edit_cities']);

		// delete product installation  city   : AUTHOR (Akshay Ugale)
		Route::get('/delete_product_installation_city/{id}',['as' => $route_slug.'delete_product_installation_city', 	'uses' => $module_controller.'delete_product_installation_city']);




		//Product Accessories
		// load product accessories     : AUTHOR (Akshay Ugale)
		Route::get('/load_product_accessories',['as' => $route_slug.'load_product_accessories',  'uses' => $module_controller.'load_product_accessories']);

		// assign product accessories     : AUTHOR (Akshay Ugale)
		Route::post('/store_product_accessory',	['as' => $route_slug.'store_product_accessory', 'uses' => $module_controller.'store_product_accessory']);

		// delete product accessories     : AUTHOR (Akshay Ugale)
		Route::get('/delete_product_accessory/{id}',['as' => $route_slug.'delete_product_accessory', 	'uses' => $module_controller.'delete_product_accessory']);


	});

	// all reports     : AUTHOR (Akshay Ugale)
	Route::group(array('prefix' => 'reports'), function ()
	{
		// customers report     : AUTHOR (Akshay Ugale)
		Route::group(array('prefix' => 'customers'), function ()
		{
			$route_slug 	   = 'reports_';

			$module_controller = 'Admin\CustomersReportsManagementController@';

			Route::get('/',							['as' => $route_slug.'index', 							'uses' => $module_controller.'index']);

			Route::get('/load_data_all_user',		['as' => $route_slug.'load_data_all_user',  			'uses' => $module_controller.'load_data_all_user']);
			
			Route::get('/export',					['as' => $route_slug.'export', 							'uses' => $module_controller.'export']);

			Route::get('/load_data_business_user',	['as' => $route_slug.'load_data_business_user',  		'uses' => $module_controller.'load_data_business_user']);

			Route::get('/load_data_consumer_user',	['as' => $route_slug.'load_data_consumer_user',  		'uses' => $module_controller.'load_data_consumer_user']);

		});

		// agents report     : AUTHOR (Akshay Ugale)
		Route::group(array('prefix' => 'agents'), function ()
		{
			$route_slug 	   = 'reports_';

			$module_controller = 'Admin\AgentsReportsManagementController@';

			Route::get('/',							['as' => $route_slug.'index', 							'uses' => $module_controller.'index']);

			Route::get('/load_data',				['as' => $route_slug.'load_data',  						'uses' => $module_controller.'load_data']);		
			
			Route::get('/export',					['as' => $route_slug.'export', 							'uses' => $module_controller.'export']);
		});

		// products report     : AUTHOR (Akshay Ugale)
		Route::group(array('prefix' => 'products'), function ()
		{
			$route_slug 	   = 'reports_';

			$module_controller = 'Admin\ProductsReportsManagementController@';

			Route::get('/',							['as' => $route_slug.'index', 							'uses' => $module_controller.'index']);

			Route::get('/load_data',				['as' => $route_slug.'load_data',  						'uses' => $module_controller.'load_data']);	
			
			Route::get('/load_accessory_data',		['as' => $route_slug.'load_accessory_data',				'uses' => $module_controller.'load_accessory_data']);		
			
			Route::get('/export',					['as' => $route_slug.'export', 							'uses' => $module_controller.'export']);

			Route::get('/export_accessory',			['as' => $route_slug.'export_accessory', 				'uses' => $module_controller.'export_accessory']);
		});

		// sales report     : AUTHOR (Akshay Ugale)
		Route::group(array('prefix' => 'sales'), function ()
		{
			$route_slug 	   = 'reports_';

			$module_controller = 'Admin\SalesReportsManagementController@';

			Route::get('/',							['as' => $route_slug.'index', 							'uses' => $module_controller.'index']);

			Route::get('/load_data',				['as' => $route_slug.'load_data',  						'uses' => $module_controller.'load_data']);		
			
			Route::get('/export',					['as' => $route_slug.'export', 							'uses' => $module_controller.'export']);
		});

		// orders report     : AUTHOR (Akshay Ugale)
		Route::group(array('prefix' => 'orders'), function ()
		{
			$route_slug 	   = 'reports_';

			$module_controller = 'Admin\OrdersReportsManagementController@';

			Route::get('/',							['as' => $route_slug.'index', 							'uses' => $module_controller.'index']);

			Route::post('/get_orders',				['as' => $route_slug.'get_orders',  					'uses' => $module_controller.'get_orders']);		
			
			Route::post('/export_orders',			['as' => $route_slug.'export_orders', 					'uses' => $module_controller.'export_orders']);
		});

		// promo code report     : AUTHOR (Akshay Ugale)
		Route::group(array('prefix' => 'promo_code'), function ()
		{
			$route_slug 	   = 'reports_';

			$module_controller = 'Admin\PromoCodesReportsManagementController@';

			Route::get('/',							['as' => $route_slug.'index', 							'uses' => $module_controller.'index']);

			Route::get('/load_data',				['as' => $route_slug.'load_data',  						'uses' => $module_controller.'load_data']);		
			
			Route::get('/export',					['as' => $route_slug.'export', 							'uses' => $module_controller.'export']);
		});
		
		// discount report     : AUTHOR (Akshay Ugale)
		Route::group(array('prefix' => 'discount'), function ()
		{
			$route_slug 	   = 'reports_';

			$module_controller = 'Admin\DiscountReportsManagementController@';

			Route::get('/',							['as' => $route_slug.'index', 							'uses' => $module_controller.'index']);

			Route::get('/load_data',				['as' => $route_slug.'load_data',  						'uses' => $module_controller.'load_data']);		
			
			Route::get('/export',					['as' => $route_slug.'export', 							'uses' => $module_controller.'export']);
		});

		// evaluation report     : AUTHOR (Akshay Ugale)
		Route::group(array('prefix' => 'evaluation'), function ()
		{
			$route_slug 	   = 'reports_';

			$module_controller = 'Admin\EvaluationReportsManagementController@';

			Route::get('/',							['as' => $route_slug.'index', 							'uses' => $module_controller.'index']);

			Route::get('/load_data',				['as' => $route_slug.'load_data',  						'uses' => $module_controller.'load_data']);		
			
			Route::get('/export',					['as' => $route_slug.'export', 							'uses' => $module_controller.'export']);
		});

		// analytics report     : AUTHOR (Akshay Ugale)
		Route::group(array('prefix' => 'analytics'), function ()
		{
			$route_slug 	   = 'reports_';

			$module_controller = 'Admin\AnalyticsReportsManagementController@';

			Route::get('/',							['as' => $route_slug.'index', 							'uses' => $module_controller.'index']);
		});
	});
	Route::group(array('prefix' => 'settings'), function ()
	{
		Route::group(array('prefix' => 'customer_groups'), function ()
		{
			$route_slug 	   = 'customer_groups_';

			$module_controller = 'Admin\CustomerGroupsController@';

			Route::get('/',								['as' => $route_slug.'index', 		   				'uses' => $module_controller.'index']);

			Route::get('/load_data',					['as' => $route_slug.'load_data',  	  				'uses' => $module_controller.'load_data']);
			
			Route::post('/add_group',					['as' => $route_slug.'add_group',  	  				'uses' => $module_controller.'add_group']);

			Route::get('/get_group_data/{id}',			['as' => $route_slug.'get_group_data',  	  		'uses' => $module_controller.'get_group_data']);

			Route::any('/edit_group',					['as' => $route_slug.'edit_group',  	  			'uses' => $module_controller.'edit_group']);
		
			Route::any('/delete_group/{id}',			['as' => $route_slug.'delete_group',  	  			'uses' => $module_controller.'delete_group']);
			
		});



		Route::group(array('prefix' => 'countries'), function ()
		{
			$route_slug 	   = 'countries_';

			$module_controller = 'Admin\CountryController@';

			Route::get('/',								['as' => $route_slug.'index', 		   				'uses' => $module_controller.'index']);

			Route::get('/load_data',					['as' => $route_slug.'load_data',  	  				'uses' => $module_controller.'load_data']);
			
			Route::post('/add_country',					['as' => $route_slug.'add_country',  	  			'uses' => $module_controller.'add_country']);

			Route::get('/get_country_data/{id}',		['as' => $route_slug.'get_country_data',  	  		'uses' => $module_controller.'get_country_data']);

			Route::any('/edit_country',					['as' => $route_slug.'edit_country',  	  			'uses' => $module_controller.'edit_country']);
		
			Route::any('/delete_country/{id}',			['as' => $route_slug.'delete_country',  	  		'uses' => $module_controller.'delete_country']);

			Route::any('/block/{id}',					['as' => $route_slug.'block',  	  					'uses' => $module_controller.'block']);
			
			Route::any('/unblock/{id}',					['as' => $route_slug.'unblock',  	  				'uses' => $module_controller.'unblock']);
			
		});

		Route::group(array('prefix' => 'cities'), function ()
		{
			$route_slug 	   = 'cities_';

			$module_controller = 'Admin\CitiesController@';

			Route::get('/',								['as' => $route_slug.'index', 		   				'uses' => $module_controller.'index']);

			Route::get('/load_data',					['as' => $route_slug.'load_data',  	  				'uses' => $module_controller.'load_data']);
			
			Route::post('/add_city',					['as' => $route_slug.'add_city',  	  				'uses' => $module_controller.'add_city']);

			Route::get('/get_city_data/{id}',			['as' => $route_slug.'get_city_data',  	  			'uses' => $module_controller.'get_city_data']);

			Route::any('/edit_city',					['as' => $route_slug.'edit_city',  	  				'uses' => $module_controller.'edit_city']);
		
			Route::any('/delete_city/{id}',				['as' => $route_slug.'delete_city',  	  			'uses' => $module_controller.'delete_city']);
			
			Route::any('/block/{id}',					['as' => $route_slug.'block',  	  					'uses' => $module_controller.'block']);
			
			Route::any('/unblock/{id}',					['as' => $route_slug.'unblock',  	  				'uses' => $module_controller.'unblock']);
			
			Route::any('/get_aramexcity_data/{id}',		['as' => $route_slug.'get_aramexcity_data',  	  	'uses' => $module_controller.'get_aramexcity_data']);
			
		});

		Route::group(array('prefix' => 'delivery'), function ()
		{
			$route_slug 	   = 'delivery_';

			$module_controller = 'Admin\DeliveryController@';

			Route::get('/',								['as' => $route_slug.'index', 		   				'uses' => $module_controller.'index']);

			Route::get('/load_data',					['as' => $route_slug.'load_data',  	  				'uses' => $module_controller.'load_data']);
			
			Route::get('/get_data/{id}',				['as' => $route_slug.'get_data',  	  				'uses' => $module_controller.'get_data']);

			Route::any('/edit_delivery',				['as' => $route_slug.'edit_delivery',  	  			'uses' => $module_controller.'edit_delivery']);
		
			Route::any('/delete_city/{id}',				['as' => $route_slug.'delete_city',  	  			'uses' => $module_controller.'delete_city']);
			
		});

		Route::group(array('prefix' => 'pickup_points'), function ()
		{
			$route_slug 	   = 'deliverypickup_points_';

			$module_controller = 'Admin\DeliveryPickupPointController@';

			Route::get('/',								['as' => $route_slug.'index', 		   				'uses' => $module_controller.'index']);

			Route::get('/load_data',					['as' => $route_slug.'load_data',  	  				'uses' => $module_controller.'load_data']);
			
			Route::get('/get_data',						['as' => $route_slug.'get_data',  	  				'uses' => $module_controller.'get_data']);
			
			Route::get('/get_point_data/{id}',			['as' => $route_slug.'get_point_data',	  			'uses' => $module_controller.'get_point_data']);

			Route::any('/add_pickup_point',				['as' => $route_slug.'add_pickup_point',  	  		'uses' => $module_controller.'add_pickup_point']);
			
			Route::any('/edit_pickup_point',			['as' => $route_slug.'edit_pickup_point',  	  		'uses' => $module_controller.'edit_pickup_point']);
		
			Route::any('/delete_point/{id}',			['as' => $route_slug.'delete_point',  	  			'uses' => $module_controller.'delete_point']);
			
		});

		Route::group(array('prefix' => 'vat'), function ()
		{
			$route_slug 	   = 'vat_';

			$module_controller = 'Admin\VatController@';

			Route::get('/',								['as' => $route_slug.'index', 		   				'uses' => $module_controller.'index']);

			Route::post('/update_vat/{id}',				['as' => $route_slug.'update_vat', 		   			'uses' => $module_controller.'update_vat']);

		});
		
	});

	
	Route::group(array('prefix' => 'content'), function ()
	{
		$route_slug 	   = 'content_';

		$module_controller = 'Admin\ContentController@';

		Route::get('/',								['as' => $route_slug.'index', 		   				'uses' => $module_controller.'index']);

		Route::get('/load_data',					['as' => $route_slug.'load_data',  	  				'uses' => $module_controller.'load_data']);
		
		Route::get('/add_content',					['as' => $route_slug.'add_content',  	  			'uses' => $module_controller.'add_content']);
		
		Route::post('/store_content',				['as' => $route_slug.'store_content',	  			'uses' => $module_controller.'store_content']);

		Route::get('/edit_content/{id}',			['as' => $route_slug.'edit_content',	  	  		'uses' => $module_controller.'edit_content']);
		
		Route::post('/update_content/{id}',		    ['as' => $route_slug.'update_content',  	  		'uses' => $module_controller.'update_content']);
	
		Route::any('/delete_content/{id}',			['as' => $route_slug.'delete_content',  	  		'uses' => $module_controller.'delete_content']);
		
	});
	
		Route::group(array('prefix' => 'email_templates'), function ()
	{
		$route_slug 	   = 'email_templates_';

		$module_controller = 'Admin\EmailTemplateController@';

		Route::get('/',								['as' => $route_slug.'index', 		   				'uses' => $module_controller.'index']);

		Route::get('/load_data',					['as' => $route_slug.'load_data',  	  				'uses' => $module_controller.'load_data']);
		
		Route::get('/add_email_template',			['as' => $route_slug.'add_email_template',  	  	'uses' => $module_controller.'add_email_template']);
		
		Route::post('/store_email_template',		['as' => $route_slug.'store_email_template',	  	'uses' => $module_controller.'store_email_template']);

		Route::get('/edit_email_template/{id}',		['as' => $route_slug.'edit_email_template',	  	  	'uses' => $module_controller.'edit_email_template']);
		
		Route::post('/update_email_template/{id}',  ['as' => $route_slug.'update_email_template',  	  	'uses' => $module_controller.'update_email_template']);
	
		Route::any('/delete_email_template/{id}',	['as' => $route_slug.'delete_email_template',  	  	'uses' => $module_controller.'delete_email_template']);
		
	});
});



