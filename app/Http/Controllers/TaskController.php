<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * 建立一個新的控制器實例。
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $tasks = Task::where('user_id', $request->user()->id)->get();
        //$tasks= auth()->user()->tasks;
        //$tasks= auth()->user()->tasks()->get();
        //$tasks=Auth::user()->tasks;
        //$tasks=Auth::user()->tasks()->get();
        return view('tasks.index', [
            'tasks' => $tasks,
        ]);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $request->user()->tasks()->create([
            'name' => $request->name,
        ]);
        //$request->user()->tasks()->create($request->all());
        //auth()->user()->tasks()->create($request->all());
        return redirect('/tasks');
    }

}
