<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $this->validate($request,[
            'per_page' => 'nullable|integer|max:30',
            'keyword' => 'nullable|string'
        ]);
        $perPage = $request->per_page;
//        $perPage = 1;

        $query = User::query();
        if($keyword = $request->keyword){
            $query->where(function ($query)use($keyword){
                $query->where('name','like',"%$keyword%");
            });
        }

        $query->orderBy('id','desc');
        $users = $query->paginate($perPage);
        $userArr = array_merge($users->toArray(),[ 'data' => $users->map(function ($user){
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'created_at' => $user->created_at,
                'on' => $user->on
            ];
        })->toArray()]);
        $data = [
            'users' => $userArr,
            'keyword' => $keyword ? $keyword : null
        ];
        return view('admin.users.index',$data);

    }

    public function switchOn(Request $request,User $user)
    {
        $this->validate($request,[
            'flag' => 'required|integer'
        ]);
        $flag = $request->flag;
        if($flag == 1){
//         启用
            $user->on = 1;
        }else{
//         禁用
            $user->on = 0;
        }
        $user->save();

        return $this->success('成功');
    }

    public function resetPassword(Request $request,User $user)
    {
        $user->password = bcrypt('123456');
        $user->save();
        return $this->successWithData($user->fresh(),'成功');
    }
}
