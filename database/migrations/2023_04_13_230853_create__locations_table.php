<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_locations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->Date('date_debut_loc');
            $table->Date('date_fin_loc');
            $table->String('Jours');
            $table->String('Mois');
            $table->Integer('id_part')->nullable();
            $table->foreignId('id_client')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->String('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_locations');
    }
}
