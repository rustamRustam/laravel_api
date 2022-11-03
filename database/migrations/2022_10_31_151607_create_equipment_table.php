<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->unsignedInteger('id_type');

            $table->string('serial_number',255);
            $table->string('desc',255)->nullable(); // Допускается Null

            $table->foreign('id_type')->references('id')->on('equipment_type'); // внешний ключ
            $table->timestamps(); // method creates created_at and updated_at
            $table->softDeletes(); // мягкое удаление

            $table->unique(['serial_number','id_type']); // уникальность
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipment');
    }
}
