@extends('..layouts.app')

@section('content')

    <div class="container">
        
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
                            <select class="form-control" name="status" id="sel1">
                              <option>Pending</option>
                              <option>Active</option>
                              <option>Blocked</option>
                              <option>Done</option>
                            </select>
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