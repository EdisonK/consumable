<?php

namespace App\Http\Controllers\Admin;

use App\Models\CheckStatus;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
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
            'check_status' => 'nullable|string',
            'date_from' => 'nullable|string',
            'date_to' => 'nullable|string',
            'keyword' => 'nullable|string'
        ]);
        $perPage = $request->per_page;
//        $perPage = 1;
        $date_from = $request->date_from ? Carbon::parse($request->date_from)->toDateTimeString() : Carbon::now()->startOfMonth()->toDateTimeString();
        $date_to = $request->date_to ? Carbon::parse($request->date_to)->endOfDay()->toDateTimeString() : Carbon::now()->endOfDay()->toDateTimeString();

        $query = Order::with(['product','creator','checker','checkStatus','confirmer','useName']);
        $query->where('created_at','>=',$date_from);
        $query->where('created_at','<=',$date_to);
        if($keyword = $request->keyword){
            $query->where(function ($query)use($keyword){
                $query->orWhereHas('product',function ($query) use($keyword){
                    $query->where('name','like',"%$keyword%");
                })->orWhereHas('creator',function ($query) use($keyword){
                    $query->where('name','like',"%$keyword%");
                });
            });
        }
        if($check_status = $request->check_status){
            if($check_status == 1){
                $query->whereNotNull('checked_at');
            }elseif($check_status == 2){
                $query->whereNull('checked_at');
            }
        }
        $query->orderBy('id','desc');
        $orders = $query->paginate($perPage);
        $orderArr = array_merge($orders->toArray(),[ 'data' => $orders->map(function ($order){
            return [
                'id' => $order->id,
                'product_id' => $order->product_id,
                'product_name' => $order->product ? $order->product->name : null,
                'count' => $order->count,
                'price' => $order->product ? $order->product->price : 0,
                'unit' => $order->product ? $order->product->unit : null,
                'total_money' => ($order->product ? $order->product->price : 0) * $order->count,
                'note' => $order->note,
                'creator_id' => $order->creator_id,
                'creator_name' => $order->creator ? $order->creator->name : null,
                'created_at' => $order->created_at,
                'checker_id' => $order->checker_id,
                'checker_name' =>  $order->checker ? $order->checker->name : null,
                'checked_note' =>  $order->checked_note,
                'checked_at' =>  $order->checked_at,
                'check_status_id' =>  $order->check_status_id ,
                'check_status_name' =>  $order->checkStatus ? $order->checkStatus->name : null ,
                'confirm_id' => $order->confirm_id,
                'confirm_name' =>  $order->confirmer ? $order->confirmer->name : null,
                'confirmed_note' =>  $order->confirmed_note,
                'confirmed_at' =>  $order->confirmed_at,
                'use_name' =>  $order->useName ? $order->useName->name : null,
            ];
        })->toArray()]);
        $data = [
            'orders' => $orderArr,
            'checkStatus' => $check_status,
            'keyword' => $keyword ? $keyword : null,
            'date_from' => Carbon::parse($date_from)->format('Y-m-d'),
            'date_to' => Carbon::parse($date_to)->format('Y-m-d')
        ];
        return view('admin.orders.index',$data);
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
            'count' => 'required|integer|min:1',
            'product_id' => 'required|integer|exists:products,id',
        ]);
        Order::create([
            'product_id' => $request->product_id,
            'count' => $request->count,
            'note' => $request->note,
            'creator_id' => auth()->id()
        ]);
        return $this->success('添加成功');
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

    public function check(Request $request)
    {
        $this->validate($request,[
            'order_ids' => 'required|array',
            'order_ids.*' => 'required|integer|exists:orders,id',
            'flag' => 'required|integer' //到底是这个订单是通过还拒绝，通过直接穿数据中的状态id1，拒绝传2
        ]);
        $userId = auth()->id();
        $orders = Order::findMany($request->order_ids);
        $bool = $orders->contains(function ($order, $key) {

            return !is_null($order->checker_id);
        });
        if($bool){
            return $this->fail('您传入的id包含已经审核的订单');
        }

        foreach ($orders as $key => $order){
            $order->checker_id = $userId;
            $order->checked_at = Carbon::now();
            $order->check_status_id = $request->flag;
            $order->save();
        }
        return $this->successWithData(Order::findMany($request->order_ids),'审核成功');
    }
}
