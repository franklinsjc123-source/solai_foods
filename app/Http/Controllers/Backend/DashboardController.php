<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\DirectOrder;
use App\Models\DeliveryPerson;
use App\Models\Product;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $customer_count             = User::where('auth_level', 3)->where('status', 1)->count();
        $order_count                = Order::count();
        $product_count              = Product::count();
        $today_order_count          = Order::whereDate('created_at',  Carbon::today())->count();
        $direct_order_count         = DirectOrder::count();
        $today_direct_order_count   = DirectOrder::whereDate('created_at',  Carbon::today())->count();
        $delivert_person_count      = DeliveryPerson::where('status', 1)->count();
        $shop_count                 = 0; // Removed shop concept

        $categoryData = DB::table('category')
            ->leftJoin('products', 'products.category', '=', 'category.id')
            ->select(
                'category.id',
                'category.category_name',
                DB::raw('COUNT(DISTINCT products.id) as product_count')
            )
            ->groupBy('category.id', 'category.category_name')
            ->get();

        $categoryLabels = [];
        $productCounts = [];
        $shopCounts = []; // Placeholder to avoid breaking view compact

        foreach ($categoryData as $row) {
            $categoryLabels[] = $row->category_name;
            $productCounts[] = $row->product_count;
            $shopCounts[] = 0;
        }


        return view('backend.dashboard', compact('customer_count', 'order_count', 'delivert_person_count', 'direct_order_count', 'today_direct_order_count', 'today_order_count', 'categoryLabels', 'shopCounts', 'productCounts', 'product_count', 'shop_count'));
    }

    public function privacy_policy()
    {
        return view('privacy-policy');
    }

    public function account_deletion()
    {
        return view('account-deletion');
    }

    public function post_account_deletion(Request $request)
    {
        $request->validate([
            'mobile' => 'required|numeric|digits:10',
        ]);

        $user = User::where('mobile', $request->mobile)->first();

        if ($user) {
            $user->delete();
            return redirect()->back()->with('success', 'Your account and associated data have been permanently deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'No account found with the provided mobile number.');
        }
    }

    public function checkNewOrders(Request $request)
    {
        // Only allow auth_level 1 (Super Admin) and 2 (presumably Admin/Manager)
        if (!in_array(Auth::user()->auth_level, [1, 2])) {
            return response()->json(['status' => 'no_access']);
        }

        $last_direct_id = $request->input('last_direct_id', 0);
        $last_order_id = $request->input('last_order_id', 0);
        
        $direct_query = DirectOrder::query();
        $order_query = Order::query();

        if ($last_direct_id == -1 || $last_order_id == -1) {
            return response()->json([
                'status' => 'init', 
                'latest_direct_id' => $direct_query->max('id') ?? 0,
                'latest_order_id' => $order_query->max('id') ?? 0
            ]);
        }

        $new_direct = $direct_query->where('id', '>', $last_direct_id)->get();
        $new_orders = $order_query->where('id', '>', $last_order_id)->get();

        if ($new_direct->count() > 0 || $new_orders->count() > 0) {
            return response()->json([
                'status' => 'new', 
                'latest_direct_id' => $new_direct->max('id') ?? $last_direct_id,
                'latest_order_id' => $new_orders->max('id') ?? $last_order_id,
                'direct_count' => $new_direct->count(),
                'order_count' => $new_orders->count()
            ]);
        }
        return response()->json(['status' => 'no_new']);
    }
}
