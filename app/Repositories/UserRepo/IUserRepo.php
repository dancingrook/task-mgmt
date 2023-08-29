<?php

namespace App\Repositories\UserRepo;

use Illuminate\Support\Collection;

interface IUserRepo
{
    public function index(): Collection;
}
