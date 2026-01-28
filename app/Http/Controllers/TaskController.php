<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request) {
        $filter = $request->query('filter', 'completed');
        $query = Task::with('category');

        if ($filter === 'completed'){
            $query->where('is_completed', true);
        }
        elseif ($filter === 'not_completed'){
            $query->where('is_completed', false);
        }
        return view('tasks.index', ['tasks' => $query->get(),'filter' => 'not_completed',]);
        //return view('tasks.index', ['tasks' => $query->get()]);
    }
    public function create() {
        return view('tasks.create', ['categories' => Category::all()]);
    }
    public function store(Request $request) {
        $request->validate([
            'title'=>'required|min:5',
            'category_id'=>'required|exists:categories,id'
        ]);
        Task::create($request->all());
        return redirect()->route('tasks.index', ['filter' => 'not_completed']);
    }
    public function complete(Task $task) {
        $task->update(['is_completed'=>true]);
        return redirect()->route('tasks.index', ['filter' => 'not_completed']);
    }
}
