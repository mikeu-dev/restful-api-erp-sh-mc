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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('email', 80);
            $table->string('code', 30);
            $table->string('tagline', 255);
            $table->string('director', 255);
            $table->string('phone', 20);
            $table->string('logo', 20);
            $table->text('address');
            $table->integer('bank');
            $table->integer('number');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('company_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->string('key');      // nama setting
            $table->json('value');     
            $table->unique(['company_id', 'key']); // pastikan satu key per company unik
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_settings');
        Schema::dropIfExists('companies');
    }
};
