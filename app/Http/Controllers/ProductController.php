<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use App\Http\Requests\ProductRequest;
use App\Models\ProductGallery;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['products'] = Product::with('galleries')->orderByDesc('id')->get();
        return view('pages.products.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = $request->all();
        $product['slug'] = Str::slug($product['name']);

        Product::create($product);

        return redirect()->route('products.index')->with('message', [
            'status' => 'success',
            'body' => 'Berhasil menambah produk baru 👍'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['product'] = Product::find($id);
        return view('pages.products.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();
        $product = Product::find($id);
        $product->update($data);

        return redirect()->route('products.index')->with('message', [
            'status' => 'success',
            'body' => 'Berhasil mengubah data produk 👍'
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
        Product::find($id)->delete();
        ProductGallery::where('product_id', $id)->delete();

        return redirect()->route('products.index')->with('message', [
            'status' => 'success',
            'body' => 'Berhasil menghapus data produk 👍'
        ]);
    }
}
