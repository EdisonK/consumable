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
            <a class="btn btn-primary">总库存</a>
            <a class="btn btn-default" href="{{ url('private-inventories') }}">我的库存</a>
        <div class="row">
            <div class="col-lg-8 col-md-8">

            </div><!-- /.col-lg-6 -->
            <div class="col-lg-4 col-md-4">
                <div  class="col-lg-4 col-md-4">

                </div>
                <div class="input-group col-lg-8 col-md-8">
                    <input type="text" class="form-control" placeholder="关键字（产品名）"value="{{ $keyword }}" id="keyword">
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
                        <th>位置</th>
                        <th>单价</th>
                        <th>费用</th>

                    </tr>
                    </thead>
                    <tbody data-total="{{ $inventories['last_page'] }}" id="pages" data-current="{{ $inventories['current_page'] }}">
                    @foreach($inventories['data'] as $inventory)
                        <tr>
                            <td><a href="/products/{{ $inventory['product_id'] }}">{{ $inventory['product_name'] }}</a></td>
                            <td>{{ $inventory['total_count'] }}</td>
                            <td>{{ $inventory['location'] }}</td>
                            <td>{{ $inventory['price'] }}元/{{ $inventory['unit'] }}</td>
                            <td>{{ $inventory['total_money'] }}元</td>
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
                    var url = '{{ url('inventories') }}';
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
            var url = '{{ url('inventories') }}';
            var keyword = $('#keyword').val();
            if(keyword){
                url +=  '?keyword=' + keyword;
            }
            window.location.href = url;
        }

    </script>
@endpush