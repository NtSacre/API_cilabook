<?php

use App\Models\Role;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
           
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('telephone')->unique();

            $table->rememberToken();
            $table->string('image')->nullable();
            $table->foreignIdFor(Role::class)->constrained()->onDelete('cascade');
            $table->boolean('is_actived')->default(true);
            $table->enum('statut',['personne','entreprise'])->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
