<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Http\Resources\TaskResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
class TaskController extends Controller
{
    /**
     * Create a new task
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'note' => 'nullable|string',
            'date' => 'required|string',
            'time' => 'required|string',
            'colorindex' => 'nullable|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Please provide all required fields'
            ], 400);
        }

        $task = Task::create([
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'note' => $request->note ?? '',
            'date' => $request->date,
            'time' => $request->time,
            'colorindex' => $request->colorindex ?? 0,
        ]);

        return response()->json(['task' => new TaskResource($task)], 201);
    }

    /**
     * Get tasks by date
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
        ]);
        Log::info("Request date: " . $request->date);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Date is required'
            ], 400);
        }
        Log::info("User ID: " . $request->user()->id);

        $tasks = Task::where('user_id', $request->user()->id)
            ->where('date', $request->date)
            ->get();
        Log::info(json_encode(['tasks' => TaskResource::collection($tasks)]));
        return response()->json(['tasks' => $tasks]);
    }

    /**
     * Update a task
     */
    public function update(Request $request, $id)
    {
        if (!is_numeric($id)) {
            return response()->json([
                'message' => 'Invalid task ID'
            ], 400);
        }

        $task = Task::where('user_id', $request->user()->id)
            ->where('id', $id)
            ->first();

        if (!$task) {
            return response()->json([
                'message' => 'Task not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'note' => 'nullable|string',
            'date' => 'nullable|string',
            'time' => 'nullable|string',
            'colorindex' => 'nullable|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        }

        $task->update($request->only(['title', 'note', 'date', 'time', 'colorindex']));

        return response()->json(['task' => new TaskResource($task)]);
    }

    /**
     * Delete a task
     */
    public function destroy(Request $request, $id)
    {
        if (!is_numeric($id)) {
            return response()->json([
                'message' => 'Invalid task ID'
            ], 400);
        }

        $task = Task::where('user_id', $request->user()->id)
            ->where('id', $id)
            ->first();

        if (!$task) {
            return response()->json([
                'message' => 'Task not found'
            ], 404);
        }

        $task->delete();

        return response()->json([
            'message' => 'Task deleted successfully'
        ]);
    }
}
