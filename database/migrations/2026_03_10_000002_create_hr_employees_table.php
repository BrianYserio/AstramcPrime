<?php

use App\Models\Branch;
use App\Models\Company;
use App\Models\human_resource\EmployeePosition;
use App\Models\Users\UserAccount;
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
            $table->bigInteger('row_id')->unsigned();
            $table->string('employee_id')->primary()->unique();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('email')->unique();

            // Personal Information
            $table->date('birthdate');
            $table->string('gender', 20)->nullable();
            $table->string('civil_status', 20)->nullable();
            $table->string('citizenship')->nullable();
            $table->string('contact_number', 20)->nullable();
            $table->string('address')->nullable();
            $table->string('profile_image')->nullable();

            $table->foreignIdFor(EmployeePosition::class);
            $table->foreignIdFor(Company::class);
            $table->foreignIdFor(Branch::class);

            $table->date('date_hired')->nullable();
            $table->date('date_status')->nullable();
            $table->string('emp_status')->nullable();
            $table->string('level')->nullable();
            $table->string('sub_branch')->nullable();
            $table->string('assigned_location')->nullable();

            // Leave Balances
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

            // Government IDs
            $table->string('sss', 50)->nullable();
            $table->string('tin', 50)->nullable();
            $table->string('philhealth', 50)->nullable();
            $table->string('pagibig', 50)->nullable();

            // Benefits & Controls
            $table->string('healthcare_benefits_level')->nullable();
            $table->json('custom_permissions')->nullable();
            $table->boolean('update_leaves_status')->default(false);
            $table->boolean('additional_leaves_status')->default(false);
            $table->boolean('is_active')->default(true);

            // Audit
            $table->string('prepared_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
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
