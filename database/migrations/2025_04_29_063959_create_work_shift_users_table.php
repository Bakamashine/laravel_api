<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('work_shift_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")
                ->nullable()
                // ->unique()
                ->constrained("users")
                ->cascadeOnDelete();
            $table->foreignId("work_shift_id")->nullable()->constrained("work_shifts")->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_shift_users');
    }
};
