<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WarehousesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->per_page;
        $warehouses = Warehouse::all();

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
            'warehouses' => $warehouses,
            'products' => $products,
            'keyword' => $keyword ? $keyword : null
        ];
//        dd($data);

        return view('admin.warehouses.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('warehouses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Warehouse::create([
            'name' => $request->name
        ]);
       return $this->success('添加成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Warehouse $warehouse)
    {
        return view('warehouses.show',['warehouse' => $warehouse]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Warehouse $warehouse)
    {
        return view('warehouses.edit',['warehouse' => $warehouse]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Warehouse $warehouse)
    {
        $warehouse->name = $request->name;
        $warehouseUpdate = $warehouse->save();
        if($warehouseUpdate){
            return $this->successWithData($warehouse->fresh(),'更新成功');
        }
        return $this->fail('更新失败');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Warehouse $warehouse)
    {

        if($warehouse->delete()){
            return $this->success('删除成功');
        }
        return $this->fail('删除失败');

    }
}
