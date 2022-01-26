<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function addProduct(Request $request)
    {
        // validate
        $request->validate([
            "product" => "required:product",
            "description" => "required",
            "productCode" => "required",
            "category" => "required",
            "link" => "required|unique:product",
        ]);

        // create user data + save
        $product = new Product();
        $product->product = $request->product;
        $product->description = $request->description;
        $product->productCode = $request->productCode;
        $product->category = $request->category;
        $product->link = $request->link;
        $product->user_id = auth()->user()->id;
        $product->save();

        // send response
        return response()->json([
            "status" => 1,
            "message" => "Product added successfully",
            "product_id" => $product->id
        ], 200);
    }

    public function getProducts()
    {
        $products = Product::get()->where('user_id', auth()->user()->id);

        return response()->json([
            "status" => 1,
            "message" => "Listing Products",
            "data" => $products
        ], 200);
    }

    public function getSingleProduct($id)
    {
        if (Product::where("id", $id)->exists()) {
            $product_detail = Product::where("id", $id)->first();
            return response()->json([
                "status" => 1,
                "message" => "Product Found",
                "data" => $product_detail
            ], 200);
        } else {
            return response()->json([
                "status" => 0,
                "message" => "Product not found"
            ], 404);
        }
    }

    public function updateProduct(Request $request, $id)
    {
        if (Product::where("id", $id)->exists()) {
            $product = Product::find($id);
            $product->product = !empty($request->product) ? $request->product : $product->product;
            $product->description = !empty($request->description) ? $request->description : $product->description;
            $product->link = !empty($request->link) ? $request->link : $product->link;

            $product->save();

            return response()->json([
                "status" => 1,
                "message" => "Product updated successfully"
            ], 200);
        } else {
            return response()->json([
                "status" => 0,
                "message" => "Product not found"
            ], 404);
        }
    }

    public function deleteProduct($id)
    {
        if (Product::where("id", $id)->exists()) {
            $product = Product::find($id);
            $product->delete();

            return response()->json([
                "status" => 1,
                "message" => "Product successfully deleted"
            ]);
        } else {
            return response()->json([
                "status" => 0,
                "message" => "Product not found"
            ], 404);
        }
    }
}
