@extends('layouts.app')

@section('content')
    <div class="col-lg-6 col-md-6 col-md-offset-3 col-lg-offset-3">
        <div class="panel panel-primary">
            <div class="panel-heading">仓库 <a class="pull-right btn btn-primary btn-sm" href="/warehouses/create">创建新仓库</a></div>
            <div class="panel-body">

                <ul class="list-group">
                    @foreach($warehouses as $warehouse)
                        <li class="list-group-item"><a href="/warehouses/{{ $warehouse->id }}"> {{ $warehouse->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection

