<?php

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
        Schema::create('user_account_branchs', function (Blueprint $table) {
            $table->id('row_id');
            $table->foreignIdFor(UserAccount::class)->constrained()->cascadeOnDelete();
            $table->string('company');
            $table->string('branch');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_account_branchs');
    }
};
