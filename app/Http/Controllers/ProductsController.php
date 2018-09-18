<?php

namespace App\Http\Controllers;

use App\Company;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->per_page;
        $query = Product::query();
        if($keyword = $request->keyword){
            $query->where(function($query) use ($keyword){
                $query->orWhere('name','like',"%$keyword%")
                    ->orWhere('chinese_name','like',"%$keyword%")
                    ->orWhere('english_name','like',"%$keyword%")
                    ->orWhere('cas','like',"%$keyword%");
            });
        }
        $products = $query->paginate($perPage);

        $data = [
            'products' => $products,
            'keyword' => $keyword ? $keyword : null
        ];
        return view('products.index',$data);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $data = [
            'product' => $product,
            'category' => $product->category,
            'class' =>  $product->category->productClass,
            'warehouse' =>  $product->category->productClass->warehouse,
        ];
        return view('products.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
