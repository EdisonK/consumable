<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductClass;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.prodocts.index', []);
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
        return view('admin.products.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $class = $product->category->productClass;
        $data = [
            'product' => $product,
            'category' => $product->category,
            'class' =>  $class,
            'warehouse' =>  $class->warehouse,
            'categories' =>  $class->categories,
            'classes' =>  $class->warehouse->classes,
            'warehouses' =>  Warehouse::all()
        ];
//        dd($product->category->productClass->categories->toArray());
        return view('admin.products.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Product $product)
    {
        $this->validate($request,[
            'name' => 'required|string',
            'category_id' => 'required|integer|exists:categories,id'
        ]);
        $product->name = $request->name;
        $product->chinese_name = $request->chinese_name;
        $product->english_name = $request->english_name;
        $product->cas = $request->cas;
        $product->molecular_formula = $request->molecular_formula;
        $product->brand_id = $request->brand_id;
        $product->price = $request->price;
        $product->unit = $request->unit;
        $product->model_type = $request->model_type;
        $product->category_id = $request->category_id;
        $product->unit = $request->unit;
        $product->description = $request->description;
        $res = $product->save();
        if($res){
            return $this->success('成功');
        }else{
            return $this->fail('失败');
        }
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
