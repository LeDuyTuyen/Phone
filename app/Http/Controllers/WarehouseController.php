<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\WarehouseResource;
use App\Models\Warehouse;
use Exception;
use Illuminate\Http\Request;

final class WarehouseController extends Controller
{
    public function index()
    {
        try {

            $warehouses = Warehouse::with(['color', 'ram', 'storage', 'product'])->get();

            return response()->json(WarehouseResource::collection($warehouses)->resolve());
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $warehouse = Warehouse::create([
                'product_id' => $request->product,
                'ram_id'     => $request->ram,
                'color_id'   => $request->color,
                'storage_id' => $request->storage,
                'price'      => $request->price,
            ]);

            return response()->json(
                [
                    'message'   => 'Warehouse created successfully',
                    'warehouse' => new WarehouseResource($warehouse)],
                201
            );
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, Warehouse $warehouse)
    {
        try {
            // dd($request->toArray());
            $data = [
                'product_id' => is_array($request->product) ? ($request->product['id'] ?? null) : $request->product,
                'ram_id'     => is_array($request->ram) ? ($request->ram['id'] ?? null) : $request->ram,
                'color_id'   => is_array($request->color) ? ($request->color['id'] ?? null) : $request->color,
                'storage_id' => is_array($request->storage) ? ($request->storage['id'] ?? null) : $request->storage,
                'price'      => $request->price,
            ];
            
            $warehouse->update($data);

            return response()->json(
                [
                    'message'   => 'Warehouse created successfully',
                    'warehouse' => new WarehouseResource($warehouse)],
                200
            );
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy(Warehouse $warehouse)
    {
        try {
            $warehouse->delete();

            return response()->json(['message' => 'Warehouse deleted successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
