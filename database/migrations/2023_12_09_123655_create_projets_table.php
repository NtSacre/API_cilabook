<?php

use App\Models\Categorie;
use App\Models\User;
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
        Schema::create('projets', function (Blueprint $table) {
            $table->id();
            $table->string('titre'); 
            $table->string('description');
            $table->string('image');
            $table->enum('statut',['finance', 'pas_finance'])->default('pas_finance');
            $table->boolean('is_deleted')->default(false);
            $table->foreignIdFor(Categorie::class)->nullable()->constrained()->onDelete('set null');;
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');





            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projets');
    }
};
