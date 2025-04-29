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
        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            $table->foreignId("order_id")
                ->constrained("orders")
                ->cascadeOnDelete();
            $table->integer("count")->default(0);
            $table->integer("price")->default(0);
            $table->string("position")->default("Ut similique dolorum cos culpa officis");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('positions');
    }
};
