@extends('layouts.app')
@section('content')
    <div class="col-lg-9 col-md-9 col-sm-9 pull-left">
        <!-- The justified navigation menu is meant for single line per list item.
             Multiple lines will require custom code not provided by Bootstrap. -->

        <!-- Jumbotron -->
        <div class="jumbotron">
            <h1>{{ $warehouse->name }}</h1>
            {{--<p><a class="btn btn-lg btn-success" href="#" role="button">Get started today</a></p>--}}
        </div>

        <!-- Example row of columns -->
        <div class="row" style="background: white; margin: 10px;">
            @foreach($warehouse->classes as $class)
                <div class="col-lg-4">
                    <h2>{{ $class->name }}</h2>
                    <p><a class="btn btn-primary" href="/classes/{{  $class->id }}" role="button">查看 »</a></p>
                </div>
            @endforeach

        </div>
    </div>

    <div class="col-sm-3 col-md-3 col-lg-3 pull-right">
        <div class="sidebar-module">
            <h4>导航</h4>
            <ol class="list-unstyled">
                <li><a href="/warehouses/{{ $warehouse->id }}/edit">编辑</a></li>
                <li><a href="/classes/create">添加二级分类</a></li>
                <li><a href="/warehouses">我的仓库</a></li>
                <li><a href="/warehouses/create">创建仓库</a></li>
                <br/>
                <li>
                    <a href="#"
                       onclick="
                    var result = confirm('确定删除该仓库么？');
                    if(result){
                        event.preventDefault();
                        document.getElementById('delete-form').submit();
                    }">
                        删除
                    </a>
                    <form id="delete-form" action="{{ route('warehouses.destroy',[$warehouse->id]) }}"
                          method="POST" style="display: none;">
                        <input type="hidden" name="_method" value="delete">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ol>
        </div>
    </div>
@endsection