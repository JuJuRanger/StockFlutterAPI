<?php

namespace App\Http\Controllers\API;

// use App\Http\Controllers\Controller;
use App\Models\API\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\API\ApibaseController as APIBaseController;

use Illuminate\Support\Facades\Validator; // Validator

// class ProductController extends Controller
class ProductController extends APIBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();
        return $this->sendResponse($product->toArray(), 'Product get Success.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_name'      => 'required',
            'product_barcode'   => 'required',
            'product_qty'      => 'required',
            'product_price'      => 'required',
            'product_image'      => 'required',
            'product_category'      => 'required',
            'product_status'      => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        } else {
            $product_data = [
                'product_name' => $request->product_name,
                'product_detail' => $request->product_detail,
                'product_barcode' => $request->product_barcode,
                'product_qty' => $request->product_qty,
                'product_price' => $request->product_price,
                'product_image' => $request->product_image,
                'product_category' => $request->product_category,
                'product_status' => $request->product_status,
                'created_at' => now(),
            ];

            $products = Product::create($product_data);
            return $this->sendResponse($products->toArray(), 'Product create Success.');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\API\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\API\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\API\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'product_name'      => 'required',
            'product_barcode'   => 'required',
            'product_qty'      => 'required',
            'product_price'      => 'required',
            'product_image'      => 'required',
            'product_category'      => 'required',
            'product_status'      => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        } else {
            $product_data = [
                'product_name' => $request->product_name,
                'product_detail' => $request->product_detail,
                'product_barcode' => $request->product_barcode,
                'product_qty' => $request->product_qty,
                'product_price' => $request->product_price,
                'product_image' => $request->product_image,
                'product_category' => $request->product_category,
                'product_status' => $request->product_status,
                'created_at' => now(),
            ];

            $products = Product::where('id', $product->id)->update($product_data);
            return $this->sendResponse($products, 'Product update Success.');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\API\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $products = Product::where('id', $product->id)->delete();
        return $this->sendResponse($products, 'Product delete Success.');
    }
}
