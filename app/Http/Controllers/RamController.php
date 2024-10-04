<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\RamResource;
use App\Models\Ram;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class RamController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $ram = Ram::get();

            return response()->json(RamResource::collection($ram), 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        $validateData = $request->validate([
            'ram' => 'required|unique:rams',
        ]);
        try {
            $ram = Ram::create($validateData);

            return response()->json([
                'ram' => new RamResource($ram),
            ], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, Ram $ram): JsonResponse
    {
        $validateData = $request->validate([
            'ram' => 'required|unique:rams,ram,' . $ram->id,
        ]);
        try {

            $ram->update($validateData);

            return response()->json([
                'ram' => new RamResource($ram),
            ], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy(Ram $ram): JsonResponse
    {
        try {
            $ram->delete();

            return response()->json(['message' => 'Ram deleted successfully'], 204);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
