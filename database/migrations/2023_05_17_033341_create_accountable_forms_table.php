<?php

use App\Models\AccountableFormType;
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
        Schema::create('accountable_forms', function (Blueprint $table) {
            $table->id();
            // $table->foreignId()
            $table->foreignId('accountable_form_type_id')->constrained()->onDelete('cascade');
            $table->integer('accountable_form_number');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('form_date')->nullable();
            $table->string('payor')->nullable();
            $table->integer('use_status')->default('1');
            $table->integer('accounting_status')->nullable();
            
            $table->timestamps();
            // $table->primary(['accountable_form_type_id', 'accountable_form_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accountable_forms');
    }
};
