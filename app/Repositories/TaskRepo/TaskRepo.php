<?php

namespace App\Repositories\TaskRepo;

use App\Models\Task;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class TaskRepo implements ITaskRepo
{
    private $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function fetch($status, $categoryId = null, $search = null): LengthAwarePaginator
    {
        return $this->task->with('createdBy')
            ->where('status', $status)
            ->where(function ($q) use ($categoryId) {
                if ($categoryId) $q->where('category_id', $categoryId);
            })
            ->where(function ($q) use ($search) {
                if ($search != null) {
                    $q->where('title', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate(25);

    }

    public function destroy($id)
    {
        $this->task->findOrFail($id)->delete();
        return $id;
    }

    /**
     * @param array $attributes
     * @param $id
     * @return mixed
     */
    public function update(array $attributes, $id): Model
    {
        /**
         * will le later associated with TASK-Assignees having many-to-many relationship
         */
        $task = $this->task->where('created_by', Auth::id())->find($id);

        foreach ($attributes as $key => $val) {
            $task->$key = $val;
        }
        $task->save();
        return $task;
    }

    public function save(array $attributes): Model
    {
        Auth::user()->categories()->where('category_id', $attributes['category_id'])->firstorFail();
        $attributes['created_by'] = Auth::id();
        return $this->task->create($attributes);
    }
}
