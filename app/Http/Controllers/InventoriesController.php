<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InventoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->validate($request,[
            'per_page' => 'nullable|integer|max:30',
            'keyword' => 'nullable|string'
        ]);
        $perPage = $request->per_page;
//        $perPage = 1;
        $query = Inventory::with('product');
        if($keyword = $request->keyword){
            $query->whereHas('product',function ($query) use($keyword){
                $query->where('name','like',"%$keyword%");
            });
        }
        $query->orderBy('id','desc');
        $inventories = $query->paginate($perPage);
        $inventoryArr = array_merge($inventories->toArray(),[ 'data' => $inventories->map(function ($inventory){
            return [
                'id' => $inventory->id,
                'product_id' => $inventory->product_id,
                'product_name' => $inventory->product ? $inventory->product->name : null,
                'total_count' => $inventory->total_count,
                'price' => $inventory->product ? $inventory->product->price : 0,
                'unit' => $inventory->product ? $inventory->product->unit : null,
                'total_money' => ($inventory->product ? $inventory->product->price : 0) * $inventory->total_count,
                'location' => $inventory->location,
            ];
        })->toArray()]);

        $data = [
            'inventories' => $inventoryArr,
            'keyword' => $keyword ? $keyword : null,
        ];
        return view('inventories.index',$data);
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
