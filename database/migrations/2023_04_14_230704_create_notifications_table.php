<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->String('contenu');
            $table->String('type');
            $table->Integer('id_loca')->nullable(); // for client id and partenaire id
            $table->integer('id_ann')->nullable(); // for the link to annonce
            //$table->integer('id_profil')->nullable(); for there is no need we can go to /profile
            $table->String('lue');
            $table->integer('id_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
