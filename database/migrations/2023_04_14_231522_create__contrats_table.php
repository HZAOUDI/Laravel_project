<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_contrats', function (Blueprint $table) {
            // this is subjected to change in the future
            $table->id();
            $table->timestamps();
            $table->String('filename');
            $table->foreignId('id_partenaire')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_client')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_ann')->constrained('annonces')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_contrats');
    }
}
