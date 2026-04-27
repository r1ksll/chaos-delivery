<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('courier_id')->nullable()->constrained()->onDelete('set null');
            $table->decimal('total_price', 10, 2);
            $table->enum('status', ['активный', 'доставлен', 'отменён'])->default('активный');
            $table->string('delivery_time');
            $table->string('address');
            $table->string('entrance')->nullable();
            $table->string('apartment')->nullable();
            $table->string('floor')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};