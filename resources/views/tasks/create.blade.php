@extends('..layouts.app')

@section('content')

    <div class="container">

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        
        <div class="app-heading">
            <form action=" {{ route('tasks.store') }}" method="POST">
                {{ csrf_field() }}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <input type="text" name="name" class="form-control" placeholder="Name of the Task">
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <textarea name="description" id="" class="form-control" placeholder="Description" cols="30" rows="10"></textarea>
                        </div>
                        <div class="clearfix">
                            <div class="form-group">
                                <input type="date" name="duedate" id="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sel1">Status:</label>
                            {{ Form::select('status',['Pending','Active','Blocked','Done'],'',[ 'class' => 'form-control' ] )}}
                          </div>
                    </div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        
    </div>

@endsection