<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ApiController extends Controller
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

        return response()->json([
            'success' => true,
            'data' => $products,
        ]);
    }


    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found',
            ], 404);
        }

        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully',
        ]);
    }
}
