<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\ImportOrderResource;
use App\Models\ImportOrder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

final class ImportOrderController extends Controller
{
    public function index()
    {
        try {

            $importOrders = ImportOrder::with('importOrderDetails')->get();

            return ImportOrderResource::collection($importOrders);
        } catch (Exception $e) {
            return response()->json([
                'error'   => 'Lỗi khi lấy danh sách đơn hàng nhập.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'total'   => 'required|numeric',
            'user_id' => 'required|exists:users,id',
        ]);

        try {
            $importOrder = ImportOrder::create($validatedData);

            return response()->json([
                'data' => new ImportOrderResource($importOrder),
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'error'   => 'Dữ liệu đầu vào không hợp lệ.',
                'message' => $e->errors(),
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'error'   => 'Lỗi khi tạo đơn hàng nhập.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, ImportOrder $importOrder)
    {
        $validatedData = $request->validate([
            'total' => 'required|numeric',
        ]);
        try {
            $importOrder->update($validatedData);

            return response()->json([
                'data' => new ImportOrderResource($importOrder),
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'error'   => 'Dữ liệu đầu vào không hợp lệ.',
                'message' => $e->errors(),
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'error'   => 'Lỗi khi cập nhật đơn hàng nhập.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(ImportOrder $importOrder)
    {
        try {
            $importOrder->delete();

            return response()->json([
                'message' => 'Đơn hàng nhập đã được xóa thành công.',
            ], 204);
        } catch (Exception $e) {
            return response()->json([
                'error'   => 'Lỗi khi xóa đơn hàng nhập.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
