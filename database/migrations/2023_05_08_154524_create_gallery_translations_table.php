<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gallery_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gallery_id')->unsigned();
            $table->string('locale')->index();
            $table->longText('name');
            $table->unique(['gallery_id', 'locale']);
            $table->foreign('gallery_id')->references('id')->on('galleries')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gallery_translations');
    }
};
