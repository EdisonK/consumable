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
                <div class="col-lg-4 pull-right c-datepicker-date-editor J-datepicker-range-day" style="margin-right: -30px;margin-top: 2px;">
                    <i class="c-datepicker-range__icon kxiconfont icon-clock"></i>
                    <input placeholder="开始日期" name="" class="c-datepicker-data-input only-date" id="date_from" value="{{ $date_from }}">
                    <span class="c-datepicker-range-separator">-</span>
                    <input placeholder="结束日期" name="" class="c-datepicker-data-input only-date" id="date_to" value="{{ $date_to }}">
                </div>
            </div><!-- /.col-lg-6 -->
            <div class="col-lg-4">
                <div  class="col-lg-4">
                    <select  class="form-control" id="check-status">
                        <option value="">请选择</option>
                        <option value="1"  @if ($checkStatus == 1) selected @endif >已审核</option>
                        <option value="2"  @if ($checkStatus == 2) selected @endif>未审核</option>
                    </select>
                </div>
                <div class="input-group col-lg-8">
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
                        <th>数量</th>
                        <th>单价</th>
                        <th>费用</th>
                        <th>提交人</th>
                        <th>审核状态</th>
                        <th>审核人</th>
                        <th>接收人</th>
                    </tr>
                    </thead>
                    <tbody data-total="{{ $orders['last_page'] }}" id="pages" data-current="{{ $orders['current_page'] }}">
                    @foreach($orders['data'] as $order)
                        <tr>
                            <td><a href="/admin/products/{{ $order['product_id'] }}">{{ $order['product_name'] }}</a></td>
                            <td>{{ $order['count'] }}</td>
                            <td>{{ $order['price'] }}元/{{ $order['unit'] }}</td>
                            <td>{{ $order['total_money'] }}元</td>
                            <td>
                                {{ $order['creator_name'] }}
                                <p>{{  $order['created_at'] }}</p>
                            </td>
                            <td>{{ $order['check_status_name'] }}</td>
                            <td>
                                {{ $order['checker_name'] }}
                                <p>  {{ $order['checked_at'] }}</p>
                            </td>
                            <td>
                                {{ $order['confirm_name'] }}
                                <p>  {{ $order['confirmed_at'] }}</p>
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
                    var url = '/orders';
                    var keyword = $('#keyword').val();
                    var check_status = $('#check-status').val();
                    console.log(url);
                    url +=  '?page='+num;
                    url +=  '?date_from=' + date_from;
                    url +=  '&date_to=' + date_to;
                    if(check_status){
                        url +=  '&check_status=' + check_status;
                    }
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
            var url = '/orders';
            var keyword = $('#keyword').val();
            var date_from = $('#date_from').val();
            var date_to = $('#date_to').val();
            var check_status = $('#check-status').val();
            url +=  '?date_from=' + date_from;
            url +=  '&date_to=' + date_to;
            url +=  '&check_status=' + check_status;
            if(keyword){
                url +=  '&keyword=' + keyword;
            }

            window.location.href = url;

        }

    </script>
@endpush