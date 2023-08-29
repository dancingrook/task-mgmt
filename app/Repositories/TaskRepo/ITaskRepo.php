<?php

namespace App\Repositories\TaskRepo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface ITaskRepo
{
    public function fetch($status, $categoryId = null,  $search = null): LengthAwarePaginator;
    public function save(array $attributes): Model;

    public function destroy($id);
    public function update(array $attributes, $id);
}
