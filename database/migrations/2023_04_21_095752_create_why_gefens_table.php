<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('why_gefens', function (Blueprint $table) {
            $table->id();
            $table->longText('photo_1');
            $table->longText('photo_2');
            $table->longText('photo_3');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('why_gefens');
    }
};
