@extends('layouts.app')
@section('content')

    <div class="col-sm-3 col-md-3 col-lg-3 pull-left">
        <div class="sidebar-module">
            <h4>分类
                <button class="pull-right btn btn-primary btn-xs" id="edit">编辑</button>
            </h4>
            <ol class="list-unstyled  ancestor">
                @foreach($warehouses as $warehouse)
                    <li>
                        <a href="jacascript::void(0)" class="tree ancestor">{{ $warehouse->name }}</a>
                        <span class="hidden on-off"><i class="fa fa-edit warehouses-edit" alt="{{ $warehouse->id }}"></i><i class="fa fa-trash warehouse-trash" alt="{{ $warehouse->id }}"></i></span>
                        <ol class="hidden" style="list-style-type: none;">
                            @foreach($warehouse->classes as $class)
                                <li  alt="{{ $class->id }}" type_class="classes">
                                    <a href="jacascript::void(0)" class="tree">{{ $class->name }}</a>
                                    <span class="hidden on-off"><i class="fa fa-edit class-edit"  alt="{{ $class->id }}"></i><i
                                                class="fa fa-trash class-trash" alt="{{ $class->id }}"></i></span>
                                    <ol class="hidden" style="list-style-type: none;">
                                        @foreach($class->categories as $category)
                                            <li alt="{{ $category->id }}" type_class="categories"><a
                                                        href="jacascript::void(0)">{{ $category->name }}</a>
                                                <span class="hidden on-off"><i class="fa fa-edit category-edit" alt="{{ $category->id }}"></i><i
                                                            class="fa fa-trash category-trash" alt="{{ $category->id }}"></i></span>

                                            </li>
                                        @endforeach
                                        <li class="hidden on-off add_category" id="add_category" calt="{{ $class->id }}"><a href="jacascript::void(0)">添加三级分类</a><i class="fa fa-plus"
                                                                                          aria-hidden="true"></i></li>
                                    </ol>

                                </li>
                            @endforeach
                            <li class="hidden on-off add_class" id="add_class" walt="{{ $warehouse->id }}"><a href="jacascript::void(0)">添加二级分类</a><i class="fa fa-plus" aria-hidden="true"></i>
                            </li>
                        </ol>

                    </li>

                @endforeach
                <li class="hidden on-off add_warehouse" id="add_warehouse"><a href="jacascript::void(0)">添加仓库</a><i class="fa fa-plus" aria-hidden="true"></i></li>
            </ol>
        </div>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9 pull-right">
        <!-- The justified navigation menu is meant for single line per list item.
             Multiple lines will require custom code not provided by Bootstrap. -->

        <!-- Jumbotron -->
        <div class="row">
            <div class="col-lg-8">
                <!-- Single button -->
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        操作 <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="#">添加产品</a></li>
                        <li><a href="#">导出excel</a></li>
                        <li><a href="#">批量删除</a></li>
                    </ul>
                </div>
            </div><!-- /.col-lg-6 -->
            <div class="col-lg-4">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="请输入关键字（名称、cas）"value="{{ $keyword }}" id="keyword">
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="button" id="search">搜索</button>
                  </span>
                </div><!-- /input-group -->
            </div><!-- /.col-lg-6 -->
        </div>

        <!-- Example row of columns -->
        <div class="row" style=" margin: 10px;">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>
                            <input type="checkbox" aria-label="...">
                        </th>
                        <th>名称</th>
                        <th>中文名</th>
                        <th>英文名</th>
                        <th>cas号</th>
                    </tr>
                    </thead>
                    <tbody data-total="{{ $products->lastPage() }}" id="pages" data-current="{{ $products->currentPage() }}">
                    @foreach($products as $product)
                    <tr>
                        <td>
                            <input type="checkbox" aria-label="...">
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->chinese_name }}</td>
                        <td>{{ $product->english_name }}</td>
                        <td>{{ $product->cas }}</td>
                    </tr>
                    @endforeach
                    </tbody>


                </table>
            </div>
            <div class="row">
                <nav aria-label="Page navigation" style="text-align: center">
                    <ul class="pagination" id="pagination2"></ul>
                </nav>
            </div>

        </div>
    </div>


    <!-- 仓库的Modal -->
    <div class="modal fade" id="myWarehouseModal" tabindex="-1" role="dialog" aria-labelledby="myWarehouseModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myWarehouseModalLabel">仓库</h4>
                </div>
                <div class="modal-body">
                    <input class="form-control" placeholder="请填写仓库名" alt id="warehouse_name">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="warehouse_save">保存</button>
                </div>
            </div>
        </div>
    </div>

    <!-- 二级分类的Modal -->
    <div class="modal fade" id="myClassModal" tabindex="-1" role="dialog" aria-labelledby="myClassModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myClassModalLabel">二级分类</h4>
                </div>
                <div class="modal-body">
                    <input class="form-control" placeholder="请填写二级分类名" alt walt id="class_name">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="class_save">保存</button>
                </div>
            </div>
        </div>
    </div>

    <!-- 三级分类的Modal -->
    <div class="modal fade" id="myCategoryModal" tabindex="-1" role="dialog" aria-labelledby="myCategoryModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myCategoryModalLabel">三级分类</h4>
                </div>
                <div class="modal-body">
                    <input class="form-control" placeholder="请填写三级分类名" alt calt id="category_name">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="category_save">保存</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function () {

            $('#search').bind('click', search);
            $('#edit').bind('click', showEdit);
            $('.fa-edit').bind('click', showEditModel);
            //仓库相关
            $('.warehouses-edit').bind('click', showWarehouseModel);
            $('.add_warehouse').bind('click', showWarehouseModel);
            $('#warehouse_save').bind('click', saveWarehouseModel);
            $('.warehouse-trash').bind('click', trashWarehouse);

            //二级分类相关
            $('.class-edit').bind('click', showClassModel);
            $('.add_class').bind('click', showClassModel);
            $('#class_save').bind('click', saveClassModel);
            $('.class-trash').bind('click', trashClass);

            //三级分类相关
            $('.category-edit').bind('click', showCategoryModel);
            $('.add_category').bind('click', showCategoryModel);
            $('#category_save').bind('click', saveCategoryModel);
            $('.category-trash').bind('click', trashCategory);






            $('.tree').bind('click', triggerSon);


            init();






            //敲回车搜索
            $('#keyword').keyup(function (e) {
                if(e.keyCode == 13){
                    search();
                }
            });
        });

        function init() {
            var if_firstime = true;
            var currentPage = $("#pages").data('current');
            $.jqPaginator('#pagination2', {
                totalPages: $("#pages").data('total'),
                visiblePages: 5,
                currentPage: currentPage,
                first: '<li class="first"><a href="javascript:void(0);">首页</a></li>',  	// 首页的HTML样式
                prev: '<li class="prev"><a href="javascript:void(0);">上一页</a></li>',		// 上一页的HTML样式
                next: '<li class="next"><a href="javascript:void(0);">下一页</a></li>',		// 下一页的HTML样式
                last: '<li class="last"><a href="javascript:void(0);">末页</a></li>',
                onPageChange: function (num, type) {
                    var url = 'warehouses';
                    var keyword = $('#keyword').val();
                    console.log(url);
                    url +=  '?page='+num;
                    if(keyword){
                        url +=  '&keyword=' + keyword;
                    }

                    if(if_firstime){
                        if_firstime = false;
                    }else if(!if_firstime){
                        window.location.href = url;
                    }
                }
            });

        }


        function search() {
            var url = 'warehouses';
            var keyword = $('#keyword').val();
            if(keyword){
                url +=  '?keyword=' + keyword;
            }
            window.location.href = url;

        }
        
        function trashWarehouse() {
            var that =  $(this);
            var warehouse_id = that.attr('alt');
            swal({
                title: "确认删除该仓库么?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then(function (value) {
                if(value){
                    var url = "api/warehouses/"+warehouse_id;
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        success: function(result) {
                            if(result.code == 0){
                                that.parent('span').parent('li').remove();
                            }else{
                                alert('删除失败');
                            }
                        }
                    });
                }
            });
        }

        function trashClass() {
            var that =  $(this);
            var class_id = that.attr('alt');
            swal({
                title: "确认删除该二级分类么?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then(function (value) {
                if(value){
                    var url = "api/classes/"+class_id;
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        success: function(result) {
                            if(result.code == 0){
                                that.parent('span').parent('li').remove();
                            }else{
                                alert('删除失败');
                            }
                        }
                    });
                }
            });
        }

        function trashCategory() {
            var that =  $(this);
            var category_id = that.attr('alt');
            swal({
                title: "确认删除该三级分类么?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then(function (value) {
                if(value){
                    var url = "api/categories/"+category_id;
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        success: function(result) {
                            if(result.code == 0){
                                that.parent('span').parent('li').remove();
                            }else{
                                alert('删除失败');
                            }
                        }
                    });
                }
            });
        }

        function triggerSon() {
            $(this).parent('li').siblings('li').find('ol').addClass('hidden');
            var that = $(this).siblings('ol');
            if(that.hasClass('hidden')){
                that.removeClass('hidden');
            }else{
                that.addClass('hidden');
            }
        }

        function showWarehouseModel() {
            if($(this).hasClass('add_warehouse')){
            //添加仓库
                $('#myWarehouseModal').modal('show');
                $("#warehouse_name").val('');
                $("#warehouse_save").addClass('add_warehouse');
            }else{
                //修改仓库
                var warehouse_id = $(this).attr('alt');
                var name = $(this).parent('span').prev().text();
                $('#myWarehouseModal').modal('show');
                $("#warehouse_name").val(name);
                $("#warehouse_name").attr('alt',warehouse_id);
                $(this).parent('span').prev().addClass('update');
                $("#warehouse_save").removeClass('add_warehouse');
            }
        }
        
        function showClassModel() {
            if($(this).hasClass('add_class')){
                var warehouse_id = $(this).attr('walt');
                //添加二级分类
                $('#myClassModal').modal('show');
                $("#class_name").attr('walt', warehouse_id);
                $("#class_name").val('');
                $("#class_save").addClass('add_class');
            }else{
                //修改二级分类
                var class_id = $(this).attr('alt');
                var name = $(this).parent('span').prev().text();
                $('#myClassModal').modal('show');
                $("#class_name").val(name);
                $("#class_name").attr('alt',class_id);
                $(this).parent('span').prev().addClass('update-class');
                $("#class_save").removeClass('add_class');
            }
        }
        
        function showCategoryModel() {
            if($(this).hasClass('add_category')){
                var class_id = $(this).attr('calt');
                //添加三级分类
                $('#myCategoryModal').modal('show');
                $("#category_name").attr('calt', class_id);
                $("#category_name").val('');
                $("#category_save").addClass('add_category');
            }else{
                //修改三级分类
                var category_id = $(this).attr('alt');
                var name = $(this).parent('span').prev().text();
                $('#myCategoryModal').modal('show');
                $("#category_name").val(name);
                $("#category_name").attr('alt',category_id);
                $(this).parent('span').prev().addClass('update-category');
                $("#category_save").removeClass('add_category');
            }
            
        }

        function saveWarehouseModel() {
            if($(this).hasClass('add_warehouse')){
            //添加仓库
                var name = $("#warehouse_name").val();
                var url = "api/warehouses";

                $.post(url,{name:name},function(result){
                    if(result.code == 0){
                        window.location.reload();
                    }else{
                        alert(result.message);
                    }
                });


            }else{
                //更新仓库
                var name = $("#warehouse_name").val();
                var warehouse_id = $("#warehouse_name").attr('alt');
                var url = "api/warehouses/"+warehouse_id;

                $.post(url,{name:name},function(result){
                    if(result.code == 0){
                        $('.update').text(result.data.name);
                        $('#myWarehouseModal').modal('hide');
                    }else{
                        alert(result.message);
                    }
                });

            }
        }

        function saveClassModel() {
            if($(this).hasClass('add_class')){
                //添加二级分类
                var name = $("#class_name").val();
                var warehouse_id = $("#class_name").attr('walt');
                var url = "api/classes";

                $.post(url,{ name: name, warehouse_id: warehouse_id },function(result){
                    if(result.code == 0){
                        window.location.reload();
                    }else{
                        alert(result.message);
                    }
                });


            }else{
                //更新二级分类
                var name = $("#class_name").val();
                var class_id = $("#class_name").attr('alt');
                var url = "api/classes/"+class_id;

                $.post(url,{name:name},function(result){
                    if(result.code == 0){
                        $('.update-class').text(result.data.name);
                        $('#myClassModal').modal('hide');
                    }else{
                        alert(result.message);
                    }
                });

            }

        }

        function saveCategoryModel() {
            if($(this).hasClass('add_category')){
                //添加三级分类
                var name = $("#category_name").val();
                var class_id = $("#category_name").attr('calt');
                var url = "api/categories";

                $.post(url,{ name: name, class_id: class_id },function(result){
                    if(result.code == 0){
                        window.location.reload();
                    }else{
                        alert(result.message);
                    }
                });


            }else{
                //更新三级分类
                var name = $("#category_name").val();
                var category_id = $("#category_name").attr('alt');
                var url = "api/categories/"+category_id;

                $.post(url,{name:name},function(result){
                    if(result.code == 0){
                        $('.update-category').text(result.data.name);
                        $('#myCategoryModal').modal('hide');
                    }else{
                        alert(result.message);
                    }
                });

            }

        }



        function showEdit() {
            var bool = $('.on-off').hasClass('hidden');
            if (bool) {
                $('.on-off').removeClass('hidden');
                $('#edit').removeClass('btn-primary').addClass('btn-danger');
            } else {
                $('.on-off').addClass('hidden');
                $('#edit').removeClass('btn-danger').addClass('btn-primary');
            }
        }
        
        function showEditModel() {
            
        }

    </script>
@endpush