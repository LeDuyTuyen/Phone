<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\StorageResource;
use App\Models\Storage;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class StorageController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $storage = Storage::get();

            return response()->json(StorageResource::collection($storage), 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        $validateData = $request->validate([
            'storage' => 'required|unique:storages',
        ]);
        try {
            $storage = Storage::create($validateData);

            return response()->json([
                'storage' => new StorageResource($storage),
            ], 201);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, Storage $storage): JsonResponse
    {
        $validateData = $request->validate([
            'storage' => 'required|unique:storages,storage,' . $storage->id,
        ]);
        try {

            $storage->update($validateData);

            return response()->json([
                'storage' => new StorageResource($storage),
            ], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy(Storage $storage): JsonResponse
    {
        try {
            $storage->delete();

            return response()->json(['message' => 'Storage deleted successfully'], 204);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
