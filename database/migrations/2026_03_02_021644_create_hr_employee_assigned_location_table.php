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
        Schema::create('hr_employee_assigned_location', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('isActive')->default(true);
            $table->timestamps();
            $table->softDeletes('deleted_at', precision: 0);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hr_employee_assigned_location');
    }
};
