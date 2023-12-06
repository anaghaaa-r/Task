<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    // list the task
    public function list()
    {
        $tasks = Task::latest()->where('user_id', Auth::user()->id)->get();
        $categories = Category::latest()->get();

        return view('task-list', [
            'tasks' => $tasks,
            'categories' => $categories
        ]);
    }

    // view a single task
    public function single($id)
    {
        $task = Task::findOrFail($id);
        $task = Task::where('id', $id)->first();

        return view('task-detail', compact('task'));
    }

    // create a task
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'category' => 'required',
            'description' => 'required|string',
            'due_date' => 'required|date'
        ]);

        if ($validator->fails()) {
            return redirect('/task/new')->withErrors($validator)->withInput();
        }

        $user = User::where('id', Auth::id())->first();

        $task = [
            'title' => $request['title'],
            'category_id' => $request['category'],
            'description' => $request['description'],
            'due_date' => $request['due_date']
        ];

        $user->task()->create($task);

        return redirect()->route('task.list');
    }

    // edit a task
    public function edit(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string',
            'category_id' => 'nullable|string',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date'
        ]);

        if ($validator->fails()) 
        {
            return redirect()->route('task.list')->withErrors($validator)->withInput();
        }

        $updatedData = [];
        $fields = [
            'title',
            'category_id',
            'description',
            'due_date'
        ];

        foreach ($fields as $field) 
        {
            if ($request->filled($field)) 
            {
                $updatedData[$field] = $request->input($field);
            }
        }

        $task->update($updatedData);

        return redirect()->route('task.list');
    }

    // delete a task
    public function delete($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('task.list');
    }
}
