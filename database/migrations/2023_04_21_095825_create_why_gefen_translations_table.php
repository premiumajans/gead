<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('why_gefen_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('why_gefen_id')->unsigned();
            $table->string('locale')->index();
            $table->longText('description');
            $table->unique(['why_gefen_id', 'locale']);
            $table->foreign('why_gefen_id')->references('id')->on('why_gefens')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('why_gefen_translations');
    }
};
