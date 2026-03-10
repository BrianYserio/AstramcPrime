<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ir_shipment_registry_units', function (Blueprint $table) {
            $table->id('row_id'); // primary key

            $table->string('shipment_id'); // potential foreign key
            $table->string('supplier_id'); // potential foreign key
            $table->enum('importer_type', ['Local', 'Import'])->default('Import');

            $table->string('so_id'); // potential foreign key
            $table->string('pi_no'); // potential foreign key

            $table->string('make');
            $table->string('body');
            $table->string('cabin');
            $table->string('horse_power');
            $table->string('wheels');
            $table->string('chassis_no'); // fixed typo
            $table->string('engine_no');

            $table->string('remarks')->nullable();
            $table->string('shipment_tag')->nullable();

            $table->boolean('is_active')->default(true);
            $table->enum('rr_status', ['Pending', 'Completed'])->default('Pending');

            $table->timestamps();

            // Optional: Add foreign keys if referenced tables exist
            // $table->foreign('shipment_id')->references('id')->on('shipments')->onDelete('cascade');
            // $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            // $table->foreign('so_id')->references('id')->on('sales_orders')->onDelete('cascade');
            // $table->foreign('pi_no')->references('id')->on('purchase_invoices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ir_shipment_registry_units');
    }
};
