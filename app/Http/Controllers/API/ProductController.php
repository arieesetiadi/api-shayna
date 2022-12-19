<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->id;
        $limit = $request->limit ?? 6;
        $name = $request->name;
        $slug = $request->slug;
        $type = $request->type;
        $priceFrom = $request->price_from;
        $priceTo = $request->price_to;

        $product = Product::with('galleries');

        if ($id) {
            $product = $product->findOrFail($id);

            if ($product)
                return ResponseFormatterController::success($product, 'Berhasil mengambil data produk');
            else
                return ResponseFormatterController::error(null, 'Gagal mengambil data produk', 404);
        }

        if ($slug) {
            $product = $product->where('slug', $slug)->first();

            if ($product)
                return ResponseFormatterController::success($product, 'Berhasil mengambil data produk');
            else
                return ResponseFormatterController::error(null, 'Gagal mengambil data produk', 404);
        }

        if ($name) {
            $product->where('name', 'like', '%' . $name . '%');
        }

        if ($type) {
            $product->where('type', 'like', '%' . $type . '%');
        }

        if ($priceFrom) {
            $product->where('price', '>=',  $priceFrom);
        }

        if ($priceTo) {
            $product->where('price', '<=',  $priceTo);
        }

        return ResponseFormatterController::success($product->paginate($limit), 'Berhasil mengambil data produk');
    }
}
