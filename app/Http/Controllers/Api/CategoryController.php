<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user_id = Auth::id();
        $categories = Category::where('user_id', $user_id)->get();
        return response()->json($categories);
    }


    public function store(StoreCategoryRequest $request)
    {
        /** @var \App\Models\User $user */
        $user_id = Auth::id();
        $category = Category::create([
            'name' => $request->name,
            'type' => $request->type,
            'user_id' => $user_id
        ]);

        return response()->json($category, 201);
    }

    public function show(Category $category)
    {
        $user_id = Auth::id();
        if ($category->user_id !== $user_id)
        {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($category);
    }

    public function destroy(Category $category)
    {
        $user_id = Auth::id();
        if ($category->user_id !== $user_id)
        {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $category->delete();
        return response()->json('', 204);
    }

    public function update(StoreCategoryRequest $request, Category $category)
    {
        $user_id = Auth::id();
        if ($category->user_id !== $user_id)
        {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $category->update([
            'name' => $request->name,
            'type' => $request->type,
        ]);

        return response()->json($category);
    }
}
