<?php

namespace App\Http\Controllers\Api\Kendaraan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Keranjang;
use Illuminate\Support\Facades\Validator;

class cartController extends Controller
{
    // Fetch cart items based on user_id
    public function index($user_id)
    {
        $cartItems = Keranjang::where('user_id', $user_id)->with('kendaraan')->get();
        return response()->json($cartItems, 200);
    }

    // Create a new cart item
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'kendaraan_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $cartItem = Keranjang::create($request->all());
        return response()->json($cartItem, 201);
    }

    // Update a cart item
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $cartItem = Keranjang::find($id);
        if (!$cartItem) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        $cartItem->update($request->all());
        return response()->json($cartItem, 200);
    }

    // Delete a cart item
    public function destroy($id)
    {
        $cartItem = Keranjang::find($id);
        if (!$cartItem) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        $cartItem->delete();
        return response()->json(['message' => 'Item deleted successfully'], 200);
    }
}
