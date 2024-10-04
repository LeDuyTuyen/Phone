<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Filters\ColorFilter;
use App\Http\Resources\ColorResource;
use App\Models\Color;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class ColorController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            $filters = new ColorFilter($request);

            $color = Color::filter($filters)->get();

            return response()->json(ColorResource::collection($color), 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        $validateData = $request->validate([
            'name' => 'required|unique:colors',
            'code' => 'required',
        ]);
        try {
            $color = Color::create($validateData);

            return response()->json([
                'color' => new ColorResource($color),
            ], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, Color $color): JsonResponse
    {
        $validateData = $request->validate([
            'name' => 'required|unique:colors,name,' . $color->id,
            'code' => 'required',
        ]);
        try {

            $color->update($validateData);

            return response()->json([
                'color' => new ColorResource($color),
            ], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy(Color $color): JsonResponse
    {
        try {
            $color->delete();

            return response()->json(['message' => 'Color deleted successfully'], 204);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
