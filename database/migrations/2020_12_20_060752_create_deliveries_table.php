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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId("driver_id")->nullable()->constrained("users", "id")->onDelete("set null");
            $table->foreignId("truck_id")->nullable()->constrained("trucks")->onDelete("set null");
            $table->enum("status", ["pending", "receipt"]);
            $table->string("truck_dashboard")->nullable();
            $table->string("delivered_products")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
