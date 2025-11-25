<?php

use App\Modules\Religion\Model\Religion;
use App\Modules\User\Model\User;
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
        Schema::create('biodatas', function (Blueprint $table) {
            $table->id();
            // Foreign key ke table users
            $table->foreignIdFor(User::class, 'user_id')
                ->constrained()
                ->onDelete('cascade');

            // Foreign key ke table religions
            $table->foreignIdFor(Religion::class, 'religion_id')
                ->constrained()
                ->onDelete('restrict');

            $table->string('name', 80);
            $table->string('phone', 30);
            $table->string('pob', 80); // place of birth
            $table->date('dob'); // date of birth
            $table->enum('gender', ['male', 'female'])
                ->comment('Only choose male or female');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biodatas');
    }
};
