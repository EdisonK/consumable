<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\ProductClass;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /*
     * 获取指定仓库的三级类别
     * vito
     * */
    public function getCategoriesByWarehouseId(Warehouse $warehouse)
    {
        $data = [
            'categories' =>  Category::whereIn('class_id',$warehouse->classes->pluck('id'))->get()
        ];
        return $this->successWithData($data,'成功');
    }

    /*
     * 获取指定二级分类的三级类别
     * vito
     * */
    public function getCategoriesByClassId(ProductClass $class)
    {
        $data = [
            'categories' => $class->categories
        ];
        return $this->successWithData($data,'成功');

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
        $category = Category::create([
            'name' => $request->name ? $request->name : null,
            'class_id' => $request->class_id
        ]);
        if($category){
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
    public function show($id)
    {
        //
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
    public function update(Request $request,Category $category)
    {
        $category->name = $request->name;
        $categoryUpdate = $category->save();
        if($categoryUpdate){
            return $this->successWithData($category->fresh(),'更新成功');
        }
        return  $this->fail('更新失败');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if($category->delete()){
            return $this->success('删除成功');
        }
        return $this->fail('删除失败');
    }
}
