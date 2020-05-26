<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\Order;
use App\Models\ProductImage;
use Illuminate\Support\Facades\DB;

use Image;

class PagesController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:admin');
	}

	public function index()
	{
		return view('backend.pages.index');
	}

	public function reporting()
	{

		$products = Product::orderBy('id', 'desc')->get();
		$orders = Order::orderBy('id', 'desc')->get();
		$sql = "SELECT p.title, SUM(c.product_quantity) AS qty, p.price FROM `orders` AS o
					LEFT JOIN carts c ON c.order_id = o.id
					LEFT JOIN products p ON p.id = c.product_id
					LEFT JOIN payments pay on pay.id = o.payment_id
					WHERE pay.created_at BETWEEN '".date('Y-m-d', strtotime('-30 days'))."' AND '".date('Y-m-d')."'
					GROUP BY c.product_id";
		$data = DB::select(DB::raw($sql));
		$result = '<pre>'.print_r($data, true) .'</pre>';
		//return $result;
		return view('backend.pages.reports.reporting',compact('products','orders', 'data'));
	}

}
