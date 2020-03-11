@extends('..layouts.app')

@section('content')

    <div class="container">
        <div class="app-heading">
            <form action=" {{ route('tasks','TaskController@store') }}" method="POST">
                {{ csrf_field() }}
                
            </form>
        </div>
        
    </div>

@endsection