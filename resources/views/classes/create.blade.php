@extends('layouts.app')

@section('content')



    <div class="row col-md-9 col-lg-9 col-sm-9 pull-left " style="background: white; ">
        <h1>创建二级分类 </h1>

        <!-- Example row of columns -->
        <div class="row  col-md-12 col-lg-12 col-sm-12" >

            <form method="post" action="{{ route('classes.store') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="class-name">二级分类名<span class="required">*</span></label>
                    <input   placeholder="请输入类名"
                             id="class-name"
                             required
                             name="name"
                             spellcheck="false"
                             class="form-control"
                    />
                </div>

                @if($warehouses == null)
                <div class="form-group">
                    <input
                            class="form-control"
                            type="hidden"
                            name="warehouse_id"
                            value="{{ $warehouse->id }}"
                    />
                </div>
                @endif
                @if($warehouses != null)
                <div class="form-group">
                    <label for="warehouse-content">选择仓库<span class="required">*</span></label>

                    <select name="warehouse_id" class="form-control" id="warehouse-content">

                        @foreach($warehouses as $warehouse)
                            <option  value="{{$warehouse->id}}"> {{$warehouse->name}} </option>
                        @endforeach
                    </select>
                </div>
                @endif
                <div class="form-group">
                    <input type="submit" class="btn btn-primary"
                           value="提交"/>
                </div>
            </form>
        </div>
    </div>

    <div class="col-sm-3 col-md-3 col-lg-3 pull-right">
        <div class="sidebar-module">
            <h4>导航</h4>
            <h5>仓库</h5>
            <ol class="list-unstyled">
                <li><a href="/warehouses"><i class="fa fa-user-o" aria-hidden="true"></i>仓库列表</a></li>

            </ol>
        </div>

    </div>


@endsection