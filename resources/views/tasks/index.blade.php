@extends('..layouts.app')

@section('content')

    <div class="container">
        <div class="app-heading">

            <h2 class="pull-left m-0">Tasks</h2>
            <a href="./tasks/create" class="sm-text btn-success btn btn-default pull-right">Create</a>
            <div style="clear:both"></div>
        </div>

        <div class="app-content">

        @foreach ($tasks as $item)            
            <div class="task-card">
                <h3>{{ $item->name }}</h3>
                <div class="task-description">
                    <p>{{ $item->description }}</p>
                </div>
                <div class="task-status">
                    <p>{{ $item->status }}</p>
                </div>
                <div class="task-duedate">
                    <p>{{ $item->duedate }}</p>
                </div>
                <div class="task-action">
                    <form action="{{ route('tasks.destroy',$item->id ) }}" method="post"></form>
                    {{ csrf_field() }}
                    @method('DELETE')
                    <a href="{{ route('tasks.edit',$item->id )}}" class="btn btn-default btn-warning">edit</a>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </div>
        @endforeach    

        </div>

    </div>

@endsection