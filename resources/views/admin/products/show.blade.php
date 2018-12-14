@extends('layouts.app')
@section('content')
    <div class="col-lg-9 col-md-9 col-sm-9 pull-left">
        <div class="row">
            <a class="pull-right" href="{{ url('admin/products') }}/{{ $product->id }}/edit">编辑</a>
        </div>

        <div class="row" style="font-size: medium; line-height: 2em">
            <div class="col-md-4">
                <label>名称:</label> <span>{{ $product->name }}</span>
            </div>
            <div class="col-md-4">
                <label>中文名称:</label> <span>{{ $product->chinese_name }}</span>
            </div>
            <div class="col-md-4">
                <label>英文名称:</label> <span>{{ $product->english_name }}</span>
            </div>
            <div class="col-md-4">
                <label>CAS 号:</label> <span>{{ $product->cas }}</span>
            </div>
            <div class="col-md-4">
                <label>分子式:</label> <span>{{ $product->molecular_formula }}</span>
            </div>
            <div class="col-md-4">
                <label>品牌:</label> <span>{{ $product->brand ? $product->brand->name : null }}</span>
            </div>
            <div class="col-md-4">
                <label>单价:</label> <span>{{ $product->price }}/{{ $product->unit }}</span>
            </div>
            <div class="col-md-4">
                <label>型号:</label> <span>{{ $product->model_type }}</span>
            </div>
            <div class="col-md-4">
                <label>所属种类:</label> <span>{{ $warehouse->name }}/{{ $class->name }}/{{ $category->name }}</span>
            </div>
            <div class="col-md-4">
                <label>简介:</label> <span>{{ $product->description }}</span>
            </div>
        </div>
    </div>
    <div class="col-sm-3 col-md-3 col-lg-3 pull-right">
        <div class="sidebar-module">
            <h4>导航</h4>
            <ol class="list-unstyled">
                <li><a href="{{ url('admin/products') }}">产品管理</a></li>
                {{--<li><a href="/projects/create">Add Project</a></li>--}}
                {{--<li><a href="/companies">My Companies</a></li>--}}
                {{--<li><a href="/companies/create">Create new Company</a></li>--}}
                {{--<br/>--}}
                {{--<li><a href="/companies/create">Create new Company</a></li>--}}
            </ol>

        </div>

    </div>

@endsection