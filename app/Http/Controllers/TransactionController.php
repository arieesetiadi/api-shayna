<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['transactions'] = Transaction::with('detail')->orderByDesc('id')->get();
        return view('pages.transactions.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['transaction'] = Transaction::with('detail.product')->findOrFail($id);

        return view('pages.transactions.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['transaction'] = Transaction::findOrFail($id);
        return view('pages.transactions.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $transaction = Transaction::findOrFail($id);
        $transaction->update($data);

        return redirect()->route('transaction.index')->with('message', [
            'status' => 'success',
            'body' => 'Berhasil mengubah data transaksi 👍'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return redirect()->route('transactions.index')->with('message', [
            'status' => 'success',
            'body' => 'Berhasil menghapus data transaksi 👍'
        ]);
    }

    public function setStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:SUCCESS,PENDING,FAILED'
        ]);

        $transaction = Transaction::findOrFail($id);
        $transaction->update(['transaction_status' => $request->status]);

        return redirect()->route('transactions.index')->with('message', [
            'status' => 'success',
            'body' => 'Berhasil mengubah status transaksi 👍'
        ]);
    }
}
