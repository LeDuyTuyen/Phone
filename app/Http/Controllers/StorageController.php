<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Storage;
use Exception;
use Illuminate\Http\Request;

final class StorageController extends Controller
{
    public function index()
    {
        try {
            $storages = Storage::all();

            return response()->json($storages, 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $storages = Storage::create($request->all());

            return response()->json($storages, 201);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $storages = Storage::findOrFail($id);

            $storages->update($request->all());

            return response()->json($storages, 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            Storage::findOrFail($id)->delete();

            return response()->json(['message' => 'Storage deleted successfully'], 204);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
