<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnganwadiCentresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anganwadi_centres', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sector_id');
            $table->string('centre_code',50)->unique();
            $table->string('centre_name',50);
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
        Schema::dropIfExists('anganwadi_centres');
    }
}
