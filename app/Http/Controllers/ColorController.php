<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Color;
use Exception;
use Illuminate\Http\Request;

final class ColorController extends Controller
{
    public function index()
    {
        try {
            $colors = Color::all();

            return response()->json($colors, 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $colors = Color::create($request->all());

            return response()->json($colors, 201);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $colors = Color::findOrFail($id);

            $colors->update($request->all());

            return response()->json($colors, 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            Color::findOrFail($id)->delete();

            return response()->json(['message' => 'Color deleted successfully'], 204);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
