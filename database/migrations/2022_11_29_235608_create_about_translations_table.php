<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('about_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('about_id')->unsigned();
            $table->string('locale')->index();
            $table->longText('description');
            $table->unique(['about_id', 'locale']);
            $table->foreign('about_id')->references('id')->on('abouts')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('about_translations');
    }
};
