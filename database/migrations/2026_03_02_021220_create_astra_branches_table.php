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
        Schema::create('astra_branches', function (Blueprint $table) {
            $table->id('row_id');
            $table->string('branch_id');
            $table->string('branch_name');
            $table->enum('isActive', ['Yes', 'No'])->default('Yes');
            $table->enum('bytype', ['Department', 'Branch', 'Sub-department'])->default('Department');
            $table->softDeletes('deleted_at', precision: 0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('astra_branches');
    }
};
