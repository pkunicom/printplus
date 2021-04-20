<?php



use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;



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



	Route::group(array('prefix' => ''), function ()

	{

		//before user login route

		$module_controller = 'Api\AuthController@';

	

		// customer login    : AUTHOR (Akshay Ugale)

		Route::post('/login',										[	'uses' => $module_controller.'login'					]);



        Route::post('/login_staff',										[	'uses' => $module_controller.'login_staff'					]);

        

		// customer registration    : AUTHOR (Akshay Ugale)

		Route::post('/registration',								[	'uses' => $module_controller.'registration'				]);



		// customer forget password    : AUTHOR (Akshay Ugale)

		Route::post('/forgot_password',								[	'uses' => $module_controller.'forgot_password'			]);



		// customer logout    : AUTHOR (Akshay Ugale)

		Route::get('/logout',										[	'uses' => $module_controller.'logout'					]);



		// customer forget password    : AUTHOR (Akshay Ugale)

		Route::get('/verify_user/{email}/{token}',					[	'uses' => $module_controller.'verify_user'				]);



		// Check Token   : AUTHOR (Harsh chauhan)

		Route::post('/check_token',									[	'uses' => $module_controller.'check_token'				]);



		//Ser forget password   : AUTHOR (Harsh chauhan)

		Route::post('/set_forget_password',									[	'uses' => $module_controller.'set_forget_password'				]);



		// All common API's 

		$module_controller = 'Api\CommonDataController@';



		//Categories listing

		Route::get('/get_category',									[	'uses' => $module_controller.'get_category'				]);		

		Route::post('/get_signature',							[	'uses' => $module_controller.'requestSignature']				);

		//Sub Categories listing

		Route::post('/get_subcategory',								[	'uses' => $module_controller.'get_subcategory'			]);		



		//Options listing

		Route::get('/get_options',									[	'uses' => $module_controller.'get_options'			]);		



		//Sub Options listing

		Route::post('/get_suboptions',								[	'uses' => $module_controller.'get_suboptions'		]);		



		//Get header product listing

		Route::post('/get_headerproducts',							[	'uses' => $module_controller.'get_headerproducts'		]);



		//Country Code listing for Mobile No    : AUTHOR (Akshay Ugale)

		Route::get('/get_country_code',								[	'uses' => $module_controller.'get_country_code'			]);

		

		//System Country listing   : AUTHOR (Akshay Ugale)

		Route::post('/get_system_country',							[	'uses' => $module_controller.'get_system_country'		]);		

		

		//System City listing   : AUTHOR (Akshay Ugale)

		Route::post('/get_system_city',								[	'uses' => $module_controller.'get_system_city'			]);		

		

		//Homepage reviews 

		Route::get('/get_homepage_reviews',							[	'uses' => $module_controller.'get_homepage_reviews'		]);		



		//Homepage reviews 

		Route::post('/get_pickup_points',							[	'uses' => $module_controller.'get_pickup_points'		]);		



		$module_controller = 'Api\FrontPagesController@';



		//Front Pages listing

		Route::post('/get_front_pages',								[	'uses' => $module_controller.'get_front_pages'			]);	



		$module_controller = 'Api\ContactUsController@';



		//Contactus

		Route::post('/contact_us',									[	'uses' => $module_controller.'contact_us'				]);	





		$module_controller = 'Api\ProductsController@';



		//Product listing

		Route::post('/productlisting',								[	'uses' => $module_controller.'productlisting'	]);	

		

		//Home page Product listing limit 6

		Route::any('/homepage_productlisting',						[	'uses' => $module_controller.'homepage_productlisting'	]);	



		//Product details

		Route::post('/productdetails',								[	'uses' => $module_controller.'productdetails'			]);	



		//Product Combination price

		Route::post('/productprice',								[	'uses' => $module_controller.'productprice'	]);	



		//Product city installation price

		Route::post('/productcity_installation',					[	'uses' => $module_controller.'productcity_installation'	]);	



		//Get discount details

		Route::post('/get_discount_details',						[	'uses' => $module_controller.'get_discount_details'	]);	



		$module_controller = 'Api\CartController@';



		//Add to cart

		Route::post('/add_to_cart',									[	'uses' => $module_controller.'add_to_cart'	]);	



		//cart listing

		Route::post('/get_cart_listing',							[	'uses' => $module_controller.'get_cart_listing'	]);	

		

		// Delete a cart item

		Route::any('/delete_cart_item',								[	'uses' => $module_controller.'delete_cart_item'	]);	

		

		// update a cart item

		Route::any('/update_cart_quantity',							[	'uses' => $module_controller.'update_cart_quantity'	]);	



	});



	//after user login route 

	Route::group(array('prefix' => 'user','middleware' => 'api_user_auth_check'), function ()

	{

		$module_controller = 'Api\User\CustomersController@';



		// change account password    : AUTHOR (Harsh Chauhan)

		Route::post('/update_account_password',						[	'uses' => $module_controller.'change_password'			]);



		// change account password    : AUTHOR (Harsh Chauhan)

		Route::post('/check_old_password',							[	'uses' => $module_controller.'check_old_password'			]);



		// get profile detail    : AUTHOR (Akshay Ugale)

		Route::post('/profile_detail',								[	'uses' => $module_controller.'profile_detail'			]);

		

		//dashboard data    : AUTHOR (Akshay Ugale)

		Route::post('/dashboard_data',								[	'uses' => $module_controller.'dashboard_data'			]);



		// Get Customer all orders    : AUTHOR (Akshay Ugale)

		Route::post('/my_orders',									[	'uses' => $module_controller.'my_orders'				]);



		// Get all items    : AUTHOR (Akshay Ugale)

		Route::post('/items_view',									[	'uses' => $module_controller.'items_view'				]);



		// Get account detail to edit it    : AUTHOR (Akshay Ugale)

		Route::post('/account_setting',								[	'uses' => $module_controller.'account_setting'			]);



		// Update account detail    : AUTHOR (Akshay Ugale)

		Route::post('/update_account_setting',						[	'uses' => $module_controller.'update_account_setting'	]);



		// customer all addresses    : AUTHOR (Akshay Ugale)

		Route::post('/get_addresses',								[	'uses' => $module_controller.'get_addresses'			]);



		// add customer new  addresse    : AUTHOR (Akshay Ugale)

		Route::post('/store_address',								[	'uses' => $module_controller.'store_address'			]);



		// edit addresse    : AUTHOR (Akshay Ugale)

		Route::post('/edit_address',								[	'uses' => $module_controller.'edit_address'				]);



		// update addresse    : AUTHOR (Akshay Ugale)

		Route::post('/update_address',								[	'uses' => $module_controller.'update_address'			]);



		// delete addresses    : AUTHOR (Akshay Ugale)

		Route::post('/delete_address',								[	'uses' => $module_controller.'delete_address'			]);

    

        // Get address details    : AUTHOR (HArsh Chauhan)

		Route::post('/get_address_details',							[	'uses' => $module_controller.'get_address_details'			]);

    

		//refer & earn page data :AUTHOR (Akshay Ugale)

		Route::post('/refer-earn',									[	'uses' => $module_controller.'refer_earn'				]);

		

		// edit addresse    : AUTHOR (Harsh Chauhan)

		Route::post('/edit_profile_image',							[	'uses' => $module_controller.'edit_profile_image'		]);

		

	});





	Route::group(array('prefix' => 'aramex'), function ()

	{

		$module_controller = 'Api\AramexController@';



		// Calculate rate    : AUTHOR (Harsh Chauhan)

		Route::post('/calculate_rate',								[	'uses' => $module_controller.'calculate_rate'			]);

		

	});

	

	Route::group(array('prefix' => 'order','middleware' => 'api_user_auth_check'), function ()

	{

		$module_controller = 'Api\OrderManagementController@';



		// Calculate rate    : AUTHOR (Harsh Chauhan)

		Route::get('/promocode_listing',								[	'uses' => $module_controller.'promocode_listing'			]);

		

		Route::post('/validate_promocode',								[	'uses' => $module_controller.'validate_promocode'			]);

		

		Route::post('/payment_response',								[	'uses' => $module_controller.'payment_response'			]);

		

		Route::any('/payment_request',								    [	'uses' => $module_controller.'payment_request'			]);

		

		Route::post('/update_item_status',									[	'uses' => $module_controller.'update_item_status'				]);



		Route::post('/get_order_item',									[	'uses' => $module_controller.'get_order_item'				]);



		Route::get('/orders_list',									[	'uses' => $module_controller.'orders_list'				]);
		Route::post('/save_order',									[	'uses' => $module_controller.'save_order'				]);		

	});



	

	





	









Route::middleware('auth:api')->get('/user', function (Request $request) {

    return $request->user();

});

Route::group(["prefix" => "/payfort"], function() {
  
  	//Route::view('/', 'payfort');
  	Route::get('/requestSignature',['uses'=>'Api\PayfortController@requestSignature','as'=>'payfort.requestSignature']);
//   	Route::get('/request',['uses'=>'Api\PayfortController@request','as'=>'payfort.request']);
	Route::post('/callback',['uses'=>'Api\PayfortController@callback','as'=>'payfort.callback']);
});



//Endpoints for Payfort Payment Gateway : AUTHOR(Ankush Gazta)

// Route::group(["prefix" => "/payfort",'middleware' => 'api_user_auth_check'], function() {

//     Route::get('/request', ['uses'=>'PayfortController@request','as'=>'payfort.request']);

//     Route::post('/redirect', ['uses'=>'PayfortController@redirect','as'=>'payfort.redirect']);

//     Route::post('/test', ['uses'=>'PayfortController@test','as'=>'payfort.test']);

// });

