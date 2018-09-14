@extends('layouts.app')
@section('content')

    <div class="col-sm-3 col-md-3 col-lg-3 pull-left">
        <div class="sidebar-module">
            <h4>导航
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
                                    <span class="hidden on-off"><i class="fa fa-edit"></i><i
                                                class="fa fa-trash"></i></span>
                                    <ol class="hidden" style="list-style-type: none;">
                                        @foreach($class->categories as $category)
                                            <li alt="{{ $category->id }}" type_class="categories"><a
                                                        href="jacascript::void(0)">{{ $category->name }}</a>
                                                <span class="hidden on-off"><i class="fa fa-edit"></i><i
                                                            class="fa fa-trash"></i></span>

                                            </li>
                                        @endforeach
                                        <li class="hidden on-off"><a href="jacascript::void(0)">添加三级分类</a><i class="fa fa-plus"
                                                                                          aria-hidden="true"></i></li>
                                    </ol>

                                </li>
                            @endforeach
                            <li class="hidden on-off"><a href="jacascript::void(0)">添加二级分类</a><i class="fa fa-plus" aria-hidden="true"></i>
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
        <div class="jumbotron">
            <h1>lalal</h1>
            <p><a class="btn btn-lg btn-success" href="#" role="button">Get started today</a></p>
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
@endsection

@push('scripts')
    <script>
        $(function () {
            $('#edit').bind('click', showEdit);
            $('.fa-edit').bind('click', showEditModel);
            //仓库相关
            $('.warehouses-edit').bind('click', showWarehouseModel);
            $('.add_warehouse').bind('click', showWarehouseModel);
            $('#warehouse_save').bind('click', saveWarehouseModel);

            $('.warehouse-trash').bind('click', trashWarehouse);


            $('.tree').bind('click', triggerSon);


        });
        
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