@extends('layouts.app')
@section('content')
    <div class="col-lg-9 col-md-9 col-sm-9 pull-left">

        <form class="form-horizontal" role="form">
            <div class="form-group  col-md-6">
                <label class="col-md-4 control-label" for="name">名称：</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="name" value="{{ $product->name }}">
                </div>
            </div>
            <div class="form-group col-md-6">
                <label class="col-md-4 control-label" for="chinese_name">中文名：</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="chinese_name" value="{{ $product->chinese_name }}">
                </div>
            </div>


            <div class="form-group  col-md-6">
                <label class="col-md-4 control-label" for="english_name">英文名：</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="english_name" value="{{ $product->english_name }}">
                </div>
            </div>
            <div class="form-group col-md-6">
                <label class="col-md-4 control-label" for="cas">CAS号：</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="cas" value="{{ $product->cas }}">
                </div>
            </div>

            <div class="form-group  col-md-6">
                <label class="col-md-4 control-label" for="molecular_formula">分子式：</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="molecular_formula" value="{{ $product->molecular_formula }}">
                </div>
            </div>
            <div class="form-group col-md-6">
                <label class="col-md-4 control-label" for="brand_name">品牌：</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="brand_name" value="{{ $product->brand->name }}">
                </div>
            </div>

            <div class="form-group  col-md-6">
                <label class="col-md-4 control-label" for="price">单价：</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="price" value="{{ $product->price }}">
                </div>
            </div>
            <div class="form-group col-md-6">
                <label class="col-md-4 control-label" for="unit">单位：</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="unit" value="{{ $product->unit }}">
                </div>
            </div>

            <div class="form-group  col-md-6">
                <label class="col-md-4 control-label" for="model_type">型号：</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="model_type" value="{{ $product->model_type }}">
                </div>
            </div>
            <div class="form-group col-md-6">
                <label class="col-md-4 control-label" for="category_name">种类：</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="category_name" value="{{ $product->category->name }}">
                </div>
            </div>

            <div class="form-group  col-md-6">
                <label class="col-md-4 control-label" for="model_type">型号：</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="model_type" value="{{ $product->model_type }}">
                </div>
            </div>
            <div class="form-group col-md-12" style="margin-left: -20px;">
                <label class="col-md-2 control-label" for="company-content">简介：</label>
                <div class="col-md-10">
                    <textarea placeholder="Enter description"
                              style="resize: vertical"
                              id="company-content"
                              name="description"
                              rows="5" spellcheck="false"
                              class="form-control  text-left">
                           </textarea>
                </div>
            </div>





        </form>

        {{--<form class="form-horizontal" role="form">--}}
            {{--<div class="form-group col-md-4">--}}
                {{--<label for="firstname" class="col-sm-4 control-label">名字</label>--}}
                {{--<div class="col-sm-8">--}}
                    {{--<input type="text" class="form-control" id="firstname" placeholder="请输入名字">--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="form-group col-md-4">--}}
                {{--<label for="firstname" class="col-sm-4 control-label">名字</label>--}}
                {{--<div class="col-sm-8">--}}
                    {{--<input type="text" class="form-control" id="firstname" placeholder="请输入名字">--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="form-group col-md-4">--}}
                {{--<label for="firstname" class="col-sm-4 control-label">名字</label>--}}
                {{--<div class="col-sm-8">--}}
                    {{--<input type="text" class="form-control" id="firstname" placeholder="请输入名字">--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="form-group col-md-4">--}}
                {{--<label for="firstname" class="col-sm-4 control-label">名字</label>--}}
                {{--<div class="col-sm-8">--}}
                    {{--<input type="text" class="form-control" id="firstname" placeholder="请输入名字">--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="form-group col-md-4">--}}
                {{--<label for="firstname" class="col-sm-4 control-label">名字</label>--}}
                {{--<div class="col-sm-8">--}}
                    {{--<input type="text" class="form-control" id="firstname" placeholder="请输入名字">--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="form-group col-md-4">--}}
                {{--<label for="firstname" class="col-sm-4 control-label">名字</label>--}}
                {{--<div class="col-sm-8">--}}
                    {{--<input type="text" class="form-control" id="firstname" placeholder="请输入名字">--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="form-group col-md-4">--}}
                {{--<label for="firstname" class="col-sm-4 control-label">名字</label>--}}
                {{--<div class="col-sm-8">--}}
                    {{--<input type="text" class="form-control" id="firstname" placeholder="请输入名字">--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="form-group col-md-4">--}}
                {{--<label for="firstname" class="col-sm-4 control-label">名字</label>--}}
                {{--<div class="col-sm-8">--}}
                    {{--<input type="text" class="form-control" id="firstname" placeholder="请输入名字">--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="form-group col-md-4">--}}
                {{--<label for="firstname" class="col-sm-4 control-label">名字</label>--}}
                {{--<div class="col-sm-8">--}}
                    {{--<input type="text" class="form-control" id="firstname" placeholder="请输入名字">--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="form-group col-md-4">--}}
                {{--<label for="firstname" class="col-sm-4 control-label">名字</label>--}}
                {{--<div class="col-sm-8">--}}
                    {{--<input type="text" class="form-control" id="firstname" placeholder="请输入名字">--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="form-group col-md-4">--}}
                {{--<label for="firstname" class="col-sm-4 control-label">名字</label>--}}
                {{--<div class="col-sm-8">--}}
                    {{--<input type="text" class="form-control" id="firstname" placeholder="请输入名字">--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="form-group col-md-4">--}}
                {{--<label for="firstname" class="col-sm-4 control-label">名字</label>--}}
                {{--<div class="col-sm-8">--}}
                    {{--<input type="text" class="form-control" id="firstname" placeholder="请输入名字">--}}
                {{--</div>--}}
            {{--</div>--}}

        {{--</form>--}}
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