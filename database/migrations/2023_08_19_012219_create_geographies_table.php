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
        Schema::create('geographies', function (Blueprint $table) {
            $table->id();
            // psgccode	name	level	region	province	municipality	islandgroup

            $table->string('code')->unique();
            $table->string('name');
            $table->integer('level')->comment('1-Barangay, 2-SubMunicipality, 3-Municipality, 4-City, 5-Province, 6-District, 7-Region');
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('region')->nullable();
            $table->integer('island_group')->comment('1-Luzon, 2-Visayas, 3-Mindanao');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('geographies');
    }
};
