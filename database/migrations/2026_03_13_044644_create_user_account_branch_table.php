<?php

use App\Models\Branch;
use App\Models\Company;
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
            $table->foreignIdFor(UserAccount::class, 'user_id');
            $table->foreignIdFor(Company::class, 'company_id');
            $table->foreignIdFor(Branch::class, 'branch_id');
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
