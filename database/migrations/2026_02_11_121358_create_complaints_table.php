<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('complaints', function (Blueprint $table) {
        $table->id();
        $table->string('complaint_code')->unique();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('category_id')->constrained()->onDelete('cascade');
        $table->string('subject');
        $table->text('description');
        $table->enum('priority',['low','medium','high']);
        $table->enum('status',['pending','in_progress','resolved'])->default('pending');
        $table->string('attachment')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
