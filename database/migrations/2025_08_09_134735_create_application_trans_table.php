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
        Schema::create('application_trans', function (Blueprint $table) {
            $table->id();
            $table->string('value', 128);
            $table->text('description');
            $table->unsignedBigInteger('application_id');
            $table->foreign('application_id')->references('id')->on('applications')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('language_name');
            $table->foreign('language_name')->references('name')->on('languages')
                ->onUpdate('cascade')
                ->onDelete('no action');
            $table->index(["language_name", "application_id"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_trans');
    }
};
