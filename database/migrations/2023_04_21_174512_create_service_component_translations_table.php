<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('service_component_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sc_id')->unsigned();
            $table->string('locale')->index();
            $table->longText('name');
            $table->unique(['sc_id', 'locale']);
            $table->foreign('sc_id')->references('id')->on('why_gefens')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_component_translations');
    }
};
