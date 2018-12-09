@extends('layouts.app')
@section('content')
    {{--<div class="col-sm-2 col-md-2 col-lg-2 pull-left">--}}
    {{--<div class="sidebar-module">--}}
    {{--<h4>我的</h4>--}}
    {{--<ul class="list-unstyled">--}}
    {{--<li><a href="jacascript::void(0)" class="">我的订单</a></li>--}}
    {{--<li><a href="jacascript::void(0)" class="">我的损耗</a></li>--}}
    {{--</ul>--}}
    {{--</div>--}}
    {{--</div>--}}
    <div class="col-sm-12 col-md-12 col-lg-12 pull-right">
        <div class="row">
            <div class="col-lg-8 col-md-8">
                <!-- Single button -->

            </div><!-- /.col-lg-6 -->
            <div class="col-lg-4 col-md-4">
                <div  class="col-lg-4 col-md-4">
                </div>
                <div class="input-group col-md-8">
                    <input type="text" class="form-control" placeholder="关键字(姓名)"value="{{ $keyword }}" id="keyword">
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
                        <th>姓名</th>
                        <th>邮箱</th>
                        <th>角色</th>
                        <th>注册时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody data-total="{{ $users['last_page'] }}" id="pages" data-current="{{ $users['current_page'] }}">
                    @foreach($users['data'] as $user)
                        <tr>
                            <td>{{ $user['name'] }}</td>
                            <td>{{ $user['email'] }}</td>
                            <td>
                                @foreach($user['roles'] as $role)
                                    {{ $role->name }}
                                @endforeach
                                    <span aria-hidden="true" class="glyphicon glyphicon-edit role-edit" alt="{{ $user['roles'] }}"></span>
                            </td>
                            <td>{{ $user['created_at'] }}</td>
                            <td>
                                <a class="reset-password" href="javascript:void(0)" alt="{{ $user['id'] }}">重置密码</a>
                                @if( $user['on'] == 0 )
                                    <button class="btn btn-xs btn-primary on" href="javascript:void(0)" alt="{{ $user['id'] }}" flag="1">启用</button>
                                @elseif(  $user['on'] == 1 )
                                    <button class="btn btn-xs btn-danger off" href="javascript:void(0)" alt="{{ $user['id'] }}" flag="2">禁用</button>
                                @endif
                            </td>
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

    <!-- 添加Modal -->
    <div class="modal fade" id="myRoleModal" tabindex="-1" role="dialog" aria-labelledby="myRoleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myRoleModalLabel">角色</h4>
                </div>
                <div class="modal-body">
                    <select class="js-example-basic-multiple" name="states[]" multiple="multiple" style="width: 100%" id="role_ids">
                        @foreach($user['roles'] as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>

                    <br>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" alt id="save">确定</button>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('scripts')
    <script>
        $(function () {

            $('#search').bind('click', search);
            $('#check-status').on('change',search);
            $('.on').bind('click',swithOn);
            $('.off').bind('click',swithOn);
            $('.reset-password').bind('click',resetPassword);

            //添加损耗
            $('.role-edit').bind('click', showRoleModel);
            $('#loss_save').bind('click', saveLossModel);

            init();

            //敲回车搜索
            $('#keyword').keyup(function (e) {
                if(e.keyCode == 13){
                    search();
                }
            });
        });

        function showRoleModel() {
            var seletct2 = $('.js-example-basic-multiple').select2();
            $('#myRoleModal').modal('show');
            var roles = $(this).attr('alt');
            var arr = new Array();
            $.each(JSON.parse(roles),function (i,e) {
                arr[i] = e.name;
            });
            seletct2.val(arr).trigger("change");
        }

        function saveLossModel() {
            //添加损耗
            var loss_count = $("#loss_count").val();
            var product_id = $("#product_id").val();
            var note = $("#loss_note").val();

            var url = "/losses";
            $.post(url,{ loss_count : loss_count, product_id : product_id, note: note},function(result){
                if(result.code == 0){
                    window.location.reload();
                }else{
                    alert(result.message);
                }
            });
        }
        
        function resetPassword() {
            var user_id = $(this).attr('alt');
            if(!user_id){
                alert('请传入用户的id');
                return;
            }
            var url = '/admin/users/password/'+user_id;
            $.post(url,{},function (res) {
                if(res.code == 0){
                    alert('您的密码已经重置，密码为：123456');
                    window.location.href = '/admin/users';
                }else{
                    alert(res.message);
                }
            })
        }
        
        
        function swithOn() {
            var user_id = $(this).attr('alt');
            var flag = $(this).attr('flag');
            if(!user_id){
                alert('请传入用户的id');
                return;
            }
            var url = '/admin/users/on/'+user_id;
            $.post(url,{'flag':flag},function (res) {
                if(res.code == 0){
                    window.location.href = '/admin/users';
                }else{
                    alert(res.message);
                }
            })

            
        }


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
                    var url = '/admin/users';
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
            var url = '/admin/users';
            var keyword = $('#keyword').val();
            if(keyword){
                url +=  '?keyword=' + keyword;
            }

            window.location.href = url;

        }

    </script>
@endpush