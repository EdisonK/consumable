@extends('layouts.app')
@section('content')
    <div class="col-lg-9 col-md-9 col-sm-9 pull-left">




        {{--<div class="form-group">--}}
            {{--<div class="row">--}}
                {{--<div class="col-lg-6">--}}
                    {{--<div class="input-group ">--}}
                         {{--<label for="name1">名称:</label>--}}
                        {{--<input type="text" class="form-control" id="name1" placeholder="Search for...">--}}
                    {{--</div><!-- /input-group -->--}}
                {{--</div><!-- /.col-lg-6 -->--}}
                {{--<div class="col-lg-6">--}}
                    {{--<div class="input-group">--}}
                        {{--<input type="text" class="form-control" placeholder="Search for...">--}}
                    {{--</div><!-- /input-group -->--}}
                {{--</div><!-- /.col-lg-6 -->--}}
            {{--</div><!-- /.row -->--}}
        {{--</div>--}}

        <div class="row">
            <div class="col-md-4  input-group-sm">
                <label for="name" class="col-sm-4">名称:</label> <input class="col-sm-8 form-control" id="name" value="{{ $product->name }}">
            </div>
            <div class="col-md-4 form-inline input-group-sm">
                <label for="name" >名称:</label> <input class="form-control" id="name" value="{{ $product->name }}">
            </div>
            <div class="col-md-4 form-inline input-group-sm">
                <label for="name" >名称:</label> <input class="form-control" id="name" value="{{ $product->name }}">
            </div>
            <div class="col-md-4 form-inline input-group-sm">
                <label for="name" >名称:</label> <input class="form-control" id="name" value="{{ $product->name }}">
            </div>
            <div class="col-md-4 form-inline input-group-sm">
                <label for="name" >名称:</label> <input class="form-control" id="name" value="{{ $product->name }}">
            </div>
            <div class="col-md-4 form-inline input-group-sm">
                <label for="name" >名称:</label> <input class="form-control" id="name" value="{{ $product->name }}">
            </div><div class="col-md-4 form-inline input-group-sm">
                <label for="name" >名称:</label> <input class="form-control" id="name" value="{{ $product->name }}">
            </div>
            <div class="col-md-4 form-inline input-group-sm">
                <label for="name" >名称:</label> <input class="form-control" id="name" value="{{ $product->name }}">
            </div>
            <div class="col-md-4 form-inline input-group-sm">
                <label for="name" >名称:</label> <input class="form-control" id="name" value="{{ $product->name }}">
            </div>
            <div class="col-md-4 form-inline input-group-sm">
                <label for="name" >名称:</label> <input class="form-control" id="name" value="{{ $product->name }}">
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
                <label>品牌:</label> <span>{{ $product->brand->name }}</span>
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
                <label>简介:</label> <span>{{ $warehouse->description }}</span>
            </div>
        </div>
    </div>
    <div class="col-sm-3 col-md-3 col-lg-3 pull-right">
        <div class="sidebar-module">
            {{--<h4>Actions</h4>--}}
            {{--<ol class="list-unstyled">--}}
            {{--<li><a href="/companies/{{ $company->id }}/edit">Edit</a></li>--}}
            {{--<li><a href="/projects/create">Add Project</a></li>--}}
            {{--<li><a href="/companies">My Companies</a></li>--}}
            {{--<li><a href="/companies/create">Create new Company</a></li>--}}
            {{--<br/>--}}
            {{--<li>--}}
            {{--<a href="#"--}}
            {{--onclick="--}}
            {{--var result = confirm('确定删除该公司么？');--}}
            {{--if(result){--}}
            {{--event.preventDefault();--}}
            {{--document.getElementById('delete-form').submit();--}}
            {{--}">--}}
            {{--Delete--}}
            {{--</a>--}}
            {{--<form id="delete-form" action="{{ route('companies.destroy',[$company->id]) }}"--}}
            {{--method="POST" style="display: none;">--}}
            {{--<input type="hidden" name="_method" value="delete">--}}
            {{--{{ csrf_field() }}--}}
            {{--</form>--}}

            {{--</li>--}}
            {{--</ol>--}}
        </div>

    </div>

@endsection