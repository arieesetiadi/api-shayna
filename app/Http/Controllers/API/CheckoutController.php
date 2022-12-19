<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\CheckoutRequest;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout(CheckoutRequest $request)
    {
        $data = $request->except('transaction_details');
        $data['uuid'] = 'TRX' . mt_rand(10000, 99999) . mt_rand(100, 999);

        $transaction = Transaction::create($data);

        foreach ($request->transaction_details as $productId) {
            $details[] = new TransactionDetail([
                'transaction_id' => $transaction->id,
                'product_id' => $productId
            ]);

            Product::find($productId)->decrement('quantity');
        }

        $transaction->detail()->saveMany($details);

        return ResponseFormatterController::success($transaction, 'Berhasil melakukan checkout');
    }
}
