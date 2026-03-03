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
        Schema::create('hr_employee_position', function (Blueprint $table) {
            $table->id('row_id');
            $table->string('position_description');
            $table->enum('isActive', ['Yes', 'No'])->default('Yes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hr_employee_position');
    }
};
