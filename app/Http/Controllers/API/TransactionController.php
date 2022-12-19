<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function get(Request $request, $id)
    {
        $transaction = Transaction::with('detail.product')->find($id);

        if (!$transaction)
            return ResponseFormatterController::error(null, 'Gagal mengambil data transaksi', 404);

        return ResponseFormatterController::success($transaction, 'Berhasil mengambil data transaksi');
    }
}
