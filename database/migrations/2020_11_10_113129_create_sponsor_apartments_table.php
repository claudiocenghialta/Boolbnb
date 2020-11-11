<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSponsorApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsor_apartments', function (Blueprint $table) {
            $table->id();
            $table->dateTime('data_inizio');
            $table->dateTime('data_fine');
            $table->unsignedBigInteger('sponsor_id');
            $table->foreign('sponsor_id')
            ->references('id')
            ->on('sponsors')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->unsignedBigInteger('apartment_id');
            $table->foreign('apartment_id')
            ->references('id')
            ->on('apartments')
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
        Schema::dropIfExists('sponsor_apartments');
    }
}
