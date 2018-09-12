@extends('layouts.app')
@section('content')

    <div class="col-sm-3 col-md-3 col-lg-3 pull-left">
        <div class="sidebar-module">
            <h4>Actions</h4>
            <ol class="list-unstyled">
                <li><a href="/companies/{{ $company->id }}/edit">Edit</a></li>
                <li><a href="/projects/create">Add Project</a></li>
                <li><a href="/companies">My Companies</a></li>
                <li><a href="/companies/create">Create new Company</a></li>
                <br/>
                <li>
                    <a href="#"
                       onclick="
                    var result = confirm('确定删除该公司么？');
                    if(result){
                        event.preventDefault();
                        document.getElementById('delete-form').submit();
                    }">
                        Delete
                    </a>
                    <form id="delete-form" action="{{ route('companies.destroy',[$company->id]) }}"
                          method="POST" style="display: none;">
                        <input type="hidden" name="_method" value="delete">
                        {{ csrf_field() }}
                    </form>

                </li>
            </ol>
        </div>

    </div>

    <div class="col-lg-9 col-md-9 col-sm-9 pull-right">

        <div class="jumbotron">
            <h1>{{ $company->name }}</h1>
            <p class="lead">{{ $company->description }}</p>

        </div>

        <!-- Example row of columns -->
        <div class="row" style="background: white; margin: 10px;">
            @foreach($company->projects as $project)
                <div class="col-lg-4">
                    <h2>{{ $project->name }}</h2>
                    <p class="text-danger">{{ $project->description }}</p>
                    <p><a class="btn btn-primary" href="/projects/{{  $project->id }}" role="button">View Project »</a></p>
                </div>
            @endforeach

        </div>
    </div>

@endsection