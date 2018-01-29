<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
	$products = Product::all()->toArray();
	return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
	return view('products.create');
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
	$product = $this->validate(request(), [
		'name' => 'required', 
		'price' => 'required|numeric'
	]);
	
	Product::create($product);
	
	return back()->with('success', 'Product has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
	//dd($product->id);
	$id = $product->id;
	// $product = Product::find($id);
	return view('products.edit', compact('product', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //

	$this->validate(request(), [
		'name' => 'required', 
		'price' => 'required|numeric' 
	]);

	$product->name = $request->get('name');
	$product->price = $request->get('price');
	$product->updated_at = Carbon::now();
	//dd($product);exit;
	
	$product->save();
	return redirect('products')->with('success', 'Product has been updated');

	
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
	
	$product->delete();
	return redirect('products')->with('success', 'Product has been deleted');
    }
}
