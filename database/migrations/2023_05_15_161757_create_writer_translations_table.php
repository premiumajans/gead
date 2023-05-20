<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('writer_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('writer_id')->unsigned();
            $table->string('locale')->index();
            $table->longText('name');
            $table->longText('description');
            $table->unique(['writer_id', 'locale']);
            $table->foreign('writer_id')->references('id')->on('writers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('writer_translations');
    }
};
