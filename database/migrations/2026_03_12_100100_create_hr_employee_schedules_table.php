<?php

use App\Models\human_resource\Employee;
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
        Schema::create('hr_employee_schedules', function (Blueprint $table) {
            $table->id('row_id');
            $table->foreignIdFor(Employee::class, 'employee_id');
            $table->time('monday_in')->nullable();
            $table->time('monday_out')->nullable();
            $table->time('tuesday_in')->nullable();
            $table->time('tuesday_out')->nullable();
            $table->time('wednesday_in')->nullable();
            $table->time('wednesday_out')->nullable();
            $table->time('thursday_in')->nullable();
            $table->time('thursday_out')->nullable();
            $table->time('friday_in')->nullable();
            $table->time('friday_out')->nullable();
            $table->time('saturday_in')->nullable();
            $table->time('saturday_out')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hr_employee_schedules');
    }
};
