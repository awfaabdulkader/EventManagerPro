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
        Schema::create('form_tickets', function (Blueprint $table) {
            $table->id();
            $table->enum('civility',['Madame', 'Monsieur']);
            $table->string('firstName');
            $table->string('lastName');
            $table->string('organization')->nullable();
            $table->string('email')->unique();
            $table->string('phone');
            $table->enum('job', ['Architecture', 'Civil Engineering', 'BTP',  'Architecture d-interieur', 'Urban Planning']);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_tickets');
    }
};
