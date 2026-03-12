<?php

use App\Models\Branch;
use App\Models\Company;
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
       Schema::create('wh_unit_management', function (Blueprint $table) {
            $table->bigInteger('row_id')->unsigned();
            $table->string('unit_id')->primary();
            $table->string('body_type');
            $table->string('horse_type');
            $table->string('cabin_type');
            $table->string('engine_series')->nullable();
            $table->string('make');
            $table->string('unit_type');
            $table->string('sub_unit_type')->nullable();
            $table->string('num_wheels');
            $table->string('icondition');
            $table->decimal('uprice', 12, 2)->nullable();
            $table->decimal('gvw', 12, 2);
            $table->string('remarks')->nullable();;
            $table->string('prepared_by'); // employee id

            $table->foreignIdFor(Company::class);

            $table->foreignIdFor(Branch::class);

            $table->boolean('is_active')->default(true);
            $table->decimal('promo_price', 12, 2)->nullable();
            $table->boolean('visible')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wh_unit_management');
    }
};
