<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewBornDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_born_details', function (Blueprint $table) {
            $table->integer('family_id');
            $table->integer('mother_id');
            $table->integer('child_id');
            $table->string('mode_of_delivery');
            $table->string('delivery_location_type');
            $table->string('delivery_location_name');
            $table->string('village_town_name');
            $table->string('birth_status',5);
            $table->string('gender',1);
            $table->float('first_weight');
            $table->date('first_weight_date');
            $table->timestamps();
        });

        Schema::table('new_born_details', function (Blueprint $table) {
            $table->primary('child_id');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('new_born_details');
    }
}
