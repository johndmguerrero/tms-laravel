@extends('..layouts.app')

@section('content')

    <div class="container">
        
        <div class="app-heading">
            <form action=" {{ route('tasks.store') }}" method="POST">
                {{ csrf_field() }}
                
            </form>
        </div>
        
    </div>

@endsection