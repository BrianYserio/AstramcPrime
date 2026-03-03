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
        Schema::create('hr_employees', function (Blueprint $table) {
            $table->id();

            // 🔐 Identity
            $table->string('employee_id')->unique();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('email')->unique();

            // 👤 Personal Information
            $table->date('birthdate');
            $table->string('gender', 20)->nullable();
            $table->string('civil_status', 20)->nullable();
            $table->string('citizenship')->nullable();
            $table->string('contact_number', 20)->nullable();
            $table->string('address')->nullable();
            $table->string('profile_image')->nullable();
            // 🏢 Employment Details
            $table->date('date_hired')->nullable();
            $table->date('date_status')->nullable();
            $table->string('position')->index()->nullable();
            $table->string('emp_status')->nullable();
            // If you have astra_companies table:
            $table->string('company')->nullable();
            $table->string('level')->nullable();
            $table->string('branch')->nullable();
            $table->string('sub_branch')->nullable();
            $table->string('assigned_location')->nullable();

            // 🏖 Leave Balances (precision added)
            $table->decimal('previous_year_remaining_vl', 8, 2)->default(0);
            $table->decimal('carry_over_vl', 8, 2)->default(0);
            $table->decimal('vl_balance', 8, 2)->default(0);
            $table->decimal('sl_balance', 8, 2)->default(0);
            $table->decimal('bl_balance', 8, 2)->default(0);
            $table->decimal('el_balance', 8, 2)->default(0);
            $table->decimal('ml_balance', 8, 2)->default(0);
            $table->decimal('pl_balance', 8, 2)->default(0);
            $table->decimal('spl_balance', 8, 2)->default(0);

            $table->decimal('paid_vl', 8, 2)->default(0);

            // 🏦 Government Numbers
            $table->string('pagibig', 50)->nullable();
            $table->string('philhealth', 50)->nullable();
            $table->string('sss', 50)->nullable();
            $table->string('tin', 50)->nullable();

            // 🔑 System Controls
            $table->json('custom_permissions')->nullable();
            $table->boolean('update_leaves_status')->default(false);
            $table->boolean('additional_leaves_status')->default(false);
            $table->boolean('is_active')->default(true);

            $table->string('healthcare_benefits_level')->nullable();

            $table->string('prepared_by')->nullable();
            $table->softDeletes('deleted_at', precision: 0);
            $table->timestamps(); // includes created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hr_employees');
    }
};
