<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new  class extends Migration {
    public function up(): void
    {
        Schema::create('use_ful_links', function (Blueprint $table) {
            $table->id();
            $table->longText('photo');
            $table->longText('link')->nullable();
            $table->boolean('status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('use_ful_links');
    }
};
