<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepo\CategoryRepo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $categoryRepo;

    public function __construct(CategoryRepo $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function index(): JsonResponse
    {
        $categories = $this->categoryRepo->fetch();
        return response()->json($categories, 200);
    }

    public function inviteUsers(Request $request): JsonResponse
    {
        $users = $this->categoryRepo->inviteUsers($request->categoryId, $request->userIds);
        return response()->json($users, 201);
    }
}
