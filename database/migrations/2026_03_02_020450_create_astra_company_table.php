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
        Schema::create('astra_company', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->id('row_id'); // Primary Key

            $table->string('company_id')->unique(); // Custom company ID
            $table->string('company_name');
            $table->string('code')->nullable();

            $table->text('caddress')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('contact_email')->nullable();

            $table->enum('type', ['Internal Account', 'External Account'])->default('Internal Account');

            $table->string('tin')->nullable();
            $table->string('contact_person')->nullable();

            $table->enum('isActive', ['Yes', 'No'])->default('Yes');
            $table->softDeletes('deleted_at', precision: 0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('astra_company');
    }
};
