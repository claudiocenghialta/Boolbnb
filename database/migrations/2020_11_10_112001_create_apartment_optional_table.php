<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentOptionalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartment_optional', function (Blueprint $table) {
          $table->unsignedBigInteger('apartment_id');
          $table->foreign('apartment_id')
          ->references('id')
          ->on('apartments')
          ->onDelete('cascade')
          ->onUpdate('cascade');
          $table->unsignedBigInteger('optional_id');
          $table->foreign('optional_id')
          ->references('id')
          ->on('optionals')
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
        Schema::dropIfExists('apartment_optional');
    }
}
