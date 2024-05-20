<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function index(Request $request)
    {

        $query = Transactions::query();
        $dateFilter = $request->date_filter;

        switch($dateFilter){
            case 'today':
                $query->whereDate('created_at',Carbon::today());
                break;
            case 'yesterday':
                $query->wheredate('created_at',Carbon::yesterday());
                break;
            case 'this_week':
                $query->whereBetween('created_at',[Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()]);
                break;
            case 'last_week':
                $query->whereBetween('created_at',[Carbon::now()->subWeek(),Carbon::now()]);
                break;
            case 'this_month':
                $query->whereMonth('created_at',Carbon::now()->month);
                break;
            case 'last_month':
                $query->whereMonth('created_at',Carbon::now()->subMonth()->month);
                break;
            case 'this_year':
                $query->whereYear('created_at',Carbon::now()->year);
                break;
            case 'last_year':
                $query->whereYear('created_at',Carbon::now()->subYear()->year);
                break;
        }


        $transactions = $query->with('user')->get();
        // dd($transactions);
        // $transactions = Transactions::with('user')->get();
        $totalTransactions = $query->sum('amount');
        $totalFlutterwave = $query->where('payment_method', 'flutterwave')->sum('amount');
        $totalPaystack = $query->where('payment_method', 'paystack')->sum('amount');
        return view('dashboard', compact('transactions', 'totalTransactions', 'totalFlutterwave', 'totalPaystack', 'dateFilter'));
    }
}
