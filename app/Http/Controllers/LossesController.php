<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Loss;
use App\Models\PrivateInventory;
use App\User;
use Carbon\Carbon;
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
        $query = Loss::with(['product','privateInventory','inventory']);
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
                'created_at' => $loss->created_at,
                'checked_at' => $loss->checked_at,
                'checker_id' => $loss->checker_id,
                'checker_name' => $loss->checker ? $loss->checker->name : null,
                'use_name' => count($loss->inventory) ? '公用' : '自用',
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
//            'product_id' => 'required|integer|exists:products,id',
            'inv_id' => 'required|integer',
            'loss_count' => 'required|integer|min:1',
            'note' => 'nullable|string',
            'flag' => 'required|integer',
        ]);
        $userId = auth()->id();
        $lossCount = $request->loss_count;

        if($request->flag == 1){
            //表示公用的损耗
            $inventory = Inventory::find($request->inv_id);
            if($inventory->total_count <= $lossCount){
                $lossCount = $inventory->total_count;
            }
            Loss::create([
                'inventory_id' => $request->inv_id,
                'product_id' => $inventory->product_id,
                'loss_count' => $lossCount,
                'note' => $request->note,
                'creator_id' =>  $userId
            ]);
        }elseif($request->flag == 2){
            //表示私用损耗
            $privateInventory = PrivateInventory::find($request->inv_id);
            if($privateInventory->total_count <= $lossCount){
                $lossCount = $privateInventory->total_count;
            }
            Loss::create([
                'private_inventory_id' => $request->inv_id,
                'product_id' => $privateInventory->product_id,
                'loss_count' => $lossCount,
                'note' => $request->note,
                'creator_id' =>  $userId
            ]);
        }


        return $this->success('成功');
    }


     public function checkerLoss(Request $request,Loss $loss)
     {
         $userId = auth()->id();
         DB::transaction(function () use ($request,$userId,$loss) {
             $loss->checker_id = $userId;
             $loss->checked_at = Carbon::now();
             $loss->save();
             if($loss->inventory_id){
                 //审核公共库的
                 $inventory = $loss->inventory;
                 if($inventory->total_count <= $loss->loss_count){
                     $inventory->decrement('total_count', $inventory->total_count);
                 }else{
                     $inventory->decrement('total_count', $loss->loss_count);
                 }
             }elseif($loss->private_inventory_id){
                 //审核私人库
                 $privateInventory = $loss->privateInventory;
                 if($privateInventory->total_count <= $loss->loss_count){
                     $privateInventory->decrement('total_count', $privateInventory->total_count);
                 }else{
                     $privateInventory->decrement('total_count', $loss->loss_count);
                 }
             }
        });

         return $this->success('审核成功');
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
