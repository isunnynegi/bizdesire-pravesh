<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(15);
        return view('admin.product.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'sku' => 'required',
            'description' => 'required'
        ]);

        $postArr = $request->all();

        $product = new Product;
        $product->name = $postArr['name'];
        $product->sku = $postArr['sku'];
        $product->price = $postArr['price'];
        $product->description = $postArr['description'];
        $product->is_fullfillable = isset($postArr['is_fullfillable']) ? 1 : 0;

        if($product->save()){
        $message = "Product saved succesfully";
        } else {
        $message = "Unable to save product.";
        }

        return redirect()->route('admin.product_index', [], 201)->with(['status'=> $message]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if(isset($id) && !empty($id)){
            $product = Product::find($id);
            // dd($product);
            if(isset($product) && !empty($product)){
                return view('admin.product.edit',['product'=>$product]);
            } else {
                return redirect()->route('admin.product_index', [], 500)->with(['status'=> "Product not found"]);
            }
        } else{
            return redirect()->route('admin.product_index', [], 500)->with(['status'=> "Product not found"]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if(isset($id) && !empty($id)){
            $product = Product::find($id);
            if(isset($product) && !empty($product)){
            $this->validate($request, [
                'name' => 'required',
                'price' => 'required',
                'sku' => 'required',
                'description' => 'required'
            ]);

            $postArr = $request->all();

            $product->name = $postArr['name'];
            $product->sku = $postArr['sku'];
            $product->price = $postArr['price'];
            $product->description = $postArr['description'];
            $product->is_fullfillable = isset($postArr['is_fullfillable']) ? 1 : 0;

            if($product->save()){
                $message = "Product edit succesfully";
            } else {
                $message = "Unable to edit product.";
            }

            return redirect()->route('admin.product_index', [], 201)->with(['status'=> $message]);
            } else {
                return redirect()->route('admin.product_index', [], 422)->with(['status'=> "product Not Found"]);
            }
        } else {
            return redirect()->route('admin.product_index', [], 422)->with(['status'=> "product Not Found"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if(isset($id) && !empty($id)){
            $product = Product::find($id);
            if(isset($product) && !empty($product)){
                $product->delete();
                return redirect()->route('admin.product_index', [], 201)->with(['status'=> "Product deleted"]);
            } else {
                return redirect()->route('admin.product_index', [], 500)->with(['status'=> "Product not found"]);
            }
        } else{
            return redirect()->route('admin.product_index', [], 500)->with(['status'=> "Product not found"]);
        }
    }
}
