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
            Schema::dropIfExists('articles');
            Schema::create('articles', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->text('body');
                $table->unsignedBigInteger('media_id')->nullable();
                $table->foreign('media_id')->references('id')->on('media')->onDelete('set null');
                $table->foreignId('user_id')->constrained()->onDelete('cascade'); // linked to users.id
                $table->timestamps();
                $table->softDeletes();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
