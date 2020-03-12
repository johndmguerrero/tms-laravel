<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Task as TaskResource;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ----- non API fetch
        // $user = Auth::id();
        // $tasks = Task::where('creatorid',$user)->get();
        // return view('tasks.index',compact('tasks'));
        
        // ------ API fetch
        $tasks = Task::all();
        
        return TaskResource::collection($tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Validation
            // non-api 
        // $request->validate([
        //     'name' => 'required',
        //     'description' => 'required',
        //     'duedate' => 'required',
        //     'status' => 'required',
        // ]);

        // //
        // $request = $request->all();
        // $request["creatorid"] = Auth::id();

        // Task::create($request);
        // return redirect()->route('tasks.create')
        //                  ->with('success','Task Created successfully.');

        $holdtask = $request->isMethod('put') ? Task::findOrFail($request->id) : new Task;
        // protected $fillable = [ 'id','name','creatorid' ,'description','duedate','status' ];
        
        $holdtask->id = $request->input('id');
        $holdtask->name = $request->input('name');
        $holdtask->creatorid = $request->input('creatorid', Auth::id() );
        $holdtask->description = $request->input('description');
        $holdtask->duedate = $request->input('duedate');
        $holdtask->status = $request->input('status');

        if($holdtask->save()){
            return new TaskResource($holdtask);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {

        $data = Task::findOrFail($task);

        return new TaskResource($task);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
        return view('tasks.edit',compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'duedate' => 'required',
            'status' => 'required',
        ]);

        //
        $request = $request->all();
        $request["creatorid"] = Auth::id();

        $task->update($request);
        return redirect()->route('tasks.index')
                         ->with('success','Task Updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
        $task = Task::findOrFail($task);

        if($task->delete()){
            return new TaskResource($task);
        }
        // return redirect()->route('tasks.index')
        //                  ->with('success','Task Deleted successfully');
    }
}
