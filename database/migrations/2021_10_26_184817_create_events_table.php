<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string("title",255);
            $table->text("description",255)->nullable();

            
            $table->dateTime("start");
            $table->dateTime("end");




            $table->bigInteger('empleado_id')->nullable();

            // $table->bigInteger('user_id')->nullable();            
            $table->bigInteger('tipoevento_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
