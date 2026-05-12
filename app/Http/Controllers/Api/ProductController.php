<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->paginate(10);
        return $this->sendResponse($products, 'Data produk berhasil diambil');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'internal_note' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Kesalahan Validasi', $validator->errors(), 422);
        }

        $product = Product::create($request->all());
        return $this->sendResponse($product, 'Produk berhasil ditambahkan', 201);
    }

    public function show($id)
    {
        $product = Product::with('category')->find($id);

        if (!$product) {
            return $this->sendError('Produk tidak ditemukan');
        }

        return $this->sendResponse($product, 'Detail produk ditemukan');
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return $this->sendError('Produk tidak ditemukan');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|integer|min:0',
            'stock' => 'sometimes|required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Kesalahan Validasi', $validator->errors(), 422);
        }

        $product->update($request->all());
        return $this->sendResponse($product, 'Produk berhasil diperbarui');
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return $this->sendError('Produk tidak ditemukan');
        }

        $product->delete();
        return $this->sendResponse(null, 'Produk berhasil dihapus');
    }
}