<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('import_order_details', function (Blueprint $table) {
            $table->id();
            $table->decimal('price', 15, 2);
            $table->integer('quantity');
            $table->unsignedBigInteger('import_order_id');
            $table->unsignedBigInteger('warehouse_id');
            $table->timestamps();

            // Foreign keys
            $table->foreign('import_order_id')->references('id')->on('import_orders')->onDelete('cascade');
            $table->foreign('warehouse_id')->references('id')->on('warehouses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('import_order_details');
    }
};
