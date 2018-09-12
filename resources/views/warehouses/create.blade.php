@extends('layouts.app')
@section('content')
    <div class="col-lg-9 col-md-9 col-sm-9 pull-left">
        <!-- Example row of columns -->
        <div class="row col-lg-12 col-md-12 col-sm-12" style="background: white; margin: 10px;">
            <form method="post" action="{{ route('warehouses.store') }}">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="post">
                <div class="form-group">
                    <label for="warehouse-name">仓库名<span class="required">*</span></label>
                    <input placeholder="请输入仓库名"
                           id="warehouse-name"
                           required
                           name="name"
                           spellcheck="false"
                           class="form-control"
                    >
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary"
                           value="提交"/>
                </div>

            </form>

        </div>
    </div>

    <div class="col-sm-3 col-md-3 col-lg-3 pull-right">

        <div class="sidebar-module">
            <h4>导航</h4>
            <h5>仓库</h5>
            <ol class="list-unstyled">
                <li><a href="/warehouses">仓库列表</a></li>

            </ol>
        </div>
    </div>

@endsection