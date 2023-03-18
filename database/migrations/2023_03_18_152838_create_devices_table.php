<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        /** Ep23
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('brand');
            $table->string('resolution');
            $table->timestamps();
            $table->rawIndex('(naturalsort(name))', 'name_sort_index');
        });
         */
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        /** Ep23
        Schema::dropIfExists('devices');
         *
         */
    }
};
