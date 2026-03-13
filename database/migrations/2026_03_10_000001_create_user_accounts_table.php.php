<?php

use App\Models\human_resource\Employee;
use App\Models\Users\UserRole;
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
        Schema::create('user_accounts', function (Blueprint $table) {
            $table->id('row_id');

            // Identity & Auth
            $table->foreignIdFor(Employee::class, 'user_id'); // Your custom system ID
            $table->string('username')->unique();
            $table->string('password');            // Ensure this is hashed in your Controller/Observer
            $table->string('api_token', 80)->unique()->nullable();

            // Relationships
            // In user_accounts migration
            $table->foreignIdFor(UserRole::class, 'role_id');

            $table->string('prepared_by')->nullable();

            // Status & Housekeeping
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_accounts');
    }
};
