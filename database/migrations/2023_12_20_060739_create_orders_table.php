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
            $table->bigInteger("number");
            $table->json("products");
            $table->string("destination");
            $table->string("city");
            $table->string("state");
            $table->string("lat");
            $table->string("lng");
            $table->string("buyer_name");
            $table->string("buyer_phone");
            $table->string('buyer_email');
            $table->string("street");
            $table->enum("status", ["not_delivered", "delivered", "pending_delivery"])->default("not_delivered");
            $table->foreignId("delivery_id")->nullable()->constrained("deliveries", "id")->onDelete('cascade');
            $table->timestamps();
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
