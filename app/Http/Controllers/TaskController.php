<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Task;

class TaskController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

   /**
    * タスク一覧
    */
    public function index(Request $request)
    {
        //$tasks = Task::orderBy('created_at', 'asc')->get();
        $tasks = $request->user()->tasks()->get();
        return view('tasks.index',[
            'tasks'=> $tasks,
        ]);
    }

    public function store(Request $request)
    {
        
        $this->validate($request, [
            'name' => 'required | max:255'
        ]);

        //Task::create([
        //    'user_id' => 0,
        //    'name' => $request->name
        //]);
        $request->user()->tasks()->create([
            'name' => $request->name,

        ]);

        return redirect('/tasks');
    }


    public function destroy(request $request, Task $task)
    {
        $this->authorize('destroy', $task);

        $task->delete();
        return redirect('/tasks');
    }
}
