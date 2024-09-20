<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Ram;
use Exception;
use Illuminate\Http\Request;

final class RamController extends Controller
{
    public function index()
    {
        try {
            $rams = Ram::all();

            return response()->json($rams, 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $rams = Ram::create($request->all());

            return response()->json($rams, 201);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $rams = Ram::findOrFail($id);

            $rams->update($request->all());

            return response()->json($rams, 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            Ram::findOrFail($id)->delete();

            return response()->json(['message' => 'Ram deleted successfully'], 204);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}