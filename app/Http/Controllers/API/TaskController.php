<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Services\TaskService;
use App\Http\Resources\TaskResource;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    protected $service;

    public function __construct(TaskService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        return Task::where('user_id', $request->user()->id)
            ->latest()
            ->get();
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'in:pending,in_progress,done',
            'due_date' => 'nullable|date',
        ]);

        $task = Task::create([
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status ?? 'pending',
            'due_date' => $request->due_date,
        ]);

        return response()->json($task, 201);
    }

    public function show($id, Request $request)
    {
        $task = $this->service->findForUser($request->user(), $id);
        if (!$task) {
            return response()->json(['message' => 'Not Found'], Response::HTTP_NOT_FOUND);
        }
        return new TaskResource($task);
    }

    public function update(Request $request, $id)
    {
        $task = Task::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'in:pending,in_progress,done',
            'due_date' => 'nullable|date',
        ]);

        $task->update($request->only([
            'title',
            'description',
            'status',
            'due_date'
        ]));

        return response()->json($task);
    }

    public function destroy(Request $request, $id)
    {
        $task = Task::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        $task->delete();

        return response()->json(['message' => 'Task deleted successfully']);
    }
}
