@extends('layouts.app')
@section('content')
    <div class="col-lg-9 col-md-9 col-sm-9 pull-left">
        <!-- The justified navigation menu is meant for single line per list item.
             Multiple lines will require custom code not provided by Bootstrap. -->

        <!-- Jumbotron -->
        <div class="jumbotron">
            <h1>{{ $class->name }}</h1>
            {{--<p><a class="btn btn-lg btn-success" href="#" role="button">Get started today</a></p>--}}
        </div>

        <!-- Example row of columns -->
        <div class="row" style="background: white; margin: 10px;">
            @foreach($class->categories as $category)
                <div class="col-lg-4">
                    <h2>{{ $category->name }}</h2>
                    <p><a class="btn btn-primary" href="/categories/{{  $category->id }}" role="button">查看 »</a></p>
                </div>
            @endforeach

        </div>
    </div>

    <div class="col-sm-3 col-md-3 col-lg-3 pull-right">
        <div class="sidebar-module">
            <h4>导航</h4>
            <h5>仓库</h5>
            <ol class="list-unstyled">
                <li><a href="/warehouses">仓库列表</a></li>
                <li><a href="/warehouses/create">创建仓库</a></li>
                <li><a href="/warehouses/{{ $class->warehouse->id }}">当前仓库</a></li>
            </ol>
            <h5>二级分类</h5>
            <ol class="list-unstyled">
                <li><a href="/classes/create">添加二级分类</a></li>
                <li><a href="/classes/{{ $class->id }}/edit">编辑二级分类</a></li>
                <li>
                    <a href="#"
                       onclick="
                    var result = confirm('确定删除该二级分类么？');
                    if(result){
                        event.preventDefault();
                        document.getElementById('delete-form').submit();
                    }">
                        删除
                    </a>
                    <form id="delete-form" action="{{ route('classes.destroy',[$class->id]) }}"
                          method="POST" style="display: none;">
                        <input type="hidden" name="_method" value="delete">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ol>
            <h5>三级分类</h5>
            <ol class="list-unstyled">
                <li><a href="#">三级分类列表</a></li>
                <li><a href="#">添加三级分类</a></li>
            </ol>

        </div>
    </div>
@endsection