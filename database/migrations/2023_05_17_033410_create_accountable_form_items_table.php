<?php

use App\Models\AccountableForm;
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
        Schema::create('accountable_form_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('accountable_form_id')->constrained()->onDelete('cascade');
            $table->float('amount');
            $table->foreignId('revenue_type_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accountable_form_items');
    }
};
