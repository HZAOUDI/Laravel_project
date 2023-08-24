<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAnnonceIdToLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('_locations', function (Blueprint $table) {
        //$table->foreignId('id_annonce')->constrained('annonces')->onDelete('cascade')->onUpdate('cascade');
        $table->integer('id_annonce')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('_locations', function (Blueprint $table) {
            //
        });
    }
}
