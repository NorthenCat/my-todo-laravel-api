<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax() || $request->has('ajax')) {
            $date = $request->get('date', date('Y-m-d'));
            $tasks = Task::where('user_id', auth()->id())
                ->where('date', $date)
                ->orderBy('time')
                ->get();

            return response()->json(['tasks' => $tasks]);
        }

        return view('tasks.tasks');
    }

    public function create()
    {
        return view('tasks.create');
    }

    private function normalizeTimeFormat($timeString)
    {
        // Check if it's in 12-hour format (contains AM/PM)
        if (preg_match('/^(\d{1,2}):(\d{2})\s*(AM|PM)$/i', $timeString, $matches)) {
            $hours = intval($matches[1]);
            $minutes = $matches[2];
            $ampm = strtoupper($matches[3]);

            if ($ampm === 'PM' && $hours !== 12) {
                $hours += 12;
            } elseif ($ampm === 'AM' && $hours === 12) {
                $hours = 0;
            }

            return sprintf('%02d:%s', $hours, $minutes);
        }

        // Already in 24-hour format or invalid format
        return $timeString;
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'note' => 'nullable|string',
            'date' => 'required|date',
            'time' => 'required|string',
            'colorindex' => 'required|integer|min:0|max:5'
        ]);

        // Normalize time format to 24-hour
        $normalizedTime = $this->normalizeTimeFormat($request->time);

        // Validate normalized time is in correct 24-hour format
        if (!preg_match('/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/', $normalizedTime)) {
            return response()->json(['message' => 'Invalid time format'], 422);
        }

        $task = Task::create([
            'title' => $request->title,
            'note' => $request->note,
            'date' => $request->date,
            'time' => $normalizedTime,
            'colorindex' => $request->colorindex,
            'user_id' => auth()->id()
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['message' => 'Task created successfully!', 'task' => $task]);
        }

        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    public function show(Task $task, Request $request)
    {
        // Check if user owns the task
        if ($task->user_id !== auth()->id()) {
            if ($request->ajax() || $request->has('ajax')) {
                return response()->json(['message' => 'Unauthorized'], 403);
            }
            abort(403);
        }

        if ($request->ajax() || $request->has('ajax')) {
            return response()->json(['task' => $task]);
        }

        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        // Check if user owns the task
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        // Check if user owns the task
        if ($task->user_id !== auth()->id()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['message' => 'Unauthorized'], 403);
            }
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'note' => 'nullable|string',
            'date' => 'required|date',
            'time' => 'required|string',
            'colorindex' => 'required|integer|min:0|max:5'
        ]);

        // Normalize time format to 24-hour
        $normalizedTime = $this->normalizeTimeFormat($request->time);

        // Validate normalized time is in correct 24-hour format
        if (!preg_match('/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/', $normalizedTime)) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['message' => 'Invalid time format'], 422);
            }
            return back()->withErrors(['time' => 'Invalid time format']);
        }

        $task->update([
            'title' => $request->title,
            'note' => $request->note,
            'date' => $request->date,
            'time' => $normalizedTime,
            'colorindex' => $request->colorindex
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['message' => 'Task updated successfully!', 'task' => $task]);
        }

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    public function destroy(Request $request, Task $task)
    {
        // Check if user owns the task
        if ($task->user_id !== auth()->id()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['message' => 'Unauthorized'], 403);
            }
            abort(403);
        }

        $task->delete();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['message' => 'Task deleted successfully!']);
        }

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }
}
