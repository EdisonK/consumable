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
                <label class="col-md-4 control-label" for="brand_id">品牌：</label>
                <div class="col-md-8">
                    {{--<input type="text" class="form-control" id="brand_id" alt="{{ $product->brand_id }}" value="{{ $product->brand->name }}">--}}
                    <select class="form-control" id="brand_id" >
                        <option value="">请选择</option>
                        @foreach ($brands as $val)
                            <option @if ($product->brand_id == $val->id) selected @endif value="{{ $val->id }}">{{ $val->name }}</option>
                        @endforeach

                    </select>
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
                        <option value="">请选择</option>
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
                        <option value="">请选择</option>
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
                        <option value="">请选择</option>
                        @foreach ($categories as $val)
                            <option @if ($category->id == $val->id) selected @endif value="{{ $val->id }}">{{ $val->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group col-md-12" style="margin-left: -20px;">
                <label class="col-md-2 control-label" for="description">简介：</label>
                <div class="col-md-10">
                    <textarea placeholder="请输入产品简介"
                              style="resize: vertical"
                              id="description"
                              name="description"
                              rows="5" spellcheck="false"
                              class="form-control  text-left">{{ $product->description }}
                           </textarea>
                </div>
            </div>
            <div class="form-group col-md-12">
                <input type="submit" class="btn btn-primary pull-right" id="save" style="margin-right: 20px;" alt="{{ $product->id }}" onclick="return false"
                           value="保存"/>
                <input type="submit" class="btn btn-danger pull-right" id="cancel" alt="{{ $product->id }}" style="margin-right: 20px;"
                       value="取消" onclick="return false"/>
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

@push('scripts')
    <script>
        $(function () {
            $('#warehouse_name').on('change',changeClassAndCategory);
            $('#class_name').on('change',changeCategory);
            $('#category_name').on('change',changeClass);

            $('#save').bind('click',saveProduct);
            $('#cancel').bind('click',cancel);


        })

        function cancel() {
            var product_id = $(this).attr('alt');
            window.location.href = "{{ url('admin/products') }}"+'/'+product_id;
        }

        function saveProduct() {
            var name = $('#name').val();
            var chinese_name = $('#chinese_name').val();
            var english_name = $('#english_name').val();
            var cas = $('#cas').val();
            var molecular_formula = $('#molecular_formula').val();
            var brand_id = $('#brand_id').val();
            var price = $('#price').val();
            var unit = $('#unit').val();
            var model_type = $('#model_type').val();
            var category_id = $('#category_name').val();
            var description = $('#description').val();
            var product_id = $('#save').attr('alt');
            var url = "{{ url('admin/products') }}"+'/'+product_id+'/update';
            if(!category_id){
                alert('第三类别的id不能为空');
                return;
            }
            var data = {
                'name' : name,
                'chinese_name' : chinese_name,
                'english_name' : english_name,
                'cas' : cas,
                'molecular_formula' : molecular_formula,
                'brand_id' : brand_id,
                'price' : price,
                'unit' : unit,
                'model_type' : model_type,
                'category_id' : category_id,
                'description' : description
            };

            $.post(url,data,function (result) {
                if(result.code == 0){
                    window.location.href = "{{ url('admin/products') }}"+'/'+product_id;
                }else{
                    alert('保存失败');
                }
            });
        }
        
        function changeClass() {
            classesByCategory()
        }

        function changeCategory() {
            categoriesByClass()
        }

        function changeClassAndCategory() {
            classes();
            categories();
        }
        
        function classesByCategory() {
            var category_id = $("#category_name").val();
            if(!category_id){
               return;
            }
            var url = "{{ url('admin/classes/category') }}"+'/'+category_id;
            $.get(url,function(result){
                if(result.code == 0){
                    var classe = result.data.classe;
                    $('#class_name option[value='+classe.id+"]").attr("selected",true);
                }else{
                    console.log('返回值接口错误');
                }
            });
        }

        function classes() {
            $('#class_name option').remove();
            var class_option = " <option value=''>请选择</option>";
            var warehous_id = $("#warehouse_name").val();
            if(!warehous_id){
                $('#class_name').append(class_option);
                return;
            }
            var url = "{{ url('admin/classes') }}"+'/'+warehous_id;
            $.get(url,function(result){
                if(result.code == 0){
                    var classes = result.data.classes;
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
            var category_option = " <option value=''>请选择</option>";
            var warehous_id = $("#warehouse_name").val();
            if(!warehous_id){
                $('#category_name').append(category_option);
                return;
            }
            var url = "{{ url('admin/categories') }}"+"/"+warehous_id;
            $.get(url,function(result){
                if(result.code == 0){
                    var categories = result.data.categories;

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
            var category_option = " <option value=''>请选择</option>";
            var class_id = $("#class_name").val();
            if(!class_id){
                $('#category_name').append(category_option);
                return;
            }
            var url =  "{{ url('admin/categories/class') }}"+"/"+class_id;
            $.get(url,function(result){
                if(result.code == 0){
                    var categories = result.data.categories;

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