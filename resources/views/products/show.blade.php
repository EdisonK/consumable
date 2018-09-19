@extends('layouts.app')
@section('content')
    <div class="col-lg-9 col-md-9 col-sm-9 pull-left">

        <div class="row" style="font-size: medium; line-height: 2em">
            <div class="col-md-4">
                <label>名称:</label> <span>{{ $product->name }}</span>
            </div>
            <div class="col-md-4">
                <label>中文名称:</label> <span>{{ $product->chinese_name }}</span>
            </div>
            <div class="col-md-4">
                <label>英文名称:</label> <span>{{ $product->english_name }}</span>
            </div>
            <div class="col-md-4">
                <label>CAS 号:</label> <span>{{ $product->cas }}</span>
            </div>
            <div class="col-md-4">
                <label>分子式:</label> <span>{{ $product->molecular_formula }}</span>
            </div>
            <div class="col-md-4">
                <label>品牌:</label> <span>{{ $product->brand->name }}</span>
            </div>
            <div class="col-md-4">
                <label>单价:</label> <span>{{ $product->price }}/{{ $product->unit }}</span>
            </div>
            <div class="col-md-4">
                <label>型号:</label> <span>{{ $product->model_type }}</span>
            </div>
            <div class="col-md-4">
                <label>所属种类:</label> <span>{{ $warehouse->name }}/{{ $class->name }}/{{ $category->name }}</span>
            </div>
            <div class="col-md-4">
                <label>简介:</label> <span>{{ $warehouse->description }}</span>
            </div>
        </div>
    </div>
    <div class="col-sm-3 col-md-3 col-lg-3 pull-right">
        <div class="sidebar-module">
                <button class="btn btn-primary" alt="{{ $product->id }}" id="add_order">下单</button>
        </div>

    </div>


    <!-- 订单Modal -->
    <div class="modal fade" id="myOrderModal" tabindex="-1" role="dialog" aria-labelledby="myOrderModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myOrderModalLabel">仓库</h4>
                </div>
                <div class="modal-body">
                    <input class="form-control" placeholder="请输入需要的数量" id="order_count">
                    <br>
                    <textarea placeholder="请填写备注"
                              style="resize: vertical"
                              id="order_note"
                              name="body"
                              rows="3" spellcheck="false"
                              class="form-control autosize-target text-left">
                    </textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" alt id="order_save">确定</button>
                </div>
            </div>
        </div>
    </div>



@endsection

@push('scripts')
    <script>
        $(function () {
            //添加订单
            $('#add_order').bind('click', showOrderModel);
            $('#order_save').bind('click', saveOrderModel);
        });

        function showOrderModel() {
            $('#myOrderModal').modal('show');
            var productId = $(this).attr('alt');
            $('#order_save').attr('alt',productId);
            console.log('{{ csrf_token() }}');
        }

        function saveOrderModel() {
            //添加订单
            var count = $("#order_count").val();
            var note = $("#order_note").val();
            var product_id = $(this).attr('alt');

            var url = "/orders";
             $.post(url,{ count : count, product_id : product_id, note: note},function(result){
                 if(result.code == 0){
                     window.location.reload();
                 }else{
                     alert(result.message);
                 }
             });

        }

    </script>
@endpush