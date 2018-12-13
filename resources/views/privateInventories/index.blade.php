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
        <a class="btn btn-default"  href="{{ url('inventories') }}">总库存</a>
        <a class="btn btn-primary">我的库存</a>
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
                            <td>
                                {{ $inventory['location'] }}
                                <span aria-hidden="true" class="glyphicon glyphicon-edit location-edit" alt="{{ $inventory['location'] }}" piid="{{ $inventory['id'] }}"></span>
                            </td>
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

<!-- 添加Modal -->
<div class="modal fade" id="myLocationModal" tabindex="-1" role="dialog" aria-labelledby="myLocationModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myLocationModalLabel">位置</h4>
            </div>
            <div class="modal-body">
              <input class="form-control" value="" id="location">
                <br>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" alt id="save">确定</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(function () {
            $('#search').bind('click', search);
            $('.location-edit').bind('click', showLocationModel);
            $('#save').bind('click', saveLocationModel);

            init();
            //敲回车搜索
            $('#keyword').keyup(function (e) {
                if(e.keyCode == 13){
                    search();
                }
            });
        });
        
        function showLocationModel() {
            $('#myLocationModal').modal('show');
            var location = $(this).attr('alt');
            var piid = $(this).attr('piid');
            $('#save').attr('alt',piid);
            $('#location').val(location);
        }
        
        function saveLocationModel() {
            //添加修改这个药品的位置
            var location = $("#location").val();
            var piid = $(this).attr('alt');
            var url = "{{ url('') }}"+"/private-inventories/location/"+piid;
            $.post(url,{ location : location},function(result){
                if(result.code == 0){
                    window.location.href = "{{ url('') }}"+'/private-inventories';
                }else{
                    alert(result.message);
                }
            });
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
                    var url = '{{ url('private-inventories') }}';
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
            var url = '{{ url('private-inventories') }}';
            var keyword = $('#keyword').val();
            if(keyword){
                url +=  '?keyword=' + keyword;
            }
            window.location.href = url;
        }

    </script>
@endpush