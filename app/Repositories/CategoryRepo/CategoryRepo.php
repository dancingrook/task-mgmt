<?php

namespace App\Repositories\CategoryRepo;

use App\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class CategoryRepo implements ICategoryRepo
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function fetch(): Collection
    {
        return Auth::user()->categories()->with('invitedUsers')->withCount('completedTasks', 'tasks')->get();
    }

    public function inviteUsers($categoryId, $userIds): Collection
    {
        $category = Auth::user()->categories()->where('category_id', $categoryId)->firstorFail();
        $category->users()->sync($userIds, false);
        return $category->users()->whereIn('user_id', $userIds)->get();
    }
}
