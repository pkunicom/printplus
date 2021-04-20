<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\CustomerModel;
use App\Models\OrdersModel;
use DB;

class DashboardController extends Controller
{
	// dashboard index: AUTHOR (Harsh chauhan)
    public function dashboard(Request $request)
    {
    	$total_customer = CustomerModel::where('status','1')->count();
	    $total_today_user = DB::table('customers')->select(DB::raw('*'))
	                  ->whereRaw('Date(created_at) = CURDATE()')->count();
	    $total_order = OrdersModel::count();
	    $total_today_order = DB::table('orders')->select(DB::raw('*'))
	                  ->whereRaw('Date(created_at) = CURDATE()')->count();
		$total_pending_order = OrdersModel::where('printing_status','pending')->count();	                  
        return view('admin.dashboard.index',compact('total_customer','total_today_user','total_order','total_today_order','total_pending_order'));
    }
}