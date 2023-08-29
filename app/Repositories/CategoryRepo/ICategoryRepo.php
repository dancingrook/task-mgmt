<?php

namespace App\Repositories\CategoryRepo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface ICategoryRepo
{
    public function fetch(): Collection;

    public function inviteUsers($categoryId, $userIds): Collection;

}
