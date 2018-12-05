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
            <div class="col-lg-8">
                <!-- Single button -->
                <button class="btn-primary btn" id="check_pass" value="1">审核通过</button>
                <button class="btn-danger btn" id="check_reject" value="2">审核拒绝</button>
            </div><!-- /.col-lg-6 -->
            <div class="col-lg-4">
                <div  class="col-lg-4">
                    <select  class="form-control" id="check-status">
                        <option value="">请选择</option>
                        <option value="1"  @if ($checkStatus == 1) selected @endif >已审核</option>
                        <option value="2"  @if ($checkStatus == 2) selected @endif>未审核</option>
                    </select>
                </div>
                <div class="input-group">
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
                        <th><input type="checkbox" id="all"  @if($checkStatus == 1) disabled @endif></th>
                        <th>产品名</th>
                        <th>数量</th>
                        <th>单价</th>
                        <th>费用</th>
                        <th>提交人</th>
                        <th>审核状态</th>
                        <th>审核人</th>
                        <th>接收人</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody data-total="{{ $orders['last_page'] }}" id="pages" data-current="{{ $orders['current_page'] }}">
                    @foreach($orders['data'] as $order)
                        <tr>
                            <td><input type="checkbox" @if($order['checker_id']) disabled @endif value="{{  $order['id'] }}"></td>
                            <td><a href="#">{{ $order['product_name'] }}</a></td>
                            <td>{{ $order['count'] }}</td>
                            <td>{{ $order['price'] }}元/{{ $order['unit'] }}</td>
                            <td>{{ $order['total_money'] }}元</td>
                            <td>{{ $order['creator_name'] }}</td>
                            <td>{{ $order['check_status_name'] }}</td>
                            <td>
                                {{ $order['checker_name'] }}
                                <p>  {{ $order['checked_at'] }}</p>
                            </td>
                            <td>{{ $order['confirm_name'] }}</td>
                            <td>
                                @if($order['checker_id'])
                                    已审核
                                @else
                                    <button class="btn-primary btn btn-xs check_pass" alt="{{ $order['id'] }}" value="1">通过</button>
                                    <button class="btn-danger btn-xs check_pass" alt="{{ $order['id'] }}" value="2">拒绝</button>
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


@endsection

@push('scripts')
    <script>
        $(function () {

            $('#search').bind('click', search);
            $('#check-status').on('change',search);
            $('#all').on('change',changeCheckBox);
            $('#check_pass').bind('click',check);
            $('#check_reject').bind('click',check);
            $('.check_pass').bind('click',checkOne);
            $('.check_reject').bind('click',checkOne);

            init();

            //敲回车搜索
            $('#keyword').keyup(function (e) {
                if(e.keyCode == 13){
                    search();
                }
            });
        });
        
        function changeCheckBox() {
            var that = $("tbody input[type='checkbox']:not(:disabled)");
            if(that.is(':checked')){
                that.removeAttr("checked");
            }else {
                that.attr("checked",true);

            }
        }
        function check() {
            console.log('批量审核产品');
            var flag = $(this).val();
            var that = $("tbody input[type='checkbox']:not(:disabled):checked");
            var arr = new Array();
            that.each(function (i,e) {
                arr[i] = $(e).val()
            })
            if( arr.length <= 0){
                alert('请至少选择一项');
                return;
            }
            var url = '/admin/orders';
            console.log(arr);

            $.post(url,{'flag':flag,'order_ids':arr},function (res) {
                if(res.code == 0){
                    window.location.href = url;
                }else{
                    alert(res.message);
                }
            })
        }

        function checkOne() {
            $(this).parents('tr').find("input[type='checkbox']").attr('checked',true);
            var flag = $(this).val();
            var arr = new Array();
                arr[0] = $(this).attr('alt');
            if( arr.length <= 0){
                alert('请至少选择一项');
                return;
            }
            var url = '/admin/orders';
            $.post(url,{'flag':flag,'order_ids':arr},function (res) {
                if(res.code == 0){
                    window.location.href = url;
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
                    var url = '/admin/orders';
                    var keyword = $('#keyword').val();
                    var check_status = $('#check-status').val();
                    console.log(url);
                    url +=  '?page='+num;
                    if(keyword){
                        url +=  '&keyword=' + keyword;
                    }
                    if(check_status){
                        url +=  '&check_status=' + check_status;
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
            var url = '/admin/orders';
            var keyword = $('#keyword').val();
            var check_status = $('#check-status').val();
            url +=  '?check_status=' + check_status;

            if(keyword){
                url +=  '&keyword=' + keyword;
            }

            window.location.href = url;

        }

    </script>
@endpush