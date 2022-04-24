<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\RequestStack;

class TaskController extends Controller
{
    public function index()
    {

        $tasks = Task::orderBy('name')->get();
        return view('tasks', compact('tasks'));
    }

    public function store(Request $request)
    {

        $task = new Task();
        $task->name = $request->name;
        $task->save();

        return redirect()->to('/tasks');
    }

    public function destroy(Request $request)
    {
        Task::find($request->id)->delete();
        return redirect()->to('/tasks');
    }

    public function updatedata(Request $request)
    {
        $task = Task::find($request->id);
        return view('updatedata', compact('task'));
    }

    public function update(Request $request)
    {
        Task::where('id', $request->id)
            ->update(['name' => $request->name]);

        return redirect()->to('/tasks');
    }
}
