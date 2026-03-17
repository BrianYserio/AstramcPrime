<?php

use App\Models\Branch;
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
        Schema::create('user_account_branch', function (Blueprint $table) {
            $table->id('row_id');
            // Foreign Key for the User
            $table->string('id')->nullable();
            $table->string('company');
            // Foreign Key for the Branch
            $table->string('branch');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_account_branch');
    }
};
