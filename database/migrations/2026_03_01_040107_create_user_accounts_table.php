<?php

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
            $table->id('id'); // Primary key (id)

            $table->string('user_id')->unique();   // Custom system ID
            $table->string('username')->unique();
            $table->string('password');            // Should always be hashed
            $table->string('api_token');
    
            $table->foreignIdFor(UserRole::class)->constrained()->cascadeOnDelete();
            $table->string('prepared_by')->nullable();

            $table->boolean('is_active')->default(true);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_role_id')
                ->references('id')
                ->on('user_roles')
                ->cascadeOnDelete();
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
