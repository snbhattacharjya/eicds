<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExternalCitizensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('external_citizens', function (Blueprint $table) {
            $table->string('aadhaar',12)->primary();
            $table->string('name');
            $table->string('mobile',10);
            $table->integer('project_id');
            $table->integer('family_id')->nullable();
            $table->integer('member_id')->nullable();
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
        Schema::dropIfExists('external_citizens');
    }
}
