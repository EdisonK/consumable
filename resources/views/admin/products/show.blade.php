@extends('layouts.app')
@section('content')
    <div class="col-lg-9 col-md-9 col-sm-9 pull-left">

        <div class="row">
            <div class="col-md-4">
                <label>联系人:</label> <span>朱海东</span>
            </div>
            <div class="col-md-4">
                <label>联系人:</label> <span>朱海东</span>
            </div>
            <div class="col-md-4">
                <label>联系人:</label> <span>朱海东朱海东朱海朱海东朱海东朱海朱海东朱海东朱海</span>
            </div>
            <div class="col-md-4">
                <label>联系人:</label> <span>朱海东</span>
            </div>
            <div class="col-md-4">
                <label>联系人:</label> <span>朱海东</span>
            </div>
            <div class="col-md-4">
                <label>联系人:</label> <span>朱海东朱海东朱海</span>
            </div>
        </div>
    </div>
    <div class="col-sm-3 col-md-3 col-lg-3 pull-right">
        <div class="sidebar-module">
            <h4>Actions</h4>
            {{--<ol class="list-unstyled">--}}
            {{--<li><a href="/companies/{{ $company->id }}/edit">Edit</a></li>--}}
            {{--<li><a href="/projects/create">Add Project</a></li>--}}
            {{--<li><a href="/companies">My Companies</a></li>--}}
            {{--<li><a href="/companies/create">Create new Company</a></li>--}}
            {{--<br/>--}}
            {{--<li>--}}
            {{--<a href="#"--}}
            {{--onclick="--}}
            {{--var result = confirm('确定删除该公司么？');--}}
            {{--if(result){--}}
            {{--event.preventDefault();--}}
            {{--document.getElementById('delete-form').submit();--}}
            {{--}">--}}
            {{--Delete--}}
            {{--</a>--}}
            {{--<form id="delete-form" action="{{ route('companies.destroy',[$company->id]) }}"--}}
            {{--method="POST" style="display: none;">--}}
            {{--<input type="hidden" name="_method" value="delete">--}}
            {{--{{ csrf_field() }}--}}
            {{--</form>--}}

            {{--</li>--}}
            {{--</ol>--}}
        </div>

    </div>

@endsection