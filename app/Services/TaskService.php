<?php
namespace App\Services;

use App\Models\Task;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TaskService
{
    public function list($user, $perPage = 15): LengthAwarePaginator
    {
        return Task::where('user_id', $user->id)->orderBy('created_at','desc')->paginate($perPage);
    }

    public function create($user, array $data): Task
    {
        $data['user_id'] = $user->id;
        return Task::create($data);
    }

    public function findForUser($user, $id): ?Task
    {
        return Task::where('user_id', $user->id)->find($id);
    }

    public function update($user, $id, array $data): ?Task
    {
        $task = $this->findForUser($user, $id);
        if (!$task) return null;
        $task->update($data);
        return $task;
    }

    public function delete($user, $id): bool
    {
        $task = $this->findForUser($user, $id);
        if (!$task) return false;
        $task->delete();
        return true;
    }
}
