<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\ImportOrderDetails;
use Illuminate\Http\Request;

final class ImportOrderDetailsController extends Controller
{
    public function index()
    {
        // Fetch all import order details
        return response()->json([
            'data' => ImportOrderDetails::with(['importOrder', 'wareHouse'])->get(),
        ]);
    }

    public function store(Request $request)
    {
        // Validate and store a new import order detail
        $validated = $request->validate([
            'price'           => 'required|numeric',
            'quantity'        => 'required|integer',
            'import_order_id' => 'required|exists:import_orders,id',
            'warehouse_id'    => 'required|exists:warehouses,id',
        ]);

        $importOrderDetail = ImportOrderDetails::create($validated);

        return response()->json([
            'data' => $importOrderDetail,
        ]);
    }

    public function update(Request $request, ImportOrderDetails $importOrderDetail)
    {
        // Validate and update an existing import order detail
        $validated = $request->validate([
            'price'           => 'required|numeric',
            'quantity'        => 'required|integer',
            'import_order_id' => 'required|exists:import_orders,id',
            'warehouse_id'    => 'required|exists:warehouses,id',
        ]);

        $importOrderDetail->update($validated);

        return response()->json([
            'data' => $importOrderDetail,
        ]);
    }

    public function destroy(ImportOrderDetails $importOrderDetail)
    {
        // Delete an import order detail
        $importOrderDetail->delete();

        return response()->json([
            'message' => 'Import order detail deleted successfully',
        ]);
    }
}
