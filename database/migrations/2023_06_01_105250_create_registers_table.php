<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('registers', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('content_id')->unsigned();
            $table->longText('name');
            $table->longText('surname');
            $table->longText('education');
            $table->longText('work');
            $table->longText('email');
            $table->longText('phone');
            $table->boolean('read_status')->default(0);
            $table->foreign('content_id')
                ->references('id')
                ->on('contents')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registers');
    }
};
