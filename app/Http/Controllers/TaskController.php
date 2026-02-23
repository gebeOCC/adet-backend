<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return Task::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        Task::create($validated);

        return response()->json([
            'message' => 'success'
        ], 201);
    }

    public function show($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'message' => 'Task not found'
            ], 404);
        }

        return response()->json($task, 200);
    }

    public function update($id, Request $request)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'message' => 'Task not found'
            ], 404);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $task->update($validated);

        return response()->json($task, 200);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(null, 204);
    }
}