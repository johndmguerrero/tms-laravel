@extends('..layouts.app')

@section('content')
    
    <div class="container">

        <div class="app-heading">
            <form action=" {{ route('tasks.update',$task->id ) }}" method="POST">
                {{ method_field('PUT') }}
                {{ csrf_field() }}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <input type="text" name="name" class="form-control" value="{{ $task->name }}" placeholder="Name of the Task">
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <textarea name="description" value="" id="" class="form-control" placeholder="Description" cols="30" rows="10">{{$task->description}}</textarea>
                        </div>
                        <div class="clearfix">
                            <div class="form-group">
                                <input type="date" value="{{$task->duedate}}" name="duedate" id="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sel1">Status:</label>
                            
                            {{ Form::select('status',['Pending','Active','Blocked','Done'], $task->status ,[ 'class' => 'form-control' ] )}}

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