<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Cart, CartDetail, Product};
use Auth;
use DB;

class CartController extends Controller
{
    function addtocart(Request $request, string $id ){
        try {
            if(isset($id) && !empty($id)){
                /**
                 * check product exists or not
                 */
                $product = Product::findOrFail($id);

                DB::beginTransaction();
                if($product){
                    /** 
                     * Create Or Get Cart Instance for loggedin User
                     */
                    $cart = $this->getUserCart();

                    /**
                     * Add Or Update Items to the cart
                     */
                    $this->addUpdateCartItems($cart->id, $product);

                    /**
                     * Get Cart items total
                     */
                    $productstotal = $this->getCartProductTotal($cart->id);

                    /**
                     * update cart pricing
                     */
                    $this->updateCart($cart->id, $productstotal);

                    DB::commit();
                    return redirect()->back()->with('success', 'Product Added.');
                    
                } else {
                    throw new Exception("Product not found.", 422);    
                }
            } else {
                throw new Exception("Not a valid request.", 422);    
            }
        } catch (\Exception $e) {
            DB::rollBack();
            $message = $e->getMessage();
            return redirect()->back()->with('error',$message);
        }
    }

    private function getUserCart(){
        $userId = Auth::user()->id;

        $cart = Cart::firstOrCreate([
            'user_id' => $userId,
        ], [
            'subtotal' => 0,
            'total' => 0,
        ]);

        return $cart;

    }

    private function addUpdateCartItems($cartId, $product){
        $cartDetail = CartDetail::firstOrNew([
            'cart_id' => $cartId,
            'product_id' => $product->id
        ]);

        if($cartDetail->exists()){
            $cartDetail->qty = $cartDetail->qty + 1;
        } else {
            $cartDetail->qty = 1;
        }
        $cartDetail->price = $product->price;
        $cartDetail->save();
    }

    private function getCartProductTotal($cartId){
        $cartDetail = CartDetail::where('cart_id', $cartId)->get();

        if (isset($cartDetail) && !empty($cartDetail)) {
            $productstotal = $cartDetail->reduce(function ($total, $value, $key) {
                return $total + ($value['qty'] * $value['price']);
            });

           return $productstotal;
        } else {
            throw new Exception("No item not found in cart.", 422);
        }
    }

    private function updateCart($cartId, $productstotal){
        $cart = Cart::findOrFail($cartId);
        $cart->subtotal = $productstotal;
        $cart->total = $productstotal;
        $cart->save();
    }
}