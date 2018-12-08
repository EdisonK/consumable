<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Loss;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LossesController extends Controller
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
            'creator_id' => 'nullable|integer',
            'keyword' => 'nullable|string'
        ]);
        $perPage = $request->per_page;
        $query = Loss::with('product');
        if($creator_id = $request->creator_id){
            $query->where('creator_id',$creator_id);
        }
        if($keyword = $request->keyword){
            $query->whereHas('product',function ($query) use($keyword){
                $query->where('name','like',"%$keyword%");
            });
        }
        $query->orderBy('id','desc');

        $losses = $query->paginate($perPage);

        $lossArr = array_merge($losses->toArray(),[ 'data' => $losses->map(function ($loss){
            return [
                'id' => $loss->id,
                'product_id' => $loss->product_id,
                'product_name' => $loss->product ? $loss->product->name : null,
                'loss_count' => $loss->loss_count,
                'price' => $loss->product ? $loss->product->price : 0,
                'unit' => $loss->product ? $loss->product->unit : null,
                'total_money' => ($loss->product ? $loss->product->price : 0) * $loss->loss_count,
                'note' => $loss->note,
                'creator_id' => $loss->creator_id,
                'creator_name' => $loss->creator ? $loss->creator->name : null,
                'created_at' => $loss->created_at
            ];
        })->toArray()]);

        $inventories = Inventory::all();

        $data = [
            'losses' => $lossArr,
            'creatorId' => $creator_id,
            'keyword' => $keyword ? $keyword : null,
            'users' => User::all(),
            'inventories' => $inventories,
        ];
        return view('losses.index',$data);
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
        $this->validate($request,[
            'product_id' => 'required|integer|exists:products,id',
            'loss_count' => 'required|integer|min:1',
            'note' => 'nullable|string'
        ]);
        $userId = auth()->id();

        DB::transaction(function () use ($request,$userId) {
            Loss::create([
                'product_id' => $request->product_id,
                'loss_count' => $request->loss_count,
                'note' => $request->note,
                'creator_id' =>  $userId
            ]);
            $productId = $request->product_id;
            $lossCount = $request->loss_count;
            $inventory = Inventory::where('product_id',$productId)->first();
            if(count($inventory)){
                if($inventory->total_count <= $lossCount){
                    $inventory->total_count = 0;
                    $inventory->save();
                }else{
                    $inventory->decrement('total_count', $lossCount);
                }
            }else{
                Inventory::create([
                    'product_id' => $productId,
                    'total_count' => 0
                ]);
            }
        });

        return $this->success('成功');
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
