<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $products = Product::where('name', 'LIKE', "%{$query}%")
                ->orWhere('description', 'LIKE', "%{$query}%")
                ->get();
        } else {
            $products = Product::all();
        }

        return view('products.index', compact('products'));
    }

    public function search(Request $request)
    {
        $products = Product::where('name', 'LIKE', "%$request->data%")
            ->orWhere('description', 'LIKE', "%$request->data%")
            ->get();

        return response()->json(['data' => $products]);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->back()->with(['message' => 'Product not found'], 404);
        }
        $product->delete();
        return redirect()->back()->with(['success' => true, 'message' => 'Product deleted successfully']);
    }
}
 