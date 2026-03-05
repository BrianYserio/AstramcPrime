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
        Schema::create('user_accounts', function (Blueprint $table) {
            $table->id(); // Primary key (id)

            $table->string('user_id')->unique();   // Custom system ID
            $table->string('username')->unique();
            $table->string('password');            // Should always be hashed
            $table->string('api_token');

            $table->string('role')->nullable();
            $table->string('prepared_by')->nullable();

            $table->boolean('is_active')->default(true);
            $table->softDeletes('deleted_at', precision: 0);
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
