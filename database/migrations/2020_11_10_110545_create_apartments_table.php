<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('titolo');
            $table->text('descrizione');
            $table->string('slug')->unique();
            $table->tinyInteger('numero_stanze')->unsigned();
            $table->tinyInteger('numero_letti')->unsigned();
            $table->tinyInteger('numero_bagni')->unsigned();
            $table->smallInteger('mq')->unsigned()->nullable();
            $table->text('indirizzo');
            $table->boolean('attivo')->default(true);
            $table->integer('numero_visite')->unsigned()->default(0);
            $table->decimal('lat',9,6);
            $table->decimal('lng',9,6);
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartments');
    }
}
