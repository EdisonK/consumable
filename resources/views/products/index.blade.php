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
                {{--<button type="button" class="btn btn-default">下单</button>--}}
            </div><!-- /.col-lg-6 -->
            <div class="col-lg-4 col-md-4">
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
                        <th>名称</th>
                        <th>中文名</th>
                        <th>英文名</th>
                        <th>cas号</th>
                        <th>分子式</th>
                        <th>品牌</th>
                        <th>单价</th>
                        <th>型号</th>
                    </tr>
                    </thead>
                    <tbody data-total="{{ $products->lastPage() }}" id="pages" data-current="{{ $products->currentPage() }}">
                    @foreach($products as $product)
                        <tr>
                            <td><a href="/products/{{ $product->id }}">{{ $product->name }}</a></td>
                            <td>{{ $product->chinese_name }}</td>
                            <td>{{ $product->english_name }}</td>
                            <td>{{ $product->cas }}</td>
                            <td>{{ $product->molecular_formula }}</td>
                            <td>{{ $product->brand->name }}</td>
                            <td>{{ $product->price }}元/{{ $product->unit }}</td>
                            <td>{{ $product->model_type }}</td>
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
                    var url = 'products';
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
            var url = 'products';
            var keyword = $('#keyword').val();
            if(keyword){
                url +=  '?keyword=' + keyword;
            }
            window.location.href = url;

        }

    </script>
@endpush