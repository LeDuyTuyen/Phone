<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Filters\CategoryFilter;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

final class CategoryController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            $filters = new CategoryFilter($request);

            $category = Category::filter($filters)->get();

            return response()->json(CategoryResource::collection($category), 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {

        $validateData = $request->validate([
            'name' => 'required|unique:categories',
        ]);
        try {
            $category = Category::create($validateData);

            return response()->json([
                'data' => new CategoryResource($category),
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'error'   => 'Dữ liệu đầu vào không hợp lệ.',
                'message' => $e->errors(),
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'error'   => 'Lỗi khi tạo danh mục sản phẩm.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, Category $category): JsonResponse
    {

        $validateData = $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id,
        ]);
        try {
            $category->update($validateData);

            return response()->json([
                'data' => new CategoryResource($category),
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'error'   => 'Dữ liệu đầu vào không hợp lệ.',
                'message' => $e->errors(),
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'error'   => 'Lỗi khi cập nhật danh mục sản phẩm.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(Category $category): JsonResponse
    {
        try {

            $category->delete();

            return response()->json(['message' => ' Xóa danh mục sản phẩm thành công', 200]);
        } catch (Exception $e) {
            return response()->json([
                'error'   => 'Xóa danh mục sản phẩm thất bại.',
                'message' => $e->getMessage()], 500);
        }
    }
}
