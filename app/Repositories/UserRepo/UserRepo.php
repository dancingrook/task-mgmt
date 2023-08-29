<?php

namespace App\Repositories\UserRepo;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class UserRepo implements IUserRepo
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index(): Collection
    {
        return $this->user->where('id', '!=', Auth::id())->get();
    }
}
