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
        Schema::create('dashboard_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('dashboard_status')->onDelete('cascade');;
            $table->string('title');
            $table->longText('text');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dashboard_items');
    }
};
