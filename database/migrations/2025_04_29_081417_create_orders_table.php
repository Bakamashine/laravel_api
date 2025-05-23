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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer("count")->nullable();
            $table->foreignId("work_shift_user_id")
                ->constrained("work_shift_users")
                ->cascadeOnDelete();
            $table->foreignId("table_id")
                ->constrained("tables")
                ->cascadeOnDelete();
            $table->string("status")->default("Принят");
            // $table->foreignId("work_shift_id")
            //     ->nullable()
            //     ->constrained("work_shifts")
            //     ->cascadeOnDelete();
            
            $table->morphs("work_shift");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
