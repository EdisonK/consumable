<?php

namespace App\Http\Controllers;

use App\Models\ProductClass;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Warehouse $warehouse = null)
    {
        $warehouses = null;
        if(!$warehouse){
            $warehouses = Warehouse::get();
        }

        return view('classes.create',['warehouse'=>$warehouse, 'warehouses'=>$warehouses]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productClass = ProductClass::create([
            'name' => $request->name ? $request->name : null,
            'warehouse_id' => $request->warehouse_id
        ]);
        if($productClass){
            return redirect()->route('classes.show', ['class'=> $productClass])
                ->with('success' , '二级分类创建成功！');
        }
        return back()->withInput()->with('errors', '二级分类创建失败');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ProductClass $class)
    {
        return view('classes.show',['class' => $class]);
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
    public function destroy(ProductClass $class)
    {
        if($class->delete()){
            return redirect()->route('warehouses.show',['warehouse' => $class->warehouse])
                ->with('success' , '二级分类删除成功');
        }
        return back()->withInput()->with('error' , '二级分类删除失败');
    }
}
