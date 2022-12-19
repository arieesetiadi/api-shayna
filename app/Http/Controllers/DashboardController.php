<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'income' => Transaction::where('transaction_status', 'SUCCESS')->sum('transaction_total'),
            'sales' => Transaction::count(),
            'transactions' => Transaction::orderByDesc('id')->take(5)->get(),
            'pie' => [
                'success' => Transaction::where('transaction_status', 'SUCCESS')->count(),
                'pending' => Transaction::where('transaction_status', 'PENDING')->count(),
                'failed' => Transaction::where('transaction_status', 'FAILED')->count(),
            ]
        ];

        return view('pages.dashboard', $data);
    }
}
