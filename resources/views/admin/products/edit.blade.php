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
                <label class="col-md-4 control-label" for="warehouse_name">仓库：</label>
                <div class="col-md-8">
                    <select class="form-control" id="warehouse_name" >
                        <option value="0">请选择</option>
                        @foreach ($warehouses as $val)
                            <option @if ($warehouse->id == $val->id) selected @endif value="{{ $val->id }}">{{ $val->name }}</option>
                        @endforeach

                    </select>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label class="col-md-4 control-label" for="class_name">二级分类：</label>
                <div class="col-md-8">
                    <select class="form-control" id="class_name" >
                        <option value="0">请选择</option>
                        @foreach ($classes as $val)
                            <option @if ($class->id == $val->id) selected @endif value="{{ $val->id }}">{{ $val->name }}</option>
                        @endforeach

                    </select>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label class="col-md-4 control-label" for="category_name">三级分类：</label>
                <div class="col-md-8">
                    <select class="form-control" id="category_name" >
                        <option value="0">请选择</option>
                        @foreach ($categories as $val)
                            <option @if ($category->id == $val->id) selected @endif value="{{ $val->id }}">{{ $val->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group col-md-12" style="margin-left: -20px;">
                <label class="col-md-2 control-label" for="company-content">简介：</label>
                <div class="col-md-10">
                    <textarea placeholder="请输入产品简介"
                              style="resize: vertical"
                              id="company-content"
                              name="description"
                              rows="5" spellcheck="false"
                              class="form-control  text-left">
                           </textarea>
                </div>
            </div>
            <div class="form-group col-md-12">
                <input type="submit" class="btn btn-primary pull-right" style="margin-right: 20px;"
                           value="保存"/>
                <input type="submit" class="btn btn-danger pull-right" style="margin-right: 20px;"
                       value="取消"/>
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

@push('scripts')
    <script>
        $(function () {
            $('#warehouse_name').on('change',changeClassAndCategory);
            $('#class_name').on('change',changeCategory);
        })
        function changeCategory() {
            categoriesByClass()
        }

        function changeClassAndCategory() {
            classes();
            categories();
        }

        function classes() {
            $('#class_name option').remove();
            var warehous_id = $("#warehouse_name").val();
            var url = "/admin/classes/"+warehous_id;
            $.get(url,function(result){
                if(result.code == 0){
                    var classes = result.data.classes;
                    var class_option = " <option value='0'>请选择</option>";
                    $.each(classes,function (i,n) {
                        var xxx;
                        xxx = "<option value='"+n.id+"'>"+n.name+"</option>";
                        class_option += xxx;
                    });
                    $('#class_name').append(class_option);
                }else{
                    console.log('返回值接口错误');
                }
            });
        }

        function categories() {
            $('#category_name option').remove();
            var warehous_id = $("#warehouse_name").val();
            var url = "/admin/categories/"+warehous_id;
            $.get(url,function(result){
                if(result.code == 0){
                    var categories = result.data.categories;
                    var category_option = " <option value='0'>请选择</option>";
                    $.each(categories,function (i,n) {
                        var xxx;
                        xxx = "<option value='"+n.id+"'>"+n.name+"</option>";
                        category_option += xxx;
                    });
                    $('#category_name').append(category_option);
                }else{
                    console.log('返回值接口错误');
                }
            });
        }

        function categoriesByClass() {
            $('#category_name option').remove();
            var class_id = $("#class_name").val();
            var url = "/admin/categories/class/"+class_id;
            $.get(url,function(result){
                if(result.code == 0){
                    var categories = result.data.categories;
                    var category_option = " <option value='0'>请选择</option>";
                    $.each(categories,function (i,n) {
                        var xxx;
                        xxx = "<option value='"+n.id+"'>"+n.name+"</option>";
                        category_option += xxx;
                    });
                    $('#category_name').append(category_option);
                }else{
                    console.log('返回值接口错误');
                }
            });
        }





    </script>
@endpush