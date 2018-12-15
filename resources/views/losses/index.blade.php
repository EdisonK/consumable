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
                {{--<button class="btn btn-danger" id="add_loss">添加损耗</button>--}}
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
                        <th>仓库</th>
                        <th>单价</th>
                        <th>费用</th>
                        <th>提交人</th>
                        <th>审核人</th>
                        <th>备注</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody data-total="{{ $losses['last_page'] }}" id="pages" data-current="{{ $losses['current_page'] }}">
                    @foreach($losses['data'] as $loss)
                        <tr>
                            <td><a href="{{ url('products',[$loss['product_id']]) }}">{{ $loss['product_name'] }}</a></td>
                            <td>{{ $loss['loss_count'] }}</td>
                            <td>{{ $loss['use_name'] }}</td>
                            <td>{{ $loss['price'] }}元/{{ $loss['unit'] }}</td>
                            <td>{{ $loss['total_money'] }}元</td>
                            <td>
                                {{ $loss['creator_name'] }}
                                <p>
                                    {{ $loss['created_at'] }}
                                </p>
                            </td>
                            <td>
                                {{ $loss['checker_name'] }}
                                <p>
                                    {{ $loss['checked_at'] }}
                                </p>
                            </td>
                            <td>{{ $loss['note'] }}</td>
                            <td>
                                @if( auth()->user()->isGroupLeader())
                                    @if($loss['checked_at'])

                                     已审核
                                    @else

                                      <button class="btn btn-danger btn-xs checker" alt="{{ $loss['id'] }}">审核</button>
                                    @endif
                                @else
                                    无权限
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
    <div class="modal fade" id="myLossModal" tabindex="-1" role="dialog" aria-labelledby="myLossModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myLossModalLabel">损耗</h4>
                </div>
                <div class="modal-body">
                     <select class="form-control" id="product_id">
                         <option value="">请选择</option>
                         @foreach( $inventories as $key => $inventory)
                         <option value="{{ $inventory->product_id }}" alt="{{  $inventory->total_count }}">{{ $inventory->product->name }}</option>
                         @endforeach
                     </select>
                    {{--<select class="js-ex form-control" name="state">--}}
                        {{--<option value="AL">Alabama</option>--}}
                        {{--<option value="WY">Wyoming</option>--}}
                    {{--</select>--}}
                    <br>
                    <input class="form-control" placeholder="请输入损耗的数量" id="loss_count" alt>
                    <br>
                    <textarea placeholder="请填写损耗的备注"
                              style="resize: vertical"
                              id="loss_note"
                              name="body"
                              rows="3" spellcheck="false"
                              class="form-control autosize-target text-left">
                    </textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" alt id="loss_save">确定</button>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('scripts')
    <script>
        $(function () {

            $('#search').bind('click', search);
            $('#creator-id').on('change',search);

            //添加损耗
            $('#add_loss').bind('click', showLossModel);
            $('#loss_save').bind('click', saveLossModel);


            $('.checker').bind('click', checker);

            $('#product_id').on('change', changeCount);

            init();

            //敲回车搜索
            $('#keyword').keyup(function (e) {
                if(e.keyCode == 13){
                    search();
                }
            });

            // $('.js-ex').select2();
        });
        function changeCount() {
            // console.log($('#product_id:selected').attr('alt'));
            // $('#loss_count').attr('alt',$(this).attr('alt'));
        }

        function checker() {
            var loss_id = $(this).attr('alt');
            var url = "{{ url('') }}"+'/losses/checker/'+loss_id;
            $.post(url,{},function(result){
                if(result.code == 0){
                    window.location.reload();
                }else{
                    alert(result.message);
                }
            });

        }


        function showLossModel() {
            $('#myLossModal').modal('show');
            console.log('{{ csrf_token() }}');
        }

        function saveLossModel() {
            //添加损耗
            var loss_count = $("#loss_count").val();
            var product_id = $("#product_id").val();
            var note = $("#loss_note").val();

            var url = "{{ url('losses') }}";
            $.post(url,{ loss_count : loss_count, product_id : product_id, note: note},function(result){
                if(result.code == 0){
                    window.location.reload();
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
                    var url =  "{{ url('losses') }}";
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
            var url =  "{{ url('losses') }}";
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