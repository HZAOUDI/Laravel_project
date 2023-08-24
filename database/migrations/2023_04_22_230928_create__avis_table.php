 <?php
/*
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   // public function up()
   // {
    //    Schema::create('_avis', function (Blueprint $table) {
     //       $table->id();
         /*   $table->timestamps();
            $table->float('score_user')->nullable();
            $table->float('score_objet')->nullable();
            $table->String('description');
            $table->String('type')->nullable();
            $table->Integer('id_profile')->nullable();
            $table->Integer('id_annonce')->nullable();
            $table->Integer('id_location')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
  //  public function down()
  //  {
  //      Schema::dropIfExists('_avis');




use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_avis', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->float('score_user')->nullable();
            $table->String('description_user');
            $table->String('description_objet');
            $table->String('type_user')->nullable();
            $table->float('score_objet')->nullable();
            $table->String('type_objet')->nullable();
            $table->Integer('id_profile')->nullable();
            $table->Integer('id_annonce')->nullable();
            $table->Integer('id_location')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_avis');
    }
}