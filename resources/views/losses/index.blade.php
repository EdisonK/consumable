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
                <button class="btn btn-danger">添加损耗</button>
            </div><!-- /.col-lg-6 -->
            <div class="col-lg-4 col-md-4">
                <div  class="col-lg-4 col-md-4">
                    <select  class="form-control" id="creator-id">
                        <option value="">请选择</option>
                        @foreach( $users as $key => $user)
                            <option value="{{ $user->id }}"  @if ($creatorId == $user->id) selected @endif >{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group col-lg-8 col-md-8">
                    <input type="text" class="form-control" placeholder="关键字（产品名、创建人）"value="{{ $keyword }}" id="keyword">
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
                        <th>产品名</th>
                        <th>损耗数量</th>
                        <th>单价</th>
                        <th>费用</th>
                        <th>提交人</th>
                        <th>备注</th>
                    </tr>
                    </thead>
                    <tbody data-total="{{ $losses['last_page'] }}" id="pages" data-current="{{ $losses['current_page'] }}">
                    @foreach($losses['data'] as $loss)
                        <tr>
                            <td><a href="/admin/products/{{ $loss['product_id'] }}">{{ $loss['product_name'] }}</a></td>
                            <td>{{ $order['loss_count'] }}</td>
                            <td>{{ $order['price'] }}元/{{ $order['unit'] }}</td>
                            <td>{{ $order['total_money'] }}元</td>
                            <td>
                                {{ $order['creator_name'] }}
                                <p>
                                    {{ $order['created_at'] }}
                                </p>
                            </td>
                            <td>{{ $order['note'] }}</td>

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


@endsection

@push('scripts')
    <script>
        $(function () {

            $('#search').bind('click', search);
            $('#creator-id').on('change',search);
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
                    var url = '/losses';
                    var keyword = $('#keyword').val();
                    var creator_id = $('#creator-id').val();
                    console.log(url);
                    url +=  '?page='+num;
                    if(keyword){
                        url +=  '&keyword=' + keyword;
                    }
                    if(creator_id){
                        url +=  '&creator_id=' + creator_id;
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
            var url = '/losses';
            var keyword = $('#keyword').val();
            var creator_id = $('#creator-id').val();
            url +=  '?creator_id=' + creator_id;

            if(keyword){
                url +=  '&keyword=' + keyword;
            }

            window.location.href = url;
        }

    </script>
@endpush