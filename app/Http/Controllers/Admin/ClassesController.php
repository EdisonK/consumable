<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\ProductClass;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

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

    /*
     * 获取指定仓库的类别
     * vito
     * */
    public function getClassesByWarehouseId(Warehouse $warehouse)
    {
        $data = [
            'classes' =>  $warehouse->classes
        ];
        return $this->successWithData($data,'成功');
    }

    /*
    * 获取指定三级目录的二级目录
    * vito
    * */
    public function getClassesByCategoryId(Category $category)
    {
        $data = [
            'classe' =>   $category->productClass
        ];
        return $this->successWithData($data,'成功');
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
            return $this->success('添加成功');
        }
        return $this->fail('添加失败');
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
    public function edit(ProductClass $class)
    {
        return view('classes.edit',['class' => $class]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductClass $class)
    {
        $class->name = $request->name;
        $classUpdate = $class->save();
        if($classUpdate){
            return $this->successWithData($class->fresh(),'更新成功');
        }
        return  $this->fail('更新失败');
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
            return $this->success('删除成功');
        }
        return $this->fail('删除失败');
    }
}
