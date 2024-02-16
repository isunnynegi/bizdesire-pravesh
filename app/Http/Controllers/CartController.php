<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Cart, CartDetail, Product};
use Auth;
use DB;

class CartController extends Controller
{
    function addtocart(Request $request, string $id ){

        $userId = Auth::user()->id;
        try {
            if(isset($id) && !empty($id)){
                /**
                 * check product exists or not
                 */
                $product = Product::findOrFail($id);

                DB::beginTransaction();
                if($product){
                    $cart = Cart::firstOrCreate([
                        'user_id' => $userId
                    ],[
                        'subtotal' => 0,
                        'total' => 0
                    ]);


                    $cartDetail = CartDetail::firstOrNew([
                        'cart_id' => $cart->id,
                        'product_id' => $product->id
                    ]);

                    if($cartDetail->exists()){
                        $cartDetail->qty = $cartDetail->qty + 1;
                    } else {
                        $cartDetail->qty = 1;
                    }
                    $cartDetail->price = $product->price;
                    $cartDetail->save();

                    $cartDetail = CartDetail::where('cart_id',$cart->id)->get();

                    if(isset($cartDetail) && !empty($cartDetail)){
                        $productstotal = $cartDetail->reduce(function ($total,$value,$key) {
                            return $total + ($value['qty'] * $value['price']);
                        });

                        $cart = Cart::findOrFail($cart->id);
                        $cart->subtotal = $productstotal;
                        $cart->total = $productstotal;
                        $cart->save();

                        DB::commit();
                        return redirect()->back()->with('success', 'Product Added.');
                    } else {
                        throw new Exception("No item not found in cart.", 422);    
                    }
                    
                } else {
                    throw new Exception("Product not found.", 422);    
                }
            } else {
                throw new Exception("Not a valid request.", 422);    
            }
        } catch (\Exception $e) {
            //throw $th;
            DB::rollBack();
            $message = $e->getMessage();
            dd($message);
            return redirect()->back()->with('error',$message);
        }
    }
}
