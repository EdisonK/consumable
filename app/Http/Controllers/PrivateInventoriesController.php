<?php

namespace App\Http\Controllers;

use App\Models\PrivateInventory;
use Illuminate\Http\Request;

class PrivateInventoriesController extends Controller
{

    public function index(Request $request)
    {
        $this->validate($request,[
            'per_page' => 'nullable|integer|max:30',
            'keyword' => 'nullable|string'
        ]);
        $perPage = $request->per_page;
//        $perPage = 1;
        $userId = auth()->id();
        $query = PrivateInventory::with('product')->where('create_id',$userId);
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
        return view('privateInventories.index',$data);
    }

    public function updateLocation(Request $request,PrivateInventory $privateInventory)
    {
        $this->validate($request,[
            'location' => 'nullable|string'
        ]);
        $privateInventory->location = $request->location;
        $res = $privateInventory->save();
        if($res){
            return $this->success('成功');
        }else{
            return $this->fail('失败');
        }
    }
}
