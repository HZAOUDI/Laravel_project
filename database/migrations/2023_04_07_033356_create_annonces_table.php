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
        Schema::create('annonces', function (Blueprint $table) {
            $table->id();
            $table->String('image')->nullable();;
            $table->timestamps();
            $table->String('Nom');
            $table->String('Description');
            $table->String('Marque')->nullable();
            $table->String('Categorie')->nullable();
            $table->String('Objet')->nullable();
            $table->BigInteger('Prix')->nullable();
            $table->integer('Num_jour_min')->nullable();
            $table->String('Ville')->nullable();
            $table->date('date_dispo_debut')->nullable();
            $table->date('date_dispo_fin')->nullable();
            $table->string('status')->nullable();
            $table->string('type')->nullable();
            $table->string('is_visible')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annonces');
    }
};
